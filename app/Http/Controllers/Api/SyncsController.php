<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/9/2016
 * Time: 10:46 AM
 */

namespace App\Http\Controllers\Api;

use App\Core\Config\ConfigRepository;
use App\Core\SyncsTable\SyncsTableRepository;
use App\Core\User\UserRepository;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\AllergyEntryRequest;
use App\Backend\Infrastructure\Forms\AllergyEditRequest;
use App\Backend\Allergy\AllergyRepositoryInterface;
use App\Backend\Allergy\Allergy;
use Auth;
use App\Core\Check;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Backend\Infrastructure\Forms\UserEditFormRequest;
use App\Backend\Infrastructure\Forms\UserEntryFormRequest;
use App\Core\Role\Role;
use App\Core\Permission\Permission;
use App\Core\Utility;
use App\Session;
use App\Core\User\UserRepositoryInterface;
use App\User;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Township\TownshipRepository;
use App\Backend\Zone\ZoneRepository;
use Carbon\Carbon;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepositoryInterface;
use App\Backend\Infrastructure\Forms\PatientEntryRequest;
use App\Backend\Infrastructure\Forms\PatientEditRequest;
use App\Backend\Township\Township;
use App\Backend\Cartype\CartypeRepository;
use App\Backend\Patientsurgeryhistory\PatientsurgeryhistoryRepository;
use App\Backend\Patientfamilyhistory\PatientfamilyhistoryRepository;
use App\Backend\Familyhistory\FamilyhistoryRepository;
use App\Backend\Familymember\FamilymemberRepository;
use App\Backend\Medicalhistory\MedicalHistoryRepository;
use App\Backend\Patientmedicalhistory\PatientmedicalhistoryRepository;


class SyncsController extends Controller{

    public function __construct()
    {

    }

    public function index()
    {
        $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage'] = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function down()
    {
        $prefix                 = "";
        $temp   = Input::All();
        $inputRawJson  = $temp['param_data'];
        $inputRaw     = json_decode($inputRawJson);
        $isFirstTimeConnect = Check::checkFirstTimeConnect($inputRaw);
        $checkServerStatusArray = Check::checkCodes($inputRaw);
        $result = array();

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $prefix             = $checkServerStatusArray['tablet_id'];
            $user_id             = $checkServerStatusArray['user_id'];

            $inputParametersRaw = $checkServerStatusArray['data'];
            $inputParameters = array();

            foreach ($inputParametersRaw as $paramTb) {
                $inputParameters[$paramTb->name] = $paramTb->version;
            }

            $syncsTableRepo = new SyncsTableRepository();
            $rawSyncsTables = $syncsTableRepo->getArrays();
            $syncsTbVersionArray = array();

            $syncsTables = array();
            foreach($rawSyncsTables as $k => $v){

                $tableName = $v->table_name;
                $tableVersion = $v->version;
                $syncsTables[$tableName] = $tableVersion;

                $tempTableArray = array();
                $tempTableArray['id'] = $v->id;
                $tempTableArray['name'] = $v->table_name;
                $tempTableArray['version'] = $v->version;
                $tempTableArray['active'] = $v->active;
                $tempTableArray['created_by'] = $v->created_by;
                $tempTableArray['updated_by'] = $v->updated_by;
                $tempTableArray['deleted_by'] = $v->deleted_by;
                $tempTableArray['created_at'] = $v->created_at;
                $tempTableArray['updated_at'] = $v->updated_at;
                $tempTableArray['deleted_at'] = $v->deleted_at;
                array_push($syncsTbVersionArray,$tempTableArray);

            }

            $coreSyncsTables = array();

            if(isset($syncsTables) && count($syncsTables)>0){

                foreach($inputParameters as $kparam => $vparam) {

                    $serverTbVersion = $syncsTables[$kparam];

                    if(array_key_exists($kparam,$syncsTables )){

                        $clientTbVersion = $inputParameters[$kparam];

                        if ($kparam == "schedules") {
                            if($user_id != ""){
                                $tempObj = DB::select("SELECT * FROM $kparam WHERE `deleted_at` is null AND `status` NOT IN ('complete','cancel') AND `date` >= CURDATE() AND schedules.leader_id = '$user_id'");
                            }
                            else{
                                $tempObj = [];
                            }
                            $result[$kparam] = $tempObj;
                        }
                        else if ($kparam == "schedule_detail") {
                            if($user_id != ""){
                                $tempSchedules = DB::select("SELECT `id` FROM schedules WHERE `deleted_at` is null AND `status` NOT IN ('complete','cancel') AND `date` >= CURDATE() AND schedules.leader_id = '$user_id'");
                            }
                            else{
                                $tempSchedules = [];
                            }
                            $tempScheduleIdArr = array();
                            foreach($tempSchedules as $tmpSchedule){
                                array_push($tempScheduleIdArr,$tmpSchedule->id);

                            }
//                                $tempObj = DB::select("SELECT schedule_detail.* FROM schedule_detail LEFT JOIN schedules ON schedule_detail.schedule_id = schedules.id WHERE `deleted_at` is null AND `status` NOT IN ('complete','cancel')");
                            $tempObj = DB::select("SELECT schedule_detail.* FROM schedule_detail WHERE `schedule_id` IN ( '" . implode($tempScheduleIdArr, "', '") . "' )");
                            $result[$kparam] = $tempObj;
                        }
                        else if($clientTbVersion < $serverTbVersion) {
                            $tempObj = DB::select("SELECT * FROM " . $kparam);
                            $result[$kparam] = $tempObj;
                        }
                        else{
                            $result[$kparam] = array();
                        }

                    }
                    else{
                        $result[$kparam] = array();
                    }

                    //$coreSyncsTables[$kparam] = $syncsTables[$kparam];

                    $tempArray = array();
                    $tempArray['name'] = $kparam;
                    $tempArray['version'] = $syncsTables[$kparam];

                    // For First Time Login Case about the schedule
                    // to return the empty schedule and schedule_detail with version zeros
                    // added by William - 20161130 - 0145 - PM
                    if($isFirstTimeConnect == true){
                        if ($kparam == "schedules") {
                            $result[$kparam] = array();
                        }

                        if ($kparam == "schedule_detail") {
                            $result[$kparam] = array();
                        }
                    }

                    array_push($coreSyncsTables,$tempArray);
                }

                // For First Time Login Case about the schedule
                // to return the empty schedule and schedule_detail with version zeros
                // added by William - 20161130 - 0145 - PM

                if($isFirstTimeConnect == true) {
                    foreach ($syncsTbVersionArray as $k2 => $v2) {

                        $tableName = $v2['name'];

                        if ($tableName == "schedules") {
                            $syncsTbVersionArray[$k2]['version'] = 0;
                        }

                        if ($tableName == "schedule_detail") {
                            $syncsTbVersionArray[$k2]['version'] = 0;
                        }

                    }
                }

                $result['core_syncs_tables'] = $syncsTbVersionArray;

                ///////////////////////////////////
                $maxPatient                                 = Utility::getMaxKey($prefix,'patients','user_id');
                $maxCoreUser                                = Utility::getMaxKey($prefix,'core_users','id');
                $maxSchedule                                = Utility::getMaxKey($prefix,'schedules','id');
                $maxEnquiry                                 = Utility::getMaxKey($prefix,'enquiries','id');
                $maxPatientFamilyHistory                    = Utility::getMaxKey($prefix,'patient_family_history','id');
                $maxPatientMedicalHistory                   = Utility::getMaxKey($prefix,'patient_medical_history','id');
                $maxPatientSurgeryHistory                   = Utility::getMaxKey($prefix,'patient_surgery_history','id');
                $maxScheduleTreatmentHistory                = Utility::getMaxKey($prefix,'schedule_treatment_histories','id');
                $maxProduct                                 = Utility::getMaxKey($prefix,'products','id');
                $maxRoute                                   = Utility::getMaxKey($prefix,'route','id');
                $maxInvoice                                 = Utility::getMaxKey($prefix,'invoices','id');
                $maxSchedulePhysiotherapyMusculo            = Utility::getMaxKey($prefix,'schedule_physiotherapy_musculo','id');
                $maxSchedulePhysiotherapyNeuro              = Utility::getMaxKey($prefix,'schedule_physiotherapy_neuro','id');
                $maxSchedulePatientVitals                   = Utility::getMaxKey($prefix,'schedule_patient_vitals','id');
                $maxMedicalHistory                          = Utility::getMaxKey($prefix,'medical_history','id');
                $maxFamilyHistory                           = Utility::getMaxKey($prefix,'family_histories','id');
                $maxPatientFamilyMember                     = Utility::getMaxKey($prefix,'patient_family_member','id');
                $maxSchedulePhysicalExamsAbdomenExtreNeuro  = Utility::getMaxKey($prefix,'schedule_physical_exams_abdomen_extre_neuro','id');
                $maxSchedulePhysicalExamsHeartLungs         = Utility::getMaxKey($prefix,'schedule_physical_exams_heart_lungs','id');
                $maxSchedulePhysicalExamsGeneralPupilsHead  = Utility::getMaxKey($prefix,'schedule_physical_exams_general_pupils_head','id');
                $maxWayTracking                             = Utility::getMaxKey($prefix,'way_tracking','id');
                $maxPatientPackage                          = Utility::getMaxKey($prefix,'patient_package','id');
                $maxSchedulePatientChiefComplaint           = Utility::getMaxKey($prefix,'schedule_patient_chief_complaint','id');
                $maxLogPatientCaseSummary                   = Utility::getMaxKey($prefix,'log_patient_case_summary','id');

                $maxKey = array();

                $maxKey[0]['table_name'] = "patients";
                $maxKey[0]['max_key_id'] = $maxPatient;
                $maxKey[1]['table_name'] = "core_users";
                $maxKey[1]['max_key_id'] = $maxCoreUser;
                $maxKey[2]['table_name'] = "schedules";
                $maxKey[2]['max_key_id'] = $maxSchedule;
                $maxKey[3]['table_name'] = "enquiries";
                $maxKey[3]['max_key_id'] = $maxEnquiry;
                $maxKey[4]['table_name'] = "patient_family_history";
                $maxKey[4]['max_key_id'] = $maxPatientFamilyHistory;
                $maxKey[5]['table_name'] = "patient_medical_history";
                $maxKey[5]['max_key_id'] = $maxPatientMedicalHistory;
                $maxKey[6]['table_name'] = "patient_surgery_history";
                $maxKey[6]['max_key_id'] = $maxPatientSurgeryHistory;
                $maxKey[7]['table_name'] = "schedule_treatment_histories";
                $maxKey[7]['max_key_id'] = $maxScheduleTreatmentHistory;
                $maxKey[8]['table_name'] = "products";
                $maxKey[8]['max_key_id'] = $maxProduct;
                $maxKey[9]['table_name'] = "route";
                $maxKey[9]['max_key_id'] = $maxRoute;
                $maxKey[10]['table_name'] = "invoices";
                $maxKey[10]['max_key_id'] = $maxInvoice;
                $maxKey[11]['table_name'] = "schedule_physiotherapy_musculo";
                $maxKey[11]['max_key_id'] = $maxSchedulePhysiotherapyMusculo;
                $maxKey[12]['table_name'] = "schedule_physiotherapy_neuro";
                $maxKey[12]['max_key_id'] = $maxSchedulePhysiotherapyNeuro;
                $maxKey[13]['table_name'] = "schedule_patient_vitals";
                $maxKey[13]['max_key_id'] = $maxSchedulePatientVitals;
                $maxKey[14]['table_name'] = "medical_history";
                $maxKey[14]['max_key_id'] = $maxMedicalHistory;
                $maxKey[15]['table_name'] = "family_histories";
                $maxKey[15]['max_key_id'] = $maxFamilyHistory;
                $maxKey[16]['table_name'] = "patient_family_member";
                $maxKey[16]['max_key_id'] = $maxPatientFamilyMember;
                $maxKey[17]['table_name'] = "schedule_physical_exams_abdomen_extre_neuro";
                $maxKey[17]['max_key_id'] = $maxSchedulePhysicalExamsAbdomenExtreNeuro;
                $maxKey[18]['table_name'] = "schedule_physical_exams_heart_lungs";
                $maxKey[18]['max_key_id'] = $maxSchedulePhysicalExamsHeartLungs;
                $maxKey[19]['table_name'] = "schedule_physical_exams_general_pupils_head";
                $maxKey[19]['max_key_id'] = $maxSchedulePhysicalExamsGeneralPupilsHead;
                $maxKey[20]['table_name'] = "way_tracking";
                $maxKey[20]['max_key_id'] = $maxWayTracking;
                $maxKey[21]['table_name'] = "patient_package";
                $maxKey[21]['max_key_id'] = $maxPatientPackage;
                $maxKey[22]['table_name'] = "schedule_patient_chief_complaint";
                $maxKey[22]['max_key_id'] = $maxSchedulePatientChiefComplaint;
                $maxKey[23]['table_name'] = "log_patient_case_summary";
                $maxKey[23]['max_key_id'] = $maxLogPatientCaseSummary;

                ////////////////////////////////////

                $result['max_key'] = $maxKey;

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage'] = "Request success !";
                $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
                $returnedObj['user_id'] = $checkServerStatusArray['user_id'];
                $returnedObj['data'] = $result;

                return \Response::json($returnedObj);
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage'] = "There is no tables to syncs down!";
            $returnedObj['data'] = "";
            return \Response::json($returnedObj);
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }
}
