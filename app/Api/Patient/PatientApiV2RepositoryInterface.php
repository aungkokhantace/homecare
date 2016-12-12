<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/13/2016
 * Time: 3:18 PM
 */

namespace App\Api\Patient;


interface PatientApiV2RepositoryInterface
{
    public function createPatientMedicalHistory($data);
    public function createPatientSurgeryHistory($data);
    public function createPatientFamilyHistory($data);
    public function createPatientPhysiothreapyMusculo($data);
    public function createPatientPhysiothreapyNeuro($data);
    public function createPatientPackage($data);
    public function createPatientFamilyMember($data);
    public function getPatientData($patientArray);
    public function getPatientMedicalHistoryData($patientArray);
    public function getPatientFamilyHistoryData($patientArray);
    public function getPatientSurgeryHistoryData($patientArray);
    public function getPatientFamilyMemberData();
    public function getPatientPackageArray();
}