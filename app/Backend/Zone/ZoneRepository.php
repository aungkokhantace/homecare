<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:48 PM
 */
namespace App\Backend\Zone;
use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Backend\Township\TownshipRepository;

class ZoneRepository implements ZoneRepositoryInterface
{
    public function getObjs()
    {
        $objs = Zone::whereNull('deleted_at')->get();
        return $objs;
    }

    public function create($paramObj,$childArray)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            DB::beginTransaction();
            $tempObj = Utility::addCreatedBy($paramObj);
            if($tempObj->save()){
                $zone_id = $tempObj->id;
                if(isset($childArray) && count($childArray)>0){
                    foreach($childArray as $township_id){
                        DB::table('zone_detail')->insert([
                            ['zone_id' => $zone_id, 'township_id' => $township_id]
                        ]);
                    }
                }
                DB::commit();

                //create info log
                $date = $tempObj->created_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created zone_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();

                //create error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a zone and got error';
                LogCustom::create($date,$message);

                return $returnedObj;
            }
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a zone and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function update($paramObj,$childArray)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            DB::beginTransaction();
            $tempObj = Utility::addUpdatedBy($paramObj);
            if($tempObj->save()){

                $zone_id = $tempObj->id;
                DB::table('zone_detail')->where('zone_id', '=', $zone_id)->delete();

                if(isset($childArray) && count($childArray)>0){
                    foreach($childArray as $township_id){
                        DB::table('zone_detail')->insert([
                            ['zone_id' => $zone_id, 'township_id' => $township_id]
                        ]);
                    }
                }
                DB::commit();

                //update info log
                $date = $tempObj->updated_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated zone_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                return $returnedObj;
            }
            else{
                DB::rollBack();
                return $returnedObj;
            }
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated  zone_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = Zone::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);
            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->save();

            //delete info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted zone_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  zone_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){

        $obj = Zone::find($id);
        $childArray = DB::select("SELECT township_id FROM zone_detail WHERE zone_id = $id");

        $townshipRepo = new TownshipRepository();
        $townships      = $townshipRepo->getArrays();
        
        if(isset($childArray) && count($childArray)>0){

            $tempTspArray = array();
            foreach($childArray as $township){
                $tspId = $township->township_id;
                array_push($tempTspArray,$tspId);
            }

            if(isset($townships) && count($townships)>0){
                foreach($townships as $keyTsp => $tsp){
                    if (in_array($tsp->id, $tempTspArray)) {
                        $townships[$keyTsp]->selected = 1;
                    }
                }

                foreach($townships as $keyTsp2 => $tsp2){
                    if (!array_key_exists('selected', $tsp2)) {
                        $townships[$keyTsp2]->selected = 0;
                    }
                }
            }
            $obj['townships'] = $townships;
        }
        else{

            foreach($townships as $keyTsp3 => $tsp3){
                $townships[$keyTsp3]->selected = 0;
            }
            $obj['townships'] = $townships;
        }
        return $obj;
    }

    public function getObjByIDForEdit($id){

        $obj = Zone::find($id);
        $childArray = DB::select("SELECT township_id FROM zone_detail WHERE zone_id = $id");

        $townshipRepo = new TownshipRepository();
//        $townships      = $townshipRepo->getArrays();
        $usedTownships      = $this->getUsedTownshipsInOtherZones($id);
        $usedTownshipsArray = array();
        foreach($usedTownships as $used){
            array_push($usedTownshipsArray,$used->township_id);
        }

        $townships      = $townshipRepo->getArraysUnusedTownships($usedTownshipsArray);
        if(isset($childArray) && count($childArray)>0){

            $tempTspArray = array();
            foreach($childArray as $township){
                $tspId = $township->township_id;
                array_push($tempTspArray,$tspId);
            }

            if(isset($townships) && count($townships)>0){
                foreach($townships as $keyTsp => $tsp){
                    if (in_array($tsp->id, $tempTspArray)) {
                        $townships[$keyTsp]->selected = 1;
                    }
                }

                foreach($townships as $keyTsp2 => $tsp2){
                    if (!array_key_exists('selected', $tsp2)) {
                        $townships[$keyTsp2]->selected = 0;
                    }
                }
            }
            $obj['townships'] = $townships;
        }
        else{

            foreach($townships as $keyTsp3 => $tsp3){
                $townships[$keyTsp3]->selected = 0;
            }
            $obj['townships'] = $townships;
        }
        return $obj;
    }

    //retrieve zone_id from township_id
    public function getZoneId($townships){
        $zone_id = DB::table('zone_detail')->where('township_id', $townships)->value('zone_id');
        $zone = DB::table('zones')->where('id', $zone_id)->value('id');
        return $zone;
    }
    //retrieve zone_id from township_id


    public function getZonePrice($zone_id)
    {
        $zone_price = DB::table('zones')->where('id', $zone_id)->value('price');
        return $zone_price;
    }

    public function getUsedTownships(){
        $result = DB::select("SELECT township_id FROM zone_detail");
        return $result;
    }

    public function getUsedTownshipsInOtherZones($zone_id){
        $result = DB::select("SELECT township_id FROM zone_detail where zone_id != $zone_id");
        return $result;
    }

    public function checkToDelete($id){
        $result = DB::select("SELECT * FROM car_type_setup WHERE zone_id = $id AND deleted_at IS NULL");
        return $result;
    }
}