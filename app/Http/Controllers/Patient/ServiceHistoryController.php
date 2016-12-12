<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/3/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Patient;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class ServiceHistoryController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {
            $id = Auth::guard('User')->user()->id;
            $servicesHistory = $this->repo->getServiceHistory($id);
            return view('patient.servicehistory.servicehistory')->with('servicesHistory',$servicesHistory);
        }
        return redirect('/');
    }
}
