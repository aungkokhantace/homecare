<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 7/26/2016
 * Time: 4:50 PM
 */

namespace App\Api\Package;


use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Patient\PatientRepository;
use App\Backend\Zone\ZoneRepository;

class PackageApiRepository implements PackageApiRepositoryInterface
{
    
    public function getArrays()
    {
        $tempObj    = DB::select("SELECT * FROM patient_package WHERE deleted_at is null");
        $detailObj  = DB::select("SELECT * FROM patient_package_detail ");

        foreach($tempObj as $key => $obj){
            $package_id = $obj->id;
            foreach($detailObj as $detail => $package){
                if($package_id == $package->patient_package_id){
                    $tempObj[$key]->package_detail = $package;
                }
            }
        }
        return $tempObj;
    }

    public function create($paramObj, $invoiceObj)
    {
    	$returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        DB::beginTransaction();

        $tempPackageSaleObj = Utility::addCreatedBy($paramObj);
        $tempInvoiceObj = Utility::addCreatedBy($invoiceObj);

        //start generating invoice_id
        $table_name = Utility::getTable($tempInvoiceObj);                                                         //get table name of current obj
        $invoiceId = Utility::generateKey($prefix = "inv",$table_name,$col = "id",$offset = 1, $pad_length = 10); //Parameters::($prefix,$table,$col,$offset,$pad_length)
        $tempInvoiceObj->id = $invoiceId;
        //end generating invoice_id

        if($tempPackageSaleObj->save()){                    //Package Sale obj is successfully saved
            $package_id = $tempPackageSaleObj->package_id;  //extract package_id from Package Sale obj to get services of that package

            $services = DB::table('package_detail')->select('service_id')->where('package_id', '=', $package_id)->get();

            //after getting services, insert into patient_package_detail table
            if(isset($services) && count($services)>0){
                foreach($services as $service_id){
                    DB::table('patient_package_detail')->insert([
                        ['patient_package_id' => $package_id, 'service_id' => $service_id->service_id]
                    ]);
                }
            }

            //start invoice section
            $patient_package_id = $tempPackageSaleObj->id;                  //get id from "patient_package" table
            $tempInvoiceObj->patient_package_id = $patient_package_id;      //bind that id to "patient_package_id" of Invoice obj

            $patientRepo = new PatientRepository();
            $zone_id = $patientRepo->getZoneId($tempPackageSaleObj->patient_id);  //get zone_id from patient id of package sale obj
            
            if($zone_id == 0){                                                    //if zone_id is zero; i.e. township_id of that patient is a township with no zone
                $zone_price = 0.0;                                                //set zone_price to zero
            }
            else{
                $zoneRepo = new ZoneRepository();                                 //if there is zone_id,
                $zone_price = $zoneRepo->getZonePrice($zone_id);                  //get zone_price via that zone_id
            }

            $tempInvoiceObj->zone_id = $zone_id;                                   //bind those zone_id and zone_price to tempInvoiceObj
            $tempInvoiceObj->zone_price = $zone_price;
            if($tempInvoiceObj->save()){                                    //Invoice obj is successfully saved
                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                $returnedObj['invoice_id'] = $invoiceId;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        else{
            DB::rollBack();
            return $returnedObj;
        }
    }
   
    
}