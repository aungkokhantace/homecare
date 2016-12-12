<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:24 PM
 */

namespace App\Core\Permission;

use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getObjs()
    {
        $roles = Permission::whereNull('deleted_at')->get();
        return $roles;
    }

    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            //create info log
            $date = $tempObj->created_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created permission_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a permission and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {

            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            //update info log
            $date = $tempObj->updated_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated permission_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated permission_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            if($id != 1){
                $tempObj = Permission::find($id);
                $tempObj = Utility::addDeletedBy($tempObj);
                $tempObj->deleted_at = date('Y-m-d H:m:i');
                $tempObj->save();

                //delete info log
                $date = $tempObj->deleted_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted permission_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);
            }
            else{
                //delete error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  permission_id = 1 and got error'. PHP_EOL;
                LogCustom::create($date,$message);
            }
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  permission_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){
        $role = Permission::find($id);
        return $role;
    }

    public static function getPermissionsByRoleId($roleId){

        $permissionIds = DB::table('core_permission_role')
            ->where('role_id', '=', $roleId)
            ->whereNull('deleted_at')
            ->get();

        $result = array();

        if (count($permissionIds) > 0) {

            $countPermission = 0;

            foreach($permissionIds as $id){

                $permission = Permission::where('id', '=' ,$id->permission_id)
                    ->whereNull('deleted_at')->first()->toArray();

                $result[$countPermission] = $permission;
                $countPermission++;
            }

            return $result;
        }
        else{
            return null;
        }

    }
}