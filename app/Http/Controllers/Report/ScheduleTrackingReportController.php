<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: September/6/2016
 * Time: 3:00 PM
 */

namespace App\Http\Controllers\Report;

use App\Backend\Cartype\CartypeRepository;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Core\Role\RoleRepository;
use App\Core\User\UserRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Maatwebsite\Excel\Facades\Excel;
use App\Backend\Scheduletracking\ScheduletrackingRepositoryInterface;

class ScheduleTrackingReportController extends Controller
{
    private $repo;

    public function __construct(ScheduleTrackingRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index() {
        if (Auth::guard('User')->check()) {
            $type = 'all';
            $from_date = null;
            $to_date = null;

            $scheduleTrackings = $this->repo->getscheduleTrackings($type,$from_date,$to_date);

            $schedule_tracking_array = array();
            foreach($scheduleTrackings as $scheduleTracking){
              $schedule_id = $scheduleTracking->schedule_id;
              $scheduleRepo = new ScheduleRepository();
              $temp_schedule = $scheduleRepo->getObjByID($schedule_id);
              $schedule = $temp_schedule['result'];

              $date     = $schedule->date;
              $time     = $schedule->time;
              $patient_name = $schedule->patient->name;
              $doctor_name = $schedule->leader->name;
              $township = $schedule->township->name;

              //get times
              $preparation_start_time   = $scheduleTracking->preparation_start_time;
              $preparation_end_time     = $scheduleTracking->preparation_end_time;
              $arrived_to_patient_time  = $scheduleTracking->arrived_to_patient_time;
              $leave_from_patient_time  = $scheduleTracking->leave_from_patient_time;

              //calculate preparation duration
              $temp_preparation_duration     = strtotime($preparation_end_time) - strtotime($preparation_start_time);
              $preparation_duration = gmdate("H:i:s", $temp_preparation_duration);

              //calculate transportation duration
              $temp_transportation_duration     = strtotime($arrived_to_patient_time) - strtotime($preparation_end_time);
              $transportation_duration = gmdate("H:i:s", $temp_transportation_duration);

              //calculate treatment duration
              $temp_treatment_duration       = strtotime($leave_from_patient_time) - strtotime($arrived_to_patient_time);
              $treatment_duration = gmdate("H:i:s", $temp_treatment_duration);
              // dd($scheduleTracking);
              $schedule_tracking_array[$schedule_id]["schedule_tracking_id"] = $scheduleTracking->id;
              $schedule_tracking_array[$schedule_id]["date"]            = $date;
              // $schedule_tracking_array[$schedule_id]["time"]            = $time;
              $schedule_tracking_array[$schedule_id]["patient_name"]    = $patient_name;
              $schedule_tracking_array[$schedule_id]["doctor_name"]     = $doctor_name;
              $schedule_tracking_array[$schedule_id]["township"]        = $township;
              // $schedule_tracking_array[$schedule_id]["preparation_start_time"]  = $preparation_start_time;
              $schedule_tracking_array[$schedule_id]["preparation_duration"]    = $preparation_duration;
              $schedule_tracking_array[$schedule_id]["transportation_duration"] = $transportation_duration;
              $schedule_tracking_array[$schedule_id]["treatment_duration"]      = $treatment_duration;
            }

            return view('report.scheduletrackingreport')
                ->with('schedule_tracking_array',$schedule_tracking_array)
                ->with('type',$type)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date);
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

          $scheduleTrackings = $this->repo->getscheduleTrackings($type,$from_date,$to_date);
          $schedule_tracking_array = array();
          foreach($scheduleTrackings as $scheduleTracking){
            $schedule_id = $scheduleTracking->schedule_id;
            $scheduleRepo = new ScheduleRepository();
            $temp_schedule = $scheduleRepo->getObjByID($schedule_id);
            $schedule = $temp_schedule['result'];

            $date     = $schedule->date;
            $time     = $schedule->time;
            $patient_name = $schedule->patient->name;
            $doctor_name = $schedule->leader->name;
            $township = $schedule->township->name;

            //get times
            $preparation_start_time   = $scheduleTracking->preparation_start_time;
            $preparation_end_time     = $scheduleTracking->preparation_end_time;
            $arrived_to_patient_time  = $scheduleTracking->arrived_to_patient_time;
            $leave_from_patient_time  = $scheduleTracking->leave_from_patient_time;

            //calculate preparation duration
            $temp_preparation_duration     = strtotime($preparation_end_time) - strtotime($preparation_start_time);
            $preparation_duration = gmdate("H:i:s", $temp_preparation_duration);

            //calculate transportation duration
            $temp_transportation_duration     = strtotime($arrived_to_patient_time) - strtotime($preparation_end_time);
            $transportation_duration = gmdate("H:i:s", $temp_transportation_duration);

            //calculate treatment duration
            $temp_treatment_duration       = strtotime($leave_from_patient_time) - strtotime($arrived_to_patient_time);
            $treatment_duration = gmdate("H:i:s", $temp_treatment_duration);

            $schedule_tracking_array[$schedule_id]["schedule_tracking_id"] = $scheduleTracking->id;
            $schedule_tracking_array[$schedule_id]["date"]            = $date;
            // $schedule_tracking_array[$schedule_id]["time"]            = $time;
            $schedule_tracking_array[$schedule_id]["patient_name"]    = $patient_name;
            $schedule_tracking_array[$schedule_id]["doctor_name"]     = $doctor_name;
            $schedule_tracking_array[$schedule_id]["township"]        = $township;
            // $schedule_tracking_array[$schedule_id]["preparation_start_time"]  = $preparation_start_time;
            $schedule_tracking_array[$schedule_id]["preparation_duration"]    = $preparation_duration;
            $schedule_tracking_array[$schedule_id]["transportation_duration"] = $transportation_duration;
            $schedule_tracking_array[$schedule_id]["treatment_duration"]      = $treatment_duration;
          }

          return view('report.scheduletrackingreport')
              ->with('schedule_tracking_array',$schedule_tracking_array)
              ->with('type',$type)
              ->with('from_date',$from_date)
              ->with('to_date',$to_date);
        }
        return redirect('/');
    }

    public function excel($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            ob_end_clean();
            ob_start();

            $scheduleTrackings = $this->repo->getscheduleTrackings($type,$from_date,$to_date);
            $schedule_tracking_array = array();
            foreach($scheduleTrackings as $scheduleTracking){
              $schedule_id = $scheduleTracking->schedule_id;
              $scheduleRepo = new ScheduleRepository();
              $temp_schedule = $scheduleRepo->getObjByID($schedule_id);
              $schedule = $temp_schedule['result'];

              $date     = $schedule->date;
              $time     = $schedule->time;
              $patient_name = $schedule->patient->name;
              $doctor_name = $schedule->leader->name;
              $township = $schedule->township->name;

              //get times
              $preparation_start_time   = $scheduleTracking->preparation_start_time;
              $preparation_end_time     = $scheduleTracking->preparation_end_time;
              $arrived_to_patient_time  = $scheduleTracking->arrived_to_patient_time;
              $leave_from_patient_time  = $scheduleTracking->leave_from_patient_time;

              //calculate preparation duration
              $temp_preparation_duration     = strtotime($preparation_end_time) - strtotime($preparation_start_time);
              $preparation_duration = gmdate("H:i:s", $temp_preparation_duration);

              //calculate transportation duration
              $temp_transportation_duration     = strtotime($arrived_to_patient_time) - strtotime($preparation_end_time);
              $transportation_duration = gmdate("H:i:s", $temp_transportation_duration);

              //calculate treatment duration
              $temp_treatment_duration       = strtotime($leave_from_patient_time) - strtotime($arrived_to_patient_time);
              $treatment_duration = gmdate("H:i:s", $temp_treatment_duration);

              $schedule_tracking_array[$schedule_id]["date"]            = $date;
              // $schedule_tracking_array[$schedule_id]["time"]            = $time;
              $schedule_tracking_array[$schedule_id]["patient_name"]    = $patient_name;
              $schedule_tracking_array[$schedule_id]["doctor_name"]     = $doctor_name;
              $schedule_tracking_array[$schedule_id]["township"]        = $township;
              // $schedule_tracking_array[$schedule_id]["preparation_start_time"]  = $preparation_start_time;
              $schedule_tracking_array[$schedule_id]["preparation_duration"]    = $preparation_duration;
              $schedule_tracking_array[$schedule_id]["transportation_duration"] = $transportation_duration;
              $schedule_tracking_array[$schedule_id]["treatment_duration"]      = $treatment_duration;
            }

            Excel::create('ScheduleTrackingReport', function($excel)use($schedule_tracking_array) {
                $excel->sheet('ScheduleTrackingReport', function($sheet)use($schedule_tracking_array) {
                    $displayArray = array();
                    foreach($schedule_tracking_array as $key=>$schedule_tracking){
                        $displayArray[$key]["Date"] = $schedule_tracking['date'];
                        $displayArray[$key]["Patient Name"] = $schedule_tracking['patient_name'];
                        $displayArray[$key]["Doctor Name"] = $schedule_tracking['doctor_name'];
                        $displayArray[$key]["Township"] = $schedule_tracking['township'];
                        $displayArray[$key]["Preparation Duration"] = $schedule_tracking['preparation_duration'];
                        $displayArray[$key]["Transportation Duration"] = $schedule_tracking['transportation_duration'];
                        $displayArray[$key]["Treatment Duration"] = $schedule_tracking['treatment_duration'];
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

    public function scheduleDetail($schedule_tracking_id){
        $scheduleTracking = $this->repo->getObjByID($schedule_tracking_id);

        $schedule_id = $scheduleTracking->schedule_id;
        $scheduleRepo = new ScheduleRepository();
        $temp_schedule = $scheduleRepo->getObjByID($schedule_id);
        $schedule = $temp_schedule['result'];

        $date     = $schedule->date;
        $time     = $schedule->time;
        $patient_name = $schedule->patient->name;
        $doctor_name = $schedule->leader->name;
        $township = $schedule->township->name;
        $zone = $schedule->zone->name;

        //get times
        $preparation_start_time   = $scheduleTracking->preparation_start_time;
        $preparation_end_time     = $scheduleTracking->preparation_end_time;
        $arrived_to_patient_time  = $scheduleTracking->arrived_to_patient_time;
        $leave_from_patient_time  = $scheduleTracking->leave_from_patient_time;

        //calculate preparation duration
        $temp_preparation_duration     = strtotime($preparation_end_time) - strtotime($preparation_start_time);
        $preparation_duration = gmdate("H:i:s", $temp_preparation_duration);

        //calculate transportation duration
        $temp_transportation_duration     = strtotime($arrived_to_patient_time) - strtotime($preparation_end_time);
        $transportation_duration = gmdate("H:i:s", $temp_transportation_duration);

        //calculate treatment duration
        $temp_treatment_duration       = strtotime($leave_from_patient_time) - strtotime($arrived_to_patient_time);
        $treatment_duration = gmdate("H:i:s", $temp_treatment_duration);
        // dd($scheduleTracking);
        $schedule_tracking = array();
        $scheduleTracking->date            = $date;
        // $schedule_tracking_array["time"]            = $time;
        $scheduleTracking->patient_name    = $patient_name;
        $scheduleTracking->doctor_name     = $doctor_name;
        $scheduleTracking->township        = $township;
        $scheduleTracking->zone            = $zone;
        // $scheduleTracking->preparation_start_time  = $preparation_start_time;
        $scheduleTracking->preparation_duration    = $preparation_duration;
        // $scheduleTracking->preparation_end_time  = $preparation_end_time;
        $scheduleTracking->transportation_duration = $transportation_duration;
        // $scheduleTracking->arrived_to_patient_time  = $arrived_to_patient_time;
        $scheduleTracking->treatment_duration      = $treatment_duration;
        // $scheduleTracking->leave_from_patient_time  = $leave_from_patient_time;
        // dd('result',$scheduleTracking);
        return view('report.scheduletrackingreport_detail')
            ->with('scheduleTracking',$scheduleTracking);
    }
}
