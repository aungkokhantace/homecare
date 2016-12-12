<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/3/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Patient;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Backend\Service\ServiceRepository;
use App\Core\User\UserRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ScheduleHistoryController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {

            $id = Auth::guard('User')->user()->id;
            $schedules = $this->repo->getScheduleHistory($id);

            foreach($schedules as $schedule){
                $servicesForEachSchedule = $this->repo->servicesForEachSchedule($schedule->id);
                $servicesString = "";
                foreach($servicesForEachSchedule as $service){
                    $servicesString .= $service->service->name.", ";
                }
                $servicesString = rtrim($servicesString,', ');
                $schedule["services"] = $servicesString;
            }
            return view('patient.schedulehistory.schedulehistory')->with('schedules',$schedules);
        }
        return redirect('/');
    }
}
