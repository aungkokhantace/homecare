<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: September/5/2016
 * Time: 10:33 AM
 */

namespace App\Http\Controllers\Report;

use App\Backend\Cartype\CartypeRepository;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleStatusReportController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index() {
        if (Auth::guard('User')->check()) {
            $scheduleRepo = new ScheduleRepository();
            $schedules = $scheduleRepo->getScheduleStatus();
            return view('report.schedulestatusreport')->with('schedules',$schedules);
        }
        return redirect('/');
    }

    public function search($from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            $scheduleRepo = new ScheduleRepository();
            $schedules = $scheduleRepo->getScheduleStatusByDate($from_date, $to_date);
            return view('report.schedulestatusreport')
                ->with('schedules',$schedules)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date);
        }
        return redirect('/');
    }
}
