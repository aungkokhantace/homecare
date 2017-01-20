<?php

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: Aug/3/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Patient;
use App\Backend\Allergy\AllergyRepository;
use App\Backend\Infrastructure\Forms\PatientEditRequest;
use App\Backend\Infrastructure\Forms\ProfileEditRequest;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepositoryInterface;
use App\Backend\Township\TownshipRepository;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Core\User\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PatientProfileController extends Controller
{
    private $repo;

    public function __construct(PatientRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function edit()
    {
        if (Auth::guard('User')->check()) {
            $id                     = Auth::guard('User')->user()->id;
            $result                 = $this->repo->getObjByID($id);
            $patient                = $result['result'];
            $patientDob             = Carbon::parse($patient->dob)->format('d-m-Y');
            $registrationDate       = Carbon::parse($patient->created_at)->format('d-m-Y');

            $userRepo               = new UserRepository();
            $user                   = $userRepo->getObjByID($id);

            $townshipRepo           = new TownshipRepository();
            $townships              = $townshipRepo->getObjs();

            $allergyRepo            = new AllergyRepository();
            $allergyObj             = $allergyRepo->getObjs();

            $allergies              = array();
            $foodArr                = array();
            $drugArr                = array();
            $environmentArr         = array();
            foreach($allergyObj as $allergy){
                if($allergy->type == "food"){
                    array_push($foodArr,$allergy);
                }
                if($allergy->type == "drug"){
                    array_push($drugArr,$allergy);
                }
                if($allergy->type == "environment"){
                    array_push($environmentArr,$allergy);
                }
            }
            $allergies['food'] = $foodArr;
            $allergies['drug'] = $drugArr;
            $allergies['environment'] = $environmentArr;

            return view('patient.profile.profile')->with('patient',$patient)->with('patientDob',$patientDob)->with('registrationDate',$registrationDate)->with('user',$user)->with('townships',$townships)->with('allergies',$allergies);
        }
        return redirect('/');
    }

    public function update(ProfileEditRequest $request)
    {
        $request->validate();

        if (Auth::guard('User')->check()) {
            $id = Input::get('id');

            $name            =   Input::get('name');
            $nrc_no          =   Input::get('nrc_no');
            $password        =   Input::get('password');

            if(Input::get('email')==""){
                $tmp = strtolower($name);
                $tmp = preg_replace('/\s+/', '', $tmp);
                $email          = $tmp."@gmail.com";
            }
            else{
                $email          = Input::get('email');
            }

            $dob             =   Carbon::parse(Input::get('dob'))->format('Y-m-d');
            $gender          =   Input::get('gender');
            $phone_no        =   Input::get('phone_no');
            $townships       =   Input::get('townships');
            $address         =   Input::get('address');
            $having_allergy     = Input::get('having_allergy');
            if($having_allergy == "yes"){
                $allergies   = Input::get('allergies');
            }
            else{
                $allergies = null;
            }
            $paramObj = Patient::find($id);

            $paramObj->name             =   $name;
            $paramObj->nrc_no           =   $nrc_no;
            $paramObj->email            =   $email;
            $paramObj->dob              =   $dob;
            $paramObj->gender           =   $gender;
            $paramObj->phone_no         =   $phone_no;
            $paramObj->township_id      =   $townships;
            $paramObj->address          =   $address;
            if($having_allergy == "yes"){
                $paramObj->having_allergy  = 1;
            }
            else{
                $paramObj->having_allergy  = 0;
            }

            $userObj = User::find($id);

            $userObj->name     =   $name;
//            $userObj->id            =   $patient_id;
            if(isset($password) && $password != ""){
                //encrypt password
                $pwd                    = base64_encode(Input::get('password'));
                //bind to userObj
                $userObj->password = $pwd;
            }
            $userObj->phone         = $phone_no;
            $userObj->email         = $email;
            $userObj->address       = $address;
//            $userObj->created_at    =   $registration;

            //create log patient case summery
            $logObj = new LogPatientCaseSummary();
            $logObj->case_summary = "Patient Edit";


            $result = $this->repo->update($userObj,$paramObj,$allergies,$logObj);

            if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
                return redirect()->action('Patient\PatientProfileController@edit')
                    ->withMessage(FormatGenerator::message('Success', 'Profile updated ...'));
            }
            else{
                return redirect()->action('Patient\PatientProfileController@edit')
                    ->withMessage(FormatGenerator::message('Fail', 'Profile did not update ...'));
            }
        }
        return redirect('/');
    }
}
