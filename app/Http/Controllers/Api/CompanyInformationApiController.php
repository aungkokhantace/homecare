<?php

namespace App\Http\Controllers\Api;
use App\Api\CompanyInformation\CompanyInformationApiRepository;
use App\Api\CompanyInformation\CompanyInformationApiRepositoryInterface;
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

class CompanyInformationApiController extends Controller
{
    private $repo;

    public function __construct(CompanyInformationApiRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function download(){
        $temp                           = Input::All();
        $inputAll                       = json_decode($temp['param_data']);
        $checkServerStatusArray         = Check::checkCodes($inputAll);
        
        $prefix                         = "";

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $prefix             = $checkServerStatusArray['tablet_id'];
            $returnedObj        = array();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            
            $user_id                = $inputAll->user_id;
            $tablet_id          = $checkServerStatusArray['tablet_id'];

            try{
                //start response data section
                $data        = array();
                $companyInformation = $this->repo->getObjs();

                $data[0]['company_information'] = $companyInformation;
                //end response data section

                $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage']    = "Request success !";
                $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];
                $returnedObj['data']                    = $data;
                
                return \Response::json($returnedObj);
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