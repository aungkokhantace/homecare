<?php
namespace App\Api\Transactionpromotion;
use App\Backend\Scheduletracking\Scheduletracking;
use App\Backend\Waytracking\Waytracking;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;
use App\Backend\Schedule\Schedule;
use App\Backend\Scheduledetail\Scheduledetail;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 2017-03-23
 * Time: 03:21 PM
 */
class TransactionpromotionApiRepository implements TransactionpromotionApiRepositoryInterface
{
    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $paramObj->save();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function createMultipleRows($data,$tablet_id,$user_id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr     = array();
            foreach($data as $row){
                $id = $row->id;
                //Check update or create for log date
                $findObj    = Transactionpromotion::find($id);

                $tempArr['date'] = date("Y-m-d H:i:s");

                if(isset($findObj) && count($findObj) > 0){
                    $create = "updated";
                }
                else{
                    $create = "created";
                }

                //delete existing schedules data which is the same as input data
                DB::table('transaction_promotions')
                    ->where('id', '=', $id)
                    ->delete();
                //end clearing all existing data relating to input data

                DB::table('transaction_promotions')->insert([
                    [
                        'id' => $row->id,
                        'promotion_code' => $row->promotion_code,
                        'reference_type' => $row->reference_type,
                        'reference_id' => $row->reference_id,
                        'package_id' => $row->package_id,
                        'used' => $row->used,
                        'promo_group_code' => $row->promo_group_code,
                        'promo_group_code_order' => $row->promo_group_code_order,
                        'remark' => $row->remark,
                    ]
                ]);
                ///////////////////////////

                //if insertion was successful, then create date and message for log
                $tempArr['message'] = $create.' transaction_promotion_id = '.$row->id;
                array_push($tempLogArr,$tempArr);

                continue;
            }

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log']               = $tempLogArr;
            $returnedObj['data'] ="SUCCESS";

            return $returnedObj;
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }

    }
}