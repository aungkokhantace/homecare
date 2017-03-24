<?php

namespace App\Http\Controllers\Api;
use App\Api\Transactionpromotion\TransactionpromotionApiRepository;
use App\Api\Transactionpromotion\TransactionpromotionApiRepositoryInterface;
use App\Http\Requests;
use App\Log\LogCustom;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Auth;
use App\Core\Check;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

use App\Core\Role\Role;
use App\Core\Permission\Permission;
use App\Core\Utility;
use App\Session;
use App\User;
use Carbon\Carbon;

class TransactionpromotionApiController extends Controller
{
    private $repo;

    public function __construct(TransactionpromotionApiRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage']    = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function upload(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);

        $prefix                         = "";

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $prefix             = $checkServerStatusArray['tablet_id'];
            $returnedObj        = array();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $params             = $checkServerStatusArray['data'][0];
            $user_id                = $inputAll->user_id;
            $tablet_id          = $checkServerStatusArray['tablet_id'];

            try{
                DB::beginTransaction();

                    $data = array();
                    $data = $params->transaction_promotions;

                    $result = $this->repo->createMultipleRows($data,$inputAll->tablet_activation_key,$checkServerStatusArray['user_id']);

                    if($result['aceplusStatusCode'] == ReturnMessage::OK){
                        DB::commit();

                        //for log
                        foreach($result['log'] as $value){
                            $date = $value['date'];
                            $message = '['. $date .'] '. 'info User - '.$user_id .' '. $value['message'] .' with tablet_id - '.$tablet_id. PHP_EOL;
                            LogCustom::create($date,$message);
                        }
                        //for log

                        //start response data section
                        $data        = array();
                        $transactionPromotions = $this->repo->getObjs();

                        $data[0]['transaction_promotions'] = $transactionPromotions;
                        //end response data section

                        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                        $returnedObj['aceplusStatusMessage']    = "Request success !";
                        $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                        $returnedObj['data']                    = $data;

                        return \Response::json($returnedObj);
                    }
                    else{
                        $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                        $returnedObj['aceplusStatusMessage']    = $result['aceplusStatusMessage'];
                        $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                        return \Response::json($returnedObj);
                    }

            }
            catch (\Exception $e) {
                DB::rollback();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage'] = $e->getMessage() . " ----- line " . $e->getLine() . " ----- " . $e->getFile();
                $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }

    }
}
