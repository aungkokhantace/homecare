<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:18 PM
 */

namespace App\Http\Controllers\Backend;

use App\Backend\Medicalhistory\MedicalhistoryRepository;
use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\PatientmedicalhistoryEntryRequest;
use App\Backend\Infrastructure\Forms\PatientmedicalhistoryEditRequest;
use App\Backend\Patientmedicalhistory\PatientmedicalhistoryRepositoryInterface;
use App\Backend\Patientmedicalhistory\Patientmedicalhistory;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class PatientmedicalhistoryController extends Controller
{
    private $patientmedicalhistoryRepository;

    public function __construct(PatientmedicalhistoryRepositoryInterface $patientmedicalhistoryRepository)
    {
        $this->patientmedicalhistoryRepository = $patientmedicalhistoryRepository;
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

                $medicalHistoryRepo = new MedicalhistoryRepository();
                $medicalHistories = $medicalHistoryRepo->getArrays();

                return view('backend.patientmedicalhistory.patientmedicalhistory')
                    ->with('patient_id',$patient_id)
                    ->with('medicalHistories',$medicalHistories);
            }
        }
        return redirect('/');
    }

    public function store(PatientmedicalhistoryEntryRequest $request)
    {
        $request->validate();
        $patient_id                     = Input::get('patient_id');
        $medical_history_id             = Input::get('medical_history_id');

        $prefix                         = Utility::getTerminalId();
        $table                          = (new Patientmedicalhistory())->getTable();
        $col                            = "id";
        $offset                         = 1;
        $generatedId                    = Utility::generatedId($prefix,$table,$col,$offset);

        $paramObj                       = new Patientmedicalhistory();
        $paramObj->id                   = $generatedId;
        $paramObj->patient_id           = $patient_id;
        $paramObj->medical_history_id   = $medical_history_id;

        $result = $this->patientmedicalhistoryRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect('/patient/detail/' . $patient_id)
                ->withMessage(FormatGenerator::message('Success', 'Patient Medical history created ...'));
        }
        if($result['aceplusStatusCode'] ==  ReturnMessage::NOT_IMPLEMENTED){
            return redirect('/patientmedicalhistory/create/' . $patient_id)
                ->withMessage(FormatGenerator::message('Fail',$result['aceplusStatusMessage']));
        }
        else{
            return redirect('/patientmedicalhistory/create/' . $patient_id)
                ->withMessage(FormatGenerator::message('Fail', 'Patient Medical history did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {

            $medicalHistoryRepo = new MedicalhistoryRepository();
            $medicalHistories = $medicalHistoryRepo->getArraysByOrder();

            $patient_medical_ids = explode('___', $id);
            $patient_id = $patient_medical_ids[0];
            $medical_history_id = $patient_medical_ids[1];

            $patientmedicalhistory = $this->patientmedicalhistoryRepository->getObjByParam($patient_id,$medical_history_id);
            $tempDate = $patientmedicalhistory->date;
            $patientmedicalhistory->date = date("d-m-Y", strtotime($tempDate));
            return view('backend.patientmedicalhistory.patientmedicalhistory')
                            ->with('patientmedicalhistory', $patientmedicalhistory)
                            ->with('patient_id', $patient_id    )
                            ->with('medicalHistories',$medicalHistories);
        }
        return redirect('/');
    }

    public function update(PatientmedicalhistoryEditRequest $request){

        $request->validate();
        $patient_id           = Input::get('patient_id');
        $medical_history_id    = Input::get('medical_history_id');
        $date    = Input::get('date');

        $paramObj = new Patientmedicalhistory();
        $paramObj->patient_id = $patient_id;
        $paramObj->medical_history_id = $medical_history_id;
        $paramObj->date = date("Y-m-d", strtotime($date));

        $result = $this->patientmedicalhistoryRepository->updateByParam($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect('/patient/detail/' . $patient_id)
                ->withMessage(FormatGenerator::message('Success', 'Patient Medical history updated ...'));
        }
        else{
            return redirect('/patientmedicalhistory/edit/' . $patient_id . '___' . $medical_history_id)
                ->withMessage(FormatGenerator::message('Fail', 'Patient Medical history did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('patientmedicalhistory_selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $patient_medical_ids = explode('___', $id);
            $patient_id = $patient_medical_ids[0];
            $medical_history_id = $patient_medical_ids[1];
            $this->patientmedicalhistoryRepository->deleteByParam($patient_id,$medical_history_id);
        }
        return redirect('/patient/detail/' . $patient_id)
            ->withMessage(FormatGenerator::message('Success', 'Patient medical history deleted ...'));

    }

}
