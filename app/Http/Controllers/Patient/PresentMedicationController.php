<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/26/2016
 * Time: 4:00 PM
 */

namespace App\Http\Controllers\Patient;

use App\Backend\Presentmedication\PresentmedicationRepositoryInterface;
use App\Backend\Schedule\ScheduleRepository;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PresentMedicationController extends Controller
{
    private $repo;

    public function __construct(PresentMedicationRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {
            $id = Auth::guard('User')->user()->id;
            $presentMedications = $this->repo->getPresentMedications($id);
            return view('patient.presentmedication.presentmedication')->with('presentMedications',$presentMedications);
        }
        return redirect('/');
    }
}
