<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 9:55 AM
 */

namespace App\Backend\Enquiry;

interface EnquiryRepositoryInterface
{
    public function getObjs($enquiry_status, $enquiry_case_type, $from_date , $to_date );
    public function create($paramObj,$services,$allergies);
    public function update($id,$paramObj,$services,$allergies);
    public function getObjByID($id);
    public function delete($id);
    public function getEnquiryDetail($id,$type);
    public function cancel($paramObj);
    public function getArrays();
    public function getArrayByID($id);
    public function getAllergiesByEnquiryId($id);
    public function confirm($id);
}
