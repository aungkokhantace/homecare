<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 8/11/2016
 * Time: 10:52 AM
 */
namespace App\Backend\Packagesale;

use App\Backend\Patient\PatientRepository;
use App\Backend\Zone\ZoneRepository;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use App\Backend\Invoice\Invoice;

class PackageSaleRepository implements PackageSaleRepositoryInterface
{
    public function getArrays()
    {
        $tbName = (new Packagesale())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }

    public function getObjs()
    {
        $objs = Packagesale::whereNull('deleted_at')->get();
        return $objs;
    }

    public function create($paramObj, $invoiceObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            DB::beginTransaction();

            $tempPackageSaleObj = Utility::addCreatedBy($paramObj);
            $tempInvoiceObj = Utility::addCreatedBy($invoiceObj);

            //start generating patient_package_id
            $prefix = Utility::getTerminalId();
            $table = (new Packagesale())->getTable();
            $col = "id";
            $offset = 1;
            $packageSaleId = Utility::generatedId($prefix,$table,$col,$offset);
            $tempPackageSaleObj->id = $packageSaleId;
            //end generating patient_package_id

            //start generating invoice_id
            $prefix = Utility::getTerminalId();
            $table = (new Invoice())->getTable();
            $col = "id";
            $offset = 1;
            $invoiceId = Utility::generatedId($prefix,$table,$col,$offset);

            $tempInvoiceObj->id = $invoiceId;
            //end generating invoice_id

            if($tempPackageSaleObj->save()){                    //Package Sale obj is successfully saved
                $package_id = $tempPackageSaleObj->package_id;  //extract package_id from Package Sale obj to get services of that package

                $services = DB::table('package_detail')->select('service_id')->where('package_id', '=', $package_id)->get();

                //after getting services, insert into patient_package_detail table
                if(isset($services) && count($services)>0){
                    foreach($services as $service_id){
                        DB::table('patient_package_detail')->insert([
//                            ['patient_package_id' => $package_id, 'service_id' => $service_id->service_id]
                            ['patient_package_id' => $tempPackageSaleObj->id, 'service_id' => $service_id->service_id]
                        ]);
                    }
                }

                //start invoice section
                $patient_package_id = $tempPackageSaleObj->id;                  //get id from "patient_package" table
                $tempInvoiceObj->patient_package_id = $patient_package_id;      //bind that id to "patient_package_id" of Invoice obj

                $patientRepo = new PatientRepository();
                $zone_id = $patientRepo->getZoneId($tempPackageSaleObj->patient_id);  //get zone_id from patient id of package sale obj
                $township_id = $patientRepo->getTownshipId($tempPackageSaleObj->patient_id);  //get zone_id from patient id of package sale obj

//            if($zone_id == 0){                                                    //if zone_id is zero; i.e. township_id of that patient is a township with no zone
//                $zone_price = 0.0;                                                //set zone_price to zero
//            }
//            else{
//                $zoneRepo = new ZoneRepository();                                 //if there is zone_id,
//                $zone_price = $zoneRepo->getZonePrice($zone_id);                  //get zone_price via that zone_id
//            }

                $tempInvoiceObj->township_id = $township_id;                            //bind township_id to tempInvoiceObj
                $tempInvoiceObj->zone_id = $zone_id;                                   //bind zone_id to tempInvoiceObj
//            $tempInvoiceObj->zone_price = $zone_price;
                if($tempInvoiceObj->save()){                                    //Invoice obj is successfully saved
                    DB::commit();

                    //create info log
                    $date = $tempPackageSaleObj->created_at;
                    $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created package_sale_id = '.$tempPackageSaleObj->id . PHP_EOL;
                    LogCustom::create($date,$message);
                    //create info log
                    $date = $tempInvoiceObj->created_at;
                    $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created invoice_id = '.$tempInvoiceObj->id . PHP_EOL;
                    LogCustom::create($date,$message);

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                    $returnedObj['invoice_id'] = $invoiceId;
                    return $returnedObj;
                }
                else{
                    DB::rollBack();

                    //create error log
                    $date    = date("Y-m-d H:i:s");
                    $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created an invoice and got error'. PHP_EOL;
                    LogCustom::create($date,$message);

                    return $returnedObj;
                }
            }
            else{
                DB::rollBack();

                //create error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a package_sale and got error'. PHP_EOL;
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a package_sale/invoice and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function getObjByID($id){
        $result = Packagesale::find($id);
        return $result;
    }

    public function getObjByPatientId($id)
    {
        $result = Packagesale::where('patient_id',$id)
            ->groupBy('package_id')
            ->get();
        return $result;
    }

    public function getPackageName($package_id)
    {
        $result = Packagesale::where('package_id',$package_id)->value('name');
        return $result;
    }

    public function createSchedule($id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $tempObj = Packagesale::find($id);
        if(isset($tempObj) && count($tempObj)>0){

            $tempObj = Utility::addUpdatedBy($tempObj);
            $tempUsageCount = $tempObj->package_usage_count;
            $tempUsedCount = $tempObj->package_used_count;

            if($tempUsedCount == $tempUsageCount){
                return $returnedObj;
            }
            $tempObj->package_used_count = $tempUsedCount + 1;

            if($tempObj->save()){

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                return $returnedObj;
            }
        }
        else{
            return $returnedObj;
        }
    }

    public function getDetails($patient_package_id)
    {
        $arr = DB::select("SELECT * FROM patient_package_detail WHERE patient_package_id = '$patient_package_id'");
        return $arr;
    }
}