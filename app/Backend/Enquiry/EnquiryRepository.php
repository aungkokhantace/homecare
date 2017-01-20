<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 9:51 AM
 */

namespace App\Backend\Enquiry;
use App\Backend\Patient\PatientRepository;
use App\Backend\Zone\ZoneRepository;
use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Service\ServiceRepository;
use App\Backend\Allergy\AllergyRepository;

class EnquiryRepository implements  EnquiryRepositoryInterface
{
    public function getObjs($enquiry_status = null, $enquiry_case_type = null, $from_date = null, $to_date = null)
    {
        $query = Enquiry::query();
        if(isset($enquiry_status) && $enquiry_status != null && $enquiry_status <> 'all'){
            $query = $query->where('status', $enquiry_status);
        }

        if(isset($enquiry_case_type) && $enquiry_case_type != null && $enquiry_case_type <> 'all'){
            $query = $query->where('case_type', $enquiry_case_type);
        }
        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->whereDate('created_at', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->whereDate('created_at', '<=', $tempToDate);
        }
        $query = $query->whereNull('deleted_at');
        $objs = $query->get();

        return $objs;
    }

    public function getArrays($enquiry_status = null, $enquiry_case_type = null, $from_date = null, $to_date = null){
        $tempObj = DB::select("SELECT * FROM enquiries WHERE deleted_at is null");
        return $tempObj;
    }

    public function create($paramObj,$services,$allergies)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            DB::beginTransaction();
            $tempObj = Utility::addCreatedBy($paramObj);
            $prefix = Utility::getTerminalId();
            $table = (new Enquiry())->getTable();
            $col = "id";
            $offset = 1;
            $enquiryId = Utility::generatedId($prefix,$table,$col,$offset);
            $tempObj->id = $enquiryId;

            //retrieve zone_id from township_id
            $zoneRepo           = new zoneRepository();
            $zone               = $zoneRepo->getZoneId($paramObj->township_id);
            //retrieve zone_id from township_id

            if($zone == null){
                $tempObj->zone_id = 0;
            }
            else{
                $tempObj->zone_id = $zone;                                 //bind zone to Patient obj
            }

            if($tempObj->save()){

                // Saving the Enquiry Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('enquiry_detail')->insert([
                            ['enquiry_id' => $enquiryId, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }

                if(isset($allergies) && count($allergies)>0){
                    foreach($allergies as $allergy_id){
                        DB::table('enquiry_detail')->insert([
                            ['enquiry_id' => $enquiryId, 'allergy_id' => $allergy_id, 'type' => 'allergy']
                        ]);
                    }
                }

                DB::commit();

                //create info log
                $date = $tempObj->created_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created enquiry_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();

                //create error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created an enquiry and got error.'. PHP_EOL;
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();

            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created an enquiry and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($id,$paramObj,$services,$allergies)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $enquiry_id = $id;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {

            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);

            if($tempObj->save()){

                // Cleaning all service, allergy and related thing about the selected enquiry
                DB::table('enquiry_detail')->where('enquiry_id', '=', $enquiry_id)->delete();

                // Saving the Enquiry Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('enquiry_detail')->insert([
                            ['enquiry_id' => $enquiry_id, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }

                $isHavingAllergy = $paramObj->having_allergy;
                if($isHavingAllergy == 1) {
                    if (isset($allergies) && count($allergies) > 0) {
                        foreach ($allergies as $allergy_id) {
                            DB::table('enquiry_detail')->insert([
                                ['enquiry_id' => $enquiry_id, 'allergy_id' => $allergy_id, 'type' => 'allergy']
                            ]);
                        }
                    }
                }

                DB::commit();

                //update info log
                $date = $tempObj->updated_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated enquiry_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();

                //update error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated enquiry_id = ' .$tempObj->id. ' and got error'. PHP_EOL;
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();

            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated enquiry_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = Enquiry::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);
            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->save();

            //delete info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted enquiry_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  enquiry_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){
        $tempObj = Enquiry::find($id);

        $tempDate = $tempObj->date;
        $tempDob = $tempObj->dob;

        $tempObj->date = date("d-m-Y", strtotime($tempDate));
        $tempObj->dob = date("d-m-Y", strtotime($tempDob));


        $serviceRepo = new ServiceRepository();
        $services      = $serviceRepo->getArrays();

        $allergyRepo    = new AllergyRepository();
        $allergyFood      = $allergyRepo->getArraysByType('food');
        $allergyDrug      = $allergyRepo->getArraysByType('drug');
        $allergyEnvironment = $allergyRepo->getArraysByType('environment');
        $tempAllergies    = array();

        $enquiryAllergies = DB::select("SELECT * FROM enquiry_detail WHERE enquiry_id = '$id' AND type = 'allergy'");
        $enquiryServices = DB::select("SELECT * FROM enquiry_detail WHERE enquiry_id = '$id' AND type = 'service'");

        if(isset($enquiryAllergies) && count($enquiryAllergies)>0){

            $tempEnqArray = array();
            foreach($enquiryAllergies as $allergy){
                $algId = $allergy->allergy_id;
                array_push($tempEnqArray,$algId);
            }

            if(isset($allergyFood) && count($allergyFood)>0){

                foreach($allergyFood as $keyAlg => $alg){

                    if (in_array($alg->id, $tempEnqArray)) {
                        $allergyFood[$keyAlg]->selected = 1;
                    }
                }

                foreach($allergyFood as $keyAlg2 => $alg2){

                    if (!array_key_exists('selected', $alg2)) {
                        $allergyFood[$keyAlg2]->selected = 0;
                    }
                }
            }
            $tempAllergies['food']=$allergyFood;
        }
        else{

            foreach($allergyFood as $keyAlg3 => $alg3){
                $allergyFood[$keyAlg3]->selected = 0;
            }
            $tempAllergies['food']=$allergyFood;
        }

        if(isset($enquiryAllergies) && count($enquiryAllergies)>0){

            $tempEnqArray = array();
            foreach($enquiryAllergies as $allergy){
                $algId = $allergy->allergy_id;
                array_push($tempEnqArray,$algId);
            }

            if(isset($allergyDrug) && count($allergyDrug)>0){

                foreach($allergyDrug as $keyAlg => $alg){

                    if (in_array($alg->id, $tempEnqArray)) {
                        $allergyDrug[$keyAlg]->selected = 1;
                    }
                }

                foreach($allergyDrug as $keyAlg2 => $alg2){

                    if (!array_key_exists('selected', $alg2)) {
                        $allergyDrug[$keyAlg2]->selected = 0;
                    }
                }
            }
            $tempAllergies['drug']=$allergyDrug;
        }
        else{

            foreach($allergyDrug as $keyAlg3 => $alg3){
                $allergyDrug[$keyAlg3]->selected = 0;
            }
            $tempAllergies['drug']=$allergyDrug;
        }

        if(isset($enquiryAllergies) && count($enquiryAllergies)>0){

            $tempEnqArray = array();
            foreach($enquiryAllergies as $allergy){
                $algId = $allergy->allergy_id;
                array_push($tempEnqArray,$algId);
            }

            if(isset($allergyEnvironment) && count($allergyEnvironment)>0){

                foreach($allergyEnvironment as $keyAlg => $alg){

                    if (in_array($alg->id, $tempEnqArray)) {
                        $allergyEnvironment[$keyAlg]->selected = 1;
                    }
                }

                foreach($allergyEnvironment as $keyAlg2 => $alg2){

                    if (!array_key_exists('selected', $alg2)) {
                        $allergyEnvironment[$keyAlg2]->selected = 0;
                    }
                }
            }
            $tempAllergies['environment']=$allergyEnvironment;
        }
        else{

            foreach($allergyEnvironment as $keyAlg3 => $alg3){
                $allergyEnvironment[$keyAlg3]->selected = 0;
            }
            $tempAllergies['environment']=$allergyEnvironment;
        }

        $tempObj['allergies'] = $tempAllergies;

        if(isset($enquiryServices) && count($enquiryServices)>0){

            $tempSrvArray = array();
            foreach($enquiryServices as $service){
                $srvId = $service->service_id;
                array_push($tempSrvArray,$srvId);
            }

            if(isset($services) && count($services)>0){
                foreach($services as $keySrv => $srv){

                    if (in_array($srv->id, $tempSrvArray)) {
                        $services[$keySrv]->selected = 1;
                    }
                }

                foreach($services as $keySrv2 => $srv2){

                    if (!array_key_exists('selected', $srv2)) {
                        $services[$keySrv2]->selected = 0;
                    }
                }
            }
            $tempObj['services'] = $services;
        }
        else{

            foreach($services as $keySrv3 => $srv3){
                $services[$keySrv3]->selected = 0;
            }
            $tempObj['services'] = $services;
        }

        return $tempObj;
    }

    public function getArrayByID($id){

        $tempEnquiry = new Enquiry();
        $tbName = $tempEnquiry->getTable();
        $rawObj = DB::select("SELECT * FROM $tbName WHERE id = '$id'");

        if(isset($rawObj) && count($rawObj)>0){
            $tempObj = $rawObj[0];
        }
        else{
            return array();
        }

        $tempDate = $tempObj->date;
        $tempDob = $tempObj->dob;
        $isNewPatient = $tempObj->is_new_patient;
        $patientId = $tempObj->patient_id;
        $patientRepo = new PatientRepository();

        if($isNewPatient == 0){
            $patientRaw = $patientRepo->getObjByID($patientId);
            $patient = $patientRaw['result'];
        }else{
            $patient = array();
        }

        $tempObj->patient = $patient;
        $tempObj->date = date("d-m-Y", strtotime($tempDate));
        $tempObj->dob = date("d-m-Y", strtotime($tempDob));

        $serviceRepo = new ServiceRepository();
        $services      = $serviceRepo->getArrays();

        $allergyRepo    = new AllergyRepository();
        $allergies      = $allergyRepo->getArrays();

        $enquiryAllergies = DB::select("SELECT * FROM enquiry_detail WHERE enquiry_id = '$id' AND type = 'allergy'");
        $enquiryServices = DB::select("SELECT * FROM enquiry_detail WHERE enquiry_id = '$id' AND type = 'service'");

        if(isset($enquiryAllergies) && count($enquiryAllergies)>0){

            $tempEnqArray = array();
            foreach($enquiryAllergies as $allergy){
                $algId = $allergy->allergy_id;
                array_push($tempEnqArray,$algId);
            }

            if(isset($allergies) && count($allergies)>0){

                foreach($allergies as $keyAlg => $alg){

                    if (in_array($alg->id, $tempEnqArray)) {
                        $allergies[$keyAlg]->selected = 1;
                    }
                }

                foreach($allergies as $keyAlg2 => $alg2){

                    if (!array_key_exists('selected', $alg2)) {
                        $allergies[$keyAlg2]->selected = 0;
                    }
                }
            }
            $tempObj->allergies = $allergies;
        }
        else{

            foreach($allergies as $keyAlg3 => $alg3){
                $allergies[$keyAlg3]->selected = 0;
            }
            $tempObj->allergies = $allergies;
        }

        if(isset($enquiryServices) && count($enquiryServices)>0){

            $tempSrvArray = array();
            foreach($enquiryServices as $service){
                $srvId = $service->service_id;
                array_push($tempSrvArray,$srvId);
            }

            if(isset($services) && count($services)>0){
                foreach($services as $keySrv => $srv){

                    if (in_array($srv->id, $tempSrvArray)) {
                        $services[$keySrv]->selected = 1;
                    }
                }

                foreach($services as $keySrv2 => $srv2){

                    if (!array_key_exists('selected', $srv2)) {
                        $services[$keySrv2]->selected = 0;
                    }
                }
            }
            $tempObj->services = $services;
        }
        else{

            foreach($services as $keySrv3 => $srv3){
                $services[$keySrv3]->selected = 0;
            }
            $tempObj->services = $services;
        }

        return $tempObj;
    }

    public function getEnquiryDetail($id,$type){
        $tempObj = DB::select("SELECT * FROM enquiry_detail WHERE enquiry_id = '$id' AND type = '$type'");
        return $tempObj;
    }

    public function cancel($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {

            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);

            if($tempObj->save()){

                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function getAllergiesByEnquiryId($id){
        $tempObj = DB::select("SELECT * FROM enquiry_detail WHERE enquiry_id = '$id'");
        return $tempObj;
    }

    public function confirm($id)
    {
        $tempObj = Enquiry::find($id);
        $tempObj = Utility::addUpdatedBy($tempObj);
        $tempObj->updated_at = date('Y-m-d H:m:i');
        $tempObj->status = 'confirm';
        $tempObj->save();
    }

}