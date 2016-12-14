<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/3/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Patient;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepositoryInterface;
use App\Backend\Township\TownshipRepository;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Core\User\UserRepository;
use App\Core\Utility;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Settings;
use PDF;

class PatientCaseController extends Controller
{
    private $repo;

    public function __construct(PatientRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {
            $id = Auth::guard('User')->user()->id;
            $result = $this->repo->getObjByID($id);
            $patient = $result['result'];
            $patientDob = Carbon::parse($patient->dob)->format('d-m-Y');
            $registrationDate = Carbon::parse($patient->created_at)->format('d-m-Y');

            $age = Utility::calculateAge($patientDob);

            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

            $patient_type = "Local";        //default
            if($patient->patient_type_id == 1){
                $patient_type = "Local";
            }
            else{
                $patient_type = "Foreigner";
            }

            if($patient->gender == "male"){
                $patient_gender = "Male";
            }
            else{
                $patient_gender = "Female";
            }

            $userRepo = new UserRepository();
            $user      = $userRepo->getObjByID($id);

            $townshipRepo = new TownshipRepository();
            $townships      = $townshipRepo->getObjs();

            $allergyRepo = new AllergyRepository();
            $allergies      = $allergyRepo->getObjs();

            return view('patient.case.case')
                ->with('patient',$patient)
                ->with('patientDob',$patientDob)
                ->with('registrationDate',$registrationDate)
                ->with('age',$age)
                ->with('patientTypes',$patientTypes)
                ->with('user',$user)
                ->with('townships',$townships)
                ->with('patient_type',$patient_type)
                ->with('patient_gender',$patient_gender)
                ->with('allergies',$allergies);
        }
        return redirect('/');
    }

    public function export()
    {
        if (Auth::guard('User')->check()) {

            $id = Auth::guard('User')->user()->id;
            $result = $this->repo->getObjByID($id);
            $patient = $result['result'];
            $patientDob = Carbon::parse($patient->dob)->format('d-m-Y');

            $age = Utility::calculateAge($patientDob);

            if($patient->patient_type_id == 1){
                $patient_type = "Local";
            }
            else{
                $patient_type = "Foreigner";
            }

            if($patient->gender == "male"){
                $patient_gender = "Male";
            }
            else{
                $patient_gender = "Female";
            }

            $registrationDate = Carbon::parse($patient->created_at)->format('d-m-Y');

            $patient_allergies = "No";

            foreach($patient['allergies']['food'] as $allergy){
                if($allergy->selected == 1){
                    $patient_allergies .= "[Food] - ". $allergy->name.'<br/>';
                }
            }

            foreach($patient['allergies']['drug'] as $allergy){
                if($allergy->selected == 1){
                    $patient_allergies .= "[Drug] - ". $allergy->name.'<br/>';
                }
            }

            $pdfHeader = Utility::getPDFHeader().'<br>'.'<br>';

            $patientData = '<table class="table" style="word-wrap: break-word; table-layout: fixed; font-size:9px;">
                            <tr>
                                <td height="20" width="20%">Name</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$patient->name.'</td>
                                <td height="20" width="20%">NRC/Passport No.</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$patient->nrc_no.'</td>
                            </tr>
                            <tr>
                                <td height="20" width="20%">Age/Gender</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$age['value'].' '.$age['unit'].'/'.$patient_gender.'</td>
                                <td height="20" width="20%">Patient Type</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$patient_type.'</td>
                            </tr>
                            <tr>
                            <td height="20" width="20%">Registration Date</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$registrationDate.'</td>
                                <td height="20" width="20%">Contact Phone</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$patient->phone_no.'</td>
                            </tr>
                            <tr>
                                <td height="20" width="20%">Date of Birth</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$patientDob.'</td>
                                <td height="20" width="20%">Address</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$patient->address.'</td>
                            </tr>
                            <tr>
                                <td height="20" width="20%">Allergies</td>
                                <td height="20" width="5%">-</td>
                                <td height="20" width="25%">'.$patient_allergies.'</td>
                                <td height="20" width="20%"></td>
                                <td height="20" width="5%"></td>
                                <td height="20" width="25%"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>';

            $caseSummaryData = '<table class="table" style="word-wrap: break-word; table-layout: fixed; font-size:9px;">
                                    <tr bgcolor="#cccccc">
                                        <td><h4>Case Summary</h4></td>
                                    </tr>
                                    <tr>
                                        <td>'.$patient->case_scenario.'</td>
                                    </tr>
                            </table>';
            $html = $pdfHeader.$patientData.$caseSummaryData;
            Utility::exportPDF($html);

        }
        return redirect('/');
    }
}
