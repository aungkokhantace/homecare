<?php

namespace App\Http\Controllers\Api;

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



class PackageApiController extends Controller
{
    private $repo;

    public function __construct(PackageApiRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage'] = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function down()
    {
        $inputAll = Input::All();
        $checkServerStatusArray = Check::checkSiteActivationCode($inputAll);
        
        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $rawPackageTables = $this->repo->getArrays();
            
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage'] = "Request success !";
            $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
            $returnedObj['data'] = $rawPackageTables;
            return \Response::json($returnedObj);
            
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
    }

    public function upload()
    {
        $inputAll = Input::All();
        $checkServerStatusArray = Check::checkSiteActivationCode($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $packageRepo                   = new packageRepository();
            $package_price                 = $packageRepo->getPackagePrice($checkServerStatusArray['data']['package']);
            $schedule_no                   = $packageRepo->getScheduleNo($checkServerStatusArray['data']['package']);

            //create package sale object
            $packageSaleObj = new Packagesale();
            $packageSaleObj->patient_id             = $checkServerStatusArray['data']['user_id'];
            $packageSaleObj->package_id             = $checkServerStatusArray['data']['package'];
            $packageSaleObj->package_price          = $package_price;
            $packageSaleObj->package_usage_count    = $schedule_no;
            $packageSaleObj->date                   = date("Y-m-d");
            $packageSaleObj->remark                 = $checkServerStatusArray['data']['remark'];
            $packageSaleObj->created_by             = $checkServerStatusArray['data']['created_by'];
            $packageSaleObj->updated_by             = $checkServerStatusArray['data']['updated_by'];
            $packageSaleObj->deleted_by             = $checkServerStatusArray['data']['deleted_by'];
            $packageSaleObj->created_at             = $checkServerStatusArray['data']['created_at'];
            $packageSaleObj->updated_at             = $checkServerStatusArray['data']['updated_at'];
            $packageSaleObj->deleted_at             = $checkServerStatusArray['data']['deleted_at'];

            $invoiceDate    = date("Y-m-d");
            $patient_id     = $packageSaleObj->patient_id;
            $schedule_id    = $packageSaleObj->schedule_id;

            $packageRepo    = new PackageRepository();
            $package_price  = $packageRepo->getPackagePrice($checkServerStatusArray['data']['package']);

            //create Invoice obj and bind params to that object
            $invoiceObj             = new Invoice();
            $invoiceObj->date       = $invoiceDate;
            $invoiceObj->patient_id = $patient_id;
            $invoiceObj->schedule_id= $schedule_id;

            $invoiceObj->total_amount_wo_discount = $packageSaleObj->package_price;
            $invoiceObj->total_amount_w_discount = $packageSaleObj->package_price;

            $invoiceObj->package_id    = $checkServerStatusArray['data']['package'];
            $invoiceObj->package_price = $package_price;
            $invoiceObj->created_by    = $checkServerStatusArray['data']['created_by'];
            $invoiceObj->updated_by    = $checkServerStatusArray['data']['updated_by'];
            $invoiceObj->deleted_by    = $checkServerStatusArray['data']['deleted_by'];
            $invoiceObj->created_at    = $checkServerStatusArray['data']['created_at'];
            $invoiceObj->updated_at    = $checkServerStatusArray['data']['updated_at'];
            $invoiceObj->deleted_at    = $checkServerStatusArray['data']['deleted_at'];
                    
            if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

             $rawPatientTables = $this->repo->create($packageSaleObj, $invoiceObj);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage'] = "Request success !";
            $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
            $returnedObj['data'] ="SUCCESS";
            return \Response::json($returnedObj);
           
        }
        else{
            return \Response::json($checkServerStatusArray);
        }
        
        }
    }
}
