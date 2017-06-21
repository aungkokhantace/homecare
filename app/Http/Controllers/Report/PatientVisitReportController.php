<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 2017-06-15
 * Time: 4:11 PM
 */

namespace App\Http\Controllers\Report;

use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Patient\PatientRepository;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Core\Role\RoleRepository;
use App\Core\User\UserRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PatientVisitReportController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index() {
        if (Auth::guard('User')->check()) {

            $type = 'daily';
            $from_date = null;
            $to_date = null;

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();

            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }

            $scheduleRepo = new ScheduleRepository();

            $schedulesWithServices = $scheduleRepo->getSchedulesWithService($schedulesArray);

            $patient_visits = array();

            foreach($schedulesWithServices as $schedule_with_service){
                $date = $schedule_with_service->date;

                $total_patients       = count($scheduleRepo->getSchedulesByDate($date));
                $mo_visits            = count($scheduleRepo->getEachVisitByDate($date,1)); // service_id=1 is for MO
                $musculo_visits       = count($scheduleRepo->getEachVisitByDate($date,2)); // service_id=1 is for Musculo
                $neuro_visits         = count($scheduleRepo->getEachVisitByDate($date,3)); // service_id=1 is for Neuro
                $nutrition_visits     = count($scheduleRepo->getEachVisitByDate($date,4)); // service_id=1 is for Nutrition
                $blood_drawing_visits = count($scheduleRepo->getEachVisitByDate($date,5)); // service_id=1 is for Blood Drawing

                $patient_visits[$date]["date"]                  = $date;
                $patient_visits[$date]["total_patients"]        = $total_patients;
                $patient_visits[$date]["mo_visits"]             = $mo_visits;
                $patient_visits[$date]["musculo_visits"]        = $musculo_visits;
                $patient_visits[$date]["neuro_visits"]          = $neuro_visits;
                $patient_visits[$date]["nutrition_visits"]      = $nutrition_visits;
                $patient_visits[$date]["blood_drawing_visits"]  = $blood_drawing_visits;
            }

            return view('report.patientvisitreport')
                ->with('type',$type)
                ->with('patient_visits',$patient_visits)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date);
        }
        return redirect('/');
    }

    public function search($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            //to return to "from month, to month, from year, to year" to view
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
            } //to return to "from month, to month, from year, to year" to view


            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();

            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }

            $scheduleRepo = new ScheduleRepository();

            $schedulesWithServices = $scheduleRepo->getSchedulesWithService($schedulesArray, $type, $from_date, $to_date);

            $patient_visits = array();

            foreach($schedulesWithServices as $schedule_with_service){
                $date = $schedule_with_service->date;
                $total_patients       = count($scheduleRepo->getSchedulesByDate($date));
                $mo_visits            = count($scheduleRepo->getEachVisitByDate($date,1)); // service_id=1 is for MO
                $musculo_visits       = count($scheduleRepo->getEachVisitByDate($date,2)); // service_id=1 is for Musculo
                $neuro_visits         = count($scheduleRepo->getEachVisitByDate($date,3)); // service_id=1 is for Neuro
                $nutrition_visits     = count($scheduleRepo->getEachVisitByDate($date,4)); // service_id=1 is for Nutrition
                $blood_drawing_visits = count($scheduleRepo->getEachVisitByDate($date,5)); // service_id=1 is for Blood Drawing

                $patient_visits[$date]["date"]                  = $date;
                $patient_visits[$date]["total_patients"]        = $total_patients;
                $patient_visits[$date]["mo_visits"]             = $mo_visits;
                $patient_visits[$date]["musculo_visits"]        = $musculo_visits;
                $patient_visits[$date]["neuro_visits"]          = $neuro_visits;
                $patient_visits[$date]["nutrition_visits"]      = $nutrition_visits;
                $patient_visits[$date]["blood_drawing_visits"]  = $blood_drawing_visits;
            }

            return view('report.patientvisitreport')
                ->with('type',$type)
                ->with('patient_visits',$patient_visits)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date)
                ->with('from_month',$from_month)
                ->with('to_month',$to_month)
                ->with('from_year',$from_year)
                ->with('to_year',$to_year);
        }
        return redirect('/');
    }

    public function excel($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            ob_end_clean();
            ob_start();

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();

            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }

            $scheduleRepo = new ScheduleRepository();

            $schedulesWithServices = $scheduleRepo->getSchedulesWithService($schedulesArray, $type, $from_date, $to_date);

            $patient_visits = array();

            foreach($schedulesWithServices as $schedule_with_service){
                $date = $schedule_with_service->date;
                $total_patients       = count($scheduleRepo->getSchedulesByDate($date));
                $mo_visits            = count($scheduleRepo->getEachVisitByDate($date,1)); // service_id=1 is for MO
                $musculo_visits       = count($scheduleRepo->getEachVisitByDate($date,2)); // service_id=1 is for Musculo
                $neuro_visits         = count($scheduleRepo->getEachVisitByDate($date,3)); // service_id=1 is for Neuro
                $nutrition_visits     = count($scheduleRepo->getEachVisitByDate($date,4)); // service_id=1 is for Nutrition
                $blood_drawing_visits = count($scheduleRepo->getEachVisitByDate($date,5)); // service_id=1 is for Blood Drawing

                $patient_visits[$date]["date"]                  = $date;
                $patient_visits[$date]["total_patients"]        = $total_patients;
                $patient_visits[$date]["mo_visits"]             = $mo_visits;
                $patient_visits[$date]["musculo_visits"]        = $musculo_visits;
                $patient_visits[$date]["neuro_visits"]          = $neuro_visits;
                $patient_visits[$date]["nutrition_visits"]      = $nutrition_visits;
                $patient_visits[$date]["blood_drawing_visits"]  = $blood_drawing_visits;
            }

            Excel::create('PatientVisitReport', function($excel)use($patient_visits) {
                $excel->sheet('PatientVisitReport', function($sheet)use($patient_visits) {
                    $displayArray = array();
                    foreach($patient_visits as $visit){
//                        dd('visit',$visit);
                        $date = $visit["date"];
                        $displayArray[$date]["Date"] = $visit["date"];
                        $displayArray[$date]["Total Patient"] = $visit["total_patients"];
                        $displayArray[$date]["Doctor/MO Visit"] = $visit["mo_visits"];
                        $displayArray[$date]["Physiotherapy Musculo Visit"] = $visit["musculo_visits"];
                        $displayArray[$date]["Physiotherapy Neuro Visit"] = $visit["neuro_visits"];
                        $displayArray[$date]["Nutrition Visit"] = $visit["nutrition_visits"];
                        $displayArray[$date]["Blood Drawing Visit"] = $visit["blood_drawing_visits"];
                    }

                    if(count($displayArray) == 0){
                        $sheet->fromArray($displayArray);
                    }
                    else{
                        $sheet->cells('A1:G1', function($cells) {
                            $cells->setBackground('#1976d3');
                            $cells->setFontSize(13);
                        });

                        $sheet->fromArray($displayArray);
                    }
                });
            })
                ->download('xls');
            ob_flush();
            return Redirect();
        }
        return redirect('/');
    }
}
