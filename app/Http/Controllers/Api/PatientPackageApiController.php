<?php

namespace App\Http\Controllers\Api;

use App\Api\Invoice\InvoiceApiV2Repository;
use App\Api\Patient\PatientApiV2Repository;
use App\Core\Check;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Log\LogCustom;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Api\Transactionpromotion\TransactionpromotionApiRepository;

class PatientPackageApiController extends Controller
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

    public function upload(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $user_id                = $inputAll->user_id;
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
            $result['aceplusStatusMessage'] = "";

            $params                 = $checkServerStatusArray['data'][0];
            $tablet_id              = $checkServerStatusArray['tablet_id'];
            $result['tablet_id']    = $tablet_id;
            $logArr                 = array();

            try{
                DB::beginTransaction();
                $invoiceRepo            = new InvoiceApiV2Repository();
                $patientRepo            = new PatientApiV2Repository();

                if(isset($params->invoices) && count($params->invoices) > 0){
                    $invoices       = $params->invoices;
                    $invoiceResult  = $invoiceRepo->invoices($invoices);

                    if($invoiceResult['aceplusStatusCode'] != ReturnMessage::OK) {
                        DB::rollback();
                        $invoiceResult['tablet_id'] = $tablet_id;
                        $invoiceResult['data'] = (object) array();
                        return \Response::json($invoiceResult);
                    }

                    if(isset($invoiceResult['log']) && count($invoiceResult['log']) > 0){
                        array_push($logArr,$invoiceResult['log']);
                    }
                }

                if(isset($params->patient_package) && count($params->patient_package) > 0){
                    $patient_package = $params->patient_package;
                    $patient_packageResult = $patientRepo->createPatientPackage($patient_package);
                    if($patient_packageResult['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        $patient_packageResult['tablet_id'] = $tablet_id;
                        $patient_packageResult['data'] = (object) array();
                        return \Response::json($patient_packageResult);
                    }
                    if(isset($patient_packageResult['log']) && count($patient_packageResult['log']) > 0){
                        array_push($logArr,$patient_packageResult['log']);
                    }
                }

                //all insertions were successful
                DB::commit();
                //create custom log file with created_at or updated_at
                foreach($logArr as $logKey=>$logValue){
                    foreach($logValue as $value){
                        $date = $value['date'];
                        $message = '['. $date .'] '. 'info User - '.$user_id .' '. $value['message'] .' with tablet_id - '.$tablet_id. PHP_EOL;
                        LogCustom::create($date,$message);
                    }
                }

                //return max_key
                $prefix                                 = $checkServerStatusArray['tablet_id'];
                $maxPatientPackage                      = Utility::getMaxKey($prefix,'patient_package','id');
                $maxTransactionPromotion                = Utility::getMaxKey($prefix,'transaction_promotions','id');
                $maxKey                                 = array();
                $maxKey[0]['table_name']                = "patient_package";
                $maxKey[0]['max_key_id']                = $maxPatientPackage;
                $maxKey[1]['table_name']                = "transaction_promotions";
                $maxKey[1]['max_key_id']                = $maxTransactionPromotion;

                //return patient_package
                $data                                   = array();
                $patient_packageArr                     = $patientRepo->getPatientPackageArray();
                $data[0]['patient_package']             = $patient_packageArr;

                $transactionPromotionApiRepo            = new TransactionpromotionApiRepository();
                $transactionPromotionArr                = $transactionPromotionApiRepo->getArrays();
                $data[0]['transaction_promotions']      = $transactionPromotionArr;

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $tablet_id;
                $returnedObj['max_key']                 = $maxKey;
                $returnedObj['data']                    = $data;
                return \Response::json($returnedObj);

            }
            catch(\Exception $e){
                DB::rollback();
                $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage']    = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data'] = (object) array();
                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }
}
