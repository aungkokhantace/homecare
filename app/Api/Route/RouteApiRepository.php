<?php
namespace App\Api\Route;
use App\Backend\Route\Route;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/17/2016
 * Time: 6:03 PM
 */
class RouteApiRepository implements RouteApiRepositoryInterface
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

    public function route($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try{
            $tempLogArr = array();

            foreach($data as $row){
                $id     = $row->id;
                //Check update or create for log date
                $findRoute    = Route::find($id);
                if(isset($findRoute) && count($findRoute) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                //clear all existing data in route relating to input
                DB::table('route')
                    ->where('id', '=', $row->id)
                    ->delete();

                //creating route object
                $paramObj                        = new Route();
                $paramObj->id 			         = $row->id;
                $paramObj->name 		         = $row->name;
                $paramObj->description 	         = $row->description;
                $paramObj->created_by 	         = $row->created_by;
                $paramObj->updated_by 	         = $row->updated_by;
                $paramObj->deleted_by 	         = $row->deleted_by;
                $paramObj->created_at            = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at            = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at            = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                $result = $this->createSingleRow($paramObj);

                //check whether insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' route_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue; //continue to next loop(next row of input route)
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

    public function getRouteArray(){
        $routeArr = DB::select("SELECT * FROM route WHERE deleted_at is null");
        if(isset($routeArr) && count($routeArr) > 0 ){
            foreach($routeArr as $temp){
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

        return $routeArr;

    }
}