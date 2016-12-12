<?php

namespace App\Http\Controllers\Api;

use App\Api\Scheduletracking\ScheduletrackingApiRepositoryInterface;
use App\Backend\Scheduletracking\Scheduletracking;
use App\Backend\ScheduleTreatmentHistory\ScheduleTreatmentHistory;
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
use Carbon\Carbon;
use App\Backend\Package\Package;
use App\Api\Package\PackageApiRepositoryInterface;
use App\Backend\Invoice\Invoice;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Package\PackageRepository;
use App\Backend\Packagesale\Packagesale;
use App\Backend\Packagesale\PackageSaleRepository;
use App\Backend\Packagesale\PackageSaleRepositoryInterface;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepository;
use App\Backend\Schedule\ScheduleRepository;



class ScheduletrackingApiController extends Controller
{
    private $repo;

    public function __construct(ScheduletrackingApiRepositoryInterface $repo)
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
        $temp   = Input::All();
        $inputRaw  = $temp['param_data'];
        $inputRaw     = json_decode($inputRaw);

        $checkServerStatusArray = Check::checkCodes($inputRaw);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $result = $this->repo->createMultipleRows($checkServerStatusArray['data'],$checkServerStatusArray['tablet_id']);

                if($result['aceplusStatusCode'] == ReturnMessage::OK){

                    $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                    $returnedObj['aceplusStatusMessage']    = "Request success !";
                    $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                    return \Response::json($returnedObj);
                }
                else{
                    $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage']    = "Request Fail !";
                    $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                    return \Response::json($returnedObj);
                }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }

    }
}
