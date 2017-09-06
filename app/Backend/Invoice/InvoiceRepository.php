<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/16/2016
 * Time: 2:52 PM
 */

namespace App\Backend\Invoice;


use App\Backend\Invoicedetail\Invoicedetail;
use App\Core\ReturnMessage;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function getObjs()
    {
        $objs = Invoice::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new Packagesale())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }

    public function getObjByID($id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $returnedObj['result'] = array();

        $tempObj = Invoice::find($id);
        if (isset($tempObj) && count($tempObj) > 0) {
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['result'] = $tempObj;
            return $returnedObj;
        }
        else{
            return $returnedObj;
        }
    }

    public function getInvoiceID($id)
    {
        $result = DB::table('invoices')->where('patient_package_id', $id)->value('id');
        return $result;
    }

    public function getInvoiceByPatientID($id){
        $result = Invoice::
            leftjoin('invoice_detail', 'invoice_detail.invoice_id', '=', 'invoices.id')
            ->select('invoices.*','invoice_detail.car_type','invoice_detail.car_type_setup_id')
            ->where('patient_id',$id)
            ->get();
        return $result;
    }

    public function getInvoiceHeaderByPatientID($id){
        $result = Invoice::
            where('patient_id',$id)
//            ->whereNotNull('schedule_id')
            ->get();
        return $result;
    }

    public function getDetails($id)
    {
        $result = Invoicedetail::where('invoice_id', $id)->get();
        return $result;
    }

    public function getInvoicesWithSchedules()
    {
        $result = Invoice::
            whereNull('deleted_at')
            ->whereNotNull('schedule_id')
            ->where('schedule_id','!=',"")
            ->get();
        return $result;
    }

    public function getIncomeSummary($type = null, $from_date = null, $to_date = null)
    {
        $query = Invoice::query();
        $query = $query->select(DB::raw('DATE(created_at) as date'),
            DB::raw('sum(total_car_amount) as total_car_amount'),
            DB::raw('sum(total_service_amount) as total_service_amount'),
            DB::raw('sum(total_medication_amount) as total_medication_amount'),
            DB::raw('sum(total_investigation_amount) as total_investigation_amount'),
            DB::raw('sum(package_price) as package_price'));

        if(isset($type) && $type != null && $type == 'yearly'){
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime('01-01-'.$from_date));
                $query = $query->where('created_at', '>=' , $tempFromDate.' 00:00:00');
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime('31-12-'.$to_date));
                $query = $query->where('created_at', '<=', $tempToDate.' 23:59:59');
            }
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime('01-'.$from_date));
                $query = $query->where('created_at', '>=' , $tempFromDate.' 00:00:00');
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime('31-'.$to_date));
                $query = $query->where('created_at', '<=', $tempToDate.' 23:59:59');
            }
        }
        else{
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime($from_date));
                $query = $query->where('created_at', '>=' , $tempFromDate.' 00:00:00');
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime($to_date));
                $query = $query->where('created_at', '<=', $tempToDate.' 23:59:59');
            }
        }

        $query = $query->whereNull('deleted_at');
        $query = $query->groupBy(DB::raw("DATE(created_at)"));
        $result = $query->get();
        return $result;
    }

    public function getScheduleInvestigations($patientId,$scheduleId){
        $result = DB::select("SELECT * FROM schedule_investigations WHERE deleted_at is null AND patient_id = '$patientId' AND schedule_id = '$scheduleId'");
        return $result;
    }

    public function getInvestigations($id){
        $result = DB::select("SELECT * FROM investigations WHERE id = $id");
        return $result;
    }

    public function getInvestigationLabs($id){
        $result = DB::select("SELECT * FROM investigation_labs WHERE id = $id");
        return $result;
    }

    public function getInvestigationImagings($id){
        $result = DB::select("SELECT * FROM investigations_imaging WHERE id = $id");
        return $result;
    }

    public function getHeader($id){
//        $result = DB::select("SELECT * FROM invoices WHERE id = '$id' and deleted_at is null");
        $result = Invoice::where('id', $id)
            ->whereNull('deleted_at')
            ->first();
        return $result;
    }

    public function getInvoiceByScheduleID($schedule_id){
        $result = Invoice::where('schedule_id', $schedule_id)
            ->whereNull('deleted_at')
            ->first();
        return $result;
    }

    public function getEachServiceProfitByMonth($month, $service_id){
        $result = Invoice::leftjoin('schedules', 'invoices.schedule_id', '=', 'schedules.id')
            ->leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
            ->select(DB::raw('sum(invoices.total_payable_amt) as amount'))
            ->whereMonth('schedules.date','=', $month)
            ->whereYear('schedules.date','=',date('Y'))
            ->where('schedule_detail.service_id', $service_id)
            ->where('schedule_detail.type', 'service')
            ->where('schedules.status', 'complete')
            ->whereNull('invoices.deleted_at')
            ->whereNull('schedules.deleted_at')
            ->get();

        $amount = $result[0]->amount;
        return $amount;
    }
    

    // public function getEachProfitByMonth($month,$service_id) {
    //     $result = Schedule::leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
    //         ->where('schedule_detail.service_id','=',$service_id)
    //         ->where('schedules.status','=','complete')
    //         ->whereYear('schedules.date','=',date('Y'))
    //         ->whereMonth('schedules.date','=',$month)
    //         ->get();
            
    //     return $result;
    // }

    public function getPackageSaleProfitByMonth($month) {
        $result = Invoice::leftjoin('patient_package', 'patient_package.id', '=', 'invoices.patient_package_id')
            ->select(DB::raw('sum(invoices.total_payable_amt) as amount'))
            ->whereYear('patient_package.sold_date','=',date('Y'))
            ->whereMonth('patient_package.sold_date','=',$month)
            ->where('invoices.type','=','package')
            ->get();
                
        $amount = $result[0]->amount;
        return $amount;

    }

    public function getIncomeSummaryByType($type = null, $from_date = null, $to_date = null)
    {
        $query = Invoice::query();

        $query = $query->leftjoin('schedules', 'schedules.id', '=', 'invoices.schedule_id');
        $query = $query->leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id');

        if(isset($type) && $type != null && $type == 'yearly'){
            $query = $query->select(DB::raw('DATE_FORMAT(invoices.created_at,"%Y") as date'),
            DB::raw('sum(invoices.total_car_amount) as total_car_amount'),
            DB::raw('sum(invoices.total_service_amount) as total_service_amount'),
            DB::raw('sum(invoices.total_medication_amount) as total_medication_amount'),
            DB::raw('sum(invoices.total_investigation_amount) as total_investigation_amount'),
            DB::raw('sum(invoices.total_consultant_fee) as total_consultant_amount'),
            DB::raw('sum(invoices.package_price) as package_price'),
            DB::raw('sum(invoices.total_other_service_amount) as total_other_service_amount'),
            DB::raw('sum(invoices.total_tax_amt) as total_tax_amount'));
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            $query = $query->select(DB::raw('DATE_FORMAT(invoices.created_at,"%m-%Y") as date'),
            DB::raw('sum(invoices.total_car_amount) as total_car_amount'),
            DB::raw('sum(invoices.total_service_amount) as total_service_amount'),
            DB::raw('sum(invoices.total_medication_amount) as total_medication_amount'),
            DB::raw('sum(invoices.total_investigation_amount) as total_investigation_amount'),
            DB::raw('sum(invoices.total_consultant_fee) as total_consultant_amount'),
            DB::raw('sum(invoices.package_price) as package_price'),
            DB::raw('sum(invoices.total_other_service_amount) as total_other_service_amount'),
            DB::raw('sum(invoices.total_tax_amt) as total_tax_amount'));
        }
        else{
            $query = $query->select(DB::raw('DATE_FORMAT(invoices.created_at,"%d-%m-%Y") as date'),
            DB::raw('sum(invoices.total_car_amount) as total_car_amount'),
            DB::raw('sum(invoices.total_service_amount) as total_service_amount'),
            DB::raw('sum(invoices.total_medication_amount) as total_medication_amount'),
            DB::raw('sum(invoices.total_investigation_amount) as total_investigation_amount'),
            DB::raw('sum(invoices.total_consultant_fee) as total_consultant_amount'),
            DB::raw('sum(invoices.package_price) as package_price'),
            DB::raw('sum(invoices.total_other_service_amount) as total_other_service_amount'),
            DB::raw('sum(invoices.total_tax_amt) as total_tax_amount'));
        }

        if(isset($type) && $type != null && $type == 'yearly'){
            if(isset($from_date) && $from_date != null){
                $temp_from_date = "01-01-".$from_date;
                $from_year = date("Y", strtotime($temp_from_date));
                $query = $query->whereYear('invoices.created_at','>=',$from_year);
            }
            if(isset($to_date) && $to_date != null){
                $temp_to_date = "01-01-".$to_date;
                $to_year = date("Y", strtotime($temp_to_date));
                $query = $query->whereYear('invoices.created_at','<=',$to_year);
            }
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            if(isset($from_date) && $from_date != null){
                $temp_from_date = "01-".$from_date;
                $from_month = date("m", strtotime($temp_from_date));
                $query = $query->whereMonth('invoices.created_at','>=',$from_month);
            }
            if(isset($to_date) && $to_date != null){
                $temp_to_date = "01-".$to_date;
                $to_month = date("m", strtotime($temp_to_date));
                $query = $query->whereMonth('invoices.created_at','<=',$to_month);
            }
        }
        else{
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime($from_date));
                $query = $query->where('invoices.created_at', '>=' , $tempFromDate.' 00:00:00');
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime($to_date));
                $query = $query->where('invoices.created_at', '<=', $tempToDate.' 23:59:59');
            }
        }

        $query = $query->whereNull('invoices.deleted_at');
        if(isset($type) && $type != null && $type == 'yearly'){
            $query = $query->groupBy(DB::raw("YEAR(invoices.created_at)"));
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            $query = $query->groupBy(DB::raw("MONTH(invoices.created_at)"));
        }
        else{
            $query = $query->groupBy(DB::raw("DATE(invoices.created_at)"));
        }

        // $query = $query->orderBy(DB::raw('DATE_FORMAT(invoices.created_at,"%Y-%m-%d"'));
        // $query = $query->orderBy(DB::raw('STR_TO_DATE(invoices.created_at,"%d-%m-%Y")','desc'));
        $result = $query->get();
        return $result;
    }

    public function getEachServiceIncome($type = null, $from_date = null, $to_date = null,$scheduleArray = [])
    {
        $query = Invoice::query();

        $query = $query->leftjoin('schedules', 'schedules.id', '=', 'invoices.schedule_id');
        $query = $query->leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id');
        
        if(isset($type) && $type != null && $type == 'yearly'){
            $query = $query->select(DB::raw('DATE_FORMAT(invoices.created_at,"%Y") as date'),
            DB::raw('sum(invoices.total_car_amount) as total_car_amount'),
            DB::raw('sum(invoices.total_service_amount) as total_service_amount'),
            DB::raw('sum(invoices.total_medication_amount) as total_medication_amount'),
            DB::raw('sum(invoices.total_investigation_amount) as total_investigation_amount'),
            DB::raw('sum(invoices.total_consultant_fee) as total_consultant_amount'),
            DB::raw('sum(invoices.package_price) as package_price'),
            DB::raw('sum(invoices.total_other_service_amount) as total_other_service_amount'),
            DB::raw('sum(invoices.total_tax_amt) as total_tax_amount'));
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            $query = $query->select(DB::raw('DATE_FORMAT(invoices.created_at,"%m-%Y") as date'),
            DB::raw('sum(invoices.total_car_amount) as total_car_amount'),
            DB::raw('sum(invoices.total_service_amount) as total_service_amount'),
            DB::raw('sum(invoices.total_medication_amount) as total_medication_amount'),
            DB::raw('sum(invoices.total_investigation_amount) as total_investigation_amount'),
            DB::raw('sum(invoices.total_consultant_fee) as total_consultant_amount'),
            DB::raw('sum(invoices.package_price) as package_price'),
            DB::raw('sum(invoices.total_other_service_amount) as total_other_service_amount'),
            DB::raw('sum(invoices.total_tax_amt) as total_tax_amount'));
        }
        else{
            $query = $query->select(DB::raw('DATE_FORMAT(invoices.created_at,"%d-%m-%Y") as date'),
            DB::raw('sum(invoices.total_car_amount) as total_car_amount'),
            DB::raw('sum(invoices.total_service_amount) as total_service_amount'),
            DB::raw('sum(invoices.total_medication_amount) as total_medication_amount'),
            DB::raw('sum(invoices.total_investigation_amount) as total_investigation_amount'),
            DB::raw('sum(invoices.total_consultant_fee) as total_consultant_amount'),
            DB::raw('sum(invoices.package_price) as package_price'),
            DB::raw('sum(invoices.total_other_service_amount) as total_other_service_amount'),
            DB::raw('sum(invoices.total_tax_amt) as total_tax_amount'));
        }

        if(isset($type) && $type != null && $type == 'yearly'){
            if(isset($from_date) && $from_date != null){
                $temp_from_date = "01-01-".$from_date;
                $from_year = date("Y", strtotime($temp_from_date));
                $query = $query->whereYear('invoices.created_at','>=',$from_year);
            }
            if(isset($to_date) && $to_date != null){
                $temp_to_date = "01-01-".$to_date;
                $to_year = date("Y", strtotime($temp_to_date));
                $query = $query->whereYear('invoices.created_at','<=',$to_year);
            }
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            if(isset($from_date) && $from_date != null){
                $temp_from_date = "01-".$from_date;
                $from_month = date("m", strtotime($temp_from_date));
                $query = $query->whereMonth('invoices.created_at','>=',$from_month);
            }
            if(isset($to_date) && $to_date != null){
                $temp_to_date = "01-".$to_date;
                $to_month = date("m", strtotime($temp_to_date));
                $query = $query->whereMonth('invoices.created_at','<=',$to_month);
            }
        }
        else{
            if(isset($from_date) && $from_date != null){
                $tempFromDate = date("Y-m-d", strtotime($from_date));
                $query = $query->where('invoices.created_at', '>=' , $tempFromDate.' 00:00:00');
            }
            if(isset($to_date) && $to_date != null){
                $tempToDate = date("Y-m-d", strtotime($to_date));
                $query = $query->where('invoices.created_at', '<=', $tempToDate.' 23:59:59');
            }
        }

        $query = $query->whereNull('invoices.deleted_at');
        if(isset($type) && $type != null && $type == 'yearly'){
            $query = $query->groupBy(DB::raw("YEAR(invoices.created_at)"));
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            $query = $query->groupBy(DB::raw("MONTH(invoices.created_at)"));
        }
        else{
            $query = $query->groupBy(DB::raw("DATE(invoices.created_at)"));
        }
        $result = $query->get();
        return $result;
    }

    public function getInvoiceListByDate($date,$type){
        if(isset($type) && $type == "yearly"){
            $date = "01-01-".$date;
        }
        else if(isset($type) && $type == "monthly"){
            $date = "01-".$date;
        }
        
        $formatted_date = date("Y-m-d", strtotime($date));
        
        $month=date("m",strtotime($formatted_date));
        $year=date("Y",strtotime($formatted_date));
        
    
        // $result = Invoice::leftjoin('schedules', 'schedules.id', '=', 'invoices.schedule_id')
        //                     ->leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id')
        //                     ->leftjoin('patients', 'patients.user_id', '=', 'invoices.patient_id')
        //                     ->leftjoin('core_users', 'core_users.id', '=', 'schedules.leader_id')
        //                     ->leftjoin('services', 'services.id', '=', 'schedule_detail.service_id')
        //                     ->select('invoices.id as invoice_id',DB::raw('DATE_FORMAT(invoices.created_at,"%Y-%m-%d") as date'),'patients.name as patient_name','services.name as service','core_users.name as doctor','invoices.total_payable_amt as total')
        //                     ->whereDate('invoices.created_at','=',$formatted_date)
        //                     ->where('schedule_detail.type','=','service')
        //                     ->get();

        $query = Invoice::query();
        $query = $query->leftjoin('schedules', 'schedules.id', '=', 'invoices.schedule_id');
        $query = $query->leftjoin('schedule_detail', 'schedule_detail.schedule_id', '=', 'schedules.id');
        $query = $query->leftjoin('patients', 'patients.user_id', '=', 'invoices.patient_id');
        $query = $query->leftjoin('core_users', 'core_users.id', '=', 'schedules.leader_id');
        $query = $query->leftjoin('services', 'services.id', '=', 'schedule_detail.service_id');
        $query = $query->select('invoices.id as invoice_id',DB::raw('DATE_FORMAT(invoices.created_at,"%Y-%m-%d") as date'),'patients.name as patient_name','services.name as service','core_users.name as doctor','invoices.total_payable_amt as total');
        if($type == "yearly"){
            $query = $query->whereYear('invoices.created_at','=',$formatted_date);
        }
        elseif($type == "monthly"){
            $query = $query->whereMonth('invoices.created_at','=',$month);
            $query = $query->whereYear('invoices.created_at','=',$year);
        }
        else{
            $query = $query->whereDate('invoices.created_at','=',$formatted_date);
        }
        
        $query = $query->where('schedule_detail.type','=','service');
        $result = $query->get();
        
                            
        return $result;
    }
}