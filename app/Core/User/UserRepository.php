<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 6/21/2016
 * Time: 3:51 PM
 */
namespace App\Core\User;

use App\Log\LogCustom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Core\Permission\PermissionRepository;
use App\Core\Utility;
use App\Core\ReturnMessage;

class UserRepository implements UserRepositoryInterface
{

    public function getObjs()
    {
        $objs = User::whereNull('deleted_at')->get();
        return $objs;
    }

    public function create($userObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            $tempObj = Utility::addCreatedBy($userObj);
            $tempObj->save();

            //create info log
            $date = $tempObj->created_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created user_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['staff']          = $tempObj;
            return $returnedObj;
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a user and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($userObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {

            $tempObj = Utility::addUpdatedBy($userObj);
            $tempObj->save();

            //update info log
            $date = $tempObj->updated_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated user_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated user_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function getUsers()
    {
        $role  = [1,5];
        $users = User::whereNull('deleted_at')->whereNotIn('role_id',$role)->get();
        return $users;
    }

    public function getUserByEmail($email)
    {
        $user = DB::select("SELECT * FROM core_users WHERE email = '$email'");
        return $user;
    }

    public function getRoles(){
        if(Auth::guard('User')->user()->role_id == 1){
            $roles  = DB::table('core_roles')->whereNull('deleted_at')->get();
        }
        else{
            $id    = [1,5];
            $roles = DB::table('core_roles')->whereNotIn('id',$id)->whereNull('deleted_at')->get();
        }

        return $roles;
    }
    public function delete_users($id){
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user
        try{
            if($id != 1){
                //DB::table('core_users')->where('id',$id)->update(['deleted_at'=> date('Y-m-d H:m:i')]);
                $userObj = User::find($id);
                $userObj = Utility::addDeletedBy($userObj);
                $userObj->deleted_at = date('Y-m-d H:m:i');
                $userObj->save();

                //delete info log
                $date = $userObj->deleted_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted user_id = '.$userObj->id . PHP_EOL;
                LogCustom::create($date,$message);
            }
            else{
                //delete error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  user_id = U0001 and got error'. PHP_EOL;
                LogCustom::create($date,$message);
            }


        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  user_id = ' .$userObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){
        $user = User::find($id);
        return $user;
    }

    public function changeDisableToEnable($id,$cur){
        DB::table('core_users')->where('id',$id)->update(['last_activity'=>$cur,'active'=>1]);
    }

    public function changeEnableToDisable($id)
    {
        DB::table('core_users')->where('id',$id)->update(['active'=>0]);
    }


    public function getPermissionByUserId($userId) {

        $roleId = DB::table("core_users")
            ->select('role_id')
            ->where('id' , '=' , $userId)
            ->first();

        if($roleId) {
            $permissionRepo = new PermissionRepository();
            $permissions = $permissionRepo->getPermissionsByRoleId($roleId->role_id);

            if($permissions)
                return $permissions;
        }
        return null;
    }

    public function getArrays()
    {
         $tempObj = DB::select("SELECT * FROM core_users WHERE deleted_at is null");
         return $tempObj;
    }

    public function getUserByUserArray($paramArray){
        $result = User::
            select('id', 'name as Name', 'role_id')
            ->whereIn('id',$paramArray)
            ->where('role_id','>',5)
            ->whereNull('deleted_at')
            ->get();
        return $result;
    }
}