<?php
namespace App\Api\Enquiry;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2016
 * Time: 11:43 AM
 */
interface EnquiryApiV2RepositoryInterface
{
    public function createSingleRow($paramObj);
    public function enquiry($data);
    public function createEnquiry($data);
    public function getEnquiryData();
    public function getEnquiryDetail($id);
    public function getEnquiryArray($idArr);
    public function getNewEnquiryArray();
}