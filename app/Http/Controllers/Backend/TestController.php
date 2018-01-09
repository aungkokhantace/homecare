<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Backend;

use App\Backend\Schedule\ScheduleRepository;
use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\CityEntryRequest;
use App\Backend\Infrastructure\Forms\CityEditRequest;
use App\Backend\City\CityRepositoryInterface;
use App\Backend\City\City;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\User;
use App\Backend\Patient\Patient;
use App\Backend\Patient\PatientRepository;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummary;

class TestController extends Controller
{
    private $cityRepository;

    public function __construct()
    {

    }

    public function index()
    {
        if (Auth::guard('User')->check()) {
//            $scheduleRepo = new ScheduleRepository();
//            $schedules = $scheduleRepo->getSchedules();
//            $scheduleArray = array();
//            foreach($schedules as $schedule){
//                if($schedule->status == "new"){
//                    $scheduleArray['status'] = $schedule->status;
//                    $scheduleArray['count'] = $schedule->count;
//                    $scheduleArray['color'] = "#63abf3";
//                }
//                else if($schedule->status == "processing"){
//                    $scheduleArray['status'] = $schedule->status;
//                    $scheduleArray['count'] = $schedule->count;
//                    $scheduleArray['color'] = "#f2d380";
//                }
//                else if($schedule->status == "complete"){
//                    $scheduleArray['status'] = $schedule->status;
//                    $scheduleArray['count'] = $schedule->count;
//                    $scheduleArray['color'] = "#6ce9a5";
//                }
//                else {
//                    $scheduleArray['status'] = $schedule->status;
//                    $scheduleArray['count'] = $schedule->count;
//                    $scheduleArray['color'] = "#f57a7d";
//                }
//            }
//            dd($schedules);
//            dd($scheduleArray);
            return view('backend.test.test');
        }
        return redirect('/');
    }

    public function testPrint()
    {
//        $companyLogo = \App\Core\Check::companyLogo();
//        $image = '<img style="width:80px;height:50px;" src="'.$companyLogo.'" alt="Parami HomeCare Logo"><br>';
//        $logo = '<table>
//                        <tr>
//                            <td align="center" width="33%" height="20"></td>
//                            <td align="center" width="33%" height="20">'.$image.'</td>
//                            <td align="center" width="33%" height="20"></td>
//                        </tr>
//                        </table>';
//        $letterHead = '<br><table>
//                        <tr>
//                            <td align="center" height="20">No.(60/A), G-1, New Parami Road, Mayangone Township, Yangon, Myanmar</td>
//                        </tr>
//                        <tr>
//                            <td align="center" height="20">Contact:(+95-1) 661694, 657228. E-mail:shwezaneka@gmail.com, gzp.hhcs@gmail.com</td>
//                        </tr>
//                        <tr>
//                            <td align="center" height="18" bgcolor="#00c0f1" style="color:white">Parami Home Health Care Services @ Parami General Hospital - Yangon</td>
//                        </tr>
//                        </table>';

//        $pdfHeader = $logo.$letterHead;
        $pdfHeader = Utility::getPDFHeader();

        $html = $pdfHeader.'<h1>Invoice Detail</h1>
                        <table>
                            <tr>
                                <td height="30" width="25%">Invoice ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Invoice ID".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Date</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Invoice Date".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Scheudle ID".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule Start Time</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Schedule Start Time".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Schedule End Time</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Schedule End Time".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient ID</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Patient ID".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient Name</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Patient Name".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Patient Address</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Patient Address".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Township</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Township".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Zone</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Zone".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Total Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Total Amount".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Discount Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Discount Amount".'</td>
                            </tr>
                             <tr>
                                <td height="30" width="25%">Grand Total Amount</td>
                                <td height="30" width="10%">:</td>
                                <td height="30">'."Grand Total Amount".'</td>
                            </tr>
                        </table>
                        <br><br><br>';

        Utility::exportPDF($html);
    }

    public function insert_patient_test_data($count){
      for($i=1 ; $i<=$count ; $i++){
        //create user object
        $userObj = new User();
        $userObj->name              = "test_patient_".$i;
        $userObj->password          = base64_encode("123@parami");
        $userObj->phone             = "12345".$i;
        $userObj->email             = "test_patient".$i."@gmail.com";
        $userObj->display_image     = "";
        $userObj->mobile_image      = "";
        $userObj->role_id           = 5;
        $userObj->address           = "test ".$i." address";
        $userObj->active            = 1;

        //create patient object
        $paramObj                       = new Patient();
        $paramObj->name                 = "test_patient_".$i;
        $paramObj->patient_type_id      = 1;
        $paramObj->nrc_no               = "12345".$i;
        $paramObj->dob                  = "1980-01-01";
        $paramObj->township_id          = 1;
        $paramObj->address              = "test ".$i." address";
        $paramObj->having_allergy       = 0;
        $paramObj->phone_no             = "12345".$i;
        $paramObj->gender               = "male";
        $paramObj->email                = "test_patient".$i."@gmail.com";
        $paramObj->case_scenario        = "test_patient".$i." case summary";
        $paramObj->remark               = "test_patient".$i." remark";

        //create log patient case summary
        $prefix = Utility::getTerminalId();
        $table = (new LogPatientCaseSummary())->getTable();
        $col = "id";
        $offset = 1;
        $generatedId = Utility::generatedId($prefix,$table,$col,$offset);
        $logObj                         = new LogPatientCaseSummary();
        $logObj->id                     = $generatedId;
        $logObj->case_summary           = "case summary";

        $allergies = null;

        //save user obj and patient obj
        $patientRepo = new PatientRepository();
        $result = $patientRepo->create($flag = 1, $userObj,$paramObj,$allergies,$logObj); //$flag=1 is for including DB::beginTransaction() and 0 is not

        if($result['aceplusStatusCode'] !==  ReturnMessage::OK){
            alert()->success('Total '.$count.' Patient Data are not successfully inserted')->persistent('OK');
            return redirect()->action('Backend\PatientController@index');
        }
      }

      //successful
      alert()->success('Total '.$count.' Patient Data successfully inserted')->persistent('OK');
      return redirect()->action('Backend\PatientController@index');
    }

    public function delete_patient_test_data(){
      DB::select("DELETE FROM patients WHERE name like 'test_patient_%'");
      DB::select("DELETE FROM core_users WHERE name like 'test_patient_%'");
      alert()->success('Test Patient Data successfully cleared')->persistent('OK');
      return redirect()->action('Backend\PatientController@index');
    }
}
