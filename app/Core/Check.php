<?php namespace App\Core;
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 6/21/2016
 * Time: 11:46 AM
 */


use App\Core\Config\ConfigRepository;
use Validator;
use Auth;
use App\Http\Requests;
use App\Session;
use App\Core\User\UserRepository;
use DB;
use App\Backend\Terminal\Terminal;

class Check
{
    /**
     *
     * @return bool
     */
    public static function validSession()
    {
        $sessionObj = session('user');
        if(isset($sessionObj)){
            return true;
        }
        return false;
    }

    public static function hasPermission($permissions,$routeAction) {

        if(isset($permissions) && count($permissions)>0) {
            foreach ($permissions as $key => $permission) {
                if ($permission['url'] == $routeAction) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $methodString
     * @param $method
     * @return bool
     */
    public static function hasMethods($methodString,$method) {
        $methods = explode('|', $methodString);
        return (in_array("*", $methods) || in_array($method, $methods));
    }

     /**
     * @return mixed
     */
    public static function logout() {
        //flush session
        Session::flush();

        //redirect user to login page
        return Redirect::to('/login');
    }

    public static function getInfo() {
        $info = array();
        $info['companyName'] = "";
        if(Check::validSession()) {
            $info['userName'] = strtoupper(session('user')['name']);
            $info['userId'] = session('user')['id'];
            $info['userRoleId'] = session('user')['role_id'];
        }
        return $info;
    }

    public static function companyLogo() {

        $ConfigRepository = new ConfigRepository();
        $companyLogo = $ConfigRepository->getCompanyLogo();

        if(isset($companyLogo) && count($companyLogo)>0 ) {

            if(isset($companyLogo[0]->value) && $companyLogo[0]->value != ""){
                return $companyLogo[0]->value;
            }
            else{
                return "/images/aceplus_logo.png";
            }
        }
        return "/images/aceplus_logo.png";
    }

    public static function companyName() {

        $ConfigRepository = new ConfigRepository();
        $companyName = $ConfigRepository->getCompanyName();

        if(isset($companyName) && count($companyName)>0 ) {

            if(isset($companyName[0]->value) && $companyName[0]->value != ""){
                return $companyName[0]->value;
            }
            else{
                return "AcePlus Backend";
            }
        }
        return "AcePlus Backend";
    }

    public static function createSession($id) {

        $userRepository = new UserRepository();
        $tempUser = $userRepository->getObjByID($id);
        $permissions = $userRepository->getPermissionByUserId($id);
        session(['user'=>$tempUser->toArray()]);
        session(['permissions' => $permissions]);
    }

    public static function checkSiteActivationCode($inputAll)
    {
        $configRepo = new ConfigRepository();
        $rawSiteActivationKey = $configRepo->getSiteActivationKey();
        $siteActivationKey = "";

        if(isset($rawSiteActivationKey[0]->value) && $rawSiteActivationKey[0]->value != ""){
            $siteActivationKey = $rawSiteActivationKey[0]->value;

        }

        if(isset($inputAll->site_activation_key) && $inputAll->site_activation_key == $siteActivationKey) {

            $returnArray = array();
            foreach($inputAll as $k => $v ){
                if($k != 'site_activation_key' && $k != 'tablet_activation_key' && $k != 'tablet_activation_key'){
                    $returnArray[$k] = $v;
                }
            }

            $tablet_activation_key = "";
            if(isset($inputAll->tablet_activation_key)){
                $tablet_activation_key = $inputAll->tablet_activation_key;
            }

            // generating the tablet id
            $tabletId = Check::generateTabletId($tablet_activation_key);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['tablet_id'] = $tabletId;
            $returnedObj['data'] = $returnArray;
            return $returnedObj;
        }

        $returnedObj['aceplusStatusCode'] = ReturnMessage::UNAUTHORIZED;
        $returnedObj['aceplusStatusMessage'] = "Unauthorized request !";
        $returnedObj['data'] = "";

        return $returnedObj;
    }

    public static function checkCodes($inputAll)
    {
        $configRepo = new ConfigRepository();
        $rawSiteActivationKey = $configRepo->getSiteActivationKey();
        $siteActivationKey = "";

        if(isset($rawSiteActivationKey[0]->value) && $rawSiteActivationKey[0]->value != ""){
            $siteActivationKey = $rawSiteActivationKey[0]->value;

        }

        if(isset($inputAll->site_activation_key) && $inputAll->site_activation_key == $siteActivationKey) {

            $returnArray = array();
            foreach($inputAll->data as $k => $v ){
                    $returnArray[$k] = $v;
            }

            $tablet_activation_key = "";
            if(isset($inputAll->tablet_activation_key)){
                $tablet_activation_key = $inputAll->tablet_activation_key;
            }

            // generating the tablet id
            $tabletId = Check::generateTabletId($tablet_activation_key);

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['tablet_id'] = $tabletId;
            $returnedObj['user_id'] = $inputAll->user_id;
            $returnedObj['data'] = $returnArray;
            return $returnedObj;
        }

        $returnedObj['aceplusStatusCode'] = ReturnMessage::UNAUTHORIZED;
        $returnedObj['aceplusStatusMessage'] = "Unauthorized request !";
        $returnedObj['data'] = (object) array();

        return $returnedObj;
    }

    public static function generateTabletId($tabletActivationKey)
    {
        $tabletId = "";
        $prefix = "U";
        $table = "terminals";
        $col = "id";
        $offset = 1;
        $pad_length = 3;

        $allTablets = DB::select("SELECT * FROM terminals");

        if(isset($allTablets) && count($allTablets)>0){
            $tempObj = DB::select("SELECT * FROM terminals WHERE tablet_id = '$tabletActivationKey' AND deleted_at is null");

            if(isset($tempObj) && count($tempObj)>0){
                $tabletId = $tempObj[0]->id;
            }
            else{

                $tabletId = Utility::generateKey($prefix,$table,$col,$offset, $pad_length);
                $terminalObj = new Terminal();
                $terminalObj->id = $tabletId;
                $terminalObj->tablet_id = $tabletActivationKey;
                $terminalObj->save();
            }
        }
        else{

            $tabletId = Utility::generateKey($prefix,$table,$col,$offset, $pad_length);
            $terminalObj = new Terminal();
            $terminalObj->id = $tabletId;
            $terminalObj->tablet_id = $tabletActivationKey;
            $terminalObj->save();
        }
        return $tabletId;
    }

    public static function checkFirstTimeConnect($inputAll)
    {
        $allTablets = DB::select("SELECT * FROM terminals");

        $tabletActivationKey = "";
        if(isset($inputAll->tablet_activation_key)){
            $tabletActivationKey = $inputAll->tablet_activation_key;
        }

        if($tabletActivationKey == ""){
            return true;
        }

        if(isset($allTablets) && count($allTablets)>0){
            $tempObj = DB::select("SELECT * FROM terminals WHERE tablet_id = '$tabletActivationKey'");

            if(isset($tempObj) && count($tempObj)>0){
                return false;
            }
            else{

                return true;
            }
        }
        else{
            return true;
        }
        return false;
    }

    public static function checkToDeleteWithVarcharID($table, $column, $id, $status_array){
      if(isset($status_array) && count($status_array) > 0){
        $result = DB::select("SELECT * FROM $table WHERE $column = '$id' AND deleted_at IS NULL AND status IN ( '" . implode( "', '" , $status_array) . "' )");
      }
      else{
        $result = DB::select("SELECT * FROM $table WHERE $column = '$id' AND deleted_at IS NULL");
      }
      return $result;
    }
}
