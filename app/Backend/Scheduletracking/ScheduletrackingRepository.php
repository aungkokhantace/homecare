<?php
/**
 * Author: Aung Ko Khant
 * Date: 2018-01-25
 * Time: 03:36 PM
 */

namespace App\Backend\Scheduletracking;
use App\Backend\Enquiry\EnquiryRepository;
use App\Backend\Invoice\Invoice;
use App\Backend\Schedule\Schedule;
use App\Backend\Scheduledetail\Scheduledetail;
use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Service\ServiceRepository;
use App\Backend\Enquiry\Enquiry;

class ScheduletrackingRepository implements  ScheduletrackingRepositoryInterface
{
  public function getscheduleTrackings($type,$from_date,$to_date){
      // $result = Scheduletracking::leftjoin('schedules','schedules.id','=','schedule_trackings.schedule_id')
      //                     ->select('schedule_trackings.*')
      //                     ->where('schedules.status','=','complete')
      //                     ->whereNull('schedules.deleted_at')
      //                     ->orderBy('schedules.date','desc')
      //                     ->get();

      $query = ScheduleTracking::query();

      if(isset($type) && $type != null && $type == 'yearly'){
          if(isset($from_date) && $from_date != null){
              $temp_from_date = "01-01-".$from_date;
              $from_year = date("Y", strtotime($temp_from_date));
              $query = $query->whereYear('schedules.date','>=',$from_year);
          }
          if(isset($to_date) && $to_date != null){
              $temp_to_date = "01-01-".$to_date;
              $to_year = date("Y", strtotime($temp_to_date));
              $query = $query->whereYear('schedules.date','<=',$to_year);
          }
      }
      else if(isset($type) && $type != null && $type == 'monthly'){
          if(isset($from_date) && $from_date != null){
              $temp_from_date = "01-".$from_date;
              $from_month = date("m", strtotime($temp_from_date));
              $query = $query->whereMonth('schedules.date','>=',$from_month);
          }
          if(isset($to_date) && $to_date != null){
              $temp_to_date = "01-".$to_date;
              $to_month = date("m", strtotime($temp_to_date));
              $query = $query->whereMonth('schedules.date','<=',$to_month);
          }
      }
      else{
          if(isset($from_date) && $from_date != null){
              $tempFromDate = date("Y-m-d", strtotime($from_date));
              $query = $query->where('schedules.date', '>=' , $tempFromDate);
          }
          if(isset($to_date) && $to_date != null){
              $tempToDate = date("Y-m-d", strtotime($to_date));
              $query = $query->where('schedules.date', '<=', $tempToDate);
          }
      }

      $query = $query->leftjoin('schedules','schedules.id','=','schedule_trackings.schedule_id');
      $query = $query->select('schedule_trackings.*');
      $query = $query->whereNull('schedules.deleted_at');
      $query = $query->where('schedules.status','=','complete');
      $query = $query->orderBy('schedules.date','desc');
      $result = $query->get();
      // dd('result',$result);
      return $result;
  }

  public function getObjByID($id){
      $result = ScheduleTracking::find($id);
      return $result;
  }
}
