<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/22/2016
 * Time: 4:14 PM
 */

namespace App\Backend\Package;
use App\Backend\Packagedetail\Packagedetail;
use App\Backend\Service\ServiceRepository;
use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;

class PackageRepository implements PackageRepositoryInterface
{
    public function getObjs()
    {
        $objs = Package::whereNull('deleted_at')->get();
        return $objs;
    }

    public function create($paramObj,$childArray)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            DB::beginTransaction();
            $tempObj = Utility::addCreatedBy($paramObj);

            if($tempObj->save()){
                $package_id = $tempObj->id;
                if(isset($childArray) && count($childArray)>0){
                    foreach($childArray as $service_id){
                        DB::table('package_detail')->insert([
                            ['package_id' => $package_id, 'service_id' => $service_id]
                        ]);
                    }
                }
                DB::commit();

                //save price tracking
                //parameters ($table_name,$table_id,$table_id_type,$action,$old_price,$new_price,$created_by,$created_at)
                Utility::savePriceTracking('packages',$package_id,'integer','create',0.00,$tempObj->price,$currentUser,$tempObj->created_at);

                //create info log
                $date = $tempObj->created_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created package_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();

                //create error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a package and got error';
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a package and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function update($paramObj,$childArray,$old_price)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);

            if($tempObj->save()){

                $package_id = $tempObj->id;
                DB::table('package_detail')->where('package_id', '=', $package_id)->delete();

                if(isset($childArray) && count($childArray)>0){
                    foreach($childArray as $service_id){
                        DB::table('package_detail')->insert([
                            ['package_id' => $package_id, 'service_id' => $service_id]
                        ]);
                    }
                }
                DB::commit();
                if($tempObj->price !== $old_price){
                    //save price tracking
                    //parameters ($table_name,$table_id,$table_id_type,$action,$old_price,$new_price,$created_by,$created_at)
                    Utility::savePriceTracking('packages',$package_id,'integer','update',$old_price,$tempObj->price,$currentUser,$tempObj->updated_at);
                }

                //update info log
                $date = $tempObj->updated_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated package_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated  package_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = Package::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);
            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->save();

            //delete info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted package_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  package_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){

        $obj = Package::find($id);
        $childArray = DB::select("SELECT service_id FROM package_detail WHERE package_id = $id");

        $serviceRepo = new ServiceRepository();
        $services      = $serviceRepo->getArrays();
        if(isset($childArray) && count($childArray)>0){

            $tempSvcArray = array();
            foreach($childArray as $service){
                $svcId = $service->service_id;
                array_push($tempSvcArray,$svcId);
            }

            if(isset($services) && count($services)>0){
                foreach($services as $keySvc => $svc){
                    if (in_array($svc->id, $tempSvcArray)) {
                        $services[$keySvc]->selected = 1;
                    }
                }

                foreach($services as $keySvc2 => $svc2){

                    if (!array_key_exists('selected', $svc2)) {
                        $services[$keySvc2]->selected = 0;
                    }
                }
            }
            $obj['services'] = $services;
        }
        else{

            foreach($services as $keySvc3 => $svc3){
                $services[$keySvc3]->selected = 0;
            }
            $obj['services'] = $services;
        }
        return $obj;
    }

    public function getPackageByPatientId($id)
    {
        $tempObj = DB::select("SELECT p.package_name,pp.*
                                    FROM patient_package AS pp
                                    INNER JOIN packages AS p
                                    ON p.id = pp.package_id
                                    WHERE pp.patient_id = '$id'
                                    AND pp.package_usage_count > pp.package_used_count");

        return $tempObj;
    }

    public function getPackagePrice($package)
    {
        $price = DB::table('packages')->where('id', $package)->value('price');
        return $price;
    }

    public function getScheduleNo($package)
    {
        $schedule_no = DB::table('packages')->where('id', $package)->value('schedule_no');
        return $schedule_no;
    }

    public function getPackageName($package_id)
    {
        $result = DB::table('packages')->where('id', $package_id)->value('package_name');
        return $result;
    }

    public function getPackageDetails($package_id)
    {
        $result = Packagedetail::where('package_id', $package_id)->get();
        return $result;
    }

    public function getPromotions($package_id){
        $result = DB::table('package_promotions')->where('package_id', $package_id)->get();
        return $result;
    }

    public function getPromotionPrice($package_id, $promotion_order){
        $result = DB::table('package_promotions')->where('package_id', $package_id)->where('promotion_order', $promotion_order)->value('price');
        return $result;
    }
}