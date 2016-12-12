<?php
namespace App\Api\Invoice;
use App\Backend\Invoice\Invoice;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/15/2016
 * Time: 5:20 PM
 */
class InvoiceApiRepository implements InvoiceApiRepositoryInterface
{
    public function getObjById($invoiceId)
    {
        $invoice    = Invoice::find($invoiceId);

        return $invoice;
    }

    public function create($paramObj,$invoice_details)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            DB::beginTransaction();
            $tempObj = Utility::addCreatedBy($paramObj);

            if($tempObj->save()){

                // Saving invoice_detail
                if(isset($invoice_details) && count($invoice_details)>0) {
                    foreach($invoice_details as $detail){
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

                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($paramObj,$invoice_details,$invoiceId)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {

            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);

            if($tempObj->save()){

                // Cleaning all invoice_detail about the selected invoice
                DB::table('invoice_detail')->where('invoice_id', '=', $invoiceId)->delete();

                // Saving invoice_detail
                if(isset($invoice_details) && count($invoice_details)>0) {
                    foreach($invoice_details as $detail){
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

                DB::commit();
                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function createInvoice($params){
        $returnedObj                            = array();
        $returnedObj['aceplusStatusCode']       = ReturnMessage::INTERNAL_SERVER_ERROR;
        $returnedObj['aceplusStatusMessage']    = "";

        try {
            DB::beginTransaction();
            foreach($params as $data){
                $invoiceRepo                = new InvoiceApiRepository();
                $invoice                    = $invoiceRepo->getObjById($data->id);

                if(isset($invoice) && $invoice->id == $data->id){
                    $paramObj                                       = $invoice;
                    $paramObj->id                                   = $data->id;
                    $paramObj->patient_id                           = $data->patient_id;
                    $paramObj->schedule_id                          = $data->schedule_id;
                    $paramObj->zone_id                              = $data->zone_id;
                    $paramObj->township_id                          = $data->township_id;
                    $paramObj->total_car_amount                     = $data->total_car_amount;
                    $paramObj->total_medication_amount              = $data->total_medication_amount;
                    $paramObj->total_investigation_amount           = $data->total_investigation_amount;
                    $paramObj->total_service_amount                 = $data->total_service_amount;
                    $paramObj->total_other_service_amount           = $data->total_other_service_amount;
                    $paramObj->total_consultant_fee                 = $data->total_consultant_fee;
                    $paramObj->total_consultant_discount_amount     = $data->total_consultant_discount_amount;
                    $paramObj->total_nett_amt_wo_disc               = $data->total_nett_amt_wo_disc;
                    $paramObj->total_disc_amt                       = $data->total_disc_amt;
                    $paramObj->total_disc_percent                   = $data->total_disc_percent;
                    $paramObj->total_nett_amt_w_disc                = $data->total_nett_amt_w_disc;
                    $paramObj->tax_rate                             = $data->tax_rate;
                    $paramObj->total_tax_amt                        = $data->total_tax_amt;
                    $paramObj->total_payable_amt                    = $data->total_payable_amt;
                    $paramObj->status                               = $data->status;
                    $paramObj->accepted_by                          = $data->accepted_by;
                    $paramObj->schedule_start_time                  = $data->schedule_start_time;
                    $paramObj->schedule_end_time                    = $data->schedule_end_time;
                    $paramObj->patient_package_id                   = $data->patient_package_id;
                    $paramObj->package_id                           = $data->package_id;
                    $paramObj->package_price                        = $data->package_price;
                    $paramObj->created_by                           = $data->created_by;
                    $paramObj->updated_by                           = $data->updated_by;
                    $paramObj->deleted_by                           = $data->deleted_by;
                    $paramObj->created_at                           = (isset($data->created_at) && $data->created_at != "") ? $data->created_at:null;
                    $paramObj->updated_at                           = (isset($data->updated_at) && $data->updated_at != "") ? $data->updated_at:null;
                    $paramObj->deleted_at                           = (isset($data->deleted_at) && $data->deleted_at != "") ? $data->deleted_at:null;

                    $tempObj                                        = Utility::addUpdatedBy($paramObj);
                }
                else{
                    $paramObj                                       = new Invoice();
                    $paramObj->id                                   = $data->id;
                    $paramObj->patient_id                           = $data->patient_id;
                    $paramObj->schedule_id                          = $data->schedule_id;
                    $paramObj->zone_id                              = $data->zone_id;
                    $paramObj->township_id                          = $data->township_id;
                    $paramObj->total_car_amount                     = $data->total_car_amount;
                    $paramObj->total_medication_amount              = $data->total_medication_amount;
                    $paramObj->total_investigation_amount           = $data->total_investigation_amount;
                    $paramObj->total_service_amount                 = $data->total_service_amount;
                    $paramObj->total_other_service_amount           = $data->total_other_service_amount;
                    $paramObj->total_consultant_fee                 = $data->total_consultant_fee;
                    $paramObj->total_consultant_discount_amount     = $data->total_consultant_discount_amount;
                    $paramObj->total_nett_amt_wo_disc               = $data->total_nett_amt_wo_disc;
                    $paramObj->total_disc_amt                       = $data->total_disc_amt;
                    $paramObj->total_disc_percent                   = $data->total_disc_percent;
                    $paramObj->total_nett_amt_w_disc                = $data->total_nett_amt_w_disc;
                    $paramObj->tax_rate                             = $data->tax_rate;
                    $paramObj->total_tax_amt                        = $data->total_tax_amt;
                    $paramObj->total_payable_amt                    = $data->total_payable_amt;
                    $paramObj->status                               = $data->status;
                    $paramObj->accepted_by                          = $data->accepted_by;
                    $paramObj->schedule_start_time                  = $data->schedule_start_time;
                    $paramObj->schedule_end_time                    = $data->schedule_end_time;
                    $paramObj->patient_package_id                   = $data->patient_package_id;
                    $paramObj->package_id                           = $data->package_id;
                    $paramObj->package_price                        = $data->package_price;
                    $paramObj->created_by                           = $data->created_by;
                    $paramObj->updated_by                           = $data->updated_by;
                    $paramObj->deleted_by                           = $data->deleted_by;
                    $paramObj->created_at                           = $data->created_at;
                    $paramObj->updated_at                           = $data->updated_at;
                    $paramObj->deleted_at                           = $data->deleted_at;

                    $tempObj                                        = Utility::addCreatedBy($paramObj);
                }



                if($tempObj->save()){
                    $invoice_details    = $data->invoice_detail;

                    // Cleaning all invoice_detail about the selected invoice
                    DB::table('invoice_detail')->where('invoice_id', '=', $data->id)->delete();

                    // Saving invoice_detail
                    if(isset($invoice_details) && count($invoice_details)>0) {
                        foreach($invoice_details as $detail){
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

                }
                else{
                    DB::rollBack();
                    $returnedObj['aceplusStatusMessage'] = "Error in DB operation!";
                    return $returnedObj;
                }
            }
            DB::commit();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }
}