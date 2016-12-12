<?php

namespace App\Http\Controllers\Api;

use App\Api\Invoice\InvoiceApiV2Repository;
use App\Core\Check;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class InvoiceApiV2Controller extends Controller
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
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $invoiceRepo                = new InvoiceApiV2Repository();
            $params                     = $checkServerStatusArray['data'][0];
            if(isset($params->invoices) && count($params->invoices)>0){
                $result                     = $invoiceRepo->invoices($params->invoices);
            }
            else{
                $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                $result['aceplusStatusMessage'] = "invoices key is required in input JSON";
            }

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
