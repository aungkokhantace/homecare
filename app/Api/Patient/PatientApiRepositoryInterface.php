<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/26/2016
 * Time: 4:51 PM
 */

namespace App\Api\Patient;


interface PatientApiRepositoryInterface
{
   
    public function getArrays();
    public function create($flag = 1, $userObj,$paramObj,$childArray,$logObj,$familyObj,$medicalObj,$surgeryObj);
    public function update($userObj,$paramObj,$childArray,$logObj,$familyObj,$medicalObj,$surgeryObj);
    public function createPatient($params);
    public function createSinglePatient($data);
    public function getPatientForEnquiry($patient_id);
    public function getPatientAllergy($patient_id);
    public function createSingleObj($paramObj);
    public function getPatientData();
    public function getCoreUser($user_id);
    public function getLog($user_id);
}