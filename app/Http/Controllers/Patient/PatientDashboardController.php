<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/3/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Patient;

use App\Backend\Patient\PatientRepositoryInterface;
use App\Backend\Schedule\ScheduleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    private $repo;

    public function __construct(PatientRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function dashboard()
    {
        if (Auth::guard('User')->check()) {
            $id = Auth::guard('User')->user()->id;
            $result = $this->repo->getObjByID($id);
            $patient = $result['result'];
            $patientDob = Carbon::parse($patient->dob)->format('d-m-Y');

            $scheduleRepo = new ScheduleRepository();

            $scheduleCount = $scheduleRepo->getScheduleHistory($id)->count();

            $serviceCount = $scheduleRepo->getServiceHistory($id)->count();

            $packageCount = $scheduleRepo->getPackageHistory($id)->count();

            return view('patient.dashboard.dashboard')->with('patient',$patient)->with('patientDob',$patientDob)->with('serviceCount',$serviceCount)->with('packageCount',$packageCount)->with('scheduleCount',$scheduleCount);
        }
        return redirect('/');
    }
}
