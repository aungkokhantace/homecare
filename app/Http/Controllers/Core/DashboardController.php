<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Packagesale\PackageSaleRepository;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::guard('User')->check()) {
            //start visit graph data
            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();

            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }
            
            $scheduleRepo = new ScheduleRepository();

            $schedulesWithServices = $scheduleRepo->getSchedulesWithService($schedulesArray);
            
            $patient_visits_array = array();

            $year = date('Y');
            
            foreach($schedulesWithServices as $schedule_with_service){
                $date = $schedule_with_service->date;
                $month = date("m", strtotime($date)); //get only month from schedule date //to display data according to month
                
                $mo_visits              = count($scheduleRepo->getEachVisitByMonth($month,1)); // service_id=1 is for MO
                $musculo_visits         = count($scheduleRepo->getEachVisitByMonth($month,2)); // service_id=2 is for Musculo
                $neuro_visits           = count($scheduleRepo->getEachVisitByMonth($month,3)); // service_id=3 is for Neuro
                $nutrition_visits       = count($scheduleRepo->getEachVisitByMonth($month,4)); // service_id=4 is for Nutrition
                $blood_drawing_visits   = count($scheduleRepo->getEachVisitByMonth($month,5)); // service_id=5 is for Blood Drawing

                //add result to array
                $patient_visits_array[$month]["date"]                       = date("$year-$month");  //to send to graph in ('YYYY-MM') format
                $patient_visits_array[$month]["mo_visits"]                  = $mo_visits;
                $patient_visits_array[$month]["mo_visits_color"]            = "#F0D122";    //yellow
                $patient_visits_array[$month]["musculo_visits"]             = $musculo_visits;
                $patient_visits_array[$month]["musculo_visits_color"]       = "#52F23B";    //green
                $patient_visits_array[$month]["neuro_visits"]               = $neuro_visits;
                $patient_visits_array[$month]["neuro_visits_color"]         = "#F72B0B";    //red
                $patient_visits_array[$month]["nutrition_visits"]           = $nutrition_visits;
                $patient_visits_array[$month]["nutrition_visits_color"]     = "#0B53F7";    //blue
                $patient_visits_array[$month]["blood_drawing_visits"]       = $blood_drawing_visits;
                $patient_visits_array[$month]["blood_drawing_visits_color"] = "#EC0BF7";    //violet

            }
            
            $patient_visits = array_values($patient_visits_array);

            //reverse the array to sort by date in ascending order
            $ordered_patient_visits = array_reverse($patient_visits);
            //end visit graph data


            //start profit graph data
            $profit_array = array();
            //start getting service profits
            $invoiceRepo = new InvoiceRepository();
            foreach($invoicesWithSchedules as $invoice_with_schedule){
                $invoice_id = $invoice_with_schedule->id;
                
                //get service id
                $schedule_id    = $invoice_with_schedule->schedule_id;
                // $service_id     = $scheduleRepo->getServiceIdByScheduleId($schedule_id);

                //get month
                $schedule       = $scheduleRepo->getObjByID($schedule_id);                
                $schedule_date  = $schedule['result']->date;
                $month = date("m", strtotime($schedule_date)); //get only month from schedule date //to display data according to month
                
                $mo_profits             = $invoiceRepo->getEachServiceProfitByMonth($month,1);      // service_id=1 is for MO
                $musculo_profits        = $invoiceRepo->getEachServiceProfitByMonth($month,2);      // service_id=2 is for Musculo
                $neuro_profits          = $invoiceRepo->getEachServiceProfitByMonth($month,3);      // service_id=3 is for Neuro
                $nutrition_profits      = $invoiceRepo->getEachServiceProfitByMonth($month,4);      // service_id=4 is for Nutrition
                $blood_drawing_profits  = $invoiceRepo->getEachServiceProfitByMonth($month,5);      // service_id=5 is for Blood Drawing

                //add result to array
                $profit_array[$month]["date"]                        = date("$year-$month");    //to send to graph in ('YYYY-MM') format
                //start adding mo_profits data to array
                if($mo_profits != null){
                    $profit_array[$month]["mo_profits"]              = $mo_profits;
                }
                else{
                    $profit_array[$month]["mo_profits"]              = 0.0;
                }               
                $profit_array[$month]["mo_profits_color"]            = "#F0D122";               //yellow
                //end adding mo_profits data to array

                //start adding musculo_profits data to array
                if($musculo_profits != null){
                    $profit_array[$month]["musculo_profits"]         = $musculo_profits;
                }
                else{
                    $profit_array[$month]["musculo_profits"]         = 0.0;
                }
                $profit_array[$month]["musculo_profits_color"]       = "#52F23B";               //green
                //end adding musculo_profits data to array

                //start adding neuro_profits data to array
                if($neuro_profits != null){
                    $profit_array[$month]["neuro_profits"]           = $neuro_profits;
                }
                else{
                    $profit_array[$month]["neuro_profits"]           = 0.0;
                }
                $profit_array[$month]["neuro_profits_color"]         = "#F72B0B";               //red
                //end adding neuro_profits data to array

                //start adding nutrition_profits data to array
                if($nutrition_profits != null){
                    $profit_array[$month]["nutrition_profits"]       = $nutrition_profits;
                }
                else{
                    $profit_array[$month]["nutrition_profits"]       = 0.0;
                }
                $profit_array[$month]["nutrition_profits_color"]     = "#0B53F7";               //blue
                //end adding nutrition_profits data to array

                //start adding blood_drawing_profits data to array
                if($blood_drawing_profits != null){
                    $profit_array[$month]["blood_drawing_profits"]   = $blood_drawing_profits;
                }
                else{
                    $profit_array[$month]["blood_drawing_profits"]   = 0.0;
                }
                $profit_array[$month]["blood_drawing_profits_color"] = "#EC0BF7";               //violet
                //end adding blood_drawing_profits data to array
            }
            //start getting service profits

            //start getting package sale profits
            $packageSaleRepo    = new PackageSaleRepository();
            $packageSales       = $packageSaleRepo->getObjs();
            
            foreach($packageSales as $packageSale){
                $sold_date = $packageSale->sold_date;
                $month = date("m", strtotime($sold_date)); //get only month from sold date //to display data according to month
                
                $package_sale_profits = $invoiceRepo->getPackageSaleProfitByMonth($month);                

                if(array_key_exists($month,$profit_array)){
                    $profit_array[$month]["package_sale_profits"]       = $package_sale_profits;
                    $profit_array[$month]["package_sale_profits_color"] = "#2E2E2E";               //black
                }
                else{
                    $profit_array[$month]["date"]                       = date("$year-$month");    //to send to graph in ('YYYY-MM') format
                    $profit_array[$month]["mo_profits"]                 = 0.0;
                    $profit_array[$month]["mo_profits_color"]           = "#F0D122";               //yellow
                    $profit_array[$month]["musculo_profits"]            = 0.0;
                    $profit_array[$month]["musculo_profits_color"]      = "#52F23B";               //green
                    $profit_array[$month]["neuro_profits"]              = 0.0;
                    $profit_array[$month]["neuro_profits_color"]        = "#F72B0B";               //red
                    $profit_array[$month]["nutrition_profits"]          = 0.0;
                    $profit_array[$month]["nutrition_profits_color"]    = "#0B53F7";               //blue
                    $profit_array[$month]["blood_drawing_profits"]      = 0.0;
                    $profit_array[$month]["blood_drawing_profits_color"]= "#EC0BF7";               //violet
                    $profit_array[$month]["package_sale_profits"]       = $package_sale_profits;
                    $profit_array[$month]["package_sale_profits_color"] = "#2E2E2E";               //black
                }
            }
            //end getting package sale profits
            
            
            foreach($profit_array as $key=>$each_profit){
                if(!array_key_exists('package_sale_profits',$each_profit)){
                    $profit_array[$key]['package_sale_profits'] = 0.0;
                }
                if(!array_key_exists('package_sale_profits_color',$each_profit)){
                    $profit_array[$key]['package_sale_profits_color'] = "#2E2E2E";
                }
            }

            ksort($profit_array);
            $profits = array_values($profit_array);          
            //end profit graph data

            return view('core.dashboard.dashboard')
                ->with('patient_visits',$ordered_patient_visits)
                ->with('profits',$profits);
        }
        return redirect('/login');
    }
}
