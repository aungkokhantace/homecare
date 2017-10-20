<?php

namespace App\Http\Controllers\Api;

use App\Api\Enquiry\EnquiryApiV2Repository;
use App\Api\Familyhistory\FamilyhistoryApiV2Repository;
use App\Api\Invoice\InvoiceApiV2Repository;
use App\Api\Medicalhistory\MedicalhistoryApiV2Repository;
use App\Api\Nutrition\NutritionApiRepository;
use App\Api\Otherservice\OtherServiceApiRepository;
use App\Api\Patient\PatientApiRepository;
use App\Api\Patient\PatientApiV2Repository;
use App\Api\Product\ProductApiV2Repository;
use App\Api\Route\RouteApiRepository;
use App\Api\Schedule\ScheduleApiV2Repository;
use App\Core\Check;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Log\LogCustom;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class InvoiceApiV3Controller extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage']    = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function upload(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $user_id                = $inputAll->user_id;
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
            $result['aceplusStatusMessage'] = "";

            $params                 = $checkServerStatusArray['data'][0];
            $tablet_id              = $checkServerStatusArray['tablet_id'];
            $result['tablet_id']    = $tablet_id;

            try{
                DB::beginTransaction();
                $invoiceRepo            = new InvoiceApiV2Repository();
                $scheduleRepo           = new ScheduleApiV2Repository();
                $patientRepo            = new PatientApiV2Repository();
                $enquiryRepo            = new EnquiryApiV2Repository();
                $routeRepo              = new RouteApiRepository();
                $productRepo            = new ProductApiV2Repository();
                $medical_historyRepo    = new MedicalhistoryApiV2Repository();
                $family_historyRepo     = new FamilyhistoryApiV2Repository();
                $nutritionRepo          = new NutritionApiRepository();
                $otherServiceRepo       = new OtherServiceApiRepository();

                $logArr                 = array();

                if(isset($params->patient_physiothreapy_musculo_1_and_2) && count($params->patient_physiothreapy_musculo_1_and_2) > 0){
                    $physio_musculo_1and2 = $params->patient_physiothreapy_musculo_1_and_2;
                    $physio_musculo_1and2Result = $patientRepo->createPatientPhysiothreapyMusculo1and2($physio_musculo_1and2);
                    if($physio_musculo_1and2Result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $physio_musculo_1and2Result['tablet_id'] = $tablet_id;
                        $physio_musculo_1and2Result['data']      = (object) array();
                        return \Response::json($physio_musculo_1and2Result);
                    }
                    if(isset($physio_musculo_1and2Result['log']) && count($physio_musculo_1and2Result['log']) > 0){
                        array_push($logArr,$physio_musculo_1and2Result['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_musculo_3_sitting) && count($params->patient_physiotherapy_musculo_3_sitting) > 0){
                    $physio_musculo_3sitting = $params->patient_physiotherapy_musculo_3_sitting;
                    $physio_musculo_3sittingResult = $patientRepo->createPatientPhysiothreapyMusculo3sitting($physio_musculo_3sitting);
                    if($physio_musculo_3sittingResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $physio_musculo_3sittingResult['tablet_id'] = $tablet_id;
                        $physio_musculo_3sittingResult['data']                        = (object) array();
                        return \Response::json($physio_musculo_3sittingResult);
                    }
                    if(isset($physio_musculo_3sittingResult['log']) && count($physio_musculo_3sittingResult['log']) > 0){
                        array_push($logArr,$physio_musculo_3sittingResult['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_musculo_3_standing) && count($params->patient_physiotherapy_musculo_3_standing) > 0){
                    $physio_musculo_3standing = $params->patient_physiotherapy_musculo_3_standing;
                    $physio_musculo_3standingResult = $patientRepo->createPatientPhysiothreapyMusculo3standing($physio_musculo_3standing);
                    if($physio_musculo_3standingResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $physio_musculo_3standingResult['tablet_id'] = $tablet_id;
                        $physio_musculo_3standingResult['data']      = (object) array();
                        return \Response::json($physio_musculo_3standingResult);
                    }
                    if(isset($physio_musculo_3standingResult['log']) && count($physio_musculo_3standingResult['log']) > 0){
                        array_push($logArr,$physio_musculo_3standingResult['log']);
                    }

                }

                if(isset($params->patient_physiotherapy_musculo_4_1and2) && count($params->patient_physiotherapy_musculo_4_1and2) > 0){
                    $physio_musculo_4_1and2 = $params->patient_physiotherapy_musculo_4_1and2;
                    $physio_musculo_4_1and2Result = $patientRepo->createPatientPhysiothreapyMusculo4_1and2($physio_musculo_4_1and2);
                    if($physio_musculo_4_1and2Result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $physio_musculo_4_1and2Result['tablet_id'] = $tablet_id;
                        $physio_musculo_4_1and2Result['data']                    = (object) array();
                        return \Response::json($physio_musculo_4_1and2Result);
                    }
                    if(isset($physio_musculo_4_1and2Result['log']) && count($physio_musculo_4_1and2Result['log']) > 0){
                        array_push($logArr,$physio_musculo_4_1and2Result['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_musculo_4_3) && count($params->patient_physiotherapy_musculo_4_3) > 0){
                    $physio_musculo_4_3 = $params->patient_physiotherapy_musculo_4_3;
                    $physio_musculo_4_3Result = $patientRepo->createPatientPhysiothreapyMusculo4_3($physio_musculo_4_3);
                    if($physio_musculo_4_3Result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $physio_musculo_4_3Result['tablet_id'] = $tablet_id;
                        $physio_musculo_4_3Result['data']      = (object) array();
                        return \Response::json($physio_musculo_4_3Result);
                    }
                    if(isset($physio_musculo_4_3Result['log']) && count($physio_musculo_4_3Result['log']) > 0){
                        array_push($logArr,$physio_musculo_4_3Result['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_musculo_4_4and5) && count($params->patient_physiotherapy_musculo_4_4and5) > 0){
                    $physio_musculo_4_4and5 = $params->patient_physiotherapy_musculo_4_4and5;
                    $physio_musculo_4_4and5Result = $patientRepo->createPatientPhysiothreapyMusculo4_4and5($physio_musculo_4_4and5);
                    if($physio_musculo_4_4and5Result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $physio_musculo_4_4and5Result['tablet_id'] = $tablet_id;
                        $physio_musculo_4_4and5Result['data']      = (object) array();
                        return \Response::json($physio_musculo_4_4and5Result);
                    }
                    if(isset($physio_musculo_4_4and5Result['log']) && count($physio_musculo_4_4and5Result['log']) > 0){
                        array_push($logArr,$physio_musculo_4_4and5Result['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_neuro_general) && count($params->patient_physiotherapy_neuro_general) > 0){
                    $neuro_general = $params->patient_physiotherapy_neuro_general;
                    $neuro_generalResult = $patientRepo->createPatientPhysiothreapyNeuroGeneral($neuro_general);
                    if($neuro_generalResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $neuro_generalResult['tablet_id'] = $tablet_id;
                        $neuro_generalResult['data']      = (object) array();
                        return \Response::json($neuro_generalResult);
                    }

                    if(isset($neuro_generalResult['log']) && count($neuro_generalResult['log']) > 0){
                        array_push($logArr,$neuro_generalResult['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_neuro_limb) && count($params->patient_physiotherapy_neuro_limb) > 0){
                    $neuro_limb = $params->patient_physiotherapy_neuro_limb;
                    $neuro_limbResult = $patientRepo->createPatientPhysiothreapyNeuroLimb($neuro_limb);
                    if($neuro_limbResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $neuro_limbResult['tablet_id'] = $tablet_id;
                        $neuro_limbResult['data']      = (object) array();
                        return \Response::json($neuro_limbResult);
                    }
                    if(isset($neuro_limbResult['log']) && count($neuro_limbResult['log']) > 0){
                        array_push($logArr,$neuro_limbResult['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_neuro_functional_performance1) && count($params->patient_physiotherapy_neuro_functional_performance1) > 0){
                    $performance1       = $params->patient_physiotherapy_neuro_functional_performance1;
                    $performance1Result = $patientRepo->createPatientPhysiothreapyNeuroFunctionalPerformance1($performance1);
                    if($performance1Result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $performance1Result['tablet_id'] = $tablet_id;
                        $performance1Result['data']      = (object) array();
                        return \Response::json($performance1Result);
                    }
                    if(isset($performance1Result['log']) && count($performance1Result['log']) > 0){
                        array_push($logArr,$performance1Result['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_neuro_functional_performance2) && count($params->patient_physiotherapy_neuro_functional_performance2) > 0){
                    $performance2       = $params->patient_physiotherapy_neuro_functional_performance2;
                    $performance2Result = $patientRepo->createPatientPhysiothreapyNeuroFunctionalPerformance2($performance2);
                    if($performance2Result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $performance2Result['tablet_id'] = $tablet_id;
                        $performance2Result['data']      = (object) array();
                        return \Response::json($performance2Result);
                    }
                    if(isset($performance2Result['log']) && count($performance2Result['log']) > 0){
                        array_push($logArr,$performance2Result['log']);
                    }
                }

                if(isset($params->patient_physiotherapy_neuro_functional_performance3) && count($params->patient_physiotherapy_neuro_functional_performance3) > 0){
                    $performance3       = $params->patient_physiotherapy_neuro_functional_performance3;
                    $performance3Result = $patientRepo->createPatientPhysiothreapyNeuroFunctionalPerformance3($performance3);
                    if($performance3Result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $performance3Result['tablet_id'] = $tablet_id;
                        $performance3Result['data']      = (object) array();
                        return \Response::json($performance3Result);
                    }
                    if(isset($performance3Result['log']) && count($performance3Result['log']) > 0){
                        array_push($logArr,$performance3Result['log']);
                    }
                }

                if(isset($params->patient_family_history) && count($params->patient_family_history) > 0){
                    $patient_family_history       = $params->patient_family_history;
                    $patient_family_historyResult = $patientRepo->createPatientFamilyHistory($patient_family_history);
                    if($patient_family_historyResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $patient_family_historyResult['tablet_id'] = $tablet_id;
                        $patient_family_historyResult['data']      = (object) array();
                        return \Response::json($patient_family_historyResult);
                    }
                    if(isset($patient_family_historyResult['log']) && count($patient_family_historyResult['log']) > 0){
                        array_push($logArr,$patient_family_historyResult['log']);
                    }
                }

                if(isset($params->patient_medical_history) && count($params->patient_medical_history) > 0){
                    $patient_medical_history       = $params->patient_medical_history;
                    $patient_medical_historyResult = $patientRepo->createPatientMedicalHistory($patient_medical_history);
                    if($patient_medical_historyResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $patient_medical_historyResult['tablet_id'] = $tablet_id;
                        $patient_medical_historyResult['data']      = (object) array();
                        return \Response::json($patient_medical_historyResult);
                    }
                    if(isset($patient_medical_historyResult['log']) && count($patient_medical_historyResult['log']) > 0){
                        array_push($logArr,$patient_medical_historyResult['log']);
                    }
                }

                if(isset($params->patient_family_member) && count($params->patient_family_member) > 0){
                    $patient_family_member       = $params->patient_family_member;
                    $patient_family_memberResult = $patientRepo->createPatientFamilyMember($patient_family_member);
                    if($patient_family_memberResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $patient_family_memberResult['tablet_id'] = $tablet_id;
                        $patient_family_memberResult['data']      = (object) array();
                        return \Response::json($patient_family_memberResult);
                    }
                    if(isset($patient_family_memberResult['log']) && count($patient_family_memberResult['log']) > 0){
                        array_push($logArr,$patient_family_memberResult['log']);
                    }
                }

                if(isset($params->patient_surgery_history) && count($params->patient_surgery_history) > 0){
                    $patient_surgery_history       = $params->patient_surgery_history;
                    $patient_surgery_historyResult = $patientRepo->createPatientSurgeryHistory($patient_surgery_history);
                    if($patient_surgery_historyResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $patient_surgery_historyResult['tablet_id'] = $tablet_id;
                        $patient_surgery_historyResult['data']      = (object) array();
                        return \Response::json($patient_surgery_historyResult);
                    }

                    if(isset($patient_surgery_historyResult['log']) && count($patient_surgery_historyResult['log']) > 0){
                        array_push($logArr,$patient_surgery_historyResult['log']);
                    }
                }

                if(isset($params->schedule_physiotherapy_neuro) && count($params->schedule_physiotherapy_neuro) > 0){
                    $schedlue_physio_neuro          = $params->schedule_physiotherapy_neuro;
                    $schedulePhysioNeuroResult    = $scheduleRepo->schedulePhysiotherapyNeuro($schedlue_physio_neuro);

                    if($schedulePhysioNeuroResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $schedulePhysioNeuroResult['tablet_id'] = $tablet_id;
                        $schedulePhysioNeuroResult['data']      = (object) array();
                        return \Response::json($schedulePhysioNeuroResult);
                    }
                    if(isset($schedulePhysioNeuroResult['log']) && count($schedulePhysioNeuroResult['log']) > 0){
                        array_push($logArr,$schedulePhysioNeuroResult['log']);
                    }
                }

                if(isset($params->schedule_patient_chief_complaint) && count($params->schedule_patient_chief_complaint) > 0){
                    $chief_complaint        = $params->schedule_patient_chief_complaint;
                    $chief_complaintResult    = $scheduleRepo->schedulePatientChiefComplaint($chief_complaint);

                    if($chief_complaintResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $chief_complaintResult['tablet_id'] = $tablet_id;
                        $chief_complaintResult['data']      = (object) array();
                        return \Response::json($chief_complaintResult);
                    }
                    if(isset($chief_complaintResult['log']) && count($chief_complaintResult['log']) > 0){
                        array_push($logArr,$chief_complaintResult['log']);
                    }
                }

                if(isset($params->schedule_patient_vitals) && count($params->schedule_patient_vitals) > 0){
                    $vitals        = $params->schedule_patient_vitals;
                    $vitalResult    = $scheduleRepo->schedulePatientVitals($vitals);

                    if($vitalResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $vitalResult['tablet_id'] = $tablet_id;
                        $vitalResult['data']      = (object) array();
                        return \Response::json($vitalResult);
                    }
                    if(isset($vitalResult['log']) && count($vitalResult['log']) > 0){
                        array_push($logArr,$vitalResult['log']);
                    }
                }

                if(isset($params->schedule_physical_exams_abdomen_extre_neuro) && count($params->schedule_physical_exams_abdomen_extre_neuro) > 0){
                    $extre_neuro        = $params->schedule_physical_exams_abdomen_extre_neuro;
                    $extre_neuroResult    = $scheduleRepo->schedulePhysicalExamsAbdomenExtreNeuro($extre_neuro);

                    if($extre_neuroResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $extre_neuroResult['tablet_id'] = $tablet_id;
                        $extre_neuroResult['data']      = (object) array();
                        return \Response::json($extre_neuroResult);
                    }

                    if(isset($extre_neuroResult['log']) && count($extre_neuroResult['log']) > 0){
                        array_push($logArr,$extre_neuroResult['log']);
                    }
                }

                if(isset($params->schedule_physical_exams_general_pupils_head) && count($params->schedule_physical_exams_general_pupils_head) > 0){
                    $pupils_head        = $params->schedule_physical_exams_general_pupils_head;
                    $pupils_headResult    = $scheduleRepo->schedulePhysicalExamsGeneralPupilsHead($pupils_head);

                    if($pupils_headResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $pupils_headResult['tablet_id'] = $tablet_id;
                        $pupils_headResult['data']      = (object) array();
                        return \Response::json($pupils_headResult);
                    }
                    if(isset($pupils_headResult['log']) && count($pupils_headResult['log']) > 0){
                        array_push($logArr,$pupils_headResult['log']);
                    }
                }

                if(isset($params->schedule_physical_exams_heart_lungs) && count($params->schedule_physical_exams_heart_lungs) > 0){
                    $heart_lungs        = $params->schedule_physical_exams_heart_lungs;
                    $heart_lungsResult    = $scheduleRepo->schedulePhysicalExamsHeartLungs($heart_lungs);

                    if($heart_lungsResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $heart_lungsResult['tablet_id'] = $tablet_id;
                        $heart_lungsResult['data']      = (object) array();
                        return \Response::json($heart_lungsResult);
                    }
                    if(isset($heart_lungsResult['log']) && count($heart_lungsResult['log']) > 0){
                        array_push($logArr,$heart_lungsResult['log']);
                    }
                }

                if(isset($params->schedule_physiotherapy_musculo) && count($params->schedule_physiotherapy_musculo) > 0){
                    $schedlue_physio_musculo        = $params->schedule_physiotherapy_musculo;
                    $schedulePhysioMusculoResult    = $scheduleRepo->schedulePhysiotherapyMusculo($schedlue_physio_musculo);

                    if($schedulePhysioMusculoResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $schedulePhysioMusculoResult['tablet_id'] = $tablet_id;
                        $schedulePhysioMusculoResult['data']      = (object) array();
                        return \Response::json($schedulePhysioMusculoResult);
                    }
                    if(isset($schedulePhysioMusculoResult['log']) && count($schedulePhysioMusculoResult['log']) > 0){
                        array_push($logArr,$schedulePhysioMusculoResult['log']);
                    }
                }

                if(isset($params->schedule_provisional_diagnosis) && count($params->schedule_provisional_diagnosis) > 0){
                    $provisional_diagnosis           = $params->schedule_provisional_diagnosis;
                    $provisional_diagnosisResult     = $scheduleRepo->scheduleProvisionalDiagnosis($provisional_diagnosis);
                    if($provisional_diagnosisResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $provisional_diagnosisResult['tablet_id'] = $tablet_id;
                        $provisional_diagnosisResult['data']      = (object) array();
                        return \Response::json($provisional_diagnosisResult);
                    }
                    if(isset($provisional_diagnosisResult['log']) && count($provisional_diagnosisResult['log']) > 0){
                        array_push($logArr,$provisional_diagnosisResult['log']);
                    }
                }

                if(isset($params->schedule_trackings) && count($params->schedule_trackings) > 0){
                    $scheduleTrackings          = $params->schedule_trackings;
                    $scheduleTrackingResult     = $scheduleRepo->scheduleTrackings($scheduleTrackings);

                    if($scheduleTrackingResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $scheduleTrackingResult['tablet_id'] = $tablet_id;
                        $scheduleTrackingResult['data']      = (object) array();
                        return \Response::json($scheduleTrackingResult);
                    }
                    if(isset($scheduleTrackingResult['log']) && count($scheduleTrackingResult['log']) > 0){
                        array_push($logArr,$scheduleTrackingResult['log']);
                    }
                }

                if(isset($params->schedule_treatment_histories) && count($params->schedule_treatment_histories) > 0){
                    $scheduleTreatments          = $params->schedule_treatment_histories;
                    $scheduleTreatmentResult     = $scheduleRepo->scheduleTreatmentHistory($scheduleTreatments);
                    if($scheduleTreatmentResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $scheduleTreatmentResult['tablet_id'] = $tablet_id;
                        $scheduleTreatmentResult['data']      = (object) array();
                        return \Response::json($scheduleTreatmentResult);
                    }
                    if(isset($scheduleTreatmentResult['log']) && count($scheduleTreatmentResult['log']) > 0){
                        array_push($logArr,$scheduleTreatmentResult['log']);
                    }
                }

                if(isset($params->schedule_investigations) && count($params->schedule_investigations) > 0){
                    $schedule_investigation             = $params->schedule_investigations;
                    $schedule_investigationResult       = $scheduleRepo->scheduleInvestigation($schedule_investigation);
                    if($schedule_investigationResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $schedule_investigationResult['tablet_id'] = $tablet_id;
                        $schedule_investigationResult['data']      = (object) array();
                        return \Response::json($schedule_investigationResult);
                    }
                    if(isset($schedule_investigationResult['log']) && count($schedule_investigationResult['log']) > 0){
                        array_push($logArr,$schedule_investigationResult['log']);
                    }

                }

                if(isset($params->nutrition) && count($params->nutrition) > 0){
                    $nutrition           = $params->nutrition;
                    $nutritionResult       = $nutritionRepo->nutrition($nutrition);
                    if($nutritionResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $nutritionResult['tablet_id'] = $tablet_id;
                        $nutritionResult['data']      = (object) array();
                        return \Response::json($nutritionResult);
                    }
                    if(isset($nutritionResult['log']) && count($nutritionResult['log']) > 0){
                        array_push($logArr,$nutritionResult['log']);
                    }
                }

                if(isset($params->enquiries) && count($params->enquiries) > 0){
                    $enquiries                  = $params->enquiries;
                    $enquiryResult             = $enquiryRepo->createEnquiry($enquiries);
                    if($enquiryResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $enquiryResult['tablet_id'] = $tablet_id;
                        $enquiryResult['data']      = (object) array();
                        return \Response::json($enquiryResult);
                    }
                    if(isset($enquiryResult['log']) && count($enquiryResult['log']) > 0){
                        array_push($logArr,$enquiryResult['log']);
                    }
                }

                if(isset($params->schedules) && count($params->schedules) > 0){
                    $schedules                  = $params->schedules;
                    $scheduleRepo               = new ScheduleApiV2Repository();
                    $scheduleResult             = $scheduleRepo->schedule($schedules);
                    if($scheduleResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $scheduleResult['tablet_id'] = $tablet_id;
                        $scheduleResult['data']      = (object) array();
                        return \Response::json($scheduleResult);
                    }
                    if(isset($scheduleResult['log']) && count($scheduleResult['log']) > 0){
                        array_push($logArr,$scheduleResult['log']);
                    }
                }

                if(isset($params->products) && count($params->products) > 0){
                    $products          = $params->products;
                    $productResult     = $productRepo->products($products);
                    if($productResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $productResult['tablet_id'] = $tablet_id;
                        $productResult['data']      = (object) array();
                        return \Response::json($productResult);
                    }
                    if(isset($productResult['log']) && count($productResult['log']) > 0){
                        array_push($logArr,$productResult['log']);
                    }
                }

                if(isset($params->route) && count($params->route) > 0){
                    $routes          = $params->route;
                    $routeResult     = $routeRepo->route($routes);
                    if($routeResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $routeResult['tablet_id'] = $tablet_id;
                        $routeResult['data']      = (object) array();
                        return \Response::json($routeResult);
                    }

                    if(isset($routeResult['log']) && count($routeResult['log']) > 0){
                        array_push($logArr,$routeResult['log']);
                    }
                }

                if(isset($params->medical_history) && count($params->medical_history) > 0){
                    $medical_history            = $params->medical_history;
                    $medical_historyResult      = $medical_historyRepo->createMedicalHistory($medical_history);
                    if($medical_historyResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $medical_historyResult['tablet_id'] = $tablet_id;
                        $medical_historyResult['data']      = (object) array();
                        return \Response::json($medical_historyResult);
                    }

                    if(isset($medical_historyResult['log']) && count($medical_historyResult['log']) > 0){
                        array_push($logArr,$medical_historyResult['log']);
                    }
                }

                if(isset($params->family_histories) && count($params->family_histories) > 0){
                    $family_histories           = $params->family_histories;
                    $family_historyResult       = $family_historyRepo->createFamilyHistories($family_histories);
                    if($family_historyResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $family_historyResult['tablet_id'] = $tablet_id;
                        $family_historyResult['data']      = (object) array();
                        return \Response::json($family_historyResult);
                    }
                    if(isset($family_historyResult['log']) && count($family_historyResult['log']) > 0){
                        array_push($logArr,$family_historyResult['log']);
                    }
                }

                if(isset($params->invoices) && count($params->invoices) > 0){
                    $invoices       = $params->invoices;
                    $invoiceResult  = $invoiceRepo->invoices($invoices);

                    if($invoiceResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $invoiceResult['tablet_id'] = $tablet_id;
                        $invoiceResult['data']      = (object) array();
                        return \Response::json($invoiceResult);
                    }

                    if(isset($invoiceResult['log']) && count($invoiceResult['log']) > 0){
                        array_push($logArr,$invoiceResult['log']);
                    }
                }

                if (isset($params->patients) && count($params->patients) > 0) {
                    $patientRepository = new PatientApiRepository();

                    $patientResult = $patientRepository->createPatient($params->patients);

                    if($patientResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $patientResult['tablet_id'] = $tablet_id;
                        $patientResult['data'] = (object) array();
                        return \Response::json($patientResult);
                    }
                    if(isset($patientResult['log']) && count($patientResult['log']) > 0){
                        array_push($logArr,$patientResult['log']);
                    }
                }

                if(isset($params->other_services) && count($params->other_services) > 0){
                    $other_services          = $params->other_services;
                    $otherServicesResult     = $otherServiceRepo->otherservice($other_services);

                    if($otherServicesResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $routeResult['tablet_id'] = $tablet_id;
                        $routeResult['data']      = (object) array();
                        return \Response::json($otherServicesResult);
                    }

                    if(isset($otherServicesResult['log']) && count($otherServicesResult['log']) > 0){
                        array_push($logArr,$otherServicesResult['log']);
                    }
                }

                //for updating enquiry status to "complete"
                if(isset($params->invoices) && count($params->invoices) > 0){
                    $invoices       = $params->invoices;
                    $temp_sche_id_array = array();

                    //loop through invoices that has a schedule_id and get enquiry_id from each schedule
                    foreach($invoices as $sch_in_invoice){
                        //get schedule_id of invoice and get enquiry_id from that schedule
                        if(isset($sch_in_invoice->schedule_id) && count($sch_in_invoice->schedule_id) > 0){
                            $enquiry_id = $scheduleRepo->getEnquiryIdFromScheduleId($sch_in_invoice->schedule_id);
                            if(isset($enquiry_id) && count($enquiry_id) > 0){
                                $enquiry = Enquiry::find($enquiry_id);
                                //update status to "complete"
                                if(isset($enquiry) && count($enquiry)>0){
                                    $enquiry->status = "complete";
                                    $enquiry->save();
                                }
                            }                            
                        }                        
                    }

                    $invoiceResult  = $invoiceRepo->invoices($invoices);

                    if($invoiceResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $invoiceResult['tablet_id'] = $tablet_id;
                        $invoiceResult['data']      = (object) array();
                        return \Response::json($invoiceResult);
                    }

                    if(isset($invoiceResult['log']) && count($invoiceResult['log']) > 0){
                        array_push($logArr,$invoiceResult['log']);
                    }
                }

                //all insertions were successful
                DB::commit();
                if(isset($logArr) && count($logArr) > 0){
                    //create custom log file with created_at or updated_at
                    foreach($logArr as $logKey=>$logValue){
                        foreach($logValue as $value){
                            $date = $value['date'];
                            $message = '['. $date .'] '. 'info User - '.$user_id .' '. $value['message'] .' with tablet_id - '.$tablet_id. PHP_EOL;
                            LogCustom::create($date,$message);
                        }
                    }
                }

                $data  = array();
                $patientIdArray = array();

                $productArr                                 = $productRepo->getProductArray();
                $routeArr                                   = $routeRepo->getRouteArray();
                $medical_historyArr                         = $medical_historyRepo->getMedicalHistoryArray();
                $family_historyArr                          = $family_historyRepo->getFamilyHistoryArray();

                $data[0]['products']                        = $productArr;
                $data[0]['route']                           = $routeArr;
                $data[0]['medical_history']                 = $medical_historyArr;
                $data[0]['family_histories']                = $family_historyArr;

                if(isset($params->schedules) && count($params->schedules) > 0){
                    foreach($params->schedules as $schedules){
                        array_push($patientIdArray,$schedules->patient_id);
                    }

                    $enquiryArr                                 = $enquiryRepo->getEnquiryArray($patientIdArray);
                    $scheduleArr                                = $scheduleRepo->getScheduleArray($patientIdArray);
                    $schedule_treatmentArr                      = $scheduleRepo->getScheduleTreatmentArray($patientIdArray);
                    $patientData                                = $patientRepo->getPatientData($patientIdArray);
                    $patientMedicalHistoryData                  = $patientRepo->getPatientMedicalHistoryData($patientIdArray);
                    $patientSurgeryHistoryData                  = $patientRepo->getPatientSurgeryHistoryData($patientIdArray);
                    $patientFamilyHistoryData                   = $patientRepo->getPatientFamilyHistoryData($patientIdArray);
                    $patientFamilyMemberData                    = $patientRepo->getPatientFamilyMemberData();

                    $data[0]['enquiries']                       = $enquiryArr;
                    $data[0]['schedules']                       = $scheduleArr;
                    $data[0]['schedule_treatment_histories']    = $schedule_treatmentArr;
                    $data[0]['patients']                        = $patientData;
                    $data[0]['patient_medical_history']         = $patientMedicalHistoryData;
                    $data[0]['patient_family_history']          = $patientFamilyHistoryData;
                    $data[0]['patient_surgery_history']         = $patientSurgeryHistoryData;
                    $data[0]['patient_family_member']           = $patientFamilyMemberData;

                }

                elseif(isset($params->enquiries) && count($params->enquiries)) {
                    $newEnquiryArr = $enquiryRepo->getNewEnquiryArray();

                    $data[0]['enquiries']                       = $newEnquiryArr;
                    $data[0]['schedules']                       = [];
                    $data[0]['schedule_treatment_histories']    = [];
                    $patient                                    = [];
//                    $patient[0]['patient_allergy']              = [];
//                    $patient[0]['log_patient_case_summary']     = [];
//                    $patient[0]['core_user']                    = new \stdClass();
                    $data[0]['patients']                        = $patient;
                    $data[0]['patient_medical_history']         = [];
                    $data[0]['patient_family_history']          = [];
                    $data[0]['patient_surgery_history']         = [];
                    $data[0]['patient_family_member']           = [];
                }

                $prefix                             = $checkServerStatusArray['tablet_id'];
                $patient_prefix                     = Utility::generatePatientPrefix($prefix);

                $maxInvoice                         = Utility::getMaxKey($prefix,'invoices','id');
                $maxMedicalHistory                  = Utility::getMaxKey($prefix,'medical_history','id');
                $maxFamilyHistory                   = Utility::getMaxKey($prefix,'family_histories','id');
                $maxPatientFamilyHistory            = Utility::getMaxKey($prefix,'patient_family_history','id');
                $maxPatientFamilyMember             = Utility::getMaxKey($prefix,'patient_family_member','id');
                $maxPatientMedicalHistory           = Utility::getMaxKey($prefix,'patient_medical_history','id');
                $maxPatientSurgeryHistory           = Utility::getMaxKey($prefix,'patient_surgery_history','id');
                $maxProduct                         = Utility::getMaxKey($prefix,'products','id');
                $maxSchedulePatientChiefComplaint   = Utility::getMaxKey($prefix,'schedule_patient_chief_complaint','id');
                $maxSchedulePatientVital            = Utility::getMaxKey($prefix,'schedule_patient_vitals','id');
                $maxSchedulePhysicalExamAbdomen     = Utility::getMaxKey($prefix,'schedule_physical_exams_abdomen_extre_neuro','id');
                $maxSchedulePhysicalExamGeneral     = Utility::getMaxKey($prefix,'schedule_physical_exams_general_pupils_head','id');
                $maxSchedulePhysicalExamHeart       = Utility::getMaxKey($prefix,'schedule_physical_exams_heart_lungs','id');
                $maxSchedulePhysiotherapyMusculo    = Utility::getMaxKey($prefix,'schedule_physiotherapy_musculo','id');
                $maxSchedulePhysiotherapyNeuro      = Utility::getMaxKey($prefix,'schedule_physiotherapy_neuro','id');
                $maxScheduleTreatmentHistory        = Utility::getMaxKey($prefix,'schedule_treatment_histories','id');
                $maxScheduleTracking                = Utility::getMaxKey($prefix,'schedule_trackings','id');
                $maxSchedule                        = Utility::getMaxKey($prefix,'schedules','id');
                $maxEnquiry                         = Utility::getMaxKey($prefix,'enquiries','id');
                $maxRoute                           = Utility::getMaxKey($prefix,'route','id');
                $maxPatient                         = Utility::getMaxKey($patient_prefix,'patients','user_id');
                $maxCoreUser                        = Utility::getMaxKey($patient_prefix,'core_users','id');
                $maxOtherService                    = Utility::getMaxKey($prefix,'other_services','id');

                $maxKey = array();

                $maxKey[0]['table_name']   = "invoices";
                $maxKey[0]['max_key_id']   = $maxInvoice;
                $maxKey[1]['table_name']   = "medical_history";
                $maxKey[1]['max_key_id']   = $maxMedicalHistory;
                $maxKey[2]['table_name']   = "family_histories";
                $maxKey[2]['max_key_id']   = $maxFamilyHistory;
                $maxKey[3]['table_name']   = "patient_family_history";
                $maxKey[3]['max_key_id']   = $maxPatientFamilyHistory;
                $maxKey[4]['table_name']   = "patient_family_member";
                $maxKey[4]['max_key_id']   = $maxPatientFamilyMember;
                $maxKey[5]['table_name']   = "patient_medical_history";
                $maxKey[5]['max_key_id']   = $maxPatientMedicalHistory;
                $maxKey[6]['table_name']   = "patient_surgery_history";
                $maxKey[6]['max_key_id']   = $maxPatientSurgeryHistory;
                $maxKey[7]['table_name']   = "products";
                $maxKey[7]['max_key_id']   = $maxProduct;
                $maxKey[8]['table_name']   = "schedule_patient_chief_complaint";
                $maxKey[8]['max_key_id']   = $maxSchedulePatientChiefComplaint;
                $maxKey[9]['table_name']   = "schedule_patient_vitals";
                $maxKey[9]['max_key_id']   = $maxSchedulePatientVital;;
                $maxKey[10]['table_name']  = "schedule_physical_exams_abdomen_extre_neuro";
                $maxKey[10]['max_key_id']  = $maxSchedulePhysicalExamAbdomen;
                $maxKey[11]['table_name']  = "schedule_physical_exams_general_pupils_head";
                $maxKey[11]['max_key_id']  = $maxSchedulePhysicalExamGeneral;
                $maxKey[12]['table_name']  = "schedule_physical_exams_heart_lungs";
                $maxKey[12]['max_key_id']  = $maxSchedulePhysicalExamHeart;
                $maxKey[13]['table_name']  = "schedule_physiotherapy_musculo";
                $maxKey[13]['max_key_id']  = $maxSchedulePhysiotherapyMusculo;
                $maxKey[14]['table_name']  = "schedule_physiotherapy_neuro";
                $maxKey[14]['max_key_id']  = $maxSchedulePhysiotherapyNeuro;
                $maxKey[15]['table_name']  = "schedule_treatment_histories";
                $maxKey[15]['max_key_id']  = $maxScheduleTreatmentHistory;
                $maxKey[16]['table_name']  = "schedule_trackings";
                $maxKey[16]['max_key_id']  = $maxScheduleTracking;
                $maxKey[17]['table_name']  = "schedules";
                $maxKey[17]['max_key_id']  = $maxSchedule;
                $maxKey[18]['table_name']  = "enquiries";
                $maxKey[18]['max_key_id']  = $maxEnquiry;
                $maxKey[19]['table_name']  = "route";
                $maxKey[19]['max_key_id']  = $maxRoute;
                $maxKey[20]['table_name']  = "patients";
                $maxKey[20]['max_key_id']  = $maxPatient;
                $maxKey[21]['table_name']  = "core_users";
                $maxKey[21]['max_key_id']  = $maxCoreUser;
                $maxKey[22]['table_name']  = "other_services";
                $maxKey[22]['max_key_id']  = $maxOtherService;


                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $tablet_id;
                $returnedObj['user_id']                 = $user_id;
                $returnedObj['max_key']                 = $maxKey;
                $returnedObj['data']                    = $data;

                return \Response::json($returnedObj);

            }
            catch(\Exception $e){
                DB::rollback();
                $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage']    = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data']                    = (object) array();
                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }
}
