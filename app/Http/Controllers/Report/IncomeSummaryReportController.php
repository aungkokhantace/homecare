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
use App\Backend\Invoice\InvoiceRepositoryInterface;
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

class IncomeSummaryReportController extends Controller
{
    private $repo;

    public function __construct(InvoiceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index() {
        if (Auth::guard('User')->check()) {
            $type = null;
            $from_date = null;
            $to_date = null;

            $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);

            foreach($invoices as $invoice){
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
            }

            $totalArray = array();

            $totalCarAmount             = 0;
            $totalServiceAmount         = 0;
            $totalMedicationAmount      = 0;
            $totalInvestigationAmount   = 0;
            $totalPackageAmount         = 0;
            $totalAmount                = 0;

            foreach($invoices as $invoice){
                $totalCarAmount             += $invoice->total_car_amount;
                $totalServiceAmount         += $invoice->total_service_amount;
                $totalMedicationAmount      += $invoice->total_medication_amount;
                $totalInvestigationAmount   += $invoice->total_investigation_amount;
                $totalPackageAmount         += $invoice->package_price;
                $totalAmount                += $invoice->total;
            }

            $totalArray['car']              = $totalCarAmount;
            $totalArray['service']          = $totalServiceAmount;
            $totalArray['medication']       = $totalMedicationAmount;
            $totalArray['investigation']    = $totalInvestigationAmount;
            $totalArray['package']          = $totalPackageAmount;
            $totalArray['total']            = $totalAmount;

            return view('report.incomesummaryreport')
                ->with('invoices',$invoices)
                ->with('totalArray',$totalArray);
        }
        return redirect('/');
    }

    public function search($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {

            $from_year = null;
            $to_year = null;
            $from_month = null;
            $to_month = null;
            if($type == "yearly"){
                $from_year = $from_date;
                $to_year = $to_date;
            }
            if($type == "monthly"){
                $from_month = $from_date;
                $to_month = $to_date;
            }
            $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);

            foreach($invoices as $invoice){
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
            }

            $totalArray = array();

            $totalCarAmount             = 0;
            $totalServiceAmount         = 0;
            $totalMedicationAmount      = 0;
            $totalInvestigationAmount   = 0;
            $totalPackageAmount         = 0;
            $totalAmount                = 0;

            foreach($invoices as $invoice){
                $totalCarAmount             += $invoice->total_car_amount;
                $totalServiceAmount         += $invoice->total_service_amount;
                $totalMedicationAmount      += $invoice->total_medication_amount;
                $totalInvestigationAmount   += $invoice->total_investigation_amount;
                $totalPackageAmount         += $invoice->package_price;
                $totalAmount                += $invoice->total;
            }

            $totalArray['car']              = $totalCarAmount;
            $totalArray['service']          = $totalServiceAmount;
            $totalArray['medication']       = $totalMedicationAmount;
            $totalArray['investigation']    = $totalInvestigationAmount;
            $totalArray['package']          = $totalPackageAmount;
            $totalArray['total']            = $totalAmount;

            return view('report.incomesummaryreport')
                ->with('invoices',$invoices)
                ->with('totalArray',$totalArray)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date)
                ->with('from_month',$from_month)
                ->with('to_month',$to_month)
                ->with('from_year',$from_year)
                ->with('to_year',$to_year)
                ->with('type',$type);
        }
        return redirect('/');
    }

    public function excel($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {

            ob_end_clean();
            ob_start();

            $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);

            foreach($invoices as $invoice){
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
            }

            $totalArray = array();

            $totalCarAmount             = 0;
            $totalServiceAmount         = 0;
            $totalMedicationAmount      = 0;
            $totalInvestigationAmount   = 0;
            $totalPackageAmount         = 0;
            $totalAmount                = 0;

            foreach($invoices as $invoice){
                $totalCarAmount             += $invoice->total_car_amount;
                $totalServiceAmount         += $invoice->total_service_amount;
                $totalMedicationAmount      += $invoice->total_medication_amount;
                $totalInvestigationAmount   += $invoice->total_investigation_amount;
                $totalPackageAmount         += $invoice->package_price;
                $totalAmount                += $invoice->total;
            }

            $totalArray['package']          = $totalPackageAmount;
            $totalArray['car']              = $totalCarAmount;
            $totalArray['service']          = $totalServiceAmount;
            $totalArray['medication']       = $totalMedicationAmount;
            $totalArray['investigation']    = $totalInvestigationAmount;
            $totalArray['total']            = $totalAmount;

            Excel::create('IncomeSummaryReport', function($excel)use($invoices, $totalArray) {
                $excel->sheet('SaleSummaryReport', function($sheet)use($invoices, $totalArray) {

                    $displayArray = array();                                   //array to be displayed in excel
                    $count = 0;
                    foreach($invoices as $invoice){
                        $count++;
                        $displayArray[$invoice->date]["Date"] = $invoice->date;
                        $displayArray[$invoice->date]["Package Income"] = $invoice->package_price;
                        $displayArray[$invoice->date]["Car Income"] = $invoice->total_car_amount;
                        $displayArray[$invoice->date]["Service Income"] = $invoice->total_service_amount;
                        $displayArray[$invoice->date]["Medication Income"] = $invoice->total_medication_amount;
                        $displayArray[$invoice->date]["Investigation Income"] = $invoice->total_investigation_amount;
                        $displayArray[$invoice->date]["Total"] = $invoice->total;
                    }

                    if(count($displayArray) == 0){
                        $sheet->fromArray($displayArray);
                    }
                    else{
                        $count = $count +2;
                        $sheet->cells('A1:G1', function($cells) {
                            $cells->setBackground('#1976d3');
                            $cells->setFontSize(13);
                            $cells->setFontColor('#ffffff');
                        });
                        $sheet->fromArray($displayArray);

                        $appendedRow = array();
                        $appendedRow[0] = "";

                        $index = 1; //index of appended row//index 0 is for blank
                        foreach($totalArray as $total){
                            $appendedRow[$index] = $total;
                            $index++;
                        }

                        $sheet->appendRow(
                            $appendedRow
                        );
                        $sheet->cells('A'.$count.':G'.$count, function($cells) {
                            $cells->setBackground('#1976d3');
                            $cells->setFontSize(13);
                            $cells->setFontColor('#ffffff');
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

    public function graph() {
        if (Auth::guard('User')->check()) {
            $type = null;
            $from_date = null;
            $to_date = null;

            $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);

            foreach($invoices as $invoice){
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
            }

            $chartData = array();
            $count = 0;
            foreach($invoices as $invoice){
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
                $chartData[$count]["date"] = $invoice->date;
                $chartData[$count]["amount"] = $invoice->total;
                $count++;
            }
            return view('report.incomesummaryreportbygraph')->with('chartData',$chartData);
        }
        return redirect('/');
    }

    public function graphsearch($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {

            $from_year = null;
            $to_year = null;
            $from_month = null;
            $to_month = null;
            if($type == "yearly"){
                $from_year = $from_date;
                $to_year = $to_date;
            }
            if($type == "monthly"){
                $from_month = $from_date;
                $to_month = $to_date;
            }
            $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);

            foreach($invoices as $invoice){
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
            }

            $chartData = array();
            $count = 0;
            foreach($invoices as $invoice){
                $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
                $chartData[$count]["date"] = $invoice->date;
                $chartData[$count]["amount"] = $invoice->total;
                $count++;
            }

            return view('report.incomesummaryreportbygraph')
                ->with('chartData',$chartData)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date)
                ->with('from_month',$from_month)
                ->with('to_month',$to_month)
                ->with('from_year',$from_year)
                ->with('to_year',$to_year)
                ->with('type',$type);
        }
        return redirect('/');
    }
}