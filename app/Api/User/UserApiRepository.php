<?php
namespace App\Api\User;
use App\User;
use App\Api\User\UserApiRepositoryInterface;
use App\Backend\Scheduletracking\Scheduletracking;
use App\Backend\Waytracking\Waytracking;
use App\Core\ReturnMessage;
use App\Core\User\UserRepository;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;
use App\Backend\Schedule\Schedule;
use App\Backend\Scheduledetail\Scheduledetail;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 14/10/2016
 * Time: 02:20 PM
 */
class UserApiRepository implements UserApiRepositoryInterface
{
    public function getObjByIds($id, $schedule_id, $enquiry_id)
    {
        $result     = Scheduletracking::
                        where('id',$id)
                        ->where('schedule_id', $schedule_id)
                        ->where('enquiry_id', $enquiry_id)
                        ->get();
        return $result;
    }

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

    public function createUserRow($paramObj)
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
            $returnedObj['aceplusStatusMessage'] = $e->getMessage() . " ----- line " . $e->getLine() . " ----- " . $e->getFile();
            return $returnedObj;
        }
    }

    public function createSingleUser($data){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $returnedObj['aceplusStatusMessage'] = "";

        try {
            $tempLogArr     = array();
            foreach ($data as $row) {
                $id = $row->id;
                $email = $row->email;

                //Check update or create for log date
                $findObj    = User::find($id);
               
                if(isset($findObj) && count($findObj) > 0){
                    $tempArr['date'] = $row->updated_at;
                    $create = "updated";
                }
                else{
                    $tempArr['date'] = $row->created_at;
                    $create = "created";
                }

                if(isset($findObj) && count($findObj) > 0){
                    $current_updated_at = "";
                    $input_updated_at = "";

                    $temp_current_updated_at = $findObj->updated_at;
                    $current_updated_at = $temp_current_updated_at;
                    
                    $temp_input_updated_at = $row->updated_at;
                    $input_updated_at = $temp_input_updated_at;

                    //Incoming record's updated_at is later than existing record's updated_at;
                    //So, the record incoming is updated later; So, database must be updated..
                    if($input_updated_at > $current_updated_at){
                        //clear patients data relating to input
                        DB::table('patients')
                            ->where('user_id', '=', $id)
                            ->delete();

                        //clear core_users data relating to input
                        DB::table('core_users')
                            ->where('id', '=', $id)
                            ->delete();
                    }
                    //Incoming record's updated_at is not later than existing record's updated_at;
                    //So, the record incoming is updated earlier; So, database doesn't need to be updated..
                    else{
                        dd('input_current',$input_updated_at,$current_updated_at,$row->name);
                        $returnedObj['aceplusStatusCode']       = ReturnMessage::SKIPPED;
                        $returnedObj['aceplusStatusMessage']    = "User data doesn't need to be updated!";
                        $returnedObj['log']                     = $tempLogArr;
                        return $returnedObj;
                    }
                }


                $paramObj               = new User();
                $paramObj->id           = $row->id;
                $paramObj->name         = $row->name;
//                $paramObj->password     = base64_encode($row->password);
                $paramObj->password     = $row->password;
                $paramObj->phone        = $row->phone;
                $paramObj->email        = $row->email;
                $paramObj->fees         = $row->fees;
//                $paramObj->display_image= $row->display_image;
                $paramObj->mobile_image = $row->mobile_image;
                $paramObj->role_id      = $row->role_id;
                $paramObj->address      = $row->address;
                $paramObj->active       = $row->active;
                $paramObj->created_by   = $row->created_by;
                $paramObj->updated_by   = $row->updated_by;
                $paramObj->deleted_by   = $row->deleted_by;
                $paramObj->created_at   = (isset($row->created_at) && $row->created_at != "") ? $row->created_at:null;
                $paramObj->updated_at   = (isset($row->updated_at) && $row->updated_at != "") ? $row->updated_at:null;
                $paramObj->deleted_at   = (isset($row->deleted_at) && $row->deleted_at != "") ? $row->deleted_at:null;

                //decode mobile image and create image
                if(isset($row->mobile_image) && $row->mobile_image != "")
                {
                    $decode_image   = $row->mobile_image;
                    $img            = str_replace('data:image/png;base64,', '', $decode_image);
                    $img            = str_replace(' ', '+', $img);
                    $data           = base64_decode($img);

                    $f              = finfo_open();
                    $mime_type      = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
                    switch($mime_type){
                        case "image/jpeg": $extension   = ".jpg";break;
                        case "image/png": $extension    = ".png";break;
                        case "image/gif": $extension    = ".gif";break;
                    }

                    $display_image  = uniqid().$extension;
                    $paramObj->display_image= $display_image;

                    $file = base_path() . "/public/images/users/" . $display_image;
                    $success = file_put_contents($file, $data);
                }

                $result = $this->createUserRow($paramObj);

                //check whether user insertion was successful or not
                if ($result['aceplusStatusCode'] == ReturnMessage::OK) {

                    //if insertion was successful, then create date and message for log
                    $tempArr['message'] = $create.' core_users_id = '.$paramObj->id;
                    array_push($tempLogArr,$tempArr);
                    continue;       //continue to next loop(i.e. next row of user data)
                }
                else {
                    //if user insertion was not successful
                    $returnedObj['aceplusStatusMessage'] = $result['aceplusStatusMessage'];
                    return $returnedObj;
                }
            }
            $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
            $returnedObj['aceplusStatusMessage']    = "User successfully created!";
            $returnedObj['log']                     = $tempLogArr;
            return $returnedObj;
        } catch (\Exception $e) {
            $returnedObj['aceplusStatusMessage'] = $e->getMessage() . " ----- line " . $e->getLine() . " ----- " . $e->getFile();
            return $returnedObj;
        }
    }

    public function createMultipleRows($data,$tablet_id){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            DB::beginTransaction();
            foreach($data as $row){
                $id                          = $row->id;
                $user_id                     = $row->user_id;

                DB::table('way_tracking')->where('id','=',$id)->where('user_id','=',$user_id)->delete();

                $paramObj                           = new Waytracking();
                $paramObj->id                       = $row->id;
                $paramObj->user_id                  = $row->user_id;
                $paramObj->date                     = $row->date;
                $paramObj->departure_time           = $row->departure_time;
                $paramObj->arrival_time             = $row->arrival_time;
                $paramObj->created_by               = $row->created_by;
                $paramObj->updated_by               = $row->updated_by;
                $paramObj->deleted_by               = $row->deleted_by;
                $paramObj->created_at               = $row->created_at;
                $paramObj->updated_at               = $row->updated_at;
                $paramObj->deleted_at               = $row->deleted_at;

                $result = $this->create($paramObj);

                if($result['aceplusStatusCode'] == ReturnMessage::OK){
                    continue;
                }
                else{
                    DB::rollBack();
                    $returnedObj['aceplusStatusMessage'] = "Error in way_tracking insertion!";
                    return $returnedObj;
                }
            }

            DB::commit();
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            $returnedObj['data'] ="SUCCESS";

            return $returnedObj;
        }
        catch(\Exception $e){
            DB::rollBack();
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }

    }

    public function getUserForEnquiry($patient_id){
//        $tempObj = DB::select("SELECT * FROM core_users WHERE id = '$patient_id'");
        $tempObj = DB::table('core_users')->where('id', $patient_id)->first();
        return $tempObj;
    }
}