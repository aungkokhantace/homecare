<?php

namespace App\Http\Controllers\Api;

use App\Api\Enquiry\EnquiryApiRepository;
use App\Core\Check;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class EnquiryApiController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage']    = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function down()
    {
        $inputAll               = Input::All();
        $checkServerStatusArray = Check::checkSiteActivationCode($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $enquiryApiRepo             = new EnquiryApiRepository();
            if (array_key_exists("status",$inputAll)){
                $status                 = strtolower($inputAll['status']);
                $rawEnquiries           = $enquiryApiRepo->getArraysWithStatus($status);
            }
            else{
                $rawEnquiries           = $enquiryApiRepo->getArrays();
            }

            $rawIdArr                   = array();
            foreach($rawEnquiries as $raw){
                array_push($rawIdArr,$raw->id);
            }

            $enquiryDetail              = $enquiryApiRepo->getEnquiryDetailWithPara($rawIdArr);

            if(isset($rawEnquiries) && count($rawEnquiries)>0){

                foreach ($rawEnquiries as $rawKey=>$rawValue) {

                    $tempArray  = array();

                    foreach($enquiryDetail as $detail){
                        if($detail->enquiry_id == $rawValue->id){
                            array_push($tempArray,$detail);
                        }
                    }

                    $rawEnquiries[$rawKey]->enquiry_detail = $tempArray;
                }

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data']                    = $rawEnquiries;
                return \Response::json($returnedObj);
            }

            $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage']    = "There is no enquiry to down!";
            $returnedObj['data']                    = "";
            return \Response::json($returnedObj);
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }

    public function upload(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $enquiryRepo                = new EnquiryApiRepository();
            $params                     = $checkServerStatusArray['data'];
            $result                     = $enquiryRepo->createEnquiry($params);

            if($result['aceplusStatusCode'] == ReturnMessage::OK){

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                return \Response::json($returnedObj);

            }
            else{
                $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage']    = $result['aceplusStatusMessage'];
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }

}
