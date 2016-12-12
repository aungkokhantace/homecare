<?php
namespace App\Api\Schedule;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 13/10/2016
 * Time: 10:42 AM
 */
interface ScheduleApiV2RepositoryInterface
{
    public function createSingleRow($paramObj);
    public function schedule($data);
    public function schedulePatientVitals($data);
    public function schedulePatientChiefComplaint($data);
    public function scheduleTreatmentHistory($data);
    public function scheduleProvisionalDiagnosis($data);
    public function schedulePhysiotherapyMusculo($data);
    public function scheduleTrackings($data);
    public function schedulePhysiotherapyNeuro($data);
    public function schedulePhysicalExamsGeneralPupilsHead($data);
    public function schedulePhysicalExamsHeartLungs($data);
    public function schedulePhysicalExamsAbdomenExtreNeuro($data);
    public function scheduleInvestigation($data);
    public function getScheduleArray($idArr);
    public function getScheduleTreatmentArray($idArr);
}