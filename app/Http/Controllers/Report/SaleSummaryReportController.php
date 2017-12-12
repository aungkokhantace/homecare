<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: September/14/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Report;

use App\Backend\Cartype\CartypeRepository;
use App\Backend\Cartypesetup\CartypesetupRepository;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Maatwebsite\Excel\Facades\Excel;

class SaleSummaryReportController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index() {
        if (Auth::guard('User')->check()) {
            $from_date = null;
            $to_date = null;

//            $invoiceRepo = new InvoiceRepository();
//            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
//
//            $schedulesArray = array();
//            foreach($invoicesWithSchedules as $invoice){
//                $schedulesArray[] = $invoice->schedule_id;
//            }
//
//            $saleSummary = $this->repo->getSaleSummaryReport($from_date, $to_date, $schedulesArray);

//            $saleSummary = $this->repo->getSaleSummary($from_date, $to_date);

            $invoiceHeader = $this->repo->getInvoiceHeader($from_date, $to_date);
            $invoiceDetail = $this->repo->getInvoiceDetail();

            //get patient age using invoice_id
            $invoiceRepo = new InvoiceRepository();
            foreach($invoiceHeader as $invoiceHead){
                $invoice_id     = $invoiceHead->id;
                $invoiceRaw     = $invoiceRepo->getObjByID($invoice_id);
                $invoice        = $invoiceRaw["result"];

                $patient_dob    = $invoice->patient->dob;
                //calculate age from patient dob
                $patient_age_raw= Utility::calculateAge($patient_dob);
                $patient_age    = $patient_age_raw["value"]." ".$patient_age_raw["unit"];

                //bind age to invoice obj
                $invoiceHead->age = $patient_age;
            }

            $saleSummary = array();
            if(isset($invoiceHeader) && count($invoiceHeader)>0){
                foreach($invoiceHeader as $header){
                    $saleSummary[$header->id] = $header;
                    $saleSummary[$header->id]->car_type = null;
                    if(isset($invoiceDetail) && count($invoiceDetail)>0){
                        foreach($invoiceDetail as $detail){
                            if($header->id == $detail->invoice_id){
                                $saleSummary[$header->id]->car_type = $detail->car_type;
                            }
                        }
                    }
                }
            }
            $grandTotal = 0;
            foreach($saleSummary as $sale){
                $grandTotal += $sale->amount;   //calculating Grand Total
            }

            $grandTotal = number_format ($grandTotal, 2); // decimal format

            foreach($saleSummary as $summary){
                $summary->date = Carbon::parse($summary->date)->format('d-m-Y'); //changing date format to show in view
            }

            $carTypeRepo = new CartypeRepository();

            $carTypeSetupRepo = new CartypesetupRepository();

            $carTypeArray = array();

            foreach($saleSummary as $value){
                $carType = $value->car_type;
                if($carType == 1){
                    $carTypeArray[$value->id] = "Patient Owned Vehicle";
                }
                if($carType == 2){
                    $carTypeArray[$value->id] = "Rental Vehicle";
                }

                if($carType == 3){
                    if($value->car_type_setup_id != 0){
                        $carTypeID = $carTypeSetupRepo->getCarType($value->car_type_setup_id);
                        $carTypeArray[$value->id] = $carTypeRepo->getCarTypeName($carTypeID);
                    }
                    else{
                        $carTypeArray[$value->id] = "HHCS Vehicle";
                    }
                }
            }

            return view('report.salesummaryreport')
                ->with('grandTotal',$grandTotal)
                ->with('saleSummary',$saleSummary)
                ->with('carTypeArray',$carTypeArray);
        }
        return redirect('/');
    }

    public function search($from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
//            $invoiceRepo = new InvoiceRepository();
//            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
//            $schedulesArray = array();
//            foreach($invoicesWithSchedules as $invoice){
//                $schedulesArray[] = $invoice->schedule_id;
//            }

//            $saleSummary = $this->repo->getSaleSummary($from_date, $to_date);

            $invoiceHeader = $this->repo->getInvoiceHeader($from_date, $to_date);
            $invoiceDetail = $this->repo->getInvoiceDetail();

            //get patient age using invoice_id
            $invoiceRepo = new InvoiceRepository();
            foreach($invoiceHeader as $invoiceHead){
                $invoice_id     = $invoiceHead->id;
                $invoiceRaw     = $invoiceRepo->getObjByID($invoice_id);
                $invoice        = $invoiceRaw["result"];

                $patient_dob    = $invoice->patient->dob;
                //calculate age from patient dob
                $patient_age_raw= Utility::calculateAge($patient_dob);
                $patient_age    = $patient_age_raw["value"]." ".$patient_age_raw["unit"];

                //bind age to invoice obj
                $invoiceHead->age = $patient_age;
            }

            $saleSummary = array();
            if(isset($invoiceHeader) && count($invoiceHeader)>0){
                foreach($invoiceHeader as $header){
                    $saleSummary[$header->id] = $header;
                    $saleSummary[$header->id]->car_type = null;
                    if(isset($invoiceDetail) && count($invoiceDetail)>0){
                        foreach($invoiceDetail as $detail){
                            if($header->id == $detail->invoice_id){
                                $saleSummary[$header->id]->car_type = $detail->car_type;
                            }
                        }
                    }
                }
            }

            $grandTotal = 0;
            foreach($saleSummary as $sale){
                $grandTotal += $sale->amount;    //calculating Grand Total
            }

            foreach($saleSummary as $summary){
                $summary->date = Carbon::parse($summary->date)->format('d-m-Y'); //changing date format to show in view
            }

            $carTypeRepo = new CartypeRepository();

            $carTypeSetupRepo = new CartypesetupRepository();

            $carTypeArray = array();
            foreach($saleSummary as $value){
                $carType = $value->car_type;
                if($carType == 1){
                    $carTypeArray[$value->id] = "Patient Owned Vehicle";
                }
                if($carType == 2){
                    $carTypeArray[$value->id] = "Rental Vehicle";
                }

                if($carType == 3){
                    if($value->car_type_setup_id != 0){
                        $carTypeID = $carTypeSetupRepo->getCarType($value->car_type_setup_id);
                        $carTypeArray[$value->id] = $carTypeRepo->getCarTypeName($carTypeID);
                    }
                    else{
                        $carTypeArray[$value->id] = "HHCS Vehicle";
                    }
                }
            }

            return view('report.salesummaryreport')
                ->with('grandTotal',$grandTotal)
                ->with('saleSummary',$saleSummary)
                ->with('carTypeArray',$carTypeArray)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date);
        }
        return redirect('/');
    }

    public function excel($from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            ob_end_clean();
            ob_start();
//            $invoiceRepo = new InvoiceRepository();
//            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
//            $schedulesArray = array();
//            foreach($invoicesWithSchedules as $invoice){
//                $schedulesArray[] = $invoice->schedule_id;
//            }
//
//            $saleSummary = $this->repo->getSaleSummaryReport($from_date, $to_date, $schedulesArray);

//            $saleSummary = $this->repo->getSaleSummary($from_date, $to_date);

            $invoiceHeader = $this->repo->getInvoiceHeader($from_date, $to_date);
            $invoiceDetail = $this->repo->getInvoiceDetail();

            //get patient age using invoice_id
            $invoiceRepo = new InvoiceRepository();
            foreach($invoiceHeader as $invoiceHead){
                $invoice_id     = $invoiceHead->id;
                $invoiceRaw     = $invoiceRepo->getObjByID($invoice_id);
                $invoice        = $invoiceRaw["result"];

                $patient_dob    = $invoice->patient->dob;
                //calculate age from patient dob
                $patient_age_raw= Utility::calculateAge($patient_dob);
                $patient_age    = $patient_age_raw["value"]." ".$patient_age_raw["unit"];

                //bind age to invoice obj
                $invoiceHead->age = $patient_age;
            }

            $saleSummary = array();
            if(isset($invoiceHeader) && count($invoiceHeader)>0){
                foreach($invoiceHeader as $header){
                    $saleSummary[$header->id] = $header;
                    $saleSummary[$header->id]->car_type = null;
                    if(isset($invoiceDetail) && count($invoiceDetail)>0){
                        foreach($invoiceDetail as $detail){
                            if($header->id == $detail->invoice_id){
                                $saleSummary[$header->id]->car_type = $detail->car_type;
                            }
//                            else{
//                                $saleSummary[$header->id]->car_type = null;
//                            }
                        }
                    }
                }
            }

            $grandTotal = 0;
            foreach($saleSummary as $sale){
                $grandTotal += $sale->amount;       //calculating Grand Total
            }

            foreach($saleSummary as $summary){
                $summary->date = Carbon::parse($summary->date)->format('d-m-Y'); //changing date format to show in view
            }

            Excel::create('SaleSummaryReport', function($excel)use($saleSummary, $grandTotal) {
                $excel->sheet('SaleSummaryReport', function($sheet)use($saleSummary, $grandTotal) {

                    $carTypeRepo = new CartypeRepository();

                    $carTypeSetupRepo = new CartypesetupRepository();
                    $count = 0;
                    $displayArray = array();                                   //array to be displayed in excel
                    foreach($saleSummary as $value){
                        $count++;
                        $displayArray[$value->id]["InvoiceID"] = $value->id;
                        $displayArray[$value->id]["Patient Name"] = $value->patient;
                        $displayArray[$value->id]["Patient Age"] = $value->age;
                        $displayArray[$value->id]["Township"] = $value->township;

                        $carType = $value->car_type;

                        if($carType == 1){
                            $displayArray[$value->id]["Car Type"] = "Patient Owned Vehicle";            //if carType is 1, then, "Patient Owned Vehicle"
                        }
                        else if($carType == 2){
                            $displayArray[$value->id]["Car Type"] = "Rental Vehicle";                   //if carType is 2, then, "Rental Vehicle"
                        }
                        else if($carType == 3){
                            if($value->car_type_setup_id != 0){
                                $carTypeID = $carTypeSetupRepo->getCarType($value->car_type_setup_id);  //if carType is 3, then, further checking for car_type_setup_id
                                $displayArray[$value->id]["Car Type"] = $carTypeRepo->getCarTypeName($carTypeID);  //get car_type name using car_type_id
                            }
                            else{
                                $displayArray[$value->id]["Car Type"] = "HHCS Vehicle";                 //if no value is defined, HHCS Vehicle is assigned(for error handling)
                            }
                        }
                        else{
                            $displayArray[$value->id]["Car Type"] = "";
                        }


                        $displayArray[$value->id]["Date"] = $value->date;
                        $displayArray[$value->id]["Total Amount"] = $value->amount;
                    }

                    if(count($displayArray) == 0){
                        $sheet->fromArray($displayArray);
                    }
                    else{
                        $count = $count +2;
                        $sheet->cells('A1:G1', function($cells) {
                            $cells->setBackground('#1976d3');
                            $cells->setFontSize(13);
                        });

                        $sheet->fromArray($displayArray);

                        $sheet->appendRow(array(
                            'Grand Total','', '','','','',$grandTotal
                        ));
                        $sheet->cells('A'.$count.':G'.$count, function($cells) {
                            $cells->setBackground('#1976d3');
                            $cells->setFontSize(13);
                        });
                    }
                });
            })
                ->download('xls');
            ob_flush();
            return Redirect();
        }
        return redirect('/');
    }

    public function invoicedetail($id)
    {
        $invoiceRepo = new InvoiceRepository();
        if (Auth::guard('User')->check()) {
            $result = $invoiceRepo->getObjByID($id);

            if ($result['aceplusStatusCode'] == ReturnMessage::OK){
                $invoice = $result['result'];
                $grandTotalAmount = $invoice->total_nett_amt_wo_disc - $invoice->total_disc_amt;
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');

                $invoiceDetails = $invoiceRepo->getDetails($id);

                $dob = $invoice->patient->dob;
                if($dob == "0000-00-00"){
                    $dob = "1970-01-01";
                }
                $age = Utility::calculateAge($dob);

                if($invoice->patient->gender == "male"){
                    $patient_gender = "Male";
                }
                else{
                    $patient_gender = "Female";
                }

                $typeArray = array();
                $typeCount = 0;
                foreach($invoiceDetails as $invDetail){
                    $typeArray[$typeCount] = $invDetail->type;
                    $typeCount++;
                }

                $investigationArray = array();
                $investigationCounter = 0;

                $looped = 0;    //flag to loop only one time for invoice_detail->type == "investigation"

                //to create investigation array
                foreach($invoiceDetails as $invoiceDetail){
//                    if($invoiceDetail->type == "investigation"){
                    if(in_array('investigation',$typeArray) && $looped == 0){
                        $looped = 1;
                        $headerId = $invoiceDetail->invoice_id;
                        $header = $invoiceRepo->getHeader($headerId);

                        $patientId = $header->patient_id;
                        $scheduleId = $header->schedule_id;

                        $scheduleInvestigations = $invoiceRepo->getScheduleInvestigations($patientId,$scheduleId);

                        //for investigation_id
                        foreach($scheduleInvestigations as $scheduleInvestigation){
                            if($scheduleInvestigation->investigation_id != 0){
//                                $investigations = $invoiceRepo->getInvestigations($scheduleInvestigation->investigation_id);
                                $investigationLabs = $invoiceRepo->getInvestigationLabs($scheduleInvestigation->investigation_id);

                                if(isset($investigationLabs) && count($investigationLabs)>0){
                                    foreach($investigationLabs as $investigate){
                                        $investigationArray[$investigationCounter]['name']= $investigate->service_name;
                                        $investigationArray[$investigationCounter]['price']= $scheduleInvestigation->investigation_labs_price;
                                        $investigationCounter++;
                                    }
                                }
                            }
                        }

                        //for investigation_imaging_xray_id
                        foreach($scheduleInvestigations as $scheduleInvestigation){
                            if($scheduleInvestigation->investigation_imaging_xray_id != 0){
                                $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_xray_id);
                                if(isset($investigationImagings) && count($investigationImagings)>0) {
                                    foreach ($investigationImagings as $imaging) {
                                        $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                        $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                        $investigationCounter++;
                                    }
                                }
                            }
                        }

                        //for investigation_imaging_usg_id
                        foreach($scheduleInvestigations as $scheduleInvestigation){
                            if($scheduleInvestigation->investigation_imaging_usg_id != 0){
                                $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_usg_id);
                                if(isset($investigationImagings) && count($investigationImagings)>0) {
                                    foreach ($investigationImagings as $imaging) {
                                        $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                        $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                        $investigationCounter++;
                                    }
                                }
                            }
                        }

                        //for investigation_imaging_ct_id
                        foreach($scheduleInvestigations as $scheduleInvestigation){
                            if($scheduleInvestigation->investigation_imaging_ct_id != 0){
                                $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_ct_id);
                                if(isset($investigationImagings) && count($investigationImagings)>0) {
                                    foreach ($investigationImagings as $imaging) {
                                        $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                        $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                        $investigationCounter++;
                                    }
                                }
                            }
                        }

                        //for investigation_imaging_mri_id
                        foreach($scheduleInvestigations as $scheduleInvestigation){
                            if($scheduleInvestigation->investigation_imaging_mri_id != 0){
                                $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_mri_id);
                                if(isset($investigationImagings) && count($investigationImagings)>0) {
                                    foreach ($investigationImagings as $imaging) {
                                        $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                        $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                        $investigationCounter++;
                                    }
                                }
                            }
                        }

                        //for investigation_imaging_other_id
                        foreach($scheduleInvestigations as $scheduleInvestigation){
                            if($scheduleInvestigation->investigation_imaging_other_id != 0){
                                $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_other_id);
                                if(isset($investigationImagings) && count($investigationImagings)>0) {
                                    foreach ($investigationImagings as $imaging) {
                                        $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                        $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                        $investigationCounter++;
                                    }
                                }
                            }
                        }
                    }
                }

                $medicationArray = array();
                $medicationCounter = 0;

                //to create medication array
                foreach($invoiceDetails as $invoiceDetail){
                    if($invoiceDetail->type == "medication"){
                        $medicationArray[$medicationCounter]['name'] = $invoiceDetail->product->product_name;
                        $medicationArray[$medicationCounter]['qty'] = $invoiceDetail->product_qty;
                        $medicationArray[$medicationCounter]['price'] = $invoiceDetail->product_price;
                        $medicationArray[$medicationCounter]['amount'] = $invoiceDetail->product_amount;
                        $medicationCounter++;
                    }
                }

                if($invoice->type == "package"){
                    $monthToAdd = $invoice->package->expiry_date;
                    $createdDate = date("Y-m-d", strtotime($invoice->package->created_at));
                    $expiryDate = strtotime(date("Y-m-d", strtotime($createdDate)) . " +" . $monthToAdd . "month");
                    $expiryDate = date("Y-m-d", $expiryDate);
                    //invoice type is "package", with expiry date

                    return view('report.invoicedetail')
                        ->with('invoice',$invoice)
                        ->with('invoiceDetails',$invoiceDetails)
                        ->with('grandTotalAmount',$grandTotalAmount)
                        ->with('age',$age)
                        ->with('patient_gender',$patient_gender)
                        ->with('expiryDate',$expiryDate);
                }

                // start medication procedures
                $treatmentProcedureArray = array();
                $treatmentProcedureCounter = 0;
                //to create medication procedure array
                foreach($invoiceDetails as $invoiceDetail){
                    if($invoiceDetail->type == "treatment"){
                        $treatmentProcedureArray[$treatmentProcedureCounter]['name'] = $invoiceDetail->product->product_name;
                        $treatmentProcedureArray[$treatmentProcedureCounter]['price'] = $invoiceDetail->product_amount;
                        $treatmentProcedureCounter++;
                    }
                }
                // end medication procedures

                //invoice type is "invoice", without expiry date
                return view('report.invoicedetail')
                    ->with('invoice',$invoice)
                    ->with('invoiceDetails',$invoiceDetails)
                    ->with('grandTotalAmount',$grandTotalAmount)
                    ->with('age',$age)
                    ->with('patient_gender',$patient_gender)
                    ->with('investigationArray',$investigationArray)
                    ->with('medicationArray',$medicationArray)
                    ->with('treatmentProcedureArray',$treatmentProcedureArray);

            }
            else{
                return redirect()->action('Report\SaleSummaryReportController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Error in loading the invoice to view detail !!! '));
            }

        }
        return redirect('/');
    }

    public function export($id){
        if (Auth::guard('User')->check()) {
            $invoiceRepo = new InvoiceRepository();
            $result = $invoiceRepo->getObjByID($id);
            if ($result['aceplusStatusCode'] == ReturnMessage::OK){
                $invoice = $result['result'];
//                $grandTotalAmount = $invoice->total_amount_wo_discount - $invoice->total_consultant_discount_amount;
//                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoiceDetails = $invoiceRepo->getDetails($id);

                $dob = $invoice->patient->dob;
                if($dob == "0000-00-00"){
                    $dob = "1970-01-01";
                }
                $age = Utility::calculateAge($dob);

                if($invoice->patient->gender == "male"){
                    $patient_gender = "Male";
                }
                else{
                    $patient_gender = "Female";
                }

                if($invoice->type == "package") {
                    $monthToAdd = $invoice->package->expiry_date;
                    $createdDate = date("Y-m-d", strtotime($invoice->package->created_at));
                    $expiryDate = strtotime(date("Y-m-d", strtotime($createdDate)) . " +" . $monthToAdd . "month");
                    $expiryDate = date("Y-m-d", $expiryDate);
                }

                if(isset($invoiceDetails) && count($invoiceDetails)>0){
                    $pdfHeader = Utility::getPDFHeader().'<br>'.'<br>';

                    $patientData = '<table class="table" style="word-wrap: break-word; table-layout: fixed; font-size:9px;">
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
                                <td height="20" width="25%">'.$age['value'].' '.$age['unit'].'/'.$patient_gender.'</td>
                                <td height="20" width="20%">Date</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$invoice->created_at->format("d-m-Y").'</td>
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

                    if($invoice->type == "package") {
                        $saleData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                <tr bgcolor="#cccccc">
                                    <th height="15">Item</th>
                                    <th height="15">Description</th>
                                    <th height="15">Expiry Date</th>
                                    <th height="15">Amount</th>
                                </tr>
                                <tr>
                                    <td height="20">1</td>
                                    <td height="20">' . $invoice->package->package_name . '</td>
                                    <td height="20">' . $expiryDate . '</td>
                                    <td height="20">' . $invoice->package->price . '</td>
                                </tr>
                            </table>
                            <hr>';
                    }
                    else{
                        $typeArray = array();
                        $typeCount = 0;
                        foreach($invoiceDetails as $invDetail){
                            $typeArray[$typeCount] = $invDetail->type;
                            $typeCount++;
                        }

                        $investigationArray = array();
                        $investigationCounter = 0;

                        $looped = 0;    //flag to loop only one time for invoice_detail->type == "investigation"

                        //to create investigation array
                        foreach($invoiceDetails as $invoiceDetail){
//                      if($invoiceDetail->type == "investigation"){
                            if(in_array('investigation',$typeArray) && $looped == 0){
                                $looped = 1;
                                $headerId = $invoiceDetail->invoice_id;
                                $header = $invoiceRepo->getHeader($headerId);

                                $patientId = $header->patient_id;
                                $scheduleId = $header->schedule_id;

                                $scheduleInvestigations = $invoiceRepo->getScheduleInvestigations($patientId,$scheduleId);

                                //for investigation_id
                                foreach($scheduleInvestigations as $scheduleInvestigation){
                                    if($scheduleInvestigation->investigation_id != 0){
//                                        $investigations = $invoiceRepo->getInvestigations($scheduleInvestigation->investigation_id);
                                        $investigationLabs = $invoiceRepo->getInvestigationLabs($scheduleInvestigation->investigation_id);

                                        if(isset($investigationLabs) && count($investigationLabs)>0){
                                            foreach($investigationLabs as $investigate){
                                                $investigationArray[$investigationCounter]['name']= $investigate->service_name;
                                                $investigationArray[$investigationCounter]['price']= $scheduleInvestigation->investigation_labs_price;
                                                $investigationCounter++;
                                            }
                                        }
                                    }
                                }

                                //for investigation_imaging_xray_id
                                foreach($scheduleInvestigations as $scheduleInvestigation){
                                    if($scheduleInvestigation->investigation_imaging_xray_id != 0){
                                        $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_xray_id);
                                        if(isset($investigationImagings) && count($investigationImagings)>0) {
                                            foreach ($investigationImagings as $imaging) {
                                                $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                $investigationCounter++;
                                            }
                                        }
                                    }
                                }

                                //for investigation_imaging_usg_id
                                foreach($scheduleInvestigations as $scheduleInvestigation){
                                    if($scheduleInvestigation->investigation_imaging_usg_id != 0){
                                        $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_usg_id);
                                        if(isset($investigationImagings) && count($investigationImagings)>0) {
                                            foreach ($investigationImagings as $imaging) {
                                                $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                $investigationCounter++;
                                            }
                                        }
                                    }
                                }

                                //for investigation_imaging_ct_id
                                foreach($scheduleInvestigations as $scheduleInvestigation){
                                    if($scheduleInvestigation->investigation_imaging_ct_id != 0){
                                        $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_ct_id);
                                        if(isset($investigationImagings) && count($investigationImagings)>0) {
                                            foreach ($investigationImagings as $imaging) {
                                                $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                $investigationCounter++;
                                            }
                                        }
                                    }
                                }

                                //for investigation_imaging_mri_id
                                foreach($scheduleInvestigations as $scheduleInvestigation){
                                    if($scheduleInvestigation->investigation_imaging_mri_id != 0){
                                        $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_mri_id);
                                        if(isset($investigationImagings) && count($investigationImagings)>0) {
                                            foreach ($investigationImagings as $imaging) {
                                                $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                $investigationCounter++;
                                            }
                                        }
                                    }
                                }

                                //for investigation_imaging_other_id
                                foreach($scheduleInvestigations as $scheduleInvestigation){
                                    if($scheduleInvestigation->investigation_imaging_other_id != 0){
                                        $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_other_id);
                                        if(isset($investigationImagings) && count($investigationImagings)>0) {
                                            foreach ($investigationImagings as $imaging) {
                                                $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                $investigationCounter++;
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $medicationArray = array();
                        $medicationCounter = 0;

                        //to create medication array
                        foreach($invoiceDetails as $invoiceDetail){
                            if($invoiceDetail->type == "medication"){
                                $medicationArray[$medicationCounter]['name'] = $invoiceDetail->product->product_name;
                                $medicationArray[$medicationCounter]['qty'] = $invoiceDetail->product_qty;
                                $medicationArray[$medicationCounter]['price'] = $invoiceDetail->product_price;
                                $medicationArray[$medicationCounter]['amount'] = $invoiceDetail->product_amount;
                                $medicationCounter++;
                            }
                        }

                        // start medication procedures
                        $treatmentProcedureArray = array();
                        $treatmentProcedureCounter = 0;
                        //to create medication procedure array
                        foreach($invoiceDetails as $invoiceDetail){
                            if($invoiceDetail->type == "treatment"){
                                $treatmentProcedureArray[$treatmentProcedureCounter]['name'] = $invoiceDetail->product->product_name;
                                $treatmentProcedureArray[$treatmentProcedureCounter]['price'] = $invoiceDetail->product_amount;
                                $treatmentProcedureCounter++;
                            }
                        }
                        // end medication procedures

                        $saleData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                        <tr bgcolor="#cccccc">
                                            <th height="15" width="10%">Item</th>
                                            <th height="15" width="65%">Description</th>
                                            <th height="15" width="25%" style="text-align: right;">Amount</th>
                                        </tr>
                                        <tr>
                                            <td height="20">1</td>
                                            <td height="20">Service Charges</td>
                                            <td height="20" align="right">'.$invoice->total_service_amount.'</td>
                                        </tr>
                                        <tr>
                                            <td height="20">2</td>
                                            <td height="20">Consulation Fees</td>
                                            <td height="20" align="right">'.$invoice->total_consultant_fee.'</td>
                                        </tr>
                                        <tr>
                                            <td height="30" rowspan="2">3</td>
                                            <td height="30">Medications
                                            <hr><br>';
                                                $saleData.='<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">';
                                                    foreach($medicationArray as $medication){
                                                        $saleData .= '<tr height="30">';
                                                        $saleData .= '<td>'. $medication['name'] .'</td>';
                                                        $saleData .= '<td>'. $medication['qty'] .'</td>';
                                                        $saleData .= '<td>'. $medication['price'] .'</td>';
                                                        $saleData .= '<td>'. $medication['amount'] .'</td>';
                                                        $saleData .= '</tr><hr>';
                                                    }
                                                $saleData.='</table><br>';

                                            $saleData.='</td>
                                            <td height="20" align="right" rowspan="2">'.$invoice->total_medication_amount.'</td>
                                        </tr>
                                        <tr>
                                            <td height="30">Treatment (Procedure)
                                            <hr><br>';
                                                $saleData.='<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">';
                                                    foreach($treatmentProcedureArray as $treatmentProcedure){
                                                        $saleData .= '<tr height="30">';
                                                        $saleData .= '<td>'. $treatmentProcedure['name'] .'</td>';
                                                        $saleData .= '<td>'. $treatmentProcedure['price'] .'</td>';
                                                        $saleData .= '</tr><hr>';
                                                    }
                                                $saleData.='</table><br>';

                                            $saleData.='</td>
                                        </tr>
                                         <tr>
                                            <td height="30">4</td>
                                            <td height="30">Investigation Charges
                                            <hr><br>';
                                                $saleData.='<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">';
                                                    foreach($investigationArray as $investigation){
                                                        $saleData .= '<tr height="30">';
                                                        $saleData .= '<td>'. $investigation['name'] .'</td>';
                                                        $saleData .= '<td>'. $investigation['price'] .'</td>';
                                                        $saleData .= '</tr><hr>';
                                                    }
                                                $saleData.='</table><br>';

                                            $saleData.='</td>
                                            <td height="30" align="right">'.$invoice->total_investigation_amount.'</td>
                                        </tr>';
                                    $saleData.='<tr>
                                                    <td height="20" width="10%">5</td>
                                                    <td height="20" width="65%">Transportation Charges</td>
                                                    <td height="20" align="right" width="25%">'.$invoice->total_car_amount.'</td>
                                                </tr>
                                                <tr>
                                                    <td height="20" width="10%">6</td>
                                                    <td height="20" width="65%">Others</td>
                                                    <td height="20" width="25%" align="right">'.$invoice->total_other_service_amount.'</td>
                                                </tr>
                                                <tr>
                                                    <td height="20" width="10%">7</td>
                                                    <td height="20" width="65%"></td>
                                                    <td height="20" width="25%"></td>
                                                </tr>
                                                 <tr>
                                                    <td height="30" width="10%">8</td>
                                                    <td height="30" width="65%"></td>
                                                    <td height="30" width="25%"></td>
                                                </tr></table>';
                    }
                    if($invoice->type == "package"){
                        $summaryData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Total</td>
                                    <td height="20" align="right">'.$invoice->total_nett_amt_wo_disc.'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Discount</td>
                                    <td height="20" align="right">'.$invoice->total_disc_amt.'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Grand Total</td>
                                    <td height="20" align="right">'.$invoice->total_payable_amt.'</td>
                                </tr>
                                <tr>
                                    <td height="20">Remark</td>
                                    <td height="20">'.$invoice->packagesale->remark.'</td>
                                </tr>
                            </table>
                            <br>';
                    }
                    //type is invoice
                    else{
                        $summaryData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Total</td>
                                    <td height="20" align="right">'.$invoice->total_nett_amt_wo_disc.'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Discount</td>
                                    <td height="20" align="right">'.$invoice->total_disc_amt.'</td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                    <td height="20"></td>
                                    <td height="20">Grand Total</td>
                                    <td height="20" align="right">'.$invoice->total_payable_amt.'</td>
                                </tr>
                                <tr>
                                    <td height="20">Remark</td>
                                    <td height="20">'.$invoice->status.'</td>
                                </tr>
                            </table>
                            <br>';
                    }

//                    $detailData = '<hr><br><br><table border="1" style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
//                            <thead>
//                            <tr height="30">
//                                <th>Type</th>
//                                <th>Qty</th>
//                                <th>Price</th>
//                                <th>Discount Amount</th>
//                                <th>Total Amount</th>
//                            </tr>
//                            </thead>
//                            <tbody>';
//
//                    foreach($invoiceDetails as $invoiceDetail){
//                        $detailData .= '<tr height="30">';
//                        $detailData .= '<td> '. $invoiceDetail->type .'</td>';
//                        $detailData .= '<td>'. $invoiceDetail->product_qty .'</td>';
//                        $detailData .= '<td>'. $invoiceDetail->product_price .'</td>';
//                        $detailData .= '<td>'. $invoiceDetail->consultant_discount_amount .'</td>';
//                        $detailData .= '<td>'. $invoiceDetail->product_amount .'</td>';
//                        $detailData .= '</tr>';
//                    }
//
//                    $detailData .= '</tbody>
//                                </table>';

                    $signature = Utility::getSignature();

//                    $html = $pdfHeader.$patientData.'<br>'.$saleData.'<br>'.$summaryData.'<hr>'.$detailData.$signature;
                    $html = $pdfHeader.$patientData.'<br>'.$saleData.'<br>'.$summaryData.$signature;
                }
                else{
                    $pdfHeader = Utility::getPDFHeader().'<br>'.'<br>';

                    $patientData = '<table class="table" style="word-wrap: break-word; table-layout: fixed; font-size:9px;">
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
                                <td height="20" width="25%">'.$age['value'].' '.$age['unit'].'/'.$patient_gender.'</td>
                                <td height="20" width="20%">Date</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$invoice->created_at->format("d-m-Y").'</td>
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

                    if($invoice->type == "package"){
                        $saleData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                <tr bgcolor="#cccccc">
                                    <td height="15">Item</td>
                                    <td height="15">Description</td>
                                    <td height="15">Expiry Date</td>
                                    <td height="15">Amount</td>
                                </tr>
                                <tr>
                                    <td height="20">1</td>
                                    <td height="20">'.$invoice->package->package_name.'</td>
                                    <td height="20">'.$expiryDate.'</td>
                                    <td height="20">'.$invoice->package->price.'</td>
                                </tr>
                            </table>
                            <hr>';
                    }
                    else{
                            $typeArray = array();
                            $typeCount = 0;
                            foreach($invoiceDetails as $invDetail){
                                $typeArray[$typeCount] = $invDetail->type;
                                $typeCount++;
                            }

                            $investigationArray = array();
                            $investigationCounter = 0;

                            $looped = 0;    //flag to loop only one time for invoice_detail->type == "investigation"

                            //to create investigation array
                            foreach($invoiceDetails as $invoiceDetail){
//                      if($invoiceDetail->type == "investigation"){
                                if(in_array('investigation',$typeArray) && $looped == 0){
                                    $looped = 1;
                                    $headerId = $invoiceDetail->invoice_id;
                                    $header = $invoiceRepo->getHeader($headerId);

                                    $patientId = $header->patient_id;
                                    $scheduleId = $header->schedule_id;

                                    $scheduleInvestigations = $invoiceRepo->getScheduleInvestigations($patientId,$scheduleId);

                                    //for investigation_id
                                    foreach($scheduleInvestigations as $scheduleInvestigation){
                                        if($scheduleInvestigation->investigation_id != 0){
                                            $investigations = $invoiceRepo->getInvestigations($scheduleInvestigation->investigation_id);

                                            if(isset($investigations) && count($investigations)>0){
                                                foreach($investigations as $investigate){
                                                    $investigationArray[$investigationCounter]['name']= $investigate->name;
                                                    $investigationArray[$investigationCounter]['price']= $investigate->price;
                                                    $investigationCounter++;
                                                }
                                            }
                                        }
                                    }

                                    //for investigation_imaging_xray_id
                                    foreach($scheduleInvestigations as $scheduleInvestigation){
                                        if($scheduleInvestigation->investigation_imaging_xray_id != 0){
                                            $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_xray_id);
                                            if(isset($investigationImagings) && count($investigationImagings)>0) {
                                                foreach ($investigationImagings as $imaging) {
                                                    $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                    $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                    $investigationCounter++;
                                                }
                                            }
                                        }
                                    }

                                    //for investigation_imaging_usg_id
                                    foreach($scheduleInvestigations as $scheduleInvestigation){
                                        if($scheduleInvestigation->investigation_imaging_usg_id != 0){
                                            $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_usg_id);
                                            if(isset($investigationImagings) && count($investigationImagings)>0) {
                                                foreach ($investigationImagings as $imaging) {
                                                    $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                    $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                    $investigationCounter++;
                                                }
                                            }
                                        }
                                    }

                                    //for investigation_imaging_ct_id
                                    foreach($scheduleInvestigations as $scheduleInvestigation){
                                        if($scheduleInvestigation->investigation_imaging_ct_id != 0){
                                            $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_ct_id);
                                            if(isset($investigationImagings) && count($investigationImagings)>0) {
                                                foreach ($investigationImagings as $imaging) {
                                                    $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                    $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                    $investigationCounter++;
                                                }
                                            }
                                        }
                                    }

                                    //for investigation_imaging_mri_id
                                    foreach($scheduleInvestigations as $scheduleInvestigation){
                                        if($scheduleInvestigation->investigation_imaging_mri_id != 0){
                                            $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_mri_id);
                                            if(isset($investigationImagings) && count($investigationImagings)>0) {
                                                foreach ($investigationImagings as $imaging) {
                                                    $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                    $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                    $investigationCounter++;
                                                }
                                            }
                                        }
                                    }

                                    //for investigation_imaging_other_id
                                    foreach($scheduleInvestigations as $scheduleInvestigation){
                                        if($scheduleInvestigation->investigation_imaging_other_id != 0){
                                            $investigationImagings = $invoiceRepo->getInvestigationImagings($scheduleInvestigation->investigation_imaging_other_id);
                                            if(isset($investigationImagings) && count($investigationImagings)>0) {
                                                foreach ($investigationImagings as $imaging) {
                                                    $investigationArray[$investigationCounter]['name'] = $imaging->service_name;
                                                    $investigationArray[$investigationCounter]['price'] = $imaging->service_charges;
                                                    $investigationCounter++;
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            $medicationArray = array();
                            $medicationCounter = 0;

                            //to create medication array
                            foreach($invoiceDetails as $invoiceDetail){
                                if($invoiceDetail->type == "medication"){
                                    $medicationArray[$medicationCounter]['name'] = $invoiceDetail->product->product_name;
                                    $medicationArray[$medicationCounter]['qty'] = $invoiceDetail->product_qty;
                                    $medicationArray[$medicationCounter]['price'] = $invoiceDetail->product_price;
                                    $medicationArray[$medicationCounter]['amount'] = $invoiceDetail->product_amount;
                                    $medicationCounter++;
                                }
                            }

                            $saleData = '<table style="font-size:9px; word-wrap: break-word; table-layout: fixed;">
                                        <tr bgcolor="#cccccc">
                                            <th height="15" width="10%">Item</th>
                                            <th height="15" width="65%">Description</th>
                                            <th height="15" width="25%">Amount</th>
                                        </tr>
                                        <tr>
                                            <td height="20">1</td>
                                            <td height="20">Service Charges</td>
                                            <td height="20" align="right">'.$invoice->total_service_amount.'</td>
                                        </tr>
                                        <tr>
                                            <td height="20">2</td>
                                            <td height="20">Consulation Fees</td>
                                            <td height="20" align="right">'.$invoice->total_consultant_fee.'</td>
                                        </tr>
                                        <tr>
                                            <td height="30">3</td>
                                            <td height="30">Medications
                                            <hr><br>';
                            $saleData.='<table>';
                            foreach($medicationArray as $medication){
                                $saleData .= '<tr height="30">';
                                $saleData .= '<td>'. $medication['name'] .'</td>';
                                $saleData .= '<td>'. $medication['qty'] .'</td>';
                                $saleData .= '<td>'. $medication['price'] .'</td>';
                                $saleData .= '<td>'. $medication['amount'] .'</td>';
                                $saleData .= '</tr><hr>';
                            }
                            $saleData.='</table><br>';

                            $saleData.='</td>
                                            <td height="20" align="right">'.$invoice->total_medication_amount.'</td>
                                        </tr>
                                         <tr>
                                            <td height="30">4</td>
                                            <td height="30">Investigation Charges
                                            <hr><br>';
                            $saleData.='<table>';
                            foreach($investigationArray as $investigation){
                                $saleData .= '<tr height="30">';
                                $saleData .= '<td>'. $investigation['name'] .'</td>';
                                $saleData .= '<td>'. $investigation['price'] .'</td>';
                                $saleData .= '</tr><hr>';
                            }
                            $saleData.='</table><br>';

                            $saleData.='</td>
                                            <td height="30" align="right">'.$invoice->total_investigation_amount.'</td>
                                        </tr>
                                    </table>';
                            $saleData.='<tr>
                                                    <td height="20" width="10%">5</td>
                                                    <td height="20" width="65%">Transportation Charges</td>
                                                    <td height="20" align="right" width="24%">'.$invoice->total_car_amount.'</td>
                                                </tr>
                                                <tr>
                                                    <td height="20" width="10%">6</td>
                                                    <td height="20" width="65%">Others</td>
                                                    <td height="20" width="25%"></td>
                                                </tr>
                                                <tr>
                                                    <td height="20" width="10%">7</td>
                                                    <td height="20" width="65%"></td>
                                                    <td height="20" width="25%"></td>
                                                </tr>
                                                 <tr>
                                                    <td height="30" width="10%">8</td>
                                                    <td height="30" width="65%"></td>
                                                    <td height="30" width="25%"></td>
                                                </tr></table><hr>';
                    }

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
                }
                Utility::exportPDF($html);

            }
            else{
                return redirect()->action('Report\SaleSummaryReportController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Error in loading the invoice to view detail !!! '));
            }

        }
        return redirect('/');
    }
}
