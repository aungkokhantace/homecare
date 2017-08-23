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
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount + $invoice->total_consultant_amount + $invoice->package_price + $invoice->total_other_service_amount + $invoice->total_tax_amount;
            }

            $serviceCountArray = array();

            $scheduleRepo = new ScheduleRepository();
            $serviceRepo  = new ServiceRepository();

            foreach($invoices as $invoice_service){
                $temp_date = $invoice_service->date;
                $date = date('Y-m-d',strtotime($temp_date));
                $schedules = $scheduleRepo->getSchedulesGroupedByDate($type,$date);
                
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
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount + $invoice->total_consultant_amount + $invoice->package_price + $invoice->total_other_service_amount + $invoice->total_tax_amount;
            }
            
            $serviceCountArray = array();

            $scheduleRepo = new ScheduleRepository();
            $serviceRepo  = new ServiceRepository();
            
            foreach($invoices as $invoice_service){
                $date = $invoice_service->date;               
                $schedules = $scheduleRepo->getSchedulesGroupedByDate($type,$date);
                
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
                $invoice->total = $invoice->total_car_amount + $invoice->total_service_amount + $invoice->total_medication_amount + $invoice->total_investigation_amount + $invoice->total_consultant_amount + $invoice->package_price + $invoice->total_other_service_amount + $invoice->total_tax_amount;
            }
            
            $serviceCountArray = array();

            $scheduleRepo = new ScheduleRepository();
            $serviceRepo  = new ServiceRepository();
            
            foreach($invoices as $invoice_service){
                $date = $invoice_service->date;               
                $schedules = $scheduleRepo->getSchedulesGroupedByDate($type,$date);
                
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

            
            // $totalArray['service']          = $totalServiceAmount;
            $totalArray['mo']               = number_format($totalMOAmount,2);
            $totalArray['musculo']          = number_format($totalMusculoAmount,2);
            $totalArray['neuro']            = number_format($totalNeuroAmount,2);
            $totalArray['nutrition']        = number_format($totalNutritionAmount,2);
            $totalArray['blood drawing']    = number_format($totalBloodDrawingAmount,2);
            $totalArray['medication']       = number_format($totalMedicationAmount,2);
            $totalArray['investigation']    = number_format($totalInvestigationAmount,2);
            $totalArray['car']              = number_format($totalCarAmount,2);
            $totalArray['package']          = number_format($totalPackageAmount,2);
            $totalArray['consultant']       = number_format($totalConsultantAmount,2);
            $totalArray['other']            = number_format($totalOtherServiceAmount,2);
            $totalArray['tax']              = number_format($totalTaxAmount,2);
            $totalArray['total']            = number_format($totalAmount,2);
            
            Excel::create('SaleIncomeReport', function($excel)use($invoices, $totalArray) {
                $excel->sheet('SaleSummaryReport', function($sheet)use($invoices, $totalArray) {
                    
                    $displayArray = array();                                   //array to be displayed in excel
                    $count = 0;
                    foreach($invoices as $invoice){
                        $count++;
                        // dd('inv',$invoice);
                        $displayArray[$invoice->date]["Date"] = $invoice->date;
                        // $displayArray[$invoice->date]["Service Income"] = $invoice->total_service_amount;
                        $displayArray[$invoice->date]["MO"] = number_format($invoice->serviceCountArray['MO'],2);
                        $displayArray[$invoice->date]["Musculo"] = number_format($invoice->serviceCountArray['Musculo'],2);
                        $displayArray[$invoice->date]["Neuro"] = number_format($invoice->serviceCountArray['Neuro'],2);
                        $displayArray[$invoice->date]["Nutrition"] = number_format($invoice->serviceCountArray['Nutrition'],2);
                        $displayArray[$invoice->date]["Blood Drawing"] = number_format($invoice->serviceCountArray['Blood Drawing'],2);
                        $displayArray[$invoice->date]["Medication Income"] = number_format($invoice->total_medication_amount,2);
                        $displayArray[$invoice->date]["Investigation Income"] = number_format($invoice->total_investigation_amount,2);
                        $displayArray[$invoice->date]["Car Income"] = number_format($invoice->total_car_amount,2);
                        $displayArray[$invoice->date]["Package Income"] = number_format($invoice->package_price,2);
                        $displayArray[$invoice->date]["Consultant Income"] = number_format($invoice->total_consultant_amount,2);
                        $displayArray[$invoice->date]["Other Service Income"] = number_format($invoice->total_other_service_amount,2);
                        $displayArray[$invoice->date]["Tax Income"] = number_format($invoice->total_tax_amount,2);
                        $displayArray[$invoice->date]["Total"] = number_format($invoice->total,2);
                    }
                    // dd('display',$displayArray,$invoices);
                    if(count($displayArray) == 0){
                        $sheet->fromArray($displayArray);
                    }
                    else{
                        $count = $count +2;
                        $sheet->cells('A1:N1', function($cells) {
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
                        // dd('append',$appendedRow);
                        $sheet->appendRow(
                            $appendedRow
                        );
                        $sheet->cells('A'.$count.':N'.$count, function($cells) {
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

    public function invoiceList($date){
        $invoiceList = $this->repo->getInvoiceListByDate($date);
        $invoiceArray = array();
        foreach($invoiceList as $invoice){
            // dd('invoice',$invoice);
            $invoiceArray[$invoice->invoice_id]['invoice_id']   = $invoice->invoice_id; 
            $invoiceArray[$invoice->invoice_id]['date']         = $invoice->date; 
            $invoiceArray[$invoice->invoice_id]['patient_name'] = $invoice->patient_name; 
            if(array_key_exists('services',$invoiceArray[$invoice->invoice_id])){
                $invoiceArray[$invoice->invoice_id]['services']     .= ','.$invoice->service; 
            }
            else{
                $invoiceArray[$invoice->invoice_id]['services']     = $invoice->service; 
            }   
            $invoiceArray[$invoice->invoice_id]['doctor']       = $invoice->doctor; 
            $invoiceArray[$invoice->invoice_id]['total']        = $invoice->total; 
        }
        // dd('invoiceArray',$invoiceArray);
        // foreach($invoiceArray as $temp){
            // dd($temp['date']);
        // }
        return view('report.saleincomereportinvoicelist')
            ->with('invoiceArray',$invoiceArray);
    }
}