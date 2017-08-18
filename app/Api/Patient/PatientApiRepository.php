<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 7/26/2016
 * Time: 4:50 PM
 */

namespace App\Api\Patient;


use App\Api\User\UserApiRepository;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Backend\Patient\Patient;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Zone\ZoneRepository;

class PatientApiRepository implements PatientApiRepositoryInterface
{
    
    public function getArrays()
    {
    	$columns = 'id,name,password,phone,email,fees,display_image,mobile_image,role_id,address,active,created_by,updated_by,deleted_by,created_at,updated_at,deleted_at';
        
        $tempObj = DB::select("SELECT * FROM patients WHERE deleted_at is null");

        $userObj = DB::select("SELECT $columns FROM core_users WHERE deleted_at is null");

        $allergyObj = DB::select("SELECT * FROM patient_allergy");

        $logObj = DB::select("SELECT * FROM log_patient_case_summary");
        $returnObj = array();
        $allergy = array();
        $logs = array();
        foreach($tempObj as $key => $obj){
            $user_id = $obj->user_id;
            $returnObj[] = $obj;

            foreach($allergyObj as $allergyKey=>$allergyValue){
                if($user_id == $allergyValue->patient_id){
                    $allergy[]  = $allergyValue;
                }
                $returnObj[$key]->patient_allergy = $allergy;
            }

            foreach($logObj as $logKey=>$logValue){
                if($user_id == $logValue->patient_id){
                    $logs[] = $logValue;
                }
                $returnObj[$key]->log_patient_case_summary = $logs;
            }

            foreach($userObj as $core_users => $user){
                if($user_id == $user->id){
                    $returnObj[$key]->core_users = $user;

                }
            }
            $allergy = null;
            $logs = null;
        }

       return $returnObj;
    }

    public function create($flag = 1, $userObj,$paramObj,$childArray,$logObj,$familyObj,$medicalObj,$sugeryObj){
    	if($flag == 1){
            $returnedObj = array();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

            DB::beginTransaction();

            $tempUserObj = Utility::addCreatedBy($userObj);
            $tempObj     = Utility::addCreatedBy($paramObj);
            $familyObj   = Utility::addCreatedBy($familyObj);
            $medicalObj  = Utility::addCreatedBy($medicalObj);
            $surgeryObj  = Utility::addCreatedBy($sugeryObj);
            $logObj      = Utility::logCreatedBy($logObj);
            //start generating staff_id
            $table_name = Utility::getTable($tempUserObj);                    //get table name of current obj
            $staffId    = Utility::generateKey("",$table_name,$col = "id",$offset = 1, $pad_length = 5); //
            //end generating staff_id
            $tempUserObj->staff_id = $staffId;                                 //bind staff_id to User obj

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

            //if password is not null, that password will be hashed
            if($tempUserObj->password != ""){
                //encrypt password
                $pwd = Input::get('password');
                //bind to userObj
                $userObj->password = $pwd;
            }

            if($tempUserObj->save()){                       //user obj insert is successful
                $user_id = $tempUserObj->id;                //extract user_id after creating a row in core_users
                $tempObj->user_id  = $user_id;              //bind that user_id to patient obj
                $tempObj->staff_id = $staffId;
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
                    DB::rollBack();
                    return $returnedObj;
                }

                $logObj->patient_id         = $user_id;
                $logObj->save();

                $familyObj->patient_id      = $user_id;
                $familyObj->save();

                $medicalObj->patient_id     = $user_id;
                $medicalObj->save();

                $surgeryObj->patient_id     = $user_id;
                $surgeryObj->save();

                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                $returnedObj['patient'] = $tempObj;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        else{
            $returnedObj = array();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

            $tempUserObj = Utility::addCreatedBy($userObj);
            $tempObj = Utility::addCreatedBy($paramObj);

            //start generating staff_id
            $table_name = Utility::getTable($tempUserObj);                    //get table name of current obj
            $staffId = Utility::generateKey("",$table_name,$col = "id",$offset = 1, $pad_length = 5); //Parameters::($prefix,$table,$col,$offset,$pad_length)
            //end generating staff_id
            $tempUserObj->staff_id = $staffId;                                 //bind staff_id to User obj

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

            //if password is not null, that password will be hashed
            if($tempUserObj->password != ""){
                //encrypt password
                $pwd = Input::get('password');
                //bind to userObj
                $userObj->password = $pwd;
            }

            if($tempUserObj->save()){                       //user obj insert is successful
                $user_id = $tempUserObj->id;                //extract user_id after creating a row in core_users
                $tempObj->user_id  = $user_id;              //bind that user_id to patient obj
                $tempObj->staff_id = $staffId;
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
                    return $returnedObj;
                }

                $logObj->patient_id = $user_id;
                $logObj->save();

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                $returnedObj['patient'] = $tempObj;
                return $returnedObj;
            }
            else{
                return $returnedObj;
            }
        }
    }

    public function update($userObj,$paramObj,$childArray,$logObj,$familyObj,$medicalObj,$surgeryObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        DB::beginTransaction();
        $tempObj        = Utility::addUpdatedBy($paramObj);
        $tempUserObj    = Utility::addUpdatedBy($userObj);

        $familyObj      = Utility::addCreatedBy($familyObj);
        $familyObj->save();
        $medicalObj     = Utility::addCreatedBy($medicalObj);
        $medicalObj->save();
        $surgeryObj     = Utility::addCreatedBy($surgeryObj);
        $surgeryObj->save();

        $logObj         = Utility::logUpdatedBy($logObj);

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
                    return $returnedObj;
                }
            $logObj->patient_id = $tempObj->user_id;
            $logObj->save();


                
            DB::commit();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        else{
            DB::rollBack();
            return $returnedObj;
        }
    }

    public function getObjById($id)
    {
        $patient    = Patient::where('user_id','=',$id)->first();

        return $patient;
    }

    public function createSingleRow($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['id'] = $tempObj->id;
            $returnedObj['aceplusStatusMessage'] = "Insertion successful...";
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createPatient($params){
        $returnedObj                            = array();
        $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
        $returnedObj['aceplusStatusMessage']    = "";

        try {
            DB::beginTransaction();
            $tempLogArr         = array();
            $tempPatientArr     = array();
            $tempAllergyArr     = array();
            $tempUserArr        = array();
            foreach($params as $data) {
                $id = $data->user_id;
                $email = $data->email;

                //Check update or create for log date
                $findPatientObj    = Patient::where('user_id','=',$id)->get();
                if(isset($findPatientObj) && count($findPatientObj) > 0){
                    $tempPatientArr['date']               = $data->updated_at;
                    $patientCreate                        = "updated";
                }
                else{
                    $tempPatientArr['date']               = $data->created_at;
                    $patientCreate                        = "created";
                }
                $findAllergy        = DB::table('patient_allergy')->where('patient_id','=',$id)->get();
                if(isset($findAllergy) && count($findAllergy) > 0){
                    $tempAllergyArr['date']               = $data->updated_at;
                    $allergyCreate                        = "updated";
                }
                else{
                    $tempAllergyArr['date']               = $data->created_at;
                    $allergyCreate                        = "created";
                }

                $UserObj    = $data->core_users;
                $user_id    = $UserObj->id;
                //Check update or create for log date
                $findUserObj    = User::find($user_id);
                if(isset($findUserObj) && count($findUserObj) > 0){
                    $tempUserArr['date']               = $UserObj->updated_at;
                    $userCreate                        = "updated";
                }
                else{
                    $tempUserArr['date']               = $UserObj->created_at;
                    $userCreate                        = "created";
                }

                ////////////////////
                if(isset($findPatientObj) && count($findPatientObj) > 0){
                    $current_updated_at = "";
                    $input_updated_at = "";

                    $temp_current_updated_at = $findPatientObj->updated_at;
                    $current_updated_at = $temp_current_updated_at;
                    
                    $temp_input_updated_at = $data->updated_at;
                    $input_updated_at = $temp_input_updated_at;

                    //Incoming record's updated_at is later than existing record's updated_at;
                    //So, the record incoming is updated later; So, database must be updated..
                    if($input_updated_at > $current_updated_at){
                        //clear patient_allergy data relating to input
                            DB::table('patient_allergy')
                            ->where('patient_id', '=', $id)
                            ->delete();

                            //clear patients data relating to input
                            DB::table('patients')
                                ->where('user_id', '=', $id)
                                // ->where('email', '=', $email)
                                ->delete();

                            //clear users data relating to input
                            DB::table('core_users')
                                ->where('id', '=', $id)
                                // ->where('email', '=', $email)
                                ->delete();

                            //clear patient log data relating to input
                            DB::table('log_patient_case_summary')
                                ->where('patient_id', '=', $id)
                                ->delete();
                    }
                    //Incoming record's updated_at is not later than existing record's updated_at;
                    //So, the record incoming is updated earlier; So, database doesn't need to be updated..
                    else{
                        // $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                        // $returnedObj['aceplusStatusMessage']    = "User data doesn't need to be updated!";
                        // $returnedObj['log']                     = $tempLogArr;
                        // return $returnedObj;
                        continue;
                    }
                }
                ////////////////////

                

                if (isset($data->core_users) && count($data->core_users) > 0) {

                    $core_user = $data->core_users;
                    if (array_key_exists('id', $core_user)) {
                        if ($core_user->id != null && $core_user->id != "") {
                            $userRepo = new UserApiRepository();
                            $userArray = array();
                            $userArray[0] = $core_user;
                            $userResult = $userRepo->createSingleUser($userArray);

                            //  //input record's updated_at is earlier than latest data in DB, so input record is skipped and not being updated
                            // if($userResult['aceplusStatusCode'] == ReturnMessage::SKIPPED){
                            //     //skip this row and continue to next loop
                            //     continue;
                            // }

                            if ($userResult['aceplusStatusCode'] == ReturnMessage::OK) {

                                //if insertion was successful, then create date and message for log
                                $tempUserArr['message'] = $userCreate.' core_users_id = '.$UserObj->id;
                                array_push($tempLogArr,$tempUserArr);

                                $patientArray = array();
                                $patientArray[0] = $data;
//                                $patientResult = $this->createSinglePatient($patientArray);

                                ////////////////////////////////////////////////////////////////
                                //create patient object
                                $paramObj = new Patient();
                                $paramObj->user_id = $data->user_id;
                                $paramObj->name = $data->name;
                                $paramObj->nrc_no = $data->nrc_no;
                                $paramObj->email = $data->email;
                                $paramObj->patient_type_id = $data->patient_type_id;
                                $paramObj->gender = $data->gender;
                                $paramObj->phone_no = $data->phone_no;
                                $paramObj->address = $data->address;
                                $paramObj->township_id = $data->township_id;
                                $paramObj->zone_id = $data->zone_id;
                                $paramObj->dob = $data->dob;
                                $paramObj->remark = $data->remark;
                                $paramObj->case_scenario = $data->case_scenario;
                                $paramObj->having_allergy = $data->having_allergy;
                                $paramObj->created_by = $data->created_by;
                                $paramObj->updated_by = $data->updated_by;
                                $paramObj->deleted_by = $data->deleted_by;
                                $paramObj->created_at   = (isset($data->created_at) && $data->created_at != "") ? $data->created_at:null;
                                $paramObj->updated_at   = (isset($data->updated_at) && $data->updated_at != "") ? $data->updated_at:null;
                                $paramObj->deleted_at   = (isset($data->deleted_at) && $data->deleted_at != "") ? $data->deleted_at:null;

                                $patientResult = $this->createSingleObj($paramObj);
                                ////////////////////////////////////////////////
                                if ($patientResult['aceplusStatusCode'] == ReturnMessage::OK) {
                                    //if insertion was successful, then create date and message for patient log
                                    $tempPatientArr['message'] = $patientCreate.' patient_id = '.$paramObj->user_id;
                                    array_push($tempLogArr,$tempPatientArr);

                                    //if patient insertion was successful, continue to child objects and do next loop
                                    //start insertion of patient_allergy
                                    if (isset($data->patient_allergy) && count($data->patient_allergy) > 0) {
                                        foreach ($data->patient_allergy as $allergy) {
                                            DB::table('patient_allergy')->insert([
                                                ['patient_id' => $allergy->patient_id,
                                                    'allergy_id' => $allergy->allergy_id
                                                ]
                                            ]);

                                            //After creating patient log, then create date and message for patient_allergy
                                            $tempAllergyArr['message'] = $allergyCreate.' patient_allergy for patient_id = '.$paramObj->user_id;
                                            array_push($tempLogArr,$tempAllergyArr);
                                        }
                                    }
                                    //end insertion of patient_allergy

                                    //start insertion of log_patient_case_summary
                                    if (isset($data->log_patient_case_summary) && count($data->log_patient_case_summary) > 0) {
                                        foreach ($data->log_patient_case_summary as $log) {
                                            //create log obj
                                            $logObj                         = new LogPatientCaseSummary();
                                            $logObj->id                     = $log->id;
                                            $logObj->patient_id             = $log->patient_id;
                                            $logObj->case_summary           = $log->case_summary;
                                            $logObj->created_by             = $log->created_by;
                                            $logObj->updated_by             = $log->updated_by;
                                            $logObj->deleted_by             = $log->deleted_by;
                                            $logObj->created_at             = $log->created_at;
                                            $logObj->updated_at             = $log->updated_at;
                                            $logObj->deleted_at             = (isset($log->deleted_at)&& $log->deleted_at != "")?$log->deleted_at:null;

                                            $logResult = $this->createSingleObj($logObj);

                                            if ($logResult['aceplusStatusCode'] == ReturnMessage::OK) {
                                                //if insertion was successful, then create date and message for log_apatient_case summary's log
                                                $tempLogPatientArr['date']    = $log->created_at;
                                                $tempLogPatientArr['message'] = $patientCreate.' log_patient_case_summary_id ='.$logObj->id . ' for patient_id = '.$logObj->patient_id;
                                                array_push($tempLogArr,$tempLogPatientArr);
                                                continue; //log insertion was successful, continue to next loop
                                            }
                                            else{
                                                $returnedObj['aceplusStatusMessage'] = $logResult['aceplusStatusMessage'];
                                                return $returnedObj;
                                            }
                                        }
                                    }
                                    //end insertion of log_patient_case_summary

                                    continue;       //continue to next loop(i.e. next row of patient data)
                                }
                                else{
                                    DB::rollBack();
                                    $returnedObj['aceplusStatusMessage'] = $patientResult['aceplusStatusMessage'];
                                    return $returnedObj;
                                }

                            } else {
                                DB::rollBack();
                                $returnedObj['aceplusStatusMessage'] = $userResult['aceplusStatusMessage'];
                                return $returnedObj;
                            }
                        }
                    }
                }
            }//end foreach
            DB::commit();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createSingleObj($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['id'] = $tempObj->user_id;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage() . " ----- line " . $e->getLine() . " ----- " . $e->getFile();
            return $returnedObj;
        }
    }

    public function createSinglePatient($data)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $returnedObj['aceplusStatusMessage'] = "";

        try {
            $tempLogArr         = array();
            $tempPatientArr     = array();
            $tempAllergyArr     = array();
            $tempLogPatientArr  = array();
            foreach ($data as $row) {
                $id = $row->user_id;
                $email = $row->email;

                //Check update or create for log date
                $findObj    = Patient::where('user_id','=',$id)->first();
                if(isset($findObj) && count($findObj) > 0){
                    $tempPatientArr['date']     = $row->updated_at;
                    $patientCreate              = "updated";
                }
                else{
                    $tempPatientArr['date']     = $row->created_at;
                    $patientCreate              = "created";
                }

                $findAllergy    = DB::table('patient_allergy')->where('patient_id','=',$id)->get();
                if(isset($findAllergy) && count($findAllergy) > 0){
                    $tempAllergyArr['date']     = $row->updated_at;
                    $allergyCreate              = "updated";
                }
                else{
                    $tempAllergyArr['date']     = $row->created_at;
                    $allergyCreate              = "created";
                }
                $tempLogPatientArr['date']      = $row->created_at;

                if(isset($findObj) && count($findObj) > 0){
                    $current_updated_at = "";
                    $input_updated_at = "";
                    
                    $temp_current_updated_at = $findObj->updated_at;
                    $current_updated_at = $temp_current_updated_at;
                    
                    $temp_input_updated_at = $row->updated_at;
                    $input_updated_at = $temp_input_updated_at;

                    //Incoming record's updated_at is later than existing record's updated_at;
                    //So, the record incoming is updated later; So, database must be updated..
                    if($input_updated_at > $current_updated_at){
                        //clear patient_allergy data relating to input
                        DB::table('patient_allergy')
                        ->where('patient_id', '=', $id)
                        ->delete();

                        //clear patients data relating to input
                        DB::table('patients')
                            ->where('user_id', '=', $id)
                            ->where('email', '=', $email)
                            ->delete();
                    }
                    //Incoming record's updated_at is not later than existing record's updated_at;
                    //So, the record incoming is updated earlier; So, database doesn't need to be updated..
                    else{
                        // dd('this row is skipped',$input_updated_at,$current_updated_at,$row);
                        // $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                        // $returnedObj['aceplusStatusMessage']    = "Patient data doesn't need to be updated!";
                        // $returnedObj['log']                     = $tempLogArr;
                        // return $returnedObj;
                        continue;
                    }
                }

                //create patient object
                $paramObj = new Patient();
                $paramObj->user_id = $row->user_id;
                $paramObj->name = $row->name;
                $paramObj->nrc_no = $row->nrc_no;
                $paramObj->email = $row->email;
                $paramObj->patient_type_id = $row->patient_type_id;
                $paramObj->gender = $row->gender;
                $paramObj->phone_no = $row->phone_no;
                $paramObj->address = $row->address;
                $paramObj->township_id = $row->township_id;
                $paramObj->zone_id = $row->zone_id;
                $paramObj->dob = $row->dob;
                $paramObj->remark = $row->remark;
                $paramObj->case_scenario = $row->case_scenario;
                $paramObj->having_allergy = $row->having_allergy;
                $paramObj->created_by = $row->created_by;
                $paramObj->updated_by = $row->updated_by;
                $paramObj->deleted_by = $row->deleted_by;
                $paramObj->created_at   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $patientResult = $this->createSingleObj($paramObj);

                //check whether patient insertion was successful or not
                if ($patientResult['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for patient log
                    $tempPatientArr['message'] = $patientCreate.' patient_id = '.$paramObj->user_id;
                    array_push($tempLogArr,$tempPatientArr);

                    //if patient insertion was successful, continue to child objects and do next loop
                    //start insertion of patient_allergy
                    if (isset($row->patient_allergy) && count($row->patient_allergy) > 0) {
                        foreach ($row->patient_allergy as $allergy) {
                            DB::table('patient_allergy')->insert([
                                ['patient_id' => $allergy->patient_id,
                                    'allergy_id' => $allergy->allergy_id
                                ]
                            ]);

                            //After creating patient log, then create date and message for patient_allergy
                            $tempAllergyArr['message'] = $allergyCreate.' patient_allergy for patient_id = '.$paramObj->user_id;
                            array_push($tempLogArr,$tempAllergyArr);
                        }
                    }
                    //end insertion of patient_allergy

                    //start insertion of log_patient_case_summary
                    if (isset($row->log_patient_case_summary) && count($row->log_patient_case_summary) > 0) {
                        foreach ($row->log_patient_case_summary as $log) {
                            //create log obj
                            $logObj                         = new LogPatientCaseSummary();
                            $logObj->id                     = $log->id;
                            $logObj->patient_id             = $log->patient_id;
                            $logObj->case_summary           = $log->case_summary;
                            $logObj->created_by             = $log->created_by;
                            $logObj->updated_by             = $log->updated_by;
                            $logObj->deleted_by             = $log->deleted_by;
                            $logObj->created_at             = $log->created_at;
                            $logObj->updated_at             = $log->updated_at;
                            $logObj->deleted_at             = (isset($log->deleted_at)&& $log->deleted_at != "")?$log->deleted_at:null;

                            $logResult = $this->createSingleObj($logObj);

                            if ($logResult['aceplusStatusCode'] == ReturnMessage::OK) {
                                //if insertion was successful, then create date and message for log_apatient_case summary's log
                                $tempLogPatientArr['message'] = $patientCreate.' log_patient_case_summary_id ='.$logObj->id . ' for patient_id = '.$logObj->patient_id;
                                array_push($tempLogArr,$tempLogPatientArr);
                                continue; //log insertion was successful, continue to next loop
                            }
                            else{
                                $returnedObj['aceplusStatusMessage'] = $logResult['aceplusStatusMessage'];
                                return $returnedObj;
                            }
                        }
                    }
                    //end insertion of log_patient_case_summary

                    continue;       //continue to next loop(i.e. next row of patient data)

                } else {
                    //if patient insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = $patientResult['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode']    = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage'] = "Patient successfully created !";
            $returnedObj['log']                  = $tempLogArr;
            return $returnedObj;
        }
        catch (\Exception $e) {
            $returnedObj['aceplusStatusMessage'] = $e->getMessage() . " ----- line " . $e->getLine() . " ----- " . $e->getFile();
            return $returnedObj;
        }
    }

    public function getPatientForEnquiry($patient_id){
        $tempObj = DB::table('patients')->where('user_id', $patient_id)->first();
        return $tempObj;
    }

    public function getPatientAllergy($patient_id){
        $tempObj = DB::select("SELECT * FROM patient_allergy WHERE patient_id = '$patient_id'");
        return $tempObj;
    }

    public function getPatientData()
    {
        $tempObj = DB::select("SELECT * FROM patients WHERE deleted_at is null");
        return $tempObj;
    }

    public function getCoreUser($user_id)
    {
        $tempObj = DB::table('core_users')->where('id', $user_id)->first();
        return $tempObj;
    }

    public function getLog($user_id)
    {
        $tempObj = DB::select("SELECT * FROM log_patient_case_summary WHERE deleted_at is null AND patient_id = '$user_id'");
        return $tempObj;
    }
}