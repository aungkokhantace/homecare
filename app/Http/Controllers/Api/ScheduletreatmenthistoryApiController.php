<?php

namespace App\Http\Controllers\Api;

use App\Api\Scheduletreatmenthistory\ScheduletreatmenthistoryApiRepositoryInterface;
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



class ScheduletreatmenthistoryApiController extends Controller
{
    private $repo;

    public function __construct(ScheduletreatmenthistoryApiRepositoryInterface $repo)
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
        $inputAll     = $inputRaw[0];

        $checkServerStatusArray = Check::checkSiteActivationCode($inputAll);
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){
            $patient_id                  = $checkServerStatusArray['data']['patient_id'];
            $schedule_id                 = $checkServerStatusArray['data']['schedule_id'];

            $scheduleTreatmentHistory              = $this->repo->getObjByIds($patient_id, $schedule_id);

            if(isset($scheduleTreatmentHistory) && count($scheduleTreatmentHistory) > 0){

                $status                     = $this->repo->delete($patient_id,$schedule_id);

                if($status['aceplusStatusCode'] == ReturnMessage::OK){
                    $paramObj                   = new ScheduleTreatmentHistory();
                    $paramObj->patient_id       = $checkServerStatusArray['data']['patient_id'];
                    $paramObj->product_id       = $checkServerStatusArray['data']['product_id'];
                    $paramObj->other_product    = $checkServerStatusArray['data']['other_product'];
                    $paramObj->total_dosage     = $checkServerStatusArray['data']['total_dosage'];
                    $paramObj->frequency        = $checkServerStatusArray['data']['frequency'];
                    $paramObj->days             = $checkServerStatusArray['data']['days'];
                    $paramObj->remark           = $checkServerStatusArray['data']['remark'];
                    $paramObj->schedule_id      = $checkServerStatusArray['data']['schedule_id'];
                    $paramObj->sold_dosage      = $checkServerStatusArray['data']['sold_dosage'];
                    $paramObj->unsold_dosage    = $checkServerStatusArray['data']['unsold_dosage'];
                    $paramObj->time             = $checkServerStatusArray['data']['time'];
                    $paramObj->created_by       = $checkServerStatusArray['data']['created_by'];
                    $paramObj->updated_by       = $checkServerStatusArray['data']['updated_by'];
                    $paramObj->deleted_by       = $checkServerStatusArray['data']['deleted_by'];
                    $paramObj->created_at       = $checkServerStatusArray['data']['created_at'];
                    $paramObj->updated_at       = $checkServerStatusArray['data']['updated_at'];
                    $paramObj->deleted_at       = $checkServerStatusArray['data']['deleted_at'];

                    $result = $this->repo->create($paramObj);
                }
                else{
                    $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
                    $returnedObj['aceplusStatusMessage']    = "Request Fail !";
                    $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                    return \Response::json($returnedObj);
                }
            }
            else{
                $paramObj                   = new ScheduleTreatmentHistory();
                $paramObj->patient_id       = $checkServerStatusArray['data']['patient_id'];
                $paramObj->product_id       = $checkServerStatusArray['data']['product_id'];
                $paramObj->other_product    = $checkServerStatusArray['data']['other_product'];
                $paramObj->total_dosage     = $checkServerStatusArray['data']['total_dosage'];
                $paramObj->frequency        = $checkServerStatusArray['data']['frequency'];
                $paramObj->days             = $checkServerStatusArray['data']['days'];
                $paramObj->remark           = $checkServerStatusArray['data']['remark'];
                $paramObj->schedule_id      = $checkServerStatusArray['data']['schedule_id'];
                $paramObj->sold_dosage      = $checkServerStatusArray['data']['sold_dosage'];
                $paramObj->unsold_dosage    = $checkServerStatusArray['data']['unsold_dosage'];
                $paramObj->time             = $checkServerStatusArray['data']['time'];
                $paramObj->created_by       = $checkServerStatusArray['data']['created_by'];
                $paramObj->updated_by       = $checkServerStatusArray['data']['updated_by'];
                $paramObj->deleted_by       = $checkServerStatusArray['data']['deleted_by'];
                $paramObj->created_at       = $checkServerStatusArray['data']['created_at'];
                $paramObj->updated_at       = $checkServerStatusArray['data']['updated_at'];
                $paramObj->deleted_at       = $checkServerStatusArray['data']['deleted_at'];

                $result = $this->repo->create($paramObj);
            }

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
