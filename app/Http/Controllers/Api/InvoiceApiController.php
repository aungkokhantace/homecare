<?php

namespace App\Http\Controllers\Api;

use App\Api\Invoice\InvoiceApiRepository;
use App\Backend\Invoice\Invoice;
use App\Core\Check;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class InvoiceApiController extends Controller
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

    public function upload()
    {
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);
        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $invoiceRepo                = new InvoiceApiRepository();
            $params                     = $checkServerStatusArray['data'];
            $result                     = $invoiceRepo->createInvoice($params);

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
