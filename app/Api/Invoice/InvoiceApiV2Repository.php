<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/12/2016
 * Time: 2:16 PM
 */

namespace App\Api\Invoice;


use App\Backend\Invoice\Invoice;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

class InvoiceApiV2Repository implements InvoiceApiV2RepositoryInterface
{
    public function createSingleRow($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['id'] = $tempObj->id;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function invoices($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try{
            $tempLogArr = array();

            foreach($data as $row){

                $id = $row->id;
                $patient_id = $row->patient_id;
//                $schedule_id = $row->schedule_id;

                //Check update or create for log date
                $findInvoice    = Invoice::find($id);
                if(isset($findInvoice) && count($findInvoice) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in invoice_detail relating to input
                DB::table('invoice_detail')
                    ->where('invoice_id', '=', $id)
                    ->delete();



                //clear all existing data in invoices relating to input
                DB::table('invoices')
                    ->where('id', '=', $id)
                    ->where('patient_id', '=', $patient_id)
//                    ->where('schedule_id','=',$schedule_id)
                    ->delete();

                //creating invoice object
                $paramObj = new Invoice();
                $paramObj->id                                   = $row->id;
                $paramObj->patient_id                           = $row->patient_id;
                $paramObj->schedule_id                          = $row->schedule_id;
                $paramObj->zone_id                              = $row->zone_id;
                $paramObj->township_id                          = $row->township_id;
                $paramObj->total_car_amount                     = $row->total_car_amount;
                $paramObj->total_medication_amount              = $row->total_medication_amount;
                $paramObj->total_investigation_amount           = $row->total_investigation_amount;
                $paramObj->total_service_amount                 = $row->total_service_amount;
                $paramObj->total_other_service_amount           = $row->total_other_service_amount;
                $paramObj->total_consultant_fee                 = $row->total_consultant_fee;
                $paramObj->total_consultant_discount_amount     = $row->total_consultant_discount_amount;
                $paramObj->total_nett_amt_wo_disc               = $row->total_nett_amt_wo_disc;
                $paramObj->total_disc_amt                       = $row->total_disc_amt;
                $paramObj->total_disc_percent                   = $row->total_disc_percent;
                $paramObj->total_nett_amt_w_disc                = $row->total_nett_amt_w_disc;
                $paramObj->tax_rate                             = $row->tax_rate;
                $paramObj->total_tax_amt                        = $row->total_tax_amt;
                $paramObj->total_payable_amt                    = $row->total_payable_amt;
                $paramObj->status                               = $row->status;
                $paramObj->accepted_by                          = $row->accepted_by;
                $paramObj->schedule_start_time                  = $row->schedule_start_time;
                $paramObj->schedule_end_time                    = $row->schedule_end_time;
                $paramObj->patient_package_id                   = (isset($row->patient_package_id) && $row->patient_package_id !== 0)? $row->patient_package_id:"";
                $paramObj->package_id                           = $row->package_id;
                $paramObj->package_price                        = $row->package_price;
                $paramObj->type                                 = $row->type;
                $paramObj->created_by                           = $row->created_by;
                $paramObj->updated_by                           = $row->updated_by;
                $paramObj->deleted_by                           = $row->deleted_by;
                $paramObj->created_at                           = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at                           = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at                           = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {
                    //if insertion was successful, continue to child tables and do next loop

                    //start insertion of invoice_detail
                    if (isset($row->invoice_detail) && count($row->invoice_detail) > 0) {
                        foreach ($row->invoice_detail as $detail) {
                            DB::table('invoice_detail')->insert([
                                [
                                    'invoice_id' => $detail->invoice_id, 'type' => $detail->type, 'product_id' => $detail->product_id,
                                    'product_qty' => $detail->product_qty, 'product_price' => $detail->product_price,
                                    'product_amount' => $detail->product_amount, 'service_type_id' => $detail->service_type_id,
                                    'service_price' => $detail->service_price,'consultant_id' => $detail->consultant_id,
                                    'consultant_fee' => $detail->consultant_fee,
                                    'consultant_discount_percentage' => $detail->consultant_discount_percentage,
                                    'consultant_discount_amount' => $detail->consultant_discount_amount,'car_type' => $detail->car_type,
                                    'car_type_setup_id' => $detail->car_type_setup_id,'car_type_price' => $detail->car_type_price,
                                    'other_service' => $detail->other_service, 'other_service_price' => $detail->other_service_price,
                                    'other_service_remark' => $detail->other_service_remark
                                ]
                            ]);
                        }
                    }
                    //end insertion of invoice_detail

                    //if insertion was successful, then create message for log
                    $tempArr['message'] = $create.' invoice_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);

                    continue; //continue to next loop(next row of input invoice)


                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

}