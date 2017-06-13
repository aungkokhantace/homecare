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

class VisitReportController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index() {
        if (Auth::guard('User')->check()) {
            $type = 'all';
            $from_date = null;
            $to_date = null;

            $roleRepo = new RoleRepository();
            $roles = $roleRepo->getObjsForVisitReport();

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();

            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }

            $leaderArray = array();
            $scheduleRepo = new ScheduleRepository();
            foreach($schedulesArray as $sch_id){
                $schedule = $scheduleRepo->getObjByID($sch_id);
                $leader_id = $schedule["result"]->leader_id;
                array_push($leaderArray,$leader_id);
            }

            $usersWithSchedules    = $this->repo->getUsersByScheduleID($type, $from_date, $to_date, $schedulesArray);

            $hhcspersonArray = array();
            foreach($usersWithSchedules as $user){
                $hhcspersonArray[] = $user->user_id;
            }

            $usersArray = array_merge($leaderArray,$hhcspersonArray);

            $countsArray = array_count_values($usersArray);
            $userRepo = new UserRepository();
            $usersInfo = $userRepo->getUserByUserArray($usersArray);

            return view('report.visitreport')
                ->with('roles',$roles)
                ->with('usersInfo',$usersInfo)
                ->with('countsArray',$countsArray)
                ->with('type',$type)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date);
        }
        return redirect('/');
    }

    public function search($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            $roleRepo = new RoleRepository();
            $roles = $roleRepo->getObjsForVisitReport();

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();

            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }

            $usersWithSchedules    = $this->repo->getUsersByScheduleID($type, $from_date, $to_date, $schedulesArray);

            $usersArray = array();
            foreach($usersWithSchedules as $user){
                $usersArray[] = $user->user_id;
            }
            $countsArray = array_count_values($usersArray);

            $userRepo = new UserRepository();
            $usersInfo = $userRepo->getUserByUserArray($usersArray);

            return view('report.visitreport')
                ->with('roles',$roles)
                ->with('usersInfo',$usersInfo)
                ->with('countsArray',$countsArray)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date)
                ->with('type',$type);
        }
        return redirect('/');
    }

    public function excel($type = null, $from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            ob_end_clean();
            ob_start();

            $roleRepo = new RoleRepository();
            $roles = $roleRepo->getObjsForVisitReport();

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();

            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }

            $usersWithSchedules    = $this->repo->getUsersByScheduleID($type, $from_date, $to_date, $schedulesArray);

            $usersArray = array();
            foreach($usersWithSchedules as $user){
                $usersArray[] = $user->user_id;
            }
            $countsArray = array_count_values($usersArray);

            $userRepo = new UserRepository();
            $usersInfo = $userRepo->getUserByUserArray($usersArray);

            Excel::create('VisitReport', function($excel)use($usersInfo, $roles, $countsArray) {
                $excel->sheet('VisitReport', function($sheet)use($usersInfo, $roles, $countsArray) {
                    $displayArray = array();
                    foreach($usersInfo as $info){
                        $displayArray[$info->id]["Name"] = $info->Name;
                        foreach($roles as $role){
                            if($info->role_id == $role->id){
                                $displayArray[$info->id]["Staff Type"] = $role->name;
                            }
                        }
                        $displayArray[$info->id]["Visit Count"] = $countsArray[$info->id];
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
