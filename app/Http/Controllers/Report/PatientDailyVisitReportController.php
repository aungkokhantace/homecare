<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 2017-06-15
 * Time: 4:11 PM
 */

namespace App\Http\Controllers\Report;

use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepository;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Core\Role\RoleRepository;
use App\Core\User\UserRepository;
use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PatientDailyVisitReportController extends Controller
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

            $patientRepo = new PatientRepository();
            $patients_array = array();
            $temp_patient_array = array();

            foreach($schedulesWithServices as $schedule_with_service){
                $date       = $schedule_with_service->date;
                $patient_id = $schedule_with_service->patient_id;
                $patientRaw = $patientRepo->getObjByID($patient_id);
                $patient    = $patientRaw["result"];
                $ageRaw     = Utility::calculateAge($patient->dob);
                $age        = $ageRaw["value"]." ".$ageRaw["unit"];

                //temp array for each patient
                $temp_patient_array["date"] = $date;
                $temp_patient_array["name"] = $patient->name;
                $temp_patient_array["age"]  = $age;

                //push to patient array
                array_push($patients_array,$temp_patient_array);
            }

            return view('report.patientdailyvisitreport')
                ->with('type',$type)
                ->with('patients_array',$patients_array)
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

            $patientRepo = new PatientRepository();
            $patients_array = array();
            $temp_patient_array = array();

            foreach($schedulesWithServices as $schedule_with_service){
                $date       = $schedule_with_service->date;
                $patient_id = $schedule_with_service->patient_id;
                $patientRaw = $patientRepo->getObjByID($patient_id);
                $patient    = $patientRaw["result"];
                $ageRaw     = Utility::calculateAge($patient->dob);
                $age        = $ageRaw["value"]." ".$ageRaw["unit"];

                //temp array for each patient
                $temp_patient_array["date"] = $date;
                $temp_patient_array["name"] = $patient->name;
                $temp_patient_array["age"]  = $age;

                //push to patient array
                array_push($patients_array,$temp_patient_array);
            }

            return view('report.patientdailyvisitreport')
                ->with('type',$type)
                ->with('patients_array',$patients_array)
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

            $patientRepo = new PatientRepository();
            $patients_array = array();
            $temp_patient_array = array();

            foreach($schedulesWithServices as $schedule_with_service){
                $date       = $schedule_with_service->date;
                $patient_id = $schedule_with_service->patient_id;
                $patientRaw = $patientRepo->getObjByID($patient_id);
                $patient    = $patientRaw["result"];
                $ageRaw     = Utility::calculateAge($patient->dob);
                $age        = $ageRaw["value"]." ".$ageRaw["unit"];

                //temp array for each patient
                $temp_patient_array["date"] = $date;
                $temp_patient_array["name"] = $patient->name;
                $temp_patient_array["age"]  = $age;

                //push to patient array
                array_push($patients_array,$temp_patient_array);
            }

            Excel::create('PatientDailyVisitReport', function($excel)use($patients_array) {
                $excel->sheet('PatientDailyVisitReport', function($sheet)use($patients_array) {
                    $displayArray = array();
                    $tempArray = array();
                    foreach($patients_array as $patient){
                        $tempArray["Date"] = $patient["date"];
                        $tempArray["Name"] = $patient["name"];
                        $tempArray["Age"]  = $patient["age"];

                        array_push($displayArray,$tempArray);
                    }

                    if(count($displayArray) == 0){
                        $sheet->fromArray($displayArray);
                    }
                    else{
                        $sheet->cells('A1:C1', function($cells) {
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
