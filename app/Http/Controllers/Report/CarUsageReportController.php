<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: September/5/2016
 * Time: 10:33 AM
 */

namespace App\Http\Controllers\Report;

use App\Backend\Cartype\CartypeRepository;
use App\Backend\Invoice\InvoiceRepository;
use App\Backend\Schedule\Schedule;
use App\Backend\Schedule\ScheduleRepository;
use App\Backend\Schedule\ScheduleRepositoryInterface;
use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Maatwebsite\Excel\Facades\Excel;

class CarUsageReportController extends Controller
{
    private $repo;

    public function __construct(ScheduleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index() {
        if (Auth::guard('User')->check()) {

            $from_date = null;
            $to_date = null;

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }
            $carUsage    = $this->repo->getCarUsageReport($from_date, $to_date, $schedulesArray);

            $carTypeRepo = new CartypeRepository();
            $carTypes    = $carTypeRepo->getObjs();

            $datesArray = array();
            foreach($carUsage as $usage){
                $datesArray[] = $usage->date;
            }

            $dataByDate = array();
            foreach($carUsage as $c){
                foreach($datesArray as $d){
                    foreach($carTypes as $t){
                        if($c->date == $d){
                            if($t->id == $c->car_type_id){
                                $dataByDate[$d]["date"] = $d;
                                $dataByDate[$d][$t->id] = $c->count;
                            }
                        }
                    }
                }
            }

            $dataArray = array();
            $chartCount = 0;
            foreach($dataByDate as $data){
                $dataArray[$chartCount] = $data;
                $chartCount++;
            }

            $grandTotalArray  = array();
            $totalByCarTypeArray  = array();
            foreach($dataArray as $d) {
                $grandTotal = 0;
                foreach($carTypes as $cType){
                    if(array_key_exists($cType->id,$d)){
                        $grandTotal += $d[$cType->id];
                        $grandTotalArray[$d["date"]] = $grandTotal;
                    }
                }
            }

            foreach($carTypes as $carType){
                $totalByCarType = 0;
                foreach($carUsage as $usage){
                    if($carType->id == $usage->car_type_id){
                        $totalByCarType += $usage->count;
                        $totalByCarTypeArray[$carType->id] = $totalByCarType;
                    }
                }
            }
            $totalCars = 0;
            foreach($grandTotalArray as $grandTotal) {
                $totalCars += $grandTotal;
            }

            return view('report.carusagereport')
                ->with('dataArray',$dataArray)
                ->with('carTypes',$carTypes)
                ->with('grandTotalArray',$grandTotalArray)
                ->with('totalByCarTypeArray',$totalByCarTypeArray)
                ->with('totalCars',$totalCars);
        }
        return redirect('/');
    }

    public function search($from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }
            $carUsage    = $this->repo->getCarUsageReport($from_date, $to_date, $schedulesArray);
            $carTypeRepo = new CartypeRepository();
            $carTypes    = $carTypeRepo->getObjs();

            $datesArray = array();
            foreach($carUsage as $usage){
                $datesArray[] = $usage->date;
            }

            $dataByDate = array();
            foreach($carUsage as $c){
                foreach($datesArray as $d){
                    foreach($carTypes as $t){
                        if($c->date == $d){
                            if($t->id == $c->car_type_id){
                                $dataByDate[$d]["date"] = $d;
                                $dataByDate[$d][$t->id] = $c->count;
                            }
                        }
                    }
                }
            }

            $dataArray = array();
            $chartCount = 0;
            foreach($dataByDate as $data){
                $dataArray[$chartCount] = $data;
                $chartCount++;
            }

            $grandTotalArray  = array();
            $totalByCarTypeArray  = array();
            foreach($dataArray as $d) {
                $grandTotal = 0;
                foreach($carTypes as $cType){
                    if(array_key_exists($cType->id,$d)){
                        $grandTotal += $d[$cType->id];
                        $grandTotalArray[$d["date"]] = $grandTotal;
                    }
                }
            }

            foreach($carTypes as $carType){
                $totalByCarType = 0;
                foreach($carUsage as $usage){
                    if($carType->id == $usage->car_type_id){
                        $totalByCarType += $usage->count;
                        $totalByCarTypeArray[$carType->id] = $totalByCarType;
                    }
                }
            }
            $totalCars = 0;
            foreach($grandTotalArray as $grandTotal) {
                $totalCars += $grandTotal;
            }

            return view('report.carusagereport')
                ->with('dataArray',$dataArray)
                ->with('carTypes',$carTypes)
                ->with('grandTotalArray',$grandTotalArray)
                ->with('totalByCarTypeArray',$totalByCarTypeArray)
                ->with('totalCars',$totalCars)
                ->with('from_date', $from_date)
                ->with('to_date', $to_date);
        }
        return redirect('/');
    }

    public function excel($from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            ob_end_clean();
            ob_start();
            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }

            $carUsage    = $this->repo->getCarUsageReport($from_date, $to_date, $schedulesArray);
            $carTypeRepo = new CartypeRepository();
            $carTypes    = $carTypeRepo->getObjs();

            $datesArray = array();
            foreach($carUsage as $usage){
                $datesArray[] = $usage->date;
            }

            $dataByDate = array();
            foreach($carUsage as $c){
                foreach($datesArray as $d){
                    foreach($carTypes as $t){
                        if($c->date == $d){
                            if($t->id == $c->car_type_id){
                                $dataByDate[$d]["date"] = $d;
                                $dataByDate[$d][$t->id] = $c->count;
                            }
                        }
                    }
                }
            }

            $dataArray = array();
            $chartCount = 0;
            foreach($dataByDate as $data){
                $dataArray[$chartCount] = $data;
                $chartCount++;
            }

            $grandTotalArray  = array();
            $totalByCarTypeArray  = array();
            foreach($dataArray as $d) {
                $grandTotal = 0;
                foreach($carTypes as $cType){
                    if(array_key_exists($cType->id,$d)){
                        $grandTotal += $d[$cType->id];
                        $grandTotalArray[$d["date"]] = $grandTotal;
                    }
                }
            }

            foreach($carTypes as $carType){
                $totalByCarType = 0;
                foreach($carUsage as $usage){
                    if($carType->id == $usage->car_type_id){
                        $totalByCarType += $usage->count;
                        $totalByCarTypeArray[$carType->id] = $totalByCarType;
                    }
                }
            }
            $totalCars = 0;
            foreach($grandTotalArray as $grandTotal) {
                $totalCars += $grandTotal;
            }

            Excel::create('CarUsageReport', function($excel)use($dataArray, $carTypes, $grandTotalArray, $totalByCarTypeArray, $totalCars) {
                $excel->sheet('CarUsageReport', function($sheet)use($dataArray, $carTypes, $grandTotalArray, $totalByCarTypeArray, $totalCars) {
                    $displayArray = array();

                    $count = 0; //for indicating index of $grandTotalArray... i.e.. Array of grand totals
                    $index = 0; //for indicating index of $displayArray ... i.e.. Array to be displayed

                    foreach($dataArray as $data){
                        $displayArray[$index]["Date"] = $data["date"];
                        foreach($carTypes as $carType){
                            if(array_key_exists($carType->id,$data)){
                                $displayArray[$index][$carType->name] = $data[$carType->id];
                            }
                            else{
                                $displayArray[$index][$carType->name] = "";
                            }
                        }
                        $displayArray[$index]["Grand Total"] = $grandTotalArray[$data["date"]];
                        $count++;
                        $index++;
                    }

                    if(count($displayArray) == 0){
                        $sheet->fromArray($displayArray);
                    }
                    else{
                        $verticalCount   = count($displayArray)+2;  //number of rows that will be colored
                        $horizontalCount = count($carTypes)+2;      //number of columns that will be colored

                        $charArray = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
                        $columnArray = array();
                        $columnArray[0] = "";

                        foreach($charArray as $firstIndex){
                            foreach($charArray as $secondIndex){
                                if($secondIndex == ""){
                                    continue;
                                }
                                if(end($charArray) != "Z"){
                                    $columnArray[] = $firstIndex;
                                }
                                else{
                                    $columnArray[] = $firstIndex.$secondIndex;
                                }
                            }
                        }

                        $sheet->cells('A1:'.$columnArray[$horizontalCount].'1', function($cells) {
                            $cells->setBackground('#1976d3');
                            $cells->setFontSize(13);
                        });

                        $sheet->fromArray($displayArray);

                        $appendedRow = array();
                        $appendedRow[0] = "";
                        foreach($carTypes as $type){
                            if(array_key_exists($type->id, $totalByCarTypeArray)){
                                $appendedRow[$type->id] = $totalByCarTypeArray[$type->id];
                            }
                            else{
                                $appendedRow[$type->id] = null;
                            }
                        }

                        end($appendedRow);
                        $totalIndex = key($appendedRow)+1;
                        $appendedRow[$totalIndex] = $totalCars;

                        $sheet->appendRow(
                            $appendedRow
                        );

                        $sheet->cells('A'.$verticalCount.':'.$columnArray[$horizontalCount].$verticalCount, function($cells) {
                            $cells->setBackground('#1976d3');
                            $cells->setFontSize(13);
                        });
                    }
                });
            })
                ->download('xls');
            ob_flush();
            return Redirect();
        }
        return redirect('/');
    }

    public function graph(){
        if (Auth::guard('User')->check()) {
            $from_date = null;
            $to_date = null;

            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }
            $carUsage    = $this->repo->getCarUsageReport($from_date, $to_date, $schedulesArray);

            $carTypeRepo = new CartypeRepository();
            $carTypes    = $carTypeRepo->getObjs();

            $datesArray = array();
            foreach($carUsage as $usage){
                $datesArray[] = $usage->date;
            }

            $chartDataByDate = array();
            $colorsArray = array();
            foreach($carUsage as $c){
               foreach($datesArray as $d){
                   foreach($carTypes as $t){
                       if($c->date == $d){
                           if($t->id == $c->car_type_id){
                               $chartDataByDate[$d]["date"] = $d;
                               $chartDataByDate[$d]["value".$t->id] = $c->count;
                               $color = "#".Utility::generateColorCode();
                               $chartDataByDate[$d]["lineColor".$t->id] = $color;

                               $colorsArray[$t->name] = $color;
                           }
                       }
                   }
               }
            }

            $chartData = array();
            $chartCount = 0;
            foreach($chartDataByDate as $cdata){
                $chartData[$chartCount] = $cdata;
                $chartCount++;
            }

            $graphData = array();
            $graphCount = 0;
            foreach($carTypes as $types){
                $graphData[$graphCount]["id"] = "g".$types->id;
                $graphData[$graphCount]["balloon"]["drop"] = false;
                $graphData[$graphCount]["balloon"]["adjustBorderColor"] = false;
                $graphData[$graphCount]["balloon"]["color"] = "#ffffff";
                $graphData[$graphCount]["bullet"] = "round";
                $graphData[$graphCount]["bulletBorderAlpha"] = 1;
                $graphData[$graphCount]["bulletColor"] = "#ffffff";
                $graphData[$graphCount]["bulletSize"] = 5;
                $graphData[$graphCount]["hideBulletsCount"] = 50;
                $graphData[$graphCount]["lineThickness"] = 2;
                $graphData[$graphCount]["useLineColorForBulletBorder"] = true;
                $graphData[$graphCount]["valueField"] = "value".$types->id;
                $graphData[$graphCount]["lineColorField"] = "lineColor".$types->id;
                $graphData[$graphCount]["balloonText"] = "<span style='font-size:9px;'>$types->name ([[value]])</span>";
                $graphData[$graphCount]["showAllValueLabels"] = true;
                $graphCount++;
            }

            return view('report.carusagereportbygraph')
                ->with('graphData',$graphData)
                ->with('chartData',$chartData)
                ->with('colorsArray',$colorsArray);
        }
        return redirect('/');
    }

    public function graphsearch($from_date = null, $to_date = null){
        if (Auth::guard('User')->check()) {
            $invoiceRepo = new InvoiceRepository();
            $invoicesWithSchedules = $invoiceRepo->getInvoicesWithSchedules();
            $schedulesArray = array();
            foreach($invoicesWithSchedules as $invoice){
                $schedulesArray[] = $invoice->schedule_id;
            }
            $carUsage    = $this->repo->getCarUsageReport($from_date, $to_date, $schedulesArray);

            $carTypeRepo = new CartypeRepository();
            $carTypes    = $carTypeRepo->getObjs();

            $datesArray = array();
            foreach($carUsage as $usage){
                $datesArray[] = $usage->date;
            }

            $chartDataByDate = array();
            $colorsArray = array();
            foreach($carUsage as $c){
                foreach($datesArray as $d){
                    foreach($carTypes as $t){
                        if($c->date == $d){
                            if($t->id == $c->car_type_id){
                                $chartDataByDate[$d]["date"] = $d;
                                $chartDataByDate[$d]["value".$t->id] = $c->count;
                                $color = "#".Utility::generateColorCode();
                                $chartDataByDate[$d]["lineColor".$t->id] = $color;

                                $colorsArray[$t->name] = $color;
                            }
                        }
                    }
                }
            }

            $chartData = array();
            $chartCount = 0;
            foreach($chartDataByDate as $cdata){
                $chartData[$chartCount] = $cdata;
                $chartCount++;
            }

            $graphData = array();
            $graphCount = 0;
            foreach($carTypes as $types){
                $graphData[$graphCount]["id"] = "g".$types->id;
                $graphData[$graphCount]["balloon"]["drop"] = false;
                $graphData[$graphCount]["balloon"]["adjustBorderColor"] = false;
                $graphData[$graphCount]["balloon"]["color"] = "#ffffff";
                $graphData[$graphCount]["bullet"] = "round";
                $graphData[$graphCount]["bulletBorderAlpha"] = 1;
                $graphData[$graphCount]["bulletColor"] = "#ffffff";
                $graphData[$graphCount]["bulletSize"] = 5;
                $graphData[$graphCount]["hideBulletsCount"] = 50;
                $graphData[$graphCount]["lineThickness"] = 2;
                $graphData[$graphCount]["useLineColorForBulletBorder"] = true;
                $graphData[$graphCount]["valueField"] = "value".$types->id;
                $graphData[$graphCount]["lineColorField"] = "lineColor".$types->id;
                $graphData[$graphCount]["balloonText"] = "<span style='font-size:9px;'>$types->name ([[value]])</span>";
                $graphData[$graphCount]["showAllValueLabels"] = true;
                $graphCount++;
            }

            return view('report.carusagereportbygraph')
                ->with('graphData',$graphData)
                ->with('chartData',$chartData)
                ->with('colorsArray',$colorsArray)
                ->with('from_date',$from_date)
                ->with('to_date',$to_date);
        }
        return redirect('/');
    }
}
