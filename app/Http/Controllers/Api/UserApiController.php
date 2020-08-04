<?php

namespace App\Http\Controllers\Api;

use App\Api\Patient\PatientApiRepository;
use App\Api\User\UserApiRepository;
use App\Http\Requests;
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
use App\Core\User\UserRepositoryInterface;
use Carbon\Carbon;
use App\Backend\Patient\Patient;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Api\Patient\PatientApiRepositoryInterface;
use App\Backend\Patientfamilyhistory\Patientfamilyhistory;
use App\Backend\Patientmedicalhistory\Patientmedicalhistory;
use App\Backend\Patientsurgeryhistory\Patientsurgeryhistory;
class UserApiController extends Controller
{
    private $repo;

    public function __construct(PatientApiRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage'] = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    //patient and core_user comes in the same level(for whole enquiry api case)
    public function uploadSingleUser(){
        $temp                   = Input::All();
        $inputAll               = json_decode($temp['param_data']);

        $checkServerStatusArray = Check::checkCodes($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $userRepo                = new UserApiRepository();
            $params                     = $checkServerStatusArray['data'][0];

            $result                     = $userRepo->createSingleUser($params->core_users);
            
            // //input record's updated_at is earlier than latest data in DB, so input record is skipped and not being updated
            // if($result['aceplusStatusCode'] == ReturnMessage::SKIPPED){
            //     //skip this row and continue to next loop
            //     continue;
            // }

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
