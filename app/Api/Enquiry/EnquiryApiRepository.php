<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/12/2016
 * Time: 11:43 AM
 */

namespace App\Api\Enquiry;

use App\Backend\Enquiry\Enquiry;
use App\Backend\Zone\ZoneRepository;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;


class EnquiryApiRepository implements EnquiryApiRepositoryInterface
{
    public function getArraysWithStatus($status)
    {
        $query = '';
        if(isset($status) && $status != 'all'){
            $query  = "AND status = '".$status."'";
        }

        $enquiries  = DB::select("SELECT * FROM enquiries WHERE deleted_at is null $query");

        return $enquiries;

    }

    public function getArrays()
    {
        $enquiries  = DB::select("SELECT * FROM enquiries WHERE deleted_at is null");

        return $enquiries;
    }

    public function getEnquiryDetail(){

        $details  = DB::select("SELECT * FROM enquiry_detail");

        return $details;

    }

    public function getEnquiryDetailWithPara($rawIdArr){
        $arr  = implode("','",$rawIdArr);
        $details = DB::select("SELECT * from enquiry_detail Where enquiry_id IN ('$arr')");

        return $details;
    }

    public function create($paramObj,$services,$allergies,$enquiryId)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            DB::beginTransaction();
            $tempObj = Utility::addCreatedBy($paramObj);

            //retrieve zone_id from township_id
            $zoneRepo           = new zoneRepository();
            $zone               = $zoneRepo->getZoneId($paramObj->township_id);
            //retrieve zone_id from township_id

            if($zone == null){
                $tempObj->zone_id = 0;
            }
            else{
                $tempObj->zone_id = $zone;                                 //bind zone to Patient obj
            }

            if($tempObj->save()){

                // Saving the Enquiry Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('enquiry_detail')->insert([
                            ['enquiry_id' => $enquiryId, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }

                if(isset($allergies) && count($allergies)>0){
                    foreach($allergies as $allergy_id){
                        DB::table('enquiry_detail')->insert([
                            ['enquiry_id' => $enquiryId, 'allergy_id' => $allergy_id, 'type' => 'allergy']
                        ]);
                    }
                }

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

    public function getObjById($enquiryId)
    {
        $enquiry    = Enquiry::find($enquiryId);

        return $enquiry;
    }

    public function update($paramObj,$services,$allergies,$enquiryId)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $enquiry_id = $enquiryId;
        try {

            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);

            if($tempObj->save()){

                // Cleaning all service, allergy and related thing about the selected enquiry
                DB::table('enquiry_detail')->where('enquiry_id', '=', $enquiry_id)->delete();

                // Saving the Enquiry Services
                if(isset($services) && count($services)>0) {
                    foreach($services as $service_id){
                        DB::table('enquiry_detail')->insert([
                            ['enquiry_id' => $enquiry_id, 'service_id' => $service_id, 'type' => 'service']
                        ]);
                    }
                }

                $isHavingAllergy = $paramObj->having_allergy;
                if($isHavingAllergy == 1) {
                    if (isset($allergies) && count($allergies) > 0) {
                        foreach ($allergies as $allergy_id) {
                            DB::table('enquiry_detail')->insert([
                                ['enquiry_id' => $enquiry_id, 'allergy_id' => $allergy_id, 'type' => 'allergy']
                            ]);
                        }
                    }
                }

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

    public function createEnquiry($params){

        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $returnedObj['aceplusStatusMessage'] = "";

        try {
            DB::beginTransaction();
            foreach($params as $data){
                $enquiryRepo                = new EnquiryApiRepository();
                $enquiry                    = $enquiryRepo->getObjById($data->id);

                if(isset($enquiry) && $enquiry->id == $data->id){
                    $paramObj                   = $enquiry;
                    $paramObj->id               = $data->id;
                    $paramObj->name             = $data->name;
                    $paramObj->nrc_no           = $data->nrc_no;
                    $paramObj->is_new_patient   = $data->is_new_patient;
                    $paramObj->patient_id       = $data->patient_id;
                    $paramObj->patient_type_id  = $data->patient_type_id;
                    $paramObj->date             = date("Y-m-d", strtotime($data->date));
                    $paramObj->time             = $data->time;
                    $paramObj->gender           = $data->gender;
                    $paramObj->dob              = date("Y-m-d", strtotime($data->dob));
                    $paramObj->phone_no         = $data->phone_no;
                    $paramObj->address          = $data->address;
                    $paramObj->township_id      = $data->township_id;
                    $paramObj->zone_id          = $data->zone_id;
                    $paramObj->case_type        = $data->case_type;
                    $paramObj->car_type         = $data->car_type;
                    $paramObj->car_type_id      = $data->car_type_id;
                    $paramObj->enquiry1         = $data->enquiry1;
                    $paramObj->enquiry2         = $data->enquiry2;
                    $paramObj->enquiry3         = $data->enquiry3;
                    $paramObj->enquiry4         = $data->enquiry4;
                    $paramObj->having_allergy   = $data->having_allergy;
                    $paramObj->status           = $data->status;
                    $paramObj->remark           = $data->remark;
                    $paramObj->created_by       = $data->created_by;
                    $paramObj->updated_by       = $data->updated_by;
                    $paramObj->deleted_by       = $data->deleted_by;
                    $paramObj->created_at       = $data->created_at;
                    $paramObj->updated_at       = $data->updated_at;
                    $paramObj->deleted_at       = $data->deleted_at;

                    $tempObj                    = Utility::addUpdatedBy($paramObj);
                }
                else{
                    $paramObj                   = new Enquiry();
                    $paramObj->id               = $data->id;
                    $paramObj->name             = $data->name;
                    $paramObj->nrc_no           = $data->nrc_no;
                    $paramObj->is_new_patient   = $data->is_new_patient;
                    $paramObj->patient_id       = $data->patient_id;
                    $paramObj->patient_type_id  = $data->patient_type_id;
                    $paramObj->date             = date("Y-m-d", strtotime($data->date));
                    $paramObj->time             = $data->time;
                    $paramObj->gender           = $data->gender;
                    $paramObj->dob              = date("Y-m-d", strtotime($data->dob));
                    $paramObj->phone_no         = $data->phone_no;
                    $paramObj->address          = $data->address;
                    $paramObj->township_id      = $data->township_id;
                    $paramObj->zone_id          = $data->zone_id;
                    $paramObj->case_type        = $data->case_type;
                    $paramObj->car_type         = $data->car_type;
                    $paramObj->car_type_id      = $data->car_type_id;
                    $paramObj->enquiry1         = $data->enquiry1;
                    $paramObj->enquiry2         = $data->enquiry2;
                    $paramObj->enquiry3         = $data->enquiry3;
                    $paramObj->enquiry4         = $data->enquiry4;
                    $paramObj->having_allergy   = $data->having_allergy;
                    $paramObj->status           = $data->status;
                    $paramObj->remark           = $data->remark;
                    $paramObj->created_by       = $data->created_by;
                    $paramObj->updated_by       = $data->updated_by;
                    $paramObj->deleted_by       = $data->deleted_by;
                    $paramObj->created_at       = $data->created_at;
                    $paramObj->updated_at       = $data->updated_at;
                    $paramObj->deleted_at       = $data->deleted_at;

                    $tempObj                    = Utility::addCreatedBy($paramObj);
                }



                if($tempObj->save()){
                    $enquiry_details    = $data->enquiry_detail;

                    // Cleaning all enquiry_detail about the selected invoice
                    DB::table('enquiry_detail')->where('enquiry_id', '=', $data->id)->delete();

                    // Saving enquiry_detail
                    if(isset($enquiry_details) && count($enquiry_details)>0) {
                        foreach($enquiry_details as $detail){
                            DB::table('enquiry_detail')->insert([
                                [
                                    'enquiry_id' => $detail->enquiry_id, 'package_id' => $detail->package_id,
                                    'service_id' => $detail->service_id, 'allergy_id' => $detail->allergy_id,
                                    'type' => $detail->type
                                ]
                            ]);
                        }
                    }

                }
                else{
                    DB::rollBack();
                    $returnedObj['aceplusStatusMessage'] = "Error in DB operation!";
                    return $returnedObj;
                }
            }
            DB::commit();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }
}