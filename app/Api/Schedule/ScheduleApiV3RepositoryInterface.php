<?php
namespace App\Api\Schedule;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 13/10/2016
 * Time: 10:42 AM
 */
interface ScheduleApiV3RepositoryInterface
{
    public function createSingleRow($paramObj);
    public function schedule($data);
    public function schedulePatientVitals($data);
    public function schedulePatientChiefComplaint($data);
    public function scheduleTreatmentHistory($data);
    public function scheduleProvisionalDiagnosis($data);
    public function getScheduleDetailData($schedule_id);
}