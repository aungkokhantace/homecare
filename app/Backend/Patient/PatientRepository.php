<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 7/26/2016
 * Time: 4:50 PM
 */

namespace App\Backend\Patient;

use App\Backend\Allergy\Allergy;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Service\ServiceRepository;
use App\Backend\Zone\ZoneRepository;
use App\Log\LogCustom;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Schedule\Schedule;
//use Illuminate\Console\Scheduling\Schedule;

class PatientRepository implements PatientRepositoryInterface
{
    public function getObjs()
    {
        $objs = Patient::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getPatientWithUser()
    {
        $objs = Patient::
            leftjoin('core_users', 'patients.user_id', '=', 'core_users.id')
            ->select('patients.*','core_users.active')
            ->whereNull('patients.deleted_at')
            ->get();
        return $objs;
    }

    public function create($flag,$userObj,$paramObj,$childArray,$logObj)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user
        try{
            if($flag == 1){
                $returnedObj = array();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

                DB::beginTransaction();

                $tempUserObj = Utility::addCreatedBy($userObj);
                $tempObj = Utility::addCreatedBy($paramObj);
                $logObj         = Utility::logCreatedBy($logObj);

                //start generating id for userObj
//                $prefix = Utility::getTerminalId();
                $prefix = "P000";
                $table = (new User())->getTable();
                $col = "id";
                $offset = 1;
                $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

                //end generating id for userObj
                $tempUserObj->id = $generatedId;                                 //bind id to User obj

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

                //if user did not fill email, an account with his or her id will be created instead
                if($tempUserObj->email == ""){
                    $email          = $tempUserObj->id."@gmail.com";
                    $tempUserObj->email = $email;
                }

                if($tempObj->email == ""){
                    $email          = $tempUserObj->id."@gmail.com";
                    $tempObj->email = $email;
                }

                //if password is not null, that password will be hashed
                if($tempUserObj->password != ""){
                    //encrypt password
                    $pwd = base64_encode(Input::get('password'));
                    //bind to userObj
                    $userObj->password = $pwd;
                }
                else{
                    $passwordString = "123@parami";             //if password is null, "parami@123" is set as default password
                    //encrypt password
                    $pwd = base64_encode($passwordString);  //encrypt default password
                    //bind to userObj
                    $userObj->password = $pwd;
                }

                if($tempUserObj->save()){                       //user obj insert is successful
                    $user_id = $tempUserObj->id;                //extract user_id after creating a row in core_users
                    $tempObj->user_id  = $user_id;              //bind that user_id to patient obj

                    if($tempObj->save()){                       //patient obj insert is successful
//                    $patient_id = $tempObj->id;
                        if(isset($childArray) && count($childArray)>0){
                            foreach($childArray as $allergy_id){
                                DB::table('patient_allergy')->insert([
                                    ['patient_id' => $user_id, 'allergy_id' => $allergy_id]
                                ]);
                            }
                        }

                    }
                    else{
                        DB::rollBack();

                        //create error log
                        $date    = date("Y-m-d H:i:s");
                        $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a patient and got error'. PHP_EOL;
                        LogCustom::create($date,$message);
                        $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a user and got error'. PHP_EOL;
                        LogCustom::create($date,$message);

                        return $returnedObj;
                    }

                    $logObj->patient_id =$user_id;   //extract user_id after creating a row in core_users
                    $logObj->save(); //log obj insert is successful

                    DB::commit();

                    //create info log
                    $date = $tempObj->created_at;
                    $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created patient_id = '.$tempObj->user_id . PHP_EOL;
                    LogCustom::create($date,$message);
                    $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created user_id = '.$tempUserObj->id . PHP_EOL;
                    LogCustom::create($date,$message);

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                    $returnedObj['patient'] = $tempObj;
                    return $returnedObj;
                }
                else{
                    DB::rollBack();

                    //create error log
                    $date    = date("Y-m-d H:i:s");
                    $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a patient and got error'. PHP_EOL;
                    LogCustom::create($date,$message);
                    $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a user and got error'. PHP_EOL;
                    LogCustom::create($date,$message);

                    return $returnedObj;
                }
            }
            else{
                $returnedObj = array();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

                $tempUserObj = Utility::addCreatedBy($userObj);
                $tempObj = Utility::addCreatedBy($paramObj);
                $logObj         = Utility::logCreatedBy($logObj);

                //start generating id for userObj
//                $prefix = "U000";
                $prefix = "P000";
                $table = (new User())->getTable();
                $col = "id";
                $offset = 1;
                $generatedId = Utility::generatedId($prefix,$table,$col,$offset);
                //end generating id for userObj
                $tempUserObj->id = $generatedId;                                 //bind id to User obj

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

                //if user did not fill email, an account with his or her id will be created instead
                if($tempUserObj->email == ""){
                    $email          = $tempUserObj->id."@gmail.com";
                    $tempUserObj->email = $email;
                }

                if($tempObj->email == ""){
                    $email          = $tempUserObj->id."@gmail.com";
                    $tempObj->email = $email;
                }

                //if password is not null, that password will be hashed
                if($tempUserObj->password != ""){
                    //encrypt password
                    $pwd = base64_encode(Input::get('password'));
                    //bind to userObj
                    $userObj->password = $pwd;
                }
                else{
                    $passwordString = "123@parami";             //if password is null, "parami@123" is set as default password
                    //encrypt password
                    $pwd = base64_encode($passwordString);  //encrypt default password
                    //bind to userObj
                    $userObj->password = $pwd;
                }

                if($tempUserObj->save()){                       //user obj insert is successful
                    $user_id = $tempUserObj->id;                //extract user_id after creating a row in core_users
                    $tempObj->user_id  = $user_id;              //bind that user_id to patient obj

                    if($tempObj->save()){                   //patient obj insert is successful
//                    $patient_id = $tempObj->id;
                        if(isset($childArray) && count($childArray)>0){
                            foreach($childArray as $allergy_id){
                                DB::table('patient_allergy')->insert([
                                    ['patient_id' => $user_id, 'allergy_id' => $allergy_id]
                                ]);
                            }
                        }

                    }
                    else{
                        //create error log
                        $date    = date("Y-m-d H:i:s");
                        $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a patient and got error'. PHP_EOL;
                        LogCustom::create($date,$message);
                        $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a user and got error'. PHP_EOL;
                        LogCustom::create($date,$message);

                        return $returnedObj;
                    }

                    $logObj->patient_id =$user_id;   //extract user_id after creating a row in core_users
                    $logObj->save(); //log obj insert is successful

                    //create info log
                    $date = $tempObj->created_at;
                    $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created patient_id = '.$tempObj->user_id . PHP_EOL;
                    LogCustom::create($date,$message);
                    $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created user_id = '.$tempUserObj->id . PHP_EOL;
                    LogCustom::create($date,$message);

                    $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                    $returnedObj['patient'] = $tempObj;
                    return $returnedObj;
                }
                else{
                    //create error log
                    $date    = date("Y-m-d H:i:s");
                    $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a patient and got error'. PHP_EOL;
                    LogCustom::create($date,$message);
                    $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a user and got error'. PHP_EOL;
                    LogCustom::create($date,$message);

                    return $returnedObj;
                }
            }
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a patient and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a user and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function update($userObj,$paramObj,$childArray,$logObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            DB::beginTransaction();
            $tempObj     = Utility::addUpdatedBy($paramObj);
            $tempUserObj = Utility::addUpdatedBy($userObj);
            $logObj      = Utility::logUpdatedby($logObj);
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

            //if user did not fill email, an account with his or her name will be created instead
            if($tempUserObj->email == ""){
                $tmp = strtolower($tempUserObj->name);
                $tmp = preg_replace('/\s+/', '', $tmp);
                $email          = $tmp.'.'.$tempUserObj->staff_id."@gmail.com";
                $tempUserObj->email = $email;

            }

            if($tempObj->email == ""){
                $tmp = strtolower($tempUserObj->name);
                $tmp = preg_replace('/\s+/', '', $tmp);
                $email          = $tmp.'.'.$tempUserObj->staff_id."@gmail.com";
                $tempObj->email = $email;
            }

            if($tempObj->save()){
                if($tempUserObj->save()) {
                    $patient_id = $tempObj->user_id;
                    DB::table('patient_allergy')->where('patient_id', '=', $patient_id)->delete();
                    if (isset($childArray) && count($childArray) > 0) {
                        foreach ($childArray as $allergy_id) {
                            DB::table('patient_allergy')->insert([
                                ['patient_id' => $patient_id, 'allergy_id' => $allergy_id]
                            ]);
                        }
                    }
                }
                else{
                    DB::rollBack();

                    //update error log
                    $date    = date("Y-m-d H:i:s");
                    $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated patient_id = '.$tempObj->user_id.' and got error'. PHP_EOL;
                    LogCustom::create($date,$message);
                    $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated user_id = '.$tempUserObj->id.' and got error'. PHP_EOL;
                    LogCustom::create($date,$message);

                    return $returnedObj;
                }

                $logObj->patient_id = $tempObj->user_id;
                $logObj->save();

                DB::commit();

                //update info log
                $date = $tempObj->created_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated patient_id = '.$tempObj->user_id . PHP_EOL;
                LogCustom::create($date,$message);
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated user_id = '.$tempUserObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();

                //update error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated patient_id = '.$tempObj->user_id.' and got error'. PHP_EOL;
                LogCustom::create($date,$message);
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated user_id = '.$tempUserObj->id.' and got error'. PHP_EOL;
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated patient_id = '.$tempObj->user_id.' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated user_id = '.$tempUserObj->id.' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function delete($id,$logObj)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user
        try{
            //find and delete patient obj
            $tempObj = Patient::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);

            $logObj  = Utility::logDeletedBy($logObj);

            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->save();

            //save log file to delete
            $logObj->patient_id = $tempObj->user_id;
            $logObj->save();

            //find and delete user obj
            $user_id = $tempObj->user_id;
            $tempUserObj = User::find($user_id);
            $tempUserObj = Utility::addDeletedBy($tempUserObj);
            $tempUserObj->deleted_at = date('Y-m-d H:m:i');
            $tempUserObj->save();

            //update info log
            $date = $tempObj->created_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted patient_id = '.$tempObj->user_id . PHP_EOL;
            LogCustom::create($date,$message);
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted user_id = '.$tempUserObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  patient_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  user_id = ' .$tempUserObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }

    }

    public function getObjByID($id)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $tempObj = Patient::find($id);
        if (isset($tempObj) && count($tempObj) > 0){
            $childArray = DB::select("SELECT allergy_id FROM patient_allergy WHERE patient_id = '$id'");
            $allergyRepo = new AllergyRepository();
            $allergyFood      = $allergyRepo->getArraysByType('food');
            $allergyDrug      = $allergyRepo->getArraysByType('drug');
            $allergyEnvironment      = $allergyRepo->getArraysByType('environment');
            $tempAllergies    = array();

            if (isset($childArray) && count($childArray) > 0) {
                $tempSvcArray = array();
                foreach ($childArray as $allergy) {
                    $svcId = $allergy->allergy_id;
                    array_push($tempSvcArray, $svcId);
                }
                if (isset($allergyFood) && count($allergyFood) > 0) {
                    foreach($allergyFood as $keyAlg => $alg){

                        if (in_array($alg->id, $tempSvcArray)) {
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
            } else {

                foreach ($allergyFood as $keySvc3 => $svc3) {
                    $allergyFood[$keySvc3]->selected = 0;
                }
                $tempAllergies['food']=$allergyFood;
            }

            if (isset($childArray) && count($childArray) > 0) {
                $tempSvcArray = array();
                foreach ($childArray as $allergy) {
                    $svcId = $allergy->allergy_id;
                    array_push($tempSvcArray, $svcId);
                }
                if (isset($allergyDrug) && count($allergyDrug) > 0) {
                    foreach($allergyDrug as $keyAlg => $alg){

                        if (in_array($alg->id, $tempSvcArray)) {
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
            } else {

                foreach ($allergyDrug as $keySvc3 => $svc3) {
                    $allergyDrug[$keySvc3]->selected = 0;
                }
                $tempAllergies['drug']=$allergyDrug;
            }

            if (isset($childArray) && count($childArray) > 0) {
                $tempSvcArray = array();
                foreach ($childArray as $allergy) {
                    $svcId = $allergy->allergy_id;
                    array_push($tempSvcArray, $svcId);
                }
                if (isset($allergyEnvironment) && count($allergyEnvironment) > 0) {
                    foreach($allergyEnvironment as $keyAlg => $alg){

                        if (in_array($alg->id, $tempSvcArray)) {
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
            } else {

                foreach ($allergyEnvironment as $keySvc3 => $svc3) {
                    $allergyEnvironment[$keySvc3]->selected = 0;
                }
                $tempAllergies['environment']=$allergyEnvironment;
            }

            $tempObj['allergies'] = $tempAllergies;

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['result'] = $tempObj;
            return $returnedObj;
        }
        else{
            return $returnedObj;
        }
    }


    public function getZoneId($patient_id)
    {
        $zone_id = DB::table('patients')->where('user_id', $patient_id)->value('zone_id');
        return $zone_id;
    }

    public function getTownshipId($patient_id)
    {
        $zone_id = DB::table('patients')->where('user_id', $patient_id)->value('township_id');
        return $zone_id;
    }

    public function getArrays()
    {
        $tempObj = DB::select("SELECT * FROM patients WHERE deleted_at is null");
        return $tempObj;
    }

    public function getPatientSchedule($id)
    {
        $tb_schedule = (new Schedule())->getTable();
        $schedules = DB::select("SELECT * FROM $tb_schedule WHERE patient_id = '$id'");
        return $schedules;
    }

    public function getPatientScheduleWithInvoice($id)
    {
        $result = Schedule::
                leftjoin('invoices','schedules.id', '=', 'invoices.schedule_id')
                ->select('schedules.*', 'invoices.total_payable_amt')
                ->where('schedules.patient_id', '=', $id)
                ->whereNull('schedules.deleted_at')
                ->get();
        return $result;
    }

    
}