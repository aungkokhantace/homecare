<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: August/11/2016
 * Time: 10:50 AM
 */


namespace App\Http\Controllers\Backend;

use App\Backend\Cartype\Cartype;
use App\Backend\Cartype\CartypeRepository;
use App\Backend\Infrastructure\Forms\PackagesaleEntryRequest;
use App\Backend\Invoice\Invoice;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Package\PackageRepository;
use App\Backend\Packagesale\Packagesale;
use App\Backend\Packagesale\PackageSaleRepository;
use App\Backend\Packagesale\PackageSaleRepositoryInterface;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepository;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Zone\ZoneRepository;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PackageSaleController extends Controller
{
    private $repo;

    public function __construct(PackageSaleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        try{
            if (Auth::guard('User')->check()) {
                $packagesales      = $this->repo->getObjs();
                return view('backend.packagesale.index')->with('packagesales',$packagesales);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/package sale');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {

            $patientRepo = new PatientRepository();
            $patients = $patientRepo->getObjs();
            $packageRepo = new PackageRepository();
            $packages = $packageRepo->getObjs();

            return view('backend.packagesale.packagesale')->with('patients',$patients)->with('packages',$packages);
        }
        return redirect('/');
    }

    public function store(PackageSaleEntryRequest $request)
    {
        $request->validate();

        $user_id            = (Input::has('name')) ? Input::get('name') : "";
        $package_id         = (Input::has('package')) ? Input::get('package') : "";
        $remark             = (Input::has('remark')) ? Input::get('remark') : "";

        if($user_id != "" || $package_id != "") {
            $packageRepo = new packageRepository();
            $package_price = $packageRepo->getPackagePrice($package_id);
            $schedule_no = $packageRepo->getScheduleNo($package_id);

            //create package sale object
            $packageSaleObj = new Packagesale();
            $packageSaleObj->patient_id = $user_id;
            $packageSaleObj->package_id = $package_id;
            $packageSaleObj->package_price = $package_price;
            $packageSaleObj->package_usage_count = $schedule_no;
            $packageSaleObj->remark = $remark;

            $packageRepo = new PackageRepository();
            $package = $packageRepo->getObjByID($package_id);

            $sold_date = date("Y-m-d");
            $monthToAdd = $package->expiry_date;

            $expiryDate = strtotime(date("Y-m-d", strtotime($sold_date)) . " +" . $monthToAdd . "month");
            $expiryDate = date("Y-m-d", $expiryDate);

            $packageSaleObj->sold_date = date("Y-m-d");
            $packageSaleObj->expired_date = $expiryDate;

            $patient_id = $packageSaleObj->patient_id;
            $schedule_id = $packageSaleObj->schedule_id;

            $packageRepo = new PackageRepository();
            $package_price = $packageRepo->getPackagePrice($package_id);

            $total_tax_amt  = 0.00;
            $total_disc_amt = 0.00;
            $total_payable_amount = $package_price + $total_tax_amt - $total_disc_amt;

            //create Invoice obj and bind params to that object
            $invoiceObj = new Invoice();
            $invoiceObj->patient_id             = $patient_id;
            $invoiceObj->schedule_id            = $schedule_id;
            $invoiceObj->total_nett_amt_wo_disc = $packageSaleObj->package_price;
            $invoiceObj->package_id             = $package_id;
            $invoiceObj->package_price          = $package_price;
            $invoiceObj->type                   = 'package';
            $invoiceObj->total_payable_amt   = $total_payable_amount;

            //save package sale object
            $result = $this->repo->create($packageSaleObj, $invoiceObj);

            if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                $invoiceId = $result['invoice_id'];

                return redirect('/packagesale/invoice/' . $invoiceId)
                    ->withMessage(FormatGenerator::message('Success', 'Package sale success  !'));
            } else {
                return redirect()->action('Backend\PackageSaleController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Package Sale did not create ...'));
            }
        }
        else {
            return redirect()->action('Backend\PackageSaleController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Package Sale did not create. Invalid inputs ! ...'));
        }
    }

    public function autofill($id)
    {
        $patientRepo = new PatientRepository();
        $result = $patientRepo->getObjByID($id);
        $patients = $result['result'];

        if($patients->gender == "male"){
            $gender = "Male";
        }
        else{
            $gender = "Female";
        }
        $type_id = $patients->patient_type_id;
        $type = DB::select("SELECT code FROM core_settings WHERE value = '$type_id'");

        $phone = $patients->phone_no;
        $address = $patients->address;

        return \Response::json(array('gender'=>$gender, 'gender_id'=>$patients->gender, 'type'=>$type[0]->code,'type_id'=>$patients->patient_type_id, 'phone'=>$phone,'address'=>$address));
    }

    public function export($id)
    {
        if (Auth::guard('User')->check()) {
            $invoiceRepo = new InvoiceRepository();

            $invoice_id = $invoiceRepo->getInvoiceID($id);

            $result  = $invoiceRepo->getObjByID($invoice_id);
            if($result['aceplusStatusCode'] ==  ReturnMessage::OK) {
                $invoice = $result['result'];

                $date = Carbon::parse($invoice->date)->format('d-m-Y');

                $package_id = $invoice->package_id;

                $packageRepo = new PackageRepository();
                $package = $packageRepo->getObjByID($package_id);

                $monthToAdd = $invoice->package->expiry_date;
                $createdDate = date("Y-m-d", strtotime($invoice->package->created_at));
                $expiryDate = strtotime(date("Y-m-d", strtotime($createdDate)) . " +" . $monthToAdd . "month");
                $expiryDate = date("Y-m-d", $expiryDate);

                $dob = $invoice->patient->dob;
                $age = Utility::calculateAge($dob);

                if($invoice->patient->gender == "male"){
                    $patient_gender = "Male";
                }
                else{
                    $patient_gender = "Female";
                }

                $pdfHeader = Utility::getPDFHeader().'<br>'.'<br>';

                $patientData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                    <tr>
                                        <td height="20" width="20%">Name</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->patient->name.'</td>
                                        <td height="20" width="20%">Voucher No.</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->id.'</td>
                                    </tr>
                                    <tr>
                                        <td height="20" width="20%">Age/Sex</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$age.'/'.$patient_gender.'</td>
                                        <td height="20" width="20%">Date</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->created_at->format('d-m-Y').'</td>
                                    </tr>
                                    <tr>
                                        <td height="20" width="20%">Address</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->patient->address.'</td>
                                        <td height="20" width="20%">Contact Phone</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->patient->phone_no.'</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>';

                $saleData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                <tr bgcolor="#cccccc">
                                    <td height="15">Item</td>
                                    <td height="15">Description</td>
                                    <td height="15">Expiry Date</td>
                                    <td height="15">Amount</td>
                                </tr>
                                <tr>
                                    <td height="20">1</td>
                                    <td height="20">'.$package->package_name.'</td>
                                    <td height="20">'.$expiryDate.'</td>
                                    <td height="20">'.$package->price.'</td>
                                </tr>
                            </table>
                            <hr>';

                $summaryData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td height="20">Remark</td>
                                    <td height="20">'.$invoice->packagesale->remark.'</td>
                                    <td height="20">Total</td>
                                    <td height="20">'.$invoice->total_nett_amt_wo_disc.'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Discount</td>
                                    <td height="20">'.$invoice->total_disc_amt.'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Grand Total</td>
                                    <td height="20">'.$invoice->total_payable_amt.'</td>
                                </tr>
                            </table>
                            <hr>';

                $signature = Utility::getSignature();

                $html = $pdfHeader.$patientData.'<br>'.$saleData.'<br>'.$summaryData.$signature;

                Utility::exportPDF($html);
            }
            else{
                return redirect()->action('Backend\PackageSaleController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Invalid invoice ...'));
            }

        }
        return redirect('/');
    }

    public function schedule($id){
        if (Auth::guard('User')->check()) {
            $displayFlag = 1;

            $invoiceRepo = new InvoiceRepository();

            $invoice_id = $invoiceRepo->getInvoiceID($id);

            $result = $invoiceRepo->getObjByID($invoice_id);
            $invoice = $result['result'];

            $patient_id = $invoice->patient_id;

            $patientRepo = new PatientRepository();

            $result = $patientRepo->getObjByID($patient_id);

            $patient = $result['result'];

            $result = $patientRepo->getObjByID($patient_id);
            $patient = $result['result'];
            $patient_package_id = $invoice->patient_package_id;
            $patient_package = $this->repo->getObjByID($patient_package_id);
            $package_id = $invoice->package_id;

            $packageRepo = new PackageRepository();
            $package = $packageRepo->getObjByID($package_id);

            $carTypeRepo = new CartypeRepository();

            $scheduleRepo = new ScheduleRepository();
            $schedules = $scheduleRepo->getObjByPatientPackageID($patient_package_id);

            $carTypeArray = array();
            foreach($schedules as $schedule){
                $carType = $schedule->car_type;
                if($carType == 1){
                    $carTypeArray[$schedule->id] = "Patient Owned Vehicle";
                }
                if($carType == 2){
                    $carTypeArray[$schedule->id] = "Rental Owned Vehicle";
                }

                if($carType == 3){
                    if($schedule->car_type_id != 0){
                        $carTypeArray[$schedule->id] = $carTypeRepo->getCarTypeName($schedule->car_type_id);
                    }
                    else{
                        $carTypeArray[$schedule->id] = "HHCS Vehicle";
                    }
                }
            }

            if($patient_package->package_used_count >= $patient_package->package_usage_count){
                $displayFlag = 0;
            }

            $createdCount = $scheduleRepo->getObjByPatientPackageID($patient->user_id)->count();

            return view('backend.packagesale.packageschedule')
                ->with('invoice',$invoice)
                ->with('patient',$patient)
                ->with('patient_package',$patient_package)
                ->with('package',$package)
                ->with('schedules',$schedules)
                ->with('carTypeArray',$carTypeArray)
                ->with('displayFlag',$displayFlag);
        }
        return redirect('/');
    }

    public function invoice($invoiceId)
    {
        $invoiceRepo = new InvoiceRepository();
        $result = $invoiceRepo->getObjByID($invoiceId);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){

            $invoice = $result['result'];
            $package_id = $invoice->package_id;

            $packageRepo = new PackageRepository();
            $package = $packageRepo->getObjByID($package_id);

            $date = Carbon::parse($invoice->created_at)->format('d-m-Y');

            $monthToAdd = $invoice->package->expiry_date;
            $createdDate = date("d-m-Y",strtotime($invoice->package->created_at));

            $expiryDate = strtotime(date("Y-m-d", strtotime($createdDate)) . " +".$monthToAdd."month");
            $expiryDate = date("d-m-Y",$expiryDate);

            $dob = $invoice->patient->dob;
            $age = Utility::calculateAge($dob);

            if($invoice->patient->gender == "male"){
                $patient_gender = "Male";
            }
            else{
                $patient_gender = "Female";
            }

            return view('backend.packagesale.invoice')
                ->with('invoice',$invoice)
                ->with('package',$package)
                ->with('date',$date)
                ->with('age',$age)
                ->with('patient_gender',$patient_gender)
                ->with('expiryDate',$expiryDate);
        }
        else{
            return redirect()->action('Backend\PackageSaleController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Package Sale did not create ...'));
        }
    }
}
