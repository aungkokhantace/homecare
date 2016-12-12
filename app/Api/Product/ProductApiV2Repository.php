<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/17/2016
 * Time: 10:19 AM
 */

namespace App\Api\Product;


use App\Backend\Product\Product;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

class ProductApiV2Repository implements ProductApiV2RepositoryInterface
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

    public function products($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $tempLogArr = array();

            foreach($data as $row){
                $id                  = $row->id;

                //Check update or create for log date
                $findProduct    = Product::find($id);
                if(isset($findProduct) && count($findProduct) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in products relating to input
                DB::table('products')
                    ->where('id', '=', $id)
                    ->delete();

                //creating products object
                $paramObj                       = new Product();
                $paramObj->id 					= $row->id;
                $paramObj->product_category_id 	= $row->product_category_id;
                $paramObj->product_name 		= $row->product_name;
                $paramObj->price 				= $row->price;
                $paramObj->description 			= $row->description;
                $paramObj->created_by 			= $row->created_by;
                $paramObj->updated_by 			= $row->updated_by;
                $paramObj->deleted_by 			= $row->deleted_by;
                $paramObj->created_at           = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at           = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at           = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;


                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' product_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input products)
                }
                else {
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['log'] = $tempLogArr;
            return $returnedObj;
        }
        catch(\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function getProductArray(){

        $productArr = DB::select("SELECT * FROM products WHERE deleted_at is null");

        if(isset($productArr) && count($productArr) > 0){
            foreach($productArr as $temp){
                if($temp->created_at == null){
                    $temp->created_at = "";
                }
                if($temp->updated_at == null){
                    $temp->updated_at = "";
                }
                if($temp->deleted_at == null){
                    $temp->deleted_at = "";
                }
            }
        }

        return $productArr;
    }
}