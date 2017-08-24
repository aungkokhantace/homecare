<?php
/**
 * Created by PhpStorm.

 * Author: Wai Yan Aung
 * Date: 8/9/2016
 * Time: 4:51 PM

 */

namespace App\Backend\Schedule;

interface ScheduleRepositoryInterface
{
    public function getObjs($schedule_status, $from_date , $to_date );
    public function create($paramObj,$services,$hhcsPersonnels);
    public function update($id,$paramObj,$services,$hhcsPersonnels);
    public function getObjByID($id);
    public function delete($id);
    public function cancel($paramObj);
    public function getArrays();
    public function getArrayByID($id);
    public function getHHCSPersonal();
    public function getObjByPatientPackageID($patient_package_id);
    public function getObjByPatientID($patient_id);
    public function getScheduleHistory($id);
    public function servicesForEachSchedule($scheduleID);
    public function getServiceHistory($id);
    public function getPackageHistory($id);
    public function getPackageHistoryV2($id);
    public function getScheduleCount($id);
    public function getScheduleStatus();
    public function getScheduleStatusByDate();
    public function getCarUsageReport($from_date, $to_date, $paramArray);
    public function getUsersByScheduleID($type, $from_date, $to_date, $paramArray);
    public function getVisitReport($paramArray);
    public function getSaleSummaryReport($from_date, $to_date, $paramArray);
    public function getSaleSummary($from_date, $to_date);
    public function getScheduleVitals($latest_schedule_id);
    public function getChiefComplaint($latest_schedule_id);
    public function getGeneralPupilHead($latest_schedule_id);
    public function getHeartLung($latest_schedule_id);
    public function getAbdomenExtreNeuro($latest_schedule_id);
    public function getInvestigationId($latest_schedule_id);
    public function getInvestigationGroupName($investigation_id);
    public function getInvestigations($investigation_id);
    public function getScheduleProvisionalDiagnosis($latest_schedule_id);
    public function getProvisionalDiagnosis($provisional_id);
    public function getScheduleTreatment($latest_schedule_id);
    public function getNeurologicalRecords($latest_schedule_id);
    public function getMusculoIntercentionRecords($latest_schedule_id);
    public function getNutrition($latest_schedule_id,$patient_id);
    public function getScheduleInvestigation($latest_schedule_id);
    public function getInvoiceHeader($from_date, $to_date);
    public function getInvoiceDetail();
    public function getBloodDrawing($latest_schedule_id, $patient_id);
    public function getBloodDrawingRemark($latest_schedule_id, $patient_id);
    public function getSchedulesWithService($type, $from_date, $to_date,$schedulesArray);
    public function getEachVisitByDate($type,$date,$service_id);
    public function getScheduleOtherServices($latest_schedule_id, $patient_id);
    public function getEachVisitByMonth($month,$service_id);
    // public function getEachProfitByMonth($month,$service_id);
    public function getServiceIdByScheduleId($schedule_id);
}

