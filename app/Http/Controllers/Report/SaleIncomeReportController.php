<?php
/**
 * Author: Aung Ko Khant
 * Date: 2017-08-16
 * Time: 02:33 PM
 */

namespace App\Http\Controllers\Report;

use App\Backend\Cartype\CartypeRepository;
use App\Backend\Cartypesetup\CartypesetupRepository;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Invoice\InvoiceRepositoryInterface;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Backend\Service\Service;
use App\Backend\Service\ServiceRepository;
use App\Backend\Service\ServiceRepositoryInterface;
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

class SaleIncomeReportController extends Controller
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
            
            // $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);
            $invoices = $this->repo->getIncomeSummaryByType($type, $from_date, $to_date);
            
            foreach($invoices as $invoice){
                // $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->total_consultant_amount+$invoice->package_price;
            }

            $serviceCountArray = array();

            $scheduleRepo = new ScheduleRepository();
            $serviceRepo  = new ServiceRepository();

            foreach($invoices as $invoice_service){
                $temp_date = $invoice_service->date;
                $date = date('Y-m-d',strtotime($temp_date));
                $schedules = $scheduleRepo->getSchedulesGroupedByDate($date);

                 //reset service counters
                $mo_count = 0;              //service_id = 1
                $musculo_count = 0;         //service_id = 2
                $neuro_count = 0;           //service_id = 3
                $nutrition_count = 0;       //service_id = 4
                $blood_drawing_count = 0;   //service_id = 5

                foreach($schedules as $schedule){
                    $service_id = $schedule->service_id;
                    if($service_id == 1){
                        //MO service
                        $mo_count++;
                    }
                    else if($service_id == 2){
                        //Musculo service
                        $musculo_count++;
                    }
                    else if($service_id == 3){
                        //Neuro service
                        $neuro_count++;
                    }
                    else if($service_id == 4){
                        //Nutrition service
                        $nutrition_count++;
                    }
                    else if($service_id == 5){
                        //Blood drawing service
                        $blood_drawing_count++;
                    }
                }

                $mo_price = $serviceRepo->getServicePriceById(1);               //service_id = 1 is for MO
                $musculo_price = $serviceRepo->getServicePriceById(2);          //service_id = 1 is for Musculo
                $neuro_price = $serviceRepo->getServicePriceById(3);            //service_id = 1 is for Neuro
                $nutrition_price = $serviceRepo->getServicePriceById(4);        //service_id = 1 is for Nutrition
                $blood_drawing_price = $serviceRepo->getServicePriceById(5);    //service_id = 1 is for Blood Drawing
               
                $serviceCountArray['MO'] = $mo_price * $mo_count;
                $serviceCountArray['Musculo'] = $musculo_price * $musculo_count;
                $serviceCountArray['Neuro'] = $neuro_price * $neuro_count;
                $serviceCountArray['Nutrition'] = $nutrition_price * $nutrition_count;
                $serviceCountArray['Blood Drawing'] = $blood_drawing_price * $blood_drawing_count;
                
                $invoice_service->serviceCountArray = $serviceCountArray;
            }
            
            $totalArray = array();

            $totalCarAmount             = 0;
            // $totalServiceAmount         = 0;
            $totalMOAmount              = 0;
            $totalMusculoAmount         = 0;
            $totalNeuroAmount           = 0;
            $totalNutritionAmount       = 0;
            $totalBloodDrawingAmount    = 0;
            $totalMedicationAmount      = 0;
            $totalInvestigationAmount   = 0;
            $totalConsultantAmount      = 0;
            $totalPackageAmount         = 0;
            $totalOtherServiceAmount    = 0;
            $totalTaxAmount             = 0;
            $totalAmount                = 0;
            
            foreach($invoices as $invoice){
                $totalCarAmount             += $invoice->total_car_amount;
                // $totalServiceAmount         += $invoice->total_service_amount;
                $totalMOAmount              += $invoice->serviceCountArray['MO'];
                $totalMusculoAmount         += $invoice->serviceCountArray['Musculo'];
                $totalNeuroAmount           += $invoice->serviceCountArray['Neuro'];
                $totalNutritionAmount       += $invoice->serviceCountArray['Nutrition'];
                $totalBloodDrawingAmount    += $invoice->serviceCountArray['Blood Drawing'];
                $totalMedicationAmount      += $invoice->total_medication_amount;
                $totalInvestigationAmount   += $invoice->total_investigation_amount;
                $totalConsultantAmount      += $invoice->total_consultant_amount;
                $totalPackageAmount         += $invoice->package_price;
                $totalOtherServiceAmount    += $invoice->total_other_service_amount;
                $totalTaxAmount             += $invoice->total_tax_amount;
                $totalAmount                += $invoice->total;
            }

            $totalArray['car']              = $totalCarAmount;
            // $totalArray['service']          = $totalServiceAmount;
            $totalArray['mo']               = $totalMOAmount;
            $totalArray['musculo']          = $totalMusculoAmount;
            $totalArray['neuro']            = $totalNeuroAmount;
            $totalArray['nutrition']        = $totalNutritionAmount;
            $totalArray['blood drawing']    = $totalBloodDrawingAmount;
            $totalArray['medication']       = $totalMedicationAmount;
            $totalArray['investigation']    = $totalInvestigationAmount;
            $totalArray['consultant']       = $totalConsultantAmount;
            $totalArray['package']          = $totalPackageAmount;
            $totalArray['other']            = $totalOtherServiceAmount;
            $totalArray['tax']              = $totalTaxAmount;
            $totalArray['total']            = $totalAmount;

            // // Start getting income summary of each service
            // $invoicesWithSchedules = $this->repo->getInvoicesWithSchedules();
            
            // $schedulesArray = array();
            // foreach($invoicesWithSchedules as $invoice){
            //     $schedulesArray[] = $invoice->schedule_id;
            // }

            // $eachServiceIncome    = $this->repo->getEachServiceIncome($from_date, $to_date, $schedulesArray);
            // dd('eachServiceIncome');
            // End getting income summary of each service
            // dd('invoices',$invoices);
            return view('report.saleincomereport')
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
            
            // $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);
            $invoices = $this->repo->getIncomeSummaryByType($type, $from_date, $to_date);
            
            foreach($invoices as $invoice){
                // $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->total_consultant_amount+$invoice->package_price;
            }

            $totalArray = array();

            $totalCarAmount             = 0;
            $totalServiceAmount         = 0;
            $totalMedicationAmount      = 0;
            $totalInvestigationAmount   = 0;
            $totalConsultantAmount      = 0;
            $totalPackageAmount         = 0;
            $totalOtherServiceAmount    = 0;
            $totalTaxAmount             = 0;
            $totalAmount                = 0;
            
            foreach($invoices as $invoice){
                $totalCarAmount             += $invoice->total_car_amount;
                $totalServiceAmount         += $invoice->total_service_amount;
                $totalMedicationAmount      += $invoice->total_medication_amount;
                $totalInvestigationAmount   += $invoice->total_investigation_amount;
                $totalConsultantAmount      += $invoice->total_consultant_amount;
                $totalPackageAmount         += $invoice->package_price;
                $totalOtherServiceAmount    += $invoice->total_other_service_amount;
                $totalTaxAmount             += $invoice->total_tax_amount;
                $totalAmount                += $invoice->total;
            }

            $totalArray['car']              = $totalCarAmount;
            $totalArray['service']          = $totalServiceAmount;
            $totalArray['medication']       = $totalMedicationAmount;
            $totalArray['investigation']    = $totalInvestigationAmount;
            $totalArray['consultant']       = $totalConsultantAmount;
            $totalArray['package']          = $totalPackageAmount;
            $totalArray['other']            = $totalOtherServiceAmount;
            $totalArray['tax']              = $totalTaxAmount;
            $totalArray['total']            = $totalAmount;
            
            return view('report.saleincomereport')
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

            // $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);
            $invoices = $this->repo->getIncomeSummaryByType($type, $from_date, $to_date);

            foreach($invoices as $invoice){
                // $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
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

            Excel::create('SaleIncomeReport', function($excel)use($invoices, $totalArray) {
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
            
            // $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);
            $invoices = $this->repo->getIncomeSummaryByType($type, $from_date, $to_date);
            
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
            return view('report.saleincomereportbygraph')->with('chartData',$chartData);
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
            // $invoices = $this->repo->getIncomeSummary($type, $from_date, $to_date);
            $invoices = $this->repo->getIncomeSummaryByType($type, $from_date, $to_date);

            foreach($invoices as $invoice){
                // $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
            }

            $chartData = array();
            $count = 0;
            foreach($invoices as $invoice){
                // $invoice->date = Carbon::parse($invoice->date)->format('d-m-Y');
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount+$invoice->package_price;
                $chartData[$count]["date"] = $invoice->date;
                $chartData[$count]["amount"] = $invoice->total;
                $count++;
            }

            return view('report.saleincomereportbygraph')
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