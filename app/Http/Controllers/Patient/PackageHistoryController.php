<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/3/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Patient;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class PackageHistoryController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {
            $id = Auth::guard('User')->user()->id;
            $packages = $this->repo->getPackageHistory($id);
            return view('patient.packagehistory.packagehistory')->with('packages',$packages);
        }
        return redirect('/');
    }
}
