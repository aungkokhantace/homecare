<?php namespace App\Core;
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/12/2016
 * Time: 3:27 PM
 */

use App\Backend\Terminal\Terminal;
use App\Core\Config\ConfigRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use PDF;
use App\Http\Requests;
use App\Session;
use App\Core\User\UserRepository;
use App\Core\SyncsTable\SyncsTable;
use InterventionImage;

class Utility
{
    public static function addCreatedBy($newObj)
    {
        $sessionObj = session('user');
        if (isset($sessionObj)) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->updated_by = $loginUserId;
            $newObj->created_by = $loginUserId;
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    public static function addUpdatedBy($newObj)
    {
        $sessionObj = session('user');
        if (isset($sessionObj)) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->updated_by = $loginUserId;
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    public static function addDeletedBy($newObj)
    {
        $sessionObj = session('user');
        if (isset($sessionObj)) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->deleted_by = $loginUserId;
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    //For Log
    public static function logCreatedBy($newObj)
    {
        $sessionObj = session('user');
        if(isset($sessionObj)){
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->created_by = $loginUserId;
            $newObj->updated_by = null;
            $newObj->created_at = date("Y-m-d H:i:s");
            $newObj->updated_at = null;
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    public static function logUpdatedBy($newObj)
    {
        $sessionObj = session('user');
        if (isset($sessionObj)) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->created_by = null;
            $newObj->updated_by = $loginUserId;
            $newObj->created_at = null;
            $newObj->updated_at = date("Y-m-d H:i:s");
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    public static function logDeletedBy($newObj)
    {
        $sessionObj = session('user');
        if (isset($sessionObj)) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->created_by = null;
            $newObj->updated_by = null;
            $newObj->deleted_by = $loginUserId;
            $newObj->created_at = null;
            $newObj->updated_at = null;
            $newObj->deleted_at = date("Y-m-d H:i:s");
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }


    public static function updateSyncsTable($newObj)
    {
        $table_name = $newObj->getTable();
        $tempSyncTable = new SyncsTable();
        $syncTableName = $tempSyncTable->getTable();

        $syncTableObj = DB::table($syncTableName)
            ->select('*')
            ->where('table_name', '=', $table_name)
            ->first();

        if (isset($syncTableObj) && count($syncTableObj) > 0) {
            $id = $syncTableObj->id;
            $version = $syncTableObj->version + 1;
            $syncTable = SyncsTable::find($id);

            $sessionObj = session('user');
            if (isset($sessionObj)) {
                $userSession = session('user');
                $loginUserId = $userSession['id'];
                $syncTable->updated_by = $loginUserId;
            }

            $syncTable->version = $version++;
            $syncTable->save();
        }

        // Function call (tableName);
        Utility::updateSyncsTable_detail($table_name);
    }

    public static function updateSyncsTable_detail($table_name)
    {
        $table_array = array("enquiries"=>"enquiry_detail", "schedules"=>"schedule_detail", "invoices"=>"invoice_detail", "packages"=>"package_detail", "patient_package"=>"patient_package_detail", "zones"=>"zone_detail");
        if(array_key_exists($table_name,$table_array)){
            $detail_table_name = $table_array[$table_name];
            $tempSyncTable = new SyncsTable();
            $syncTableName = $tempSyncTable->getTable();

            $syncTableObj = DB::table($syncTableName)
                ->select('*')
                ->where('table_name', '=', $detail_table_name)
                ->first();

            if (isset($syncTableObj) && count($syncTableObj) > 0) {
                $id = $syncTableObj->id;
                $version = $syncTableObj->version + 1;
                $syncTable = SyncsTable::find($id);
                $sessionObj = session('user');
                if (isset($sessionObj)) {
                    $userSession = session('user');
                    $loginUserId = $userSession['id'];
                    $syncTable->updated_by = $loginUserId;
                }
                $syncTable->version = $version++;
                $syncTable->save();
            }
        }
    }

    public static function getSettingsByType($type)
    {
        $tempArrays = DB::select("SELECT * FROM core_settings WHERE type = '$type'");
        $result = array();
        if (isset($tempArrays) && count($tempArrays) > 0) {
            foreach ($tempArrays as $val) {

                $key = $val->value;
                $value = $val->code;
                $result[$key] = $value;
            }
        }

        return $result;
    }


    public static function exportPDF($html)
    {
        PDF::SetTitle('exportPDF');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, false, false, '');

        /* PDF::writeHTML($html, $ln = true, $fill = false, $reseth = false, $cell = false, $align = '');

        Parameter Definitions
         $html	    (string) text to display
         $ln	    (boolean) if true add a new line after text (default = true)
         $fill	    (boolean) Indicates if the background must be painted (true) or transparent (false).
         $reseth	(boolean) if true reset the last cell height (default false).
         $cell	    (boolean) if true add the current left (or right for RTL) padding to each Write (default false).
         $align	    (string) Allows to center or align the text. Possible values are:
                        L  : left align
                        C  : center
                        R  : right align
                        '' : empty string : left for LTR or right for RTL */

        PDF::Output('exportPDF.pdf');
    }

//    public static function exportPDFWithHeader($html)
//    {
//        PDF::SetTitle('exportPDF');
//        PDF::AddPage();
//        PDF::writeHTML($html, true, false, false, false, '');
//
//        /* PDF::writeHTML($html, $ln = true, $fill = false, $reseth = false, $cell = false, $align = '');
//
//        Parameter Definitions
//         $html	    (string) text to display
//         $ln	    (boolean) if true add a new line after text (default = true)
//         $fill	    (boolean) Indicates if the background must be painted (true) or transparent (false).
//         $reseth	(boolean) if true reset the last cell height (default false).
//         $cell	    (boolean) if true add the current left (or right for RTL) padding to each Write (default false).
//         $align	    (string) Allows to center or align the text. Possible values are:
//                        L  : left align
//                        C  : center
//                        R  : right align
//                        '' : empty string : left for LTR or right for RTL */
//
//        PDF::Output('exportPDF.pdf');
//    }

    public static function generateEnquiryId()
    {
        $date = date("YmdHis");
        return "ENQ" . $date;
    }

    public static function getTable($newObj) {
        $table_name = $newObj->getTable();
        return $table_name;
    }

    public static function generateKey($prefix,$table,$col,$offset, $pad_length)
    {
        $max = DB::select("SELECT MAX(`$col`) as id FROM `$table` WHERE id LIKE '$prefix%'");
        $newId = 1;
        if($max[0] != null && $max[0]->id != null) {
            $oldId = $max[0]->id;
            $numberPart = str_replace($prefix,"",$oldId);
            $value = intval($numberPart);
            $newId = $value + $offset;
        }
        $runningNo = str_pad($newId, $pad_length, 0, STR_PAD_LEFT);
        return sprintf("%s%s",$prefix,$runningNo);
    }

    public static function generatedId($prefix,$table,$col,$offset)     //with no padding (e.g. for core_users)
    {
        $idStringArray  = DB::select("SELECT `$col` as id FROM `$table` WHERE id LIKE '$prefix%'");
        if(!empty($idStringArray)){
            $idIntArray = array();
            foreach($idStringArray as $id){
                $numberpart     = str_replace($prefix,"",$id->id);  //remove prefix
                $idInt          = intval($numberpart);                 //change to integer
                $idIntArray[]   = $idInt;
            }
            $newId = 1;
            if($idIntArray[0] != null) {
                $max    = max($idIntArray);
                $newId  = $max + $offset;
            }
        }
        else{
            $newId = 1;
        }
        return sprintf("%s%s",$prefix,$newId);          //bind prefix and newId
    }

    public static function saveImage($photo,$path){
        if ( ! file_exists($path))
        {
            mkdir($path, 0777, true);
        }

        //setting photo name
        $photo_name  = $photo->getClientOriginalName();

        // moving image into image folder
        $photo->move($path, $photo_name);

        $rWidth = 1.0;
        $rHeight =  1.0;

        // getting image width and height
        $imgData = getimagesize($path . $photo_name);
        $width = $imgData[0];
        $imgWidth = $width * $rWidth;
        $height = $imgData[1];
        $imgHeight = $height * $rHeight;

        // generate unique id for the image name
        $photo_unique_name = uniqid();

        // resizing image
        $image = InterventionImage::make(sprintf($path .'/%s', $photo_name))
            ->resize($imgWidth, $imgHeight)->save();

        return $photo_name;
    }

    public static function getImage($photo){
        $photo_name = $photo->getClientOriginalName();
        return $photo_name;
    }

    public static function getImageExt($photo){
        $photo_ext = $photo->getClientOriginalExtension();

        return $photo_ext;
    }

    public static function resizeImage($photo,$photo_name,$path){

        if(! file_exists($path))
        {
            mkdir($path, 0777, true);
        }

        $photo->move($path,$photo_name);

        $rWidth     = 1.0;
        $rHeight    = 1.0;

        $imgData    = getimagesize($path . $photo_name);
        $width      = $imgData[0];
        $imgWidth   = $width * $rWidth;
        $height     = $imgData[1];
        $imgHeight  = $height * $rHeight;



        $image      = InterventionImage::make(sprintf($path . '/%s', $photo_name))
        ->resize($imgWidth,$imgHeight)->save();

        return $image;

    }

    public static function mobileUploadImage($photo){

        //$path       = base_path().'/public/images/users/';
        //$png_url    = "perfil-".time().".jpg";

        //$img        = substr($photo, strpos($photo, ",")+1);

        //$png_url    = $photo.time().".jpg";

        $path       = base_path() . "/public/images/users/" ;
        $success    = file_put_contents($path, $photo);
        return "success";
    }

    public static function generateScheduleId()
    {
        $date = date("YmdHis");
        return "SCH" . $date;
    }

    public static function getCurrentLoginUserId()
    {
        $sessionObj = session('user');
        $loginUserId = 0;
        if (isset($sessionObj)) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];
        }
        return $loginUserId;
    }

    public static function generateSurgeryId()
    {
        $date = date("YmdHis");
        return "SURGERY" . $date;
    }

    public static function getCurrentUser(){
        $role = Auth::guard('User')->user()->role_id;
        return $role;
    }

    public static function getCurrentUserID(){
        $id = Auth::guard('User')->user()->id;
        return $id;
    }

    public static function getTerminalId()
    {
        $terminal    = DB::table('terminals')->where('tablet_id','=','backend')->first();
        if(isset($terminal) && count($terminal)>0){
            return $terminal->id;
        }
        else{
            return "U000";
        }
    }

    public static function generateColorCode()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    public static function deleteImage($imagePath)
    {
        try {
            unlink($imagePath);
            return true;
        }
        catch(\Exception $ex){
            return false;
        }
    }

    //get currently maximum key
    public static function getMaxKey($prefix,$table,$col)
    {
        $idStringArray = DB::select("SELECT `$col` as id FROM `$table` where `$col` like '$prefix%'");
        $idIntArray = array();
        foreach($idStringArray as $id){
            $numberpart     = str_replace($prefix,"",$id->id);  //remove prefix
            $idInt          = intval($numberpart);               //change to integer
            $idIntArray[]   = $idInt;
        }

        $max = 0;
        if(isset($idIntArray) && count($idIntArray)>0) {
            if ($idIntArray[0] != null) {
                $max = max($idIntArray);
            }
        }

        return $max;
    }

    public static function getPrefixForApi($tablet_id)
    {
        $terminal    = DB::table('terminals')->where('tablet_id','=',$tablet_id)->first();
        if(isset($terminal) && count($terminal)>0){
            return $terminal->id;
        }
        else{
            return null;
        }
    }

    public static function getPDFHeader(){
        $companyLogo = \App\Core\Check::companyLogo();
        // $image = '<img style="width:80px;height:50px;" src="'.$companyLogo.'" alt="Parami HomeCare Logo"><br>';
        $image = '<img style="width:65px;height:35px;" src="'.$companyLogo.'" alt="Parami HomeCare Logo"><br>';
        // $logo = '<table>
        //                 <tr>
        //                     <td align="center" width="33%" height="20"></td>
        //                     <td align="center" width="33%" height="20">'.$image.'</td>
        //                     <td align="center" width="33%" height="20"></td>
        //                 </tr>
        //                 </table>';

        //get company address from core_config
        $companyAddressRaw      = DB::table('core_configs')->where('code','=','SETTING_ADDRESS')->first();
        if(isset($companyAddressRaw) && count($companyAddressRaw) > 0){
            $companyAddress     = $companyAddressRaw->value;
        }
        else{
            //set as default
            $companyAddress     = "No.(60/A), G-1, New Parami Road, Mayangone Township, Yangon, Myanmar";
        }

        //get company contact phone from core_config
        $companyPhoneRaw        = DB::table('core_configs')->where('code','=','SETTING_CONTACT_PHONE')->first();
        if(isset($companyPhoneRaw) && count($companyPhoneRaw) > 0){
            $companyPhone       = $companyPhoneRaw->value;
        }
        else{
            //set as default
            $companyPhone       = "(+95-9) 979909996, 9754013459";
        }

        //get company contact email from core_config
        $companyEmailRaw        = DB::table('core_configs')->where('code','=','SETTING_CONTACT_EMAIL')->first();
        if(isset($companyEmailRaw) && count($companyEmailRaw) > 0){
            $companyEmail       = $companyEmailRaw->value;
        }
        else{
            //set as default
            $companyEmail       = "gzp.hhcs@gmail.com";
        }

        // $letterHead = '<br><table style="font-size:11px;">
        //                 <tr>
        //                     <td align="center" height="20">'.$companyAddress.'</td>
        //                 </tr>
        //                 <tr>
        //                     <td align="center" height="20">Contact:'.$companyPhone.'. E-mail:'.$companyEmail.'</td>
        //                 </tr>
        //                 <tr>
        //                     <td align="center" height="18" bgcolor="#00c0f1" style="color:white">Parami Home Health Care Services @ Parami General Hospital - Yangon</td>
        //                 </tr>
        //                 </table>';

        $letterHead = '<br><table style="font-size:11px;">
                        <tr>
                            <td width="20%" height="20" rowspan="2" valign="middle">'.$image.'</td>
                            <td width="80%" align="left" height="20">'.$companyAddress.'</td>
                        </tr>
                        <tr>
                            <td align="left" height="20">Contact:'.$companyPhone.'. E-mail:'.$companyEmail.'</td>
                        </tr>
                        <tr>
                            <td align="center" height="18" bgcolor="#00c0f1" colspan="2" style="color:white">Parami Home Health Care Services @ Parami General Hospital - Yangon</td>
                        </tr>
                        </table>';
        // $pdfHeader  = $logo.$letterHead;
        $pdfHeader  = $letterHead;
        return $pdfHeader;
    }

    public static function getSignature(){
        $signature = '<table style="font-size:11px;">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="left" height="5">-----------------------------------</td>
                            <td align="left" height="5"></td>
                            <td align="left" height="5"></td>
                            <td align="left" height="5">-----------------------------------</td>
                        </tr>
                        <tr>
                            <td align="left" height="18">Cashier</td>
                            <td align="right" height="18"></td>
                            <td align="right" height="18"></td>
                            <td align="left" height="18">(M.O On Duty)</td>
                        </tr>
                        </table>';

        return $signature;
    }

    public static function calculateAge($dob){
        //calculate age
        $ageArray                = array();//array to return age
        $dob_year                = Carbon::parse($dob)->format('Y');
        $today_year              = Carbon::now()->format('Y');
        $diff_year               = $today_year-$dob_year;

        if($diff_year == 1){
//            $age = $diff_year.' year';
            $ageArray['value'] = $diff_year;
            $ageArray['unit'] = 'year';
        }
        elseif($diff_year == 0){
            $dob_month                = Carbon::parse($dob)->format('m');
            $today_month              = Carbon::now()->format('m');
            $diff_month               = $today_month-$dob_month;
            if($diff_month == 1){
//                $age = $diff_month.' month';
                $ageArray['value'] = $diff_month;
                $ageArray['unit'] = 'month';
            }
            elseif($diff_month == 0){
                $dob_day                = Carbon::parse($dob)->format('d');
                $today_day              = Carbon::now()->format('d');
                $diff_day               = $today_day-$dob_day;
                if($diff_day == 0 || $diff_day == 1){
//                    $age = $diff_day.' day';
                    $ageArray['value'] = $diff_day;
                    $ageArray['unit'] = 'day';
                }
                else{
//                    $age = $diff_day.' days';
                    $ageArray['value'] = $diff_day;
                    $ageArray['unit'] = 'days';
                }
            }
            else{
//                $age = $diff_month.' months';
                $ageArray['value'] = $diff_month;
                $ageArray['unit'] = 'months';
            }
        }
        else{
//            $age = $diff_year.' years';
            $ageArray['value'] = $diff_year;
            $ageArray['unit'] = 'years';
        }
        return $ageArray;
    }

    public static function savePriceTracking($table_name,$table_id,$table_id_type,$action,$old_price,$new_price,$created_by,$created_at){
        DB::table('setup_price_tracking')->insert([
            ['table_name'=>$table_name, 'table_id'=>$table_id, 'table_id_type'=>$table_id_type,
                'action'=>$action, 'old_price'=> $old_price , 'new_price'=>$new_price, 'created_by'=>$created_by, 'created_at'=>$created_at]
        ]);
    }


    public static function getTaxRate()
    {
        $tempArrays = DB::select("SELECT * FROM core_settings WHERE type = 'TAX_RATE'");
        if (isset($tempArrays) && count($tempArrays) > 0) {
            return $tempArrays[0]->value;
        }

        return 7;
    }

    //for generating package sale coupon codes
    public static function generateCouponCode($prefix,$table,$col,$offset)
    {
        $timestamp = date("_YmdHis_");

        $idStringArray  = DB::select("SELECT `$col` as id FROM `$table` WHERE id LIKE '$prefix%'");
        if(!empty($idStringArray)){
            $idIntArray = array();
            foreach($idStringArray as $id){
                $numberpart     = str_replace($prefix,"",$id->id);  //remove prefix
                $idInt          = intval($numberpart);                 //change to integer
                $idIntArray[]   = $idInt;
            }
            $newId = 1;
            if($idIntArray[0] != null) {
                $max    = max($idIntArray);
                $newId  = $max + $offset;
            }
        }
        else{
            $newId = 1;
        }
        return sprintf("%s%s%s",$prefix,$timestamp,$newId);          //bind prefix and newId
    }

    public static function getMaxDiscountTime()
    {
        $tempArrays = DB::select("SELECT * FROM core_settings WHERE type = 'MAX_DISCOUNT_TIME' and code = 'MAX_DISCOUNT_TIME'");
        if (isset($tempArrays) && count($tempArrays) > 0) {
            return $tempArrays[0]->value;
        }
        //2 by default
        return 2;
    }

    public static function generatePatientPrefix($prefix) {
        // $tempArray = DB::select("SELECT * FROM core_configs WHERE code = 'PATIENT_ID_PREFIX' and type = 'PREFIX'");
        $tempArray = DB::select("SELECT * FROM core_settings WHERE code = 'PATIENT_ID_PREFIX' and type = 'PREFIX'");
        if (isset($tempArray) && count($tempArray) > 0) {
            $temp_patient_prefix = $tempArray[0]->value;
        }
        else{
            $temp_patient_prefix    = "P";
        }
        $patient_prefix         = str_replace('U',$temp_patient_prefix,$prefix);
        return $patient_prefix;
    }

    public static function getPatientTypeByValue($value){
        $tempArrays = DB::select("SELECT * FROM core_settings WHERE value = '$value'");
        $result = $tempArrays[0]->code;
        return $result;
    }

    public static function getCurrentUserRole(){
        $role = Auth::guard('User')->user()->role_id;
        return $role;
    }

    // public static function getInvoicePrefix()
    // {
    //     $terminal    = DB::table('terminals')->where('tablet_id','=','backend_invoice')->first();
    //     if(isset($terminal) && count($terminal)>0){
    //         return $terminal->id;
    //     }
    //     else{
    //         return "I000";
    //     }
    // }

    public static function generateInvoicePrefix($prefix) {
        $tempArray = DB::select("SELECT * FROM core_settings WHERE code = 'INVOICE_ID_PREFIX' and type = 'PREFIX'");
        if (isset($tempArray) && count($tempArray) > 0) {
            $temp_invoice_prefix = $tempArray[0]->value;
        }
        else{
            $temp_invoice_prefix    = "I";
        }
        $invoice_prefix         = str_replace('U',$temp_invoice_prefix,$prefix);
        return $invoice_prefix;
    }
}
