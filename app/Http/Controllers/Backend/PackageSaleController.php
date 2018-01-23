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

                foreach($packagesales as $sale){
                    $package_sale_id    = $sale->id;
                    $package_promotion  = DB::table('transaction_promotions')->where('reference_id','=',$package_sale_id)->first();
                    $promotion_code     = $package_promotion->promotion_code;

                    //bind to packagesale obj
                    $sale->promotion_code = $promotion_code;
                }
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

        $user_id                = (Input::has('name')) ? Input::get('name') : "";
        $package_id             = (Input::has('package')) ? Input::get('package') : "";
        $remark                 = (Input::has('remark')) ? Input::get('remark') : "";
        $total_amount           = (Input::has('total_payable_amount')) ? Input::get('total_payable_amount') : 0.0;
        $transportation_price           = (Input::has('transportation_price')) ? Input::get('transportation_price') : 0.0;

//        $have_discount_coupon   = (Input::has('have_discount_coupon')) ? Input::get('have_discount_coupon') : "no";
//
//        if($have_discount_coupon == "yes"){
//            $coupon_code        = (Input::has('coupon_code')) ? Input::get('coupon_code') : "";
//        }
//        else{
//            $coupon_code        = "";
//        }

        $discount_amount        =   (Input::has('discount_amount')) ? Input::get('discount_amount') : "";

        if($user_id != "" || $package_id != "") {
            $packageRepo = new packageRepository();
//            $package_price = $packageRepo->getPackagePrice($package_id);

            if(isset($total_amount) && $total_amount != ""){
                $package_price = $total_amount;
            }
            else{
                $package_price = $packageRepo->getPackagePrice($package_id);
            }

            $schedule_no = $packageRepo->getScheduleNo($package_id);

            //create package sale object
            $packageSaleObj = new Packagesale();
            $packageSaleObj->patient_id = $user_id;
            $packageSaleObj->package_id = $package_id;
            $packageSaleObj->package_price = $package_price;
            $packageSaleObj->transportation_price = $transportation_price;
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

//            $total_disc_amt = 0.00;
            $total_disc_amt = (Input::has('discount_amount')) ? Input::get('discount_amount') : 0.00;

            // $total_payable_amount = $package_price + $total_tax_amt - $total_disc_amt; //without including transportation_price
            //calculate total payable amount
            // $total_payable_amount = $package_price + $total_tax_amt - $total_disc_amt + $transportation_price;
            $payable_amount_wo_tax = $package_price - $total_disc_amt + $transportation_price;

            //get tax percent from config
            $total_tax_percent  = Utility::getTaxPercent();
            //calculate total tax amount from tax percent
            $total_tax_amt = ($total_tax_percent / 100) * $payable_amount_wo_tax;

            //calculate total payable amount including tax amount
            $total_payable_amount = $payable_amount_wo_tax + $total_tax_amt;

            //create Invoice obj and bind params to that object
            $invoiceObj = new Invoice();
            $invoiceObj->patient_id             = $patient_id;
            $invoiceObj->schedule_id            = $schedule_id;
            $invoiceObj->total_car_amount       = $transportation_price;
            $invoiceObj->total_nett_amt_wo_disc = $package_price + $transportation_price;
            $invoiceObj->total_disc_amt         = $total_disc_amt;
            $invoiceObj->total_nett_amt_w_disc  = $payable_amount_wo_tax;
            $invoiceObj->package_id             = $package_id;
            $invoiceObj->package_price          = $packageSaleObj->package_price;
            $invoiceObj->type                   = 'package';
            $invoiceObj->tax_rate               = $total_tax_percent;
            $invoiceObj->total_tax_amt          = $total_tax_amt;
            $invoiceObj->total_payable_amt      = $total_payable_amount;

            //save package sale object
            $result = $this->repo->create($packageSaleObj, $invoiceObj);

            if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
            //start coupon code section
                if(isset($discount_amount) && $discount_amount != 0.00){
                    //coupon code is used
                    //get coupon code that is used
                    $coupon_code        = (Input::has('coupon_code')) ? Input::get('coupon_code') : "";

                    //get the previous transaction record
                    $transaction        = DB::table('transaction_promotions')->where('promotion_code','=',$coupon_code)->first();

                    //change status of old coupon code as 'used'
                    DB::table('transaction_promotions')
                        ->where('id', $transaction->id)
                        ->where('promotion_code', $transaction->promotion_code) //first_time
                        ->update(['used' => 1]);

                    $check_maximum_order = $transaction->promo_group_code_order;
                    $max_discount_time   = Utility::getMaxDiscountTime();
                    //maximum number of times that discount coupon can be used...// in this case -> 2 times
                    if($check_maximum_order < $max_discount_time){
                        //start generating new coupon code
                        $prefix = Utility::getTerminalId();
                        $table = "transaction_promotions";
                        $col = "id";
                        $offset = 1;
                        $generatedCouponCode = Utility::generateCouponCode($prefix,$table,$col,$offset);
                        //end generating coupon code

                        //generate id for transaction_promotions table
                        $transaction_promotion_id   = Utility::generatedId($prefix,$table,$col,$offset);
                        $promotion_code             = $generatedCouponCode;
                        $reference_type             = "package_sale";
                        $reference_id               = $packageSaleObj->id;
                        $used                       = 0;
                        $promo_group_code           = $transaction->promo_group_code; //assign previous 'promo_group_code'
                        $promo_group_code_order     = $transaction->promo_group_code_order +1;  //plus 1 for 'promo_group_code_order'

                        //store in transaction_promotions table
                        DB::table('transaction_promotions')->insert([
                            ['id' => $transaction_promotion_id,
                                'promotion_code' => $promotion_code,
                                'reference_type' => $reference_type,
                                'reference_id' => $reference_id,
                                'package_id' => $package_id,
                                'used' => $used,
                                'promo_group_code' => $promo_group_code,
                                'promo_group_code_order' => $promo_group_code_order,
                                'remark'=>''],
                        ]);
                    }

                }
                else{
                    //new coupon code
                    //start generating coupon code
                    $prefix = Utility::getTerminalId();
                    $table = "transaction_promotions";
                    $col = "id";
                    $offset = 1;
                    $generatedCouponCode = Utility::generateCouponCode($prefix,$table,$col,$offset);
                    //end generating coupon code

                    //generate id for transaction_promotions table
                    $transaction_promotion_id   = Utility::generatedId($prefix,$table,$col,$offset);
                    $promotion_code             = $generatedCouponCode;
                    $reference_type             = "package_sale";
                    $reference_id               = $packageSaleObj->id;
                    $used                       = 0;
                    $promo_group_code           = $generatedCouponCode;
                    $promo_group_code_order     = 1;

                    //store in transaction_promotions table
                    DB::table('transaction_promotions')->insert([
                        ['id' => $transaction_promotion_id,
                            'promotion_code' => $promotion_code,
                            'reference_type' => $reference_type,
                            'reference_id' => $reference_id,
                            'package_id' => $package_id,
                            'used' => $used,
                            'promo_group_code' => $promo_group_code,
                            'promo_group_code_order' => $promo_group_code_order,
                            'remark'=>''],
                    ]);
                }
            //end coupon code section

                $invoiceId = $result['invoice_id'];
                return redirect('/packagesale/invoice/' . $invoiceId.'/'.$generatedCouponCode)
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
        $zone_id = $patients->zone_id;

        $zones = DB::select("SELECT * FROM zones WHERE deleted_at is null");

        return \Response::json(array('gender'=>$gender, 'gender_id'=>$patients->gender, 'type'=>$type[0]->code,'type_id'=>$patients->patient_type_id, 'phone'=>$phone,'address'=>$address,'zone_id'=>$zone_id, 'zone'=>$zones[$zone_id]));
    }

    public function export($id,$couponCode)
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
                                        <td height="20" width="20%">Name / Reg No.</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->patient->name.' / '.$invoice->patient->user_id.'</td>
                                        <td height="20" width="20%">Voucher No.</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->id.'</td>
                                    </tr>
                                    <tr>
                                        <td height="20" width="20%">DOB(Age) / Sex</td>
                                        <td height="20" width="5%">-</td>
                                        <td height="20" width="25%">'.$invoice->patient->dob.'('.$age['value'].' '.$age['unit'].') / '.$patient_gender.'</td>
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

                $couponData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                    <tr>
                                        <td height="20" width="25%">Coupon Code</td>
                                        <td height="20" width="75%">'.$couponCode.'</td>
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
                                    <td height="20">'.number_format($package->price,2).'</td>
                                </tr>
                                <tr>
                                    <td height="20">2</td>
                                    <td height="20">'.'Transportation Price'.'</td>
                                    <td height="20">'.'-'.'</td>
                                    <td height="20">'.number_format($invoice->total_car_amount,2).'</td>
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
                                    <td height="20">'.number_format($invoice->total_nett_amt_wo_disc,2).'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Discount</td>
                                    <td height="20">'.number_format($invoice->total_disc_amt,2).'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Tax Amount</td>
                                    <td height="20">'.number_format($invoice->total_tax_amt,2).'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Grand Total</td>
                                    <td height="20">'.number_format($invoice->total_payable_amt,2).'</td>
                                </tr>
                            </table>
                            <hr>';

                $signature = Utility::getSignature();

                $html = $pdfHeader.$patientData.'<br>'.$couponData.'<br>'.$saleData.'<br>'.$summaryData.$signature;

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

    public function invoice($invoiceId,$couponCode)
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
                ->with('expiryDate',$expiryDate)
                ->with('couponCode',$couponCode);
        }
        else{
            return redirect()->action('Backend\PackageSaleController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Package Sale did not create ...'));
        }
    }

    public function checkCouponCode($package,$code){
        $transaction_promotion  = DB::table('transaction_promotions')->where('promotion_code','=',$code)->where('used','=',0)->where('package_id','=',$package)->first();
        if(isset($transaction_promotion) && count($transaction_promotion)>0){
            $package_id             = $transaction_promotion->package_id;
            $promo_group_code_order = $transaction_promotion->promo_group_code_order +1; //plus 1 to search order in 'package_promotions'

            $package_promotion      = DB::table('package_promotions')->where('package_id','=',$package_id)->where('promotion_order','=',$promo_group_code_order)->first();

            if(isset($package_promotion) && count($package_promotion)>0){
                $promotion_price        = $package_promotion->price;
            }
            else{
                return \Response::json(false);
            }

            //success
            return \Response::json($promotion_price);
        }
        else{
            //fail
            return \Response::json(false);
        }
    }

    public function getOriginalPrice($package){
        $packageRepo = new PackageRepository();
        $original_price = $packageRepo->getPackagePrice($package);
        return \Response::json($original_price);
    }

    public function getOriginalAndTransportationPrice($package_id,$zone_id){
        $packageRepo = new PackageRepository();
        $original_price = $packageRepo->getPackagePrice($package_id);

        $packageSaleRepo = new PackageSaleRepository();
        $transportation_price_result = $packageSaleRepo->getTransportationPrice($package_id,$zone_id);

        return \Response::json(array('original_price'=>$original_price, 'transportation_price_result'=>$transportation_price_result));
    }
}
