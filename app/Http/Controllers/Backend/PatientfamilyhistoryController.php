<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\Backend;

use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\PatientfamilyhistoryEntryRequest;
use App\Backend\Infrastructure\Forms\PatientfamilyhistoryEditRequest;
use App\Backend\Patientfamilyhistory\PatientfamilyhistoryRepositoryInterface;
use App\Backend\Patientfamilyhistory\Patientfamilyhistory;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Backend\Familyhistory\FamilyhistoryRepository;
use App\Backend\Familymember\FamilymemberRepository;

class PatientfamilyhistoryController extends Controller
{
    private $patientfamilyhistoryRepository;

    public function __construct(PatientfamilyhistoryRepositoryInterface $patientfamilyhistoryRepository)
    {
        $this->patientfamilyhistoryRepository = $patientfamilyhistoryRepository;
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
                $familyHistoryRepo = new FamilyhistoryRepository();
                $familyHistories = $familyHistoryRepo->getArraysByOrder();

                $familymemberRepo = new FamilymemberRepository();
                $familyMembers = $familymemberRepo->getArraysByOrder();

                return view('backend.patientfamilyhistory.patientfamilyhistory')
                    ->with('patient_id',$patient_id)
                    ->with('familyHistories',$familyHistories)
                    ->with('familyMembers',$familyMembers);
            }
        }
        return redirect('/');
    }

    public function store(PatientfamilyhistoryEntryRequest $request)
    {
        $request->validate();
        $patient_id             = Input::get('patient_id');
        $family_history_id      = Input::get('family_history_id');
        $family_member_id       = Input::get('family_member_id');

        $prefix                         = Utility::getTerminalId();
        $table                          = (new Patientfamilyhistory())->getTable();
        $col                            = "id";
        $offset                         = 1;
        $generatedId                    = Utility::generatedId($prefix,$table,$col,$offset);

        $paramObj                       = new Patientfamilyhistory();
        $paramObj->id                   = $generatedId;
        $paramObj->patient_id           = $patient_id;
        $paramObj->family_history_id    = $family_history_id;
        $paramObj->family_member_id     = $family_member_id;

        $result = $this->patientfamilyhistoryRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect('/patient/detail/' . $patient_id)
                ->withMessage(FormatGenerator::message('Success', 'Patient Family history created ...'));
        }
        if($result['aceplusStatusCode'] ==  ReturnMessage::NOT_IMPLEMENTED){
            return redirect('/patientfamilyhistory/create/' . $patient_id)
                ->withMessage(FormatGenerator::message('Fail',$result['aceplusStatusMessage']));
        }
        else{
            return redirect('/patientfamilyhistory/create/' . $patient_id)
                ->withMessage(FormatGenerator::message('Fail', 'Patient Family history did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $familyHistoryRepo = new FamilyhistoryRepository();
            $familyHistories = $familyHistoryRepo->getArraysByOrder();

            $familymemberRepo = new FamilymemberRepository();
            $familyMembers = $familymemberRepo->getArraysByOrder();

            $patient_family_ids = explode('___', $id);
            $patient_id = $patient_family_ids[0];
            $family_history_id = $patient_family_ids[1];
            $family_member_id = $patient_family_ids[2];

            $patientfamilyhistory = $this->patientfamilyhistoryRepository->getObjByParam($patient_id,$family_history_id,$family_member_id);

            return view('backend.patientfamilyhistory.patientfamilyhistory')
                ->with('patientfamilyhistory', $patientfamilyhistory)
                ->with('patient_id', $patient_id)
                ->with('familyHistories',$familyHistories)
                ->with('familyMembers',$familyMembers);
        }
        return redirect('/');
    }

    public function update(PatientfamilyhistoryEditRequest $request){

        $request->validate();
        $patient_id             = Input::get('patient_id');
        $family_history_id      = Input::get('family_history_id');
        $family_member_id       = Input::get('family_member_id');
        $remark                 = Input::get('remark');

        $paramObj                       = new Patientfamilyhistory();
        $paramObj->patient_id           = $patient_id;
        $paramObj->family_history_id    = $family_history_id;
        $paramObj->family_member_id     = $family_member_id;
        $paramObj->remark               = $remark;

        $result = $this->patientfamilyhistoryRepository->updateByParam($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect('/patient/detail/' . $patient_id)
                ->withMessage(FormatGenerator::message('Success', 'Patient Family history updated ...'));
        }
        if($result['aceplusStatusCode'] ==  ReturnMessage::NOT_IMPLEMENTED){
            return redirect('/patientmedicalhistory/create/' . $patient_id)
                ->withMessage(FormatGenerator::message('Fail',$result['aceplusStatusMessage']));
        }
        else{
            return redirect('/patientfamilyhistory/create/' . $patient_id)
                ->withMessage(FormatGenerator::message('Fail', 'Patient Family history did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('patientfamilyhistory_selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $patient_family_ids = explode('___', $id);
            $patient_id = $patient_family_ids[0];
            $family_history_id = $patient_family_ids[1];
            $family_member_id = $patient_family_ids[2];

            $this->patientfamilyhistoryRepository->deleteByParam($patient_id,$family_history_id,$family_member_id);
        }
        return redirect('/patient/detail/' . $patient_id)
            ->withMessage(FormatGenerator::message('Success', 'Patient family history deleted ...'));

    }

}
