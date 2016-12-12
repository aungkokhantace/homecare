<?php

namespace App\Http\Controllers\Api;

use App\Api\Scheduletracking\ScheduletrackingApiRepositoryInterface;
use App\Api\Waytracking\WaytrackingApiRepositoryInterface;
use App\Backend\Scheduletracking\Scheduletracking;
use App\Backend\ScheduleTreatmentHistory\ScheduleTreatmentHistory;
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



class WaytrackingApiController extends Controller
{
    private $repo;

    public function __construct(WaytrackingApiRepositoryInterface $repo)
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
                if (isset($params->way_tracking) && count($params->way_tracking) > 0) {
                    $result = $this->repo->createMultipleRows($params->way_tracking,$checkServerStatusArray['tablet_id']);

                    foreach($result['log'] as $value){
                        $date = $value['date'];
                        $message = '['. $date .'] '. 'info User - '.$user_id .' '. $value['message'] .' with tablet_id - '.$tablet_id. PHP_EOL;
                        LogCustom::create($date,$message);
                    }
                    if($result['aceplusStatusCode'] == ReturnMessage::OK){
                        DB::commit();

                        $maxWayTracking  = Utility::getMaxKey($prefix,'way_tracking','id');

                        $maxKey = array();

                        $maxKey[0]['table_name'] = "way_tracking";
                        $maxKey[0]['max_key_id'] = $maxWayTracking;

                        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                        $returnedObj['aceplusStatusMessage']    = "Request success !";
                        $returnedObj['max_key']                 = $maxKey;
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
                elseif(isset($params->way_tracking)){
                    $maxWayTracking  = Utility::getMaxKey($prefix,'way_tracking','id');
                    $maxKey = array();

                    $maxKey[0]['table_name'] = "way_tracking";
                    $maxKey[0]['max_key_id'] = $maxWayTracking;

                    $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
                    $returnedObj['aceplusStatusMessage']    = "Request success !";
                    $returnedObj['max_key']                 = $maxKey;
                    $returnedObj['tabletId']                = $checkServerStatusArray['tablet_id'];

                    return \Response::json($returnedObj);
                }
                else{
                        $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
                        $result['aceplusStatusMessage'] = "way_tracking key is required in input JSON";
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
