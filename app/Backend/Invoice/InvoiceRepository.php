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
}