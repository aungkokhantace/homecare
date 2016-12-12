<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\PatientsurgeryhistoryEntryRequest;
use App\Backend\Infrastructure\Forms\PatientsurgeryhistoryEditRequest;
use App\Backend\Patientsurgeryhistory\PatientsurgeryhistoryRepositoryInterface;
use App\Backend\Patientsurgeryhistory\Patientsurgeryhistory;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Utility;
use App\Backend\Patient\Patient;

class PatientsurgeryhistoryController extends Controller
{
    private $patientsurgeryhistoryRepository;

    public function __construct(PatientsurgeryhistoryRepositoryInterface $patientsurgeryhistoryRepository)
    {
        $this->patientsurgeryhistoryRepository = $patientsurgeryhistoryRepository;
    }

    public function index(Request $request)
    {
        return redirect('/');
    }

    public function create($patient_id){
        if (Auth::guard('User')->check()) {

            // Invalid Patient ID
            if($patient_id === 0){

                return redirect()->action('Backend\PatientController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Invalid Patient ...'));
            }
            else{
                $patient = Patient::find($patient_id);

                return view('backend.patientsurgeryhistory.patientsurgeryhistory')
                    ->with('patient_id',$patient_id)
                    ->with('patient',$patient);
            }
        }
        return redirect('/');
    }

    public function store(PatientsurgeryhistoryEntryRequest $request)
    {
        $request->validate();
        $patient_id             = Input::get('patient_id');
        $description            = Input::get('description');

        $prefix                 = Utility::getTerminalId();
        $table                  = (new Patientsurgeryhistory())->getTable();
        $col                    = "id";
        $offset                 = 1;
        $generatedId            = Utility::generatedId($prefix,$table,$col,$offset);

        $paramObj               = new Patientsurgeryhistory();
        $paramObj->id           = $generatedId;
        $paramObj->patient_id   = $patient_id;
        $paramObj->description  = $description;

        $result = $this->patientsurgeryhistoryRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect('/patient/detail/' . $patient_id)
                ->withMessage(FormatGenerator::message('Success', 'Patient surgery history created ...'));
        }
        else{
            return redirect('/patientmedicalhistory/create/' . $patient_id)
                ->withMessage(FormatGenerator::message('Fail', 'Patient surgery history did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $patientsurgeryhistory = $this->patientsurgeryhistoryRepository->getObjByID($id);
            if(isset($patientsurgeryhistory) && count($patientsurgeryhistory)>0){

                $patient_id = $patientsurgeryhistory->patient_id;
                $patient = Patient::find($patient_id);

                return view('backend.patientsurgeryhistory.patientsurgeryhistory')
                    ->with('patientsurgeryhistory', $patientsurgeryhistory)
                    ->with('patient_id', $patient_id)
                    ->with('patient', $patient);
            }
            else{
                return redirect()->action('Backend\PatientController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Invalid Patient Surgery History ...'));
            }

        }
        return redirect('/');
    }

    public function update(PatientsurgeryhistoryEditRequest $request){

        $id = Input::get('id');
        $request->validate();
        $patient_id         = Input::get('patient_id');
        $description        = Input::get('description');

        $paramObj = Patientsurgeryhistory::find($id);
        $paramObj->description = $description;

        $result = $this->patientsurgeryhistoryRepository->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect('/patient/detail/' . $patient_id)
                ->withMessage(FormatGenerator::message('Success', 'Patient Surgery history updated ...'));
        }
        else{
            return redirect('/patientsurgeryhistory/edit/' . $id)
                ->withMessage(FormatGenerator::message('Fail', 'Patient Surgery history did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('patientsurgeryhistory_selected_checkboxes');
        $new_string = explode(',', $id);
        $patient_id = 0;
        foreach($new_string as $id){

            // getting patient id to return the patient detail page
            $patienthistory = Patientsurgeryhistory::find($id);
            $patient_id = $patienthistory->patient_id;
            $this->patientsurgeryhistoryRepository->delete($id);

        }

        return redirect('/patient/detail/' . $patient_id)
            ->withMessage(FormatGenerator::message('Success', 'Patientsurgeryhistory deleted ...'));

    }

}
