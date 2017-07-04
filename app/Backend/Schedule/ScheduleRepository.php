<?php
/**
 * Created by PhpStorm.
<<<<<<< HEAD
 * Author: Wai Yan Aung
 * Date: 8/9/2016
 * Time: 4:50 PM
 */

namespace App\Backend\Schedule;
use App\Backend\Enquiry\EnquiryRepository;
use App\Backend\Investigation\Investigation;
use App\Backend\Invoice\Invoice;
use App\Backend\Packagesale\Packagesale;
use App\Backend\Provisionaldiagnosis\Provisionaldiagnosis;
use App\Backend\Scheduledetail\Scheduledetail;
use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Service\ServiceRepository;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Enquiry\Enquiry;

class ScheduleRepository implements  ScheduleRepositoryInterface
{
    public function getObjs($schedule_status = null, $from_date = null, $to_date = null)
    {
        $query = Schedule::query();
        if(isset($schedule_status) && $schedule_status != null && $schedule_status <> 'all'){
            $query = $query->where('status', $schedule_status);
        }
        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->where('date', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->where('date', '<=', $tempToDate);
        }
        $query = $query->whereNull('deleted_at');
        $objs = $query->get();
        return $objs;
    }

    public function getArrays(){
        $tempObj = DB::select("SELECT * FROM schedules WHERE deleted_at is null ORDER BY date DESC");
        return $tempObj;
    }

    public function create($paramObj,$services,$hhcsPersonnels)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {

            DB::beginTransaction();
            $tempObj = Utility::addCreatedBy($paramObj);
            $prefix = Utility::getTerminalId();
            $table = (new Schedule())->getTable();
            $col = "id";
            $offset = 1;
            $scheduleId = Utility::generatedId($prefix,$table,$col,$offset);
            $tempObj->id = $scheduleId;

            if($tempObj->save()){

                // Saving the Schedule Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $scheduleId, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }
                if(isset($hhcsPersonnels) && count($hhcsPersonnels)>0){
                    foreach($hhcsPersonnels as $user_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $scheduleId, 'user_id' => $user_id, 'type' => 'user']
                        ]);
                    }
                }

                // Updating the enquiry status to "confirm"
                $enquiryId = $tempObj->enquiry_id;
                if($enquiryId != ""){
                    $enquiryRepo = new EnquiryRepository();
                    $enquiryRepo->confirm($enquiryId);
                }

                DB::commit();

                //create info log
                $date = $tempObj->created_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created schedule_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();

                //create error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a schedule and got error'. PHP_EOL;
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();

            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a schedule and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($id,$paramObj,$services,$hhcsPersonnels)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $schedule_id = $id;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {

            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);

            if($tempObj->save()){

                // Cleaning all service, allergy and related thing about the selected enquiry
                DB::table('schedule_detail')->where('schedule_id', '=', $schedule_id)->delete();

                // Saving the Schedule Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $schedule_id, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }

                if(isset($hhcsPersonnels) && count($hhcsPersonnels)>0){
                    foreach($hhcsPersonnels as $user_id){
                        DB::table('schedule_detail')->insert([
                            ['schedule_id' => $schedule_id, 'user_id' => $user_id, 'type' => 'user']
                        ]);
                    }
                }

                DB::commit();

                //update info log
                $date = $tempObj->updated_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated schedule_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();

                //update error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated schedule_id = ' .$tempObj->id. ' and got error.'. PHP_EOL;
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();

            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated schedule_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = Schedule::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);
            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->save();

            //delete info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted schedule_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  schedule_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){

        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $tempObj    = Schedule::find($id);

        if(isset($tempObj) && count($tempObj)>0) {


            $tempDate       = $tempObj->date;
            $tempDob        = $tempObj->dob;
            $patientId      = $tempObj->patient_id;

            $tempObj->date  = date("d-m-Y", strtotime($tempDate));
            $tempObj->dob   = date("d-m-Y", strtotime($tempDob));
            $hhcsPersonals  = $this->getHHCSPersonal();

            $serviceRepo    = new ServiceRepository();
            $services       = $serviceRepo->getArrays();

            $allergyRepo    = new AllergyRepository();
            $allergyFood    = $allergyRepo->getArraysByType('food');
            $allergyDrug    = $allergyRepo->getArraysByType('drug');
            $tempAllergies  = array();

            $patientAllergies       = DB::select("SELECT * FROM patient_allergy WHERE patient_id = '$patientId'");
            $scheduleServices       = DB::select("SELECT * FROM schedule_detail WHERE schedule_id = '$id' AND type = 'service'");
            $scheduleHHCSPersonnels = DB::select("SELECT * FROM schedule_detail WHERE schedule_id = '$id' AND type = 'user'");

            if (isset($patientAllergies) && count($patientAllergies) > 0) {

                $tempScheduleArray = array();
                foreach ($patientAllergies as $allergy) {
                    $algId = $allergy->allergy_id;
                    array_push($tempScheduleArray, $algId);
                }

                if (isset($allergyFood) && count($allergyFood) > 0) {

                    foreach ($allergyFood as $keyAlg => $alg) {

                        if (in_array($alg->id, $tempScheduleArray)) {
                            $allergyFood[$keyAlg]->selected = 1;
                        }
                    }

                    foreach ($allergyFood as $keyAlg2 => $alg2) {

                        if (!array_key_exists('selected', $alg2)) {
                            $allergyFood[$keyAlg2]->selected = 0;
                        }
                    }
                }
                $tempAllergies['food'] = $allergyFood;
            } else {

                foreach ($allergyFood as $keyAlg3 => $alg3) {
                    $allergyFood[$keyAlg3]->selected = 0;
                }
                $tempAllergies['food'] = $allergyFood;
            }

            if (isset($enquiryAllergies) && count($enquiryAllergies) > 0) {

                $tempScheduleArray = array();
                foreach ($enquiryAllergies as $allergy) {
                    $algId = $allergy->allergy_id;
                    array_push($tempScheduleArray, $algId);
                }

                if (isset($allergyDrug) && count($allergyDrug) > 0) {

                    foreach ($allergyDrug as $keyAlg => $alg) {

                        if (in_array($alg->id, $tempScheduleArray)) {
                            $allergyDrug[$keyAlg]->selected = 1;
                        }
                    }

                    foreach ($allergyDrug as $keyAlg2 => $alg2) {

                        if (!array_key_exists('selected', $alg2)) {
                            $allergyDrug[$keyAlg2]->selected = 0;
                        }
                    }
                }
                $tempAllergies['drug'] = $allergyDrug;
            } else {

                foreach ($allergyDrug as $keyAlg3 => $alg3) {
                    $allergyDrug[$keyAlg3]->selected = 0;
                }
                $tempAllergies['drug'] = $allergyDrug;
            }
            $tempObj['allergies'] = $tempAllergies;

            if (isset($scheduleServices) && count($scheduleServices) > 0) {

                $tempSrvArray = array();
                foreach ($scheduleServices as $service) {
                    $srvId = $service->service_id;
                    array_push($tempSrvArray, $srvId);
                }

                if (isset($services) && count($services) > 0) {
                    foreach ($services as $keySrv => $srv) {
                        if (in_array($srv->id, $tempSrvArray)) {
                            $services[$keySrv]->selected = 1;
                        }
                    }
                    foreach ($services as $keySrv2 => $srv2) {

                        if (!array_key_exists('selected', $srv2)) {
                            $services[$keySrv2]->selected = 0;
                        }
                    }
                }
                $tempObj['services'] = $services;
            } else {

                foreach ($services as $keySrv3 => $srv3) {
                    $services[$keySrv3]->selected = 0;
                }
                $tempObj['services'] = $services;
            }

            // Retrieve the HHCS Personnel about the schedule
            if (isset($scheduleHHCSPersonnels) && count($scheduleHHCSPersonnels) > 0) {
                $tempHHCSArray = array();
                foreach ($scheduleHHCSPersonnels as $HHCSPersonnel) {
                    $srvId = $HHCSPersonnel->user_id;
                    array_push($tempHHCSArray, $srvId);
                }

                if (isset($hhcsPersonals) && count($hhcsPersonals) > 0) {
                    foreach ($hhcsPersonals as $keyHhcs => $Hhcs) {

                        if (in_array($Hhcs->id, $tempHHCSArray)) {
                            $hhcsPersonals[$keyHhcs]->selected = 1;
                        }
                    }

                    foreach ($hhcsPersonals as $keyHhcs2 => $Hhcs2) {

                        if (!array_key_exists('selected', $Hhcs2)) {
                            $hhcsPersonals[$keyHhcs2]->selected = 0;
                        }
                    }
                }
                $tempObj['hhcsPersonals'] = $hhcsPersonals;
            } else {
                foreach ($hhcsPersonals as $keyHHCS3 => $hhcs3) {
                    $hhcsPersonals[$keyHHCS3]->selected = 0;
                }
                $tempObj['hhcsPersonals'] = $hhcsPersonals;
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['result'] = $tempObj;
            return $returnedObj;
        }

        return $returnedObj;
    }

    public function getArrayByID($id){

        $tempSchedule = new Schedule();
        $tbName = $tempSchedule->getTable();
        $rawObj = DB::select("SELECT * FROM $tbName WHERE id = '$id'");

        if(isset($rawObj) && count($rawObj)>0){
            $tempObj = $rawObj[0];
        }
        else{
            return array();
        }

        $tempDate = $tempObj->date;
        $tempDob = $tempObj->dob;

        $tempObj->date = date("d-m-Y", strtotime($tempDate));
        $tempObj->dob = date("d-m-Y", strtotime($tempDob));


        $serviceRepo = new ServiceRepository();
        $services      = $serviceRepo->getArrays();

        $allergyRepo    = new AllergyRepository();
        $hhcsPersonnels      = $allergyRepo->getArrays();

        $enquiryAllergies = DB::select("SELECT * FROM enquiry_detail WHERE schedule_id = '$id' AND type = 'allergy'");
        $scheduleServices = DB::select("SELECT * FROM enquiry_detail WHERE schedule_id = '$id' AND type = 'service'");

        if(isset($enquiryAllergies) && count($enquiryAllergies)>0){

            $tempEnqArray = array();
            foreach($enquiryAllergies as $allergy){
                $algId = $allergy->allergy_id;
                array_push($tempEnqArray,$algId);
            }

            if(isset($hhcsPersonnels) && count($hhcsPersonnels)>0){

                foreach($hhcsPersonnels as $keyAlg => $alg){

                    if (in_array($alg->id, $tempEnqArray)) {
                        $hhcsPersonnels[$keyAlg]->selected = 1;
                    }
                }

                foreach($hhcsPersonnels as $keyAlg2 => $alg2){

                    if (!array_key_exists('selected', $alg2)) {
                        $hhcsPersonnels[$keyAlg2]->selected = 0;
                    }
                }
            }
            $tempObj->allergies = $hhcsPersonnels;
        }
        else{

            foreach($hhcsPersonnels as $keyAlg3 => $alg3){
                $hhcsPersonnels[$keyAlg3]->selected = 0;
            }
            $tempObj->allergies = $hhcsPersonnels;
        }

        if(isset($scheduleServices) && count($scheduleServices)>0){

            $tempSrvArray = array();
            foreach($scheduleServices as $service){
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

    public function getHHCSPersonal()
    {
        $tempObj = DB::select("SELECT * FROM core_users WHERE deleted_at is null AND role_id NOT IN (1,2,5)");
        return $tempObj;
    }

    public function getObjByPatientPackageID($patient_package_id)
    {
        $obj = Schedule::where('patient_package_id', $patient_package_id)->get();
        return $obj;
    }

    public function getObjByPatientID($patient_id)
    {
        $obj = Schedule::where('patient_id', $patient_id)->get();
        return $obj;
    }

    public function getScheduleHistory($id){
        $result = Schedule::
        leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
            ->select('schedules.id','schedules.status','schedules.date','schedules.time')
            ->groupBy('schedules.id')
            ->where('schedules.patient_id','=',$id)
            ->where('schedules.deleted_at','=',null)
            ->get();
        return $result;
    }

    public function servicesForEachSchedule($scheduleID){
        $result = Scheduledetail::
            select('service_id')
            ->where('schedule_id','=',$scheduleID)
            ->where('type','=','service')
            ->get();
        return $result;
    }

    public function getServiceHistory($id)
    {
        $result = Schedule::
        leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
            ->leftjoin('services', 'services.id', '=', 'schedule_detail.service_id')
            ->select('services.id','services.name as service_name',DB::raw('count(schedule_detail.service_id) as count'))
            ->where('schedules.patient_id','=',$id)
            ->where('schedules.deleted_at','=',null)
            ->whereNotNull('services.id')
            ->groupBy('services.id')
            ->get();
        return $result;
    }

    public function getPackageHistory($id){
        $result = Schedule::
        leftjoin('patient_package', 'patient_package.id', '=', 'schedules.patient_package_id')
            ->leftjoin('packages', 'packages.id', '=', 'patient_package.package_id')
            ->select('patient_package.package_id as package_id','packages.package_name as package_name','patient_package.sold_date as date')
            ->where('schedules.patient_id','=',$id)
            ->where('schedules.patient_package_id','<>',0)
            ->get();
        return $result;
    }

    public function getPackageHistoryV2($id){
        $result = Packagesale::
            leftjoin('packages', 'packages.id', '=', 'patient_package.package_id')
            ->select('patient_package.package_id as package_id','packages.package_name as package_name','patient_package.sold_date as date')
            ->where('patient_package.patient_id','=',$id)
            ->get();
        return $result;
    }

    public function getScheduleCount($id)
    {
        $result = Schedule::
        leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
            ->where('schedules.patient_id', '=', $id)
            ->where('schedules.deleted_at', '=', null)
            ->get();
        return $result;
    }

    public function getScheduleStatus(){
        $result = Schedule::
            select('status',DB::raw('count(id) as count'))
            ->groupBy('status')
            ->get();
        return $result;
    }

    public function getScheduleStatusByDate($from_date = null, $to_date = null){
        $query = Schedule::query();
        $query = $query->select('status',DB::raw('count(id) as count'));
        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->where('date', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->where('date', '<=', $tempToDate);
        }
        $query = $query->groupBy('status');
        $result = $query->get();

        return $result;
    }

    public function getCarUsageReport($from_date = null, $to_date = null, $paramArray = null){
        $query = Schedule::query();
        $query = $query->select('date', 'car_type_id', DB::raw('count(car_type_id) as count'));
        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->where('date', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->where('date', '<=', $tempToDate);
        }
        $query = $query->where('car_type_id', '!=', 0);
        $query = $query->whereIn('id',$paramArray);
        $query = $query->whereNull('deleted_at');
        $query = $query->groupBy('date','car_type_id');
        $result = $query->get();
        return $result;
    }

    public function getScheduleDetail($id){
        $result = Scheduledetail::
                where('schedule_id','=',$id)
                ->where('type','=','user')
                ->get();
        return $result;
    }

    public function getUsersByScheduleID($type = null, $from_date = null, $to_date = null, $paramArray = null){
        $query = Scheduledetail::query();
        $query = $query->leftjoin('schedules','schedules.id', '=', 'schedule_detail.schedule_id');
        $query = $query->leftjoin('core_users','core_users.id', '=', 'schedule_detail.user_id');
        $query = $query->select('core_users.role_id', 'schedules.date','schedule_detail.*');

        if(isset($type) && $type != null && $type <> 'all'){
            $query = $query->where('role_id', $type);
        }
        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->where('schedules.date', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->where('schedules.date', '<=', $tempToDate);
        }
        $query = $query->where('schedule_detail.type', '=', 'user');
        $query = $query->whereIn('schedule_detail.schedule_id',$paramArray);
        $query = $query->whereNull('schedules.deleted_at');
        $result = $query->get();

        return $result;
    }

    public function getVisitReport($paramArray){
        $result = Schedule::
            select('date', 'car_type_id', DB::raw('count(car_type_id) as count'))
            ->where('car_type_id', '!=', 0)
            ->whereNull('deleted_at')
            ->whereIn('id',$paramArray)
            ->groupBy('date','car_type_id')
            ->get();
        return $result;
    }

    public function getScheduleDetails($id)
    {
        $result = Schedule::
        leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
            ->where('schedules.patient_id', '=', $id)
            ->where('schedules.deleted_at', '=', null)
            ->get();
        return $result;
    }

    public function getSaleSummaryReport($from_date = null, $to_date = null, $paramArray = null){
        $query = Schedule::query();
        $query = $query->leftjoin('invoices', 'invoices.schedule_id', '=', 'schedules.id');
        $query = $query->leftjoin('invoice_detail', 'invoice_detail.invoice_id', '=', 'invoices.id');
        $query = $query->leftjoin('car_type_setup', 'car_type_setup.id', '=', 'invoice_detail.car_type_setup_id');
        $query = $query->leftjoin('patients', 'patients.user_id', '=', 'invoices.patient_id');
        $query = $query->leftjoin('townships', 'townships.id', '=', 'schedules.township_id');
        $query = $query->select('invoices.id',
            'patients.name as patient',
            'townships.name as township',
            'invoices.type as invoice_type',
            'invoice_detail.car_type as car_type',
            'invoice_detail.car_type_setup_id as car_type_setup_id',
            DB::raw('DATE(invoices.created_at) as date'),
            'invoices.total_payable_amt as amount');

        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->where('invoices.date', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->where('invoices.date', '<=', $tempToDate);
        }

        $query = $query->whereIn('schedules.id',$paramArray);
        $query = $query->whereNull('invoices.deleted_at');
        $query = $query->whereNull('schedules.deleted_at');
        $result = $query->get();
        return $result;
    }

    public function getSaleSummary($from_date = null, $to_date = null, $paramArray = null){
        $query = Invoice::query();
        $query = $query->leftjoin('invoice_detail', 'invoice_detail.invoice_id', '=', 'invoices.id');
        $query = $query->leftjoin('car_type_setup', 'car_type_setup.id', '=', 'invoice_detail.car_type_setup_id');
        $query = $query->leftjoin('patients', 'patients.user_id', '=', 'invoices.patient_id');
        $query = $query->leftjoin('townships', 'townships.id', '=', 'invoices.township_id');
        $query = $query->select('invoices.id',
            'patients.name as patient',
            'townships.name as township',
            'invoices.type as invoice_type',
            'invoice_detail.car_type as car_type',
            'invoice_detail.car_type_setup_id as car_type_setup_id',
            DB::raw('DATE(invoices.created_at) as date'),
            'invoices.total_payable_amt as amount');

        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->where('invoices.created_at', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->where('invoices.created_at', '<=', $tempToDate);
        }

        $query = $query->whereNull('invoices.deleted_at');
        $result = $query->get();
        return $result;
    }

    public function getScheduleVitals($latest_schedule_id){
        $vitals = DB::table('schedule_patient_vitals')->whereNull('deleted_at')->where('schedule_id','=',$latest_schedule_id)->get();
        return $vitals;
    }

    public function getChiefComplaint($latest_schedule_id){
        $chief_complaints   = DB::table('schedule_patient_chief_complaint')->whereNull('deleted_at')->where('schedule_id','=',$latest_schedule_id)->get();
        return $chief_complaints;
    }

    public function getGeneralPupilHead($latest_schedule_id){
//        $gph  = DB::table('schedule_physical_exams_general_pupils_head')->whereNull('deleted_at')->where('schedule_id','=',
//            $latest_schedule_id)->first();
        $gph  = DB::table('schedule_physical_exams_general_pupils_head')->whereNull('deleted_at')->where('schedule_id','=',
            $latest_schedule_id)->orderBy('id', 'desc')->first();
        return $gph;
    }

    public function getHeartLung($latest_schedule_id){
//        $hl = DB::table('schedule_physical_exams_heart_lungs')->whereNull('deleted_at')->where('schedule_id','=',$latest_schedule_id)->first();
        $hl = DB::table('schedule_physical_exams_heart_lungs')
            ->whereNull('deleted_at')
            ->where('schedule_id','=',$latest_schedule_id)
            ->orderBy('id', 'desc')
            ->first();
        return $hl;
    }

    public function getAbdomenExtreNeuro($latest_schedule_id){
        $aen    = DB::table('schedule_physical_exams_abdomen_extre_neuro')
            ->whereNull('deleted_at')
            ->where('schedule_id','=',$latest_schedule_id)
            ->orderBy('id', 'desc')
            ->first();
        return $aen;
    }

    public function getInvestigationId($latest_schedule_id){
        $investigation_id = DB::table('schedule_investigations')->select(array('investigation_id'))->where('schedule_id','=',$latest_schedule_id)->get();
        $investigation_id = collect($investigation_id)->map(function($x){ return (array) $x; })->toArray(); //change array in array
        return $investigation_id;
    }

    public function getInvestigationGroupName($investigation_id){
        $group_name             = Investigation::select('group_name')->whereIn('id',$investigation_id)->groupBy('group_name')->get();
        return $group_name;
    }

    public function getInvestigations($investigation_id){
        $investigation_labs     = Investigation::select('id','name','group_name')->whereIn('id',$investigation_id)->orderBy('name')->get();
        return $investigation_labs;
    }

    public function getInvestigationLabs($investigation_id){
//        $investigation_labs     = Investigation::select('id','name','group_name')->whereIn('id',$investigation_id)->orderBy('name')->get();
        $investigation_labs     = DB::table('investigation_labs')->select('id','service_name')->whereIn('id',$investigation_id)->orderBy('service_name')->get();
        return $investigation_labs;
    }

    public function getScheduleProvisionalDiagnosis($latest_schedule_id){
        $provisional_id  = DB::table('schedule_provisional_diagnosis')->select('provisional_id')->whereNull('deleted_at')->where('schedule_id','=',$latest_schedule_id)->get();
        $provisional_id = collect($provisional_id)->map(function($x){ return (array) $x; })->toArray();
        return $provisional_id;
    }

    public function getProvisionalDiagnosis($provisional_id){
        $provisional_diagnosis   = Provisionaldiagnosis::whereNull('deleted_at')->whereIn('id',$provisional_id)->get();
        return $provisional_diagnosis;
    }

    public function getScheduleTreatment($latest_schedule_id){
        $treatments     = DB::table('schedule_treatment_histories')
                          ->leftjoin('products','products.id','=','schedule_treatment_histories.product_id')
                          ->select('products.product_name','products.price','schedule_treatment_histories.*')
                          ->whereNull('schedule_treatment_histories.deleted_at')
                          ->where('schedule_treatment_histories.schedule_id','=',$latest_schedule_id)->get();
        return $treatments;
    }

    public function getNeurologicalRecords($latest_schedule_id){
        $neurologicals  = DB::table('schedule_physiotherapy_neuro')->whereNull('deleted_at')->where('schedules_id','=',$latest_schedule_id)->get();
        return $neurologicals;
    }

    public function getMusculoIntercentionRecords($latest_schedule_id){
        $musculo_intercention   = DB::table('schedule_physiotherapy_musculo')->whereNull('deleted_at')->where('schedules_id',$latest_schedule_id)->get();
        return $musculo_intercention;
    }

    public function getNutrition($latest_schedule_id,$patient_id){
        $nutritions = DB::table('nutrition')->where('schedule_id',$latest_schedule_id)->where('patient_id',$patient_id)->get();
        return $nutritions;
    }

    public function getScheduleInvestigation($latest_schedule_id){
        $schedule_investigation = DB::table('schedule_investigations')->where('schedule_id','=',$latest_schedule_id)->get();
        return $schedule_investigation;
    }

    public function getInvoiceHeader($from_date = null, $to_date = null, $paramArray = null){
        $query = Invoice::query();
//        $query = $query->leftjoin('invoice_detail', 'invoice_detail.invoice_id', '=', 'invoices.id');
//        $query = $query->leftjoin('car_type_setup', 'car_type_setup.id', '=', 'invoice_detail.car_type_setup_id');
        $query = $query->leftjoin('patients', 'patients.user_id', '=', 'invoices.patient_id');
        $query = $query->leftjoin('townships', 'townships.id', '=', 'invoices.township_id');
        $query = $query->select('invoices.id',
            'patients.name as patient',
            'townships.name as township',
            'invoices.type as invoice_type',
//            'invoice_detail.car_type as car_type',
//            'invoice_detail.car_type_setup_id as car_type_setup_id',
            DB::raw('DATE(invoices.created_at) as date'),
            'invoices.total_payable_amt as amount');

        if(isset($from_date) && $from_date != null){
            $tempFromDate = date("Y-m-d", strtotime($from_date));
            $query = $query->whereDate('invoices.created_at', '>=' , $tempFromDate);
        }
        if(isset($to_date) && $to_date != null){
            $tempToDate = date("Y-m-d", strtotime($to_date));
            $query = $query->whereDate('invoices.created_at', '<=', $tempToDate);
        }

        $query = $query->whereNull('invoices.deleted_at');
        $query = $query->orderBy('date', 'desc');
        $result = $query->get();
        return $result;
    }

    public function getInvoiceDetail()
    {
        $result = DB::table('invoice_detail')->where('car_type','!=',0)->get();
        return $result;
    }

    //for blood drawing
    public function getBloodDrawing($latest_schedule_id, $patient_id)
    {
        $bloodDrawings = DB::table('schedule_investigations')
            ->leftjoin('investigation_labs', 'schedule_investigations.investigation_id', '=', 'investigation_labs.id')
            ->select('schedule_investigations.investigation_lab_remark',
                'schedule_investigations.investigation_labs_price',
                'schedule_investigations.investigation_labs_type',
                'investigation_labs.service_name',
                'investigation_labs.description')
            ->where('schedule_investigations.schedule_id',$latest_schedule_id)
            ->where('schedule_investigations.patient_id',$patient_id)
            ->where('schedule_investigations.investigation_id','!=',0)->get();
        return $bloodDrawings;
    }

    public function getBloodDrawingRemark($latest_schedule_id, $patient_id)
    {
        $bloodDrawingRemark = DB::table('schedule_investigations')
            ->select('investigation_lab_remark')
            ->where('schedule_id',$latest_schedule_id)
            ->where('patient_id',$patient_id)
            ->where('investigation_lab_remark','!=',"")->first();
        if(isset($bloodDrawingRemark) && count($bloodDrawingRemark)>0){
            return $bloodDrawingRemark->investigation_lab_remark;
        }
        else{
            return null;
        }
    }

    public function getScheduleProvisionalDiagnosisRemark($latest_schedule_id, $provisional_id)
    {
        $provisional_remark  = DB::table('schedule_provisional_diagnosis')->select('remark')
            ->whereNull('deleted_at')
            ->where('schedule_id','=',$latest_schedule_id)
            ->where('provisional_id','=',$provisional_id)
            ->first();
        $provisional_remark = collect($provisional_remark)->map(function($x){ return (array) $x; })->toArray();
        return $provisional_remark;
    }

    public function getSchedulesWithService($schedulesArray = [], $type = null, $from_date = null, $to_date = null) {
//        $result = Schedule::leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
//                    ->where('schedule_detail.type','=','service')
//                    ->whereIn('schedules.id', $schedulesArray)
//                    ->whereNull('schedules.deleted_at')
//                    ->get();

        $query = Schedule::query();
        $query = $query->leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id');
        $query = $query->whereIn('schedules.id', $schedulesArray);
        $query = $query->where('schedule_detail.type','=','service');
        $query = $query->whereNull('schedules.deleted_at');

        if(isset($type) && $type != null && $type == 'yearly'){
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime('01-01-'.$from_date));
                $query = $query->where('schedules.date', '>=' , $tempFromDate);
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime('31-12-'.$to_date));
                $query = $query->where('schedules.date', '<=', $tempToDate);
            }
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime('01-'.$from_date));
                $query = $query->where('schedules.date', '>=' , $tempFromDate);
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime('31-'.$to_date));
                $query = $query->where('schedules.date', '<=', $tempToDate);
            }
        }
        else{
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime($from_date));
                $query = $query->where('schedules.date', '>=' , $tempFromDate);
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime($to_date));
                $query = $query->where('schedules.date', '<=', $tempToDate);
            }
        }

        $query = $query->orderBy('schedules.date','desc');
        $result = $query->get();

        return $result;
    }

    public function getSchedulesByDate($date) {
        $result = Schedule::where('date','=',$date)->get();
        return $result;
    }

    public function getEachVisitByDate($date,$service_id) {
        $result = Schedule::leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
            ->where('schedules.date','=',$date)
            ->where('schedule_detail.service_id','=',$service_id)
            ->get();
        return $result;
    }

    public function getScheduleOtherServices($latest_schedule_id, $patient_id){
        $treatments     = DB::table('other_services')
            ->leftjoin('other_services_detail','other_services.id','=','other_services_detail.other_services_id')
            ->select('other_services.id','other_services_detail.name','other_services_detail.remark')
            ->whereNull('other_services.deleted_at')
            ->where('other_services.schedule_id','=',$latest_schedule_id)
            ->where('other_services.patient_id','=',$patient_id)
            ->get();
        return $treatments;
    }
}

