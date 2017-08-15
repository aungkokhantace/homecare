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
            $profits = array();

            $from_date = null;
            $to_date = null;

            $invoiceHeader = $scheduleRepo->getInvoiceHeader($from_date, $to_date);
            $invoiceDetail = $scheduleRepo->getInvoiceDetail();
            dd('invoiceHeader',$invoiceHeader);
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

            foreach($saleSummary as $summary){
                $summary->date = Carbon::parse($summary->date)->format('d-m-Y'); //changing date format to show in view
            }

            // dd('salesummmary',$saleSummary);
            //end profit graph data

            return view('core.dashboard.dashboard')
                ->with('patient_visits',$ordered_patient_visits)
                ->with('profits',$profits);
        }
        return redirect('/login');
    }
}
