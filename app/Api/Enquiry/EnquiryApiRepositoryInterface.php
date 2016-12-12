<?php
namespace App\Api\Enquiry;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2016
 * Time: 11:43 AM
 */
interface EnquiryApiRepositoryInterface
{
    public function getArraysWithStatus($status);
    public function getArrays();
    public function getEnquiryDetail();
    public function getEnquiryDetailWithPara($rawIdArr);
    public function create($paramObj,$services,$allergies,$enquiryId);
    public function getObjById($enquiryId);
    public function createEnquiry($params);
}