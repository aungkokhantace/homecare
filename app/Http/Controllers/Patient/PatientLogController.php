<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummaryRepositoryInterface;
use Illuminate\Support\Facades\Input;
class PatientLogController extends Controller
{
    
    private $repo;

    public function __construct(LogPatientCaseSummaryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {

            $result  = $this->repo->getLogPatientCaseSummaryObj();
            $patient = $this->repo->getPatientID();

            return view('log.patient.casesummary')
                ->with('result',$result)
                ->with('selected_value','all')
                ->with('patient',$patient);
        }
        return redirect('/');
    }

    public function search(Request $request){
       
        $id = Input::get('patient_type_id');
        if($id == 'all'){
            $result  = $this->repo->getLogPatientCaseSummaryObj();
        }
        else{
            $result = $this->repo->getLogObj($id);
        }
        $patient= $this->repo->getPatientID();

        return view('log.patient.casesummary')
            ->with('result',$result)
            ->with('selected_value',$id)
            ->with('patient',$patient);
    }

    
}
