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
}
