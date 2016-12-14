<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/26/2016
 * Time: 4:00 PM
 */

namespace App\Http\Controllers\Patient;
use App\Backend\Cartype\CartypeRepository;
use App\Backend\Cartypesetup\CartypesetupRepository;
use App\Backend\Invoice\InvoiceRepositoryInterface;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller
{
    private $repo;

    public function __construct(InvoiceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {
            $id = Auth::guard('User')->user()->id;
//            $invoices = $this->repo->getInvoiceByPatientID($id);
            $invoices = $this->repo->getInvoiceHeaderByPatientID($id);

            foreach($invoices as $invoice){
                $invoiceDetails = $this->repo->getDetails($invoice->id);
                foreach($invoiceDetails as $invDetail){
                    $invoice->car_type = $invDetail->car_type;
                    $invoice->car_type_setup_id = $invDetail->car_type_setup_id;
                }
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
            }

            $carTypeRepo = new CartypeRepository();

            $carTypeSetupRepo = new CartypesetupRepository();

            $carTypeArray = array();
            foreach($invoices as $inv){
                $carType = $inv->car_type;
                if($carType == 1){
                    $carTypeArray[$inv->id] = "Patient Owned Vehicle";
                }
                if($carType == 2){
                    $carTypeArray[$inv->id] = "Rental Vehicle";
                }

                if($carType == 3){
                    if($inv->car_type_setup_id != 0){
                        $carTypeID = $carTypeSetupRepo->getCarType($inv->car_type_setup_id);
                        $carTypeArray[$inv->id] = $carTypeRepo->getCarTypeName($carTypeID);
                    }
                    else{
                        $carTypeArray[$inv->id] = "HHCS Vehicle";
                    }
                }
            }

            return view('patient.invoice.invoice')
                ->with('invoices',$invoices)
                ->with('carTypeArray',$carTypeArray);
        }
        return redirect('/');
    }

    public function detail($id){
        if (Auth::guard('User')->check()) {
            $result = $this->repo->getObjByID($id);
            if ($result['aceplusStatusCode'] == ReturnMessage::OK){
                $invoice = $result['result'];
                $grandTotalAmount = $invoice->total_nett_amt_wo_disc - $invoice->total_disc_amt;
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoiceDetails = $this->repo->getDetails($id);

                return view('patient.invoice.invoicedetail')
                    ->with('invoice',$invoice)
                    ->with('invoiceDetails',$invoiceDetails)
                    ->with('grandTotalAmount',$grandTotalAmount);
            }
            else{
                return redirect()->action('Patient\InvoiceController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Error in loading the invoice to view detail !!! '));
            }

        }
        return redirect('/');
    }

    public function export($id){
        if (Auth::guard('User')->check()) {
            $result = $this->repo->getObjByID($id);
            if ($result['aceplusStatusCode'] == ReturnMessage::OK){
                $invoice = $result['result'];
                $grandTotalAmount = $invoice->total_nett_amt_wo_disc - $invoice->total_disc_amt;
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoiceDetails = $this->repo->getDetails($id);

                if(isset($invoiceDetails) && count($invoiceDetails)>0){
                    $html = '<h1>Invoice Detail</h1>
                        <table>
                            <tr>
                                <td height="30" width="25%">Invoice ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->id.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Date</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->date.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->schedule_id.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule Start Time</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->schedule_start_time.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule End Time</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->schedule_end_time.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient_id.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient Name</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->name.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient Address</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->address.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Township</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->township->name.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Zone</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->zone->name.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Total Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->total_amount_wo_discount.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Discount Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->total_consultant_discount_amount.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Grand Total Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$grandTotalAmount.'</td>
                            </tr>
                        </table>
                        <br><br><br>
                        <table border="1">
                            <thead>
                            <tr height="30">
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Discount Amount</th>
                                <th>Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>';

                    foreach($invoiceDetails as $invoiceDetail){
                        $html .= '<tr height="30">';
                        $html .= '<td> '. $invoiceDetail->type .'</td>';
                        $html .= '<td>'. $invoiceDetail->product_qty .'</td>';
                        $html .= '<td>'. $invoiceDetail->product_price .'</td>';
                        $html .= '<td>'. $invoiceDetail->consultant_discount_amount .'</td>';
                        $html .= '<td>'. $invoiceDetail->product_amount .'</td>';
                        $html .= '</tr>';
                    }
                    $html .= '</tbody>
                                </table>';
                }
                else{
//                    dd($invoice);
                    $html='<h1>Invoice Detail</h1>
                        <table>
                            <tr>
                                <td height="30" width="25%">Invoice ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->id.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Date</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->date.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->schedule_id.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule Start Time</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->schedule_start_time.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule End Time</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->schedule_end_time.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient_id.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient Name</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->name.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient Address</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->address.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Township</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->township->name.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Zone</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->patient->zone->name.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Total Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->total_nett_amt_wo_disc.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Discount Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$invoice->total_disc_amt.'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Grand Total Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'.$grandTotalAmount.'</td>
                            </tr>
                        </table>';
                }
                Utility::exportPDF($html);

            }
            else{
                return redirect()->action('Patient\InvoiceController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Error in loading the invoice to view detail !!! '));
            }

        }
        return redirect('/');
    }
}
