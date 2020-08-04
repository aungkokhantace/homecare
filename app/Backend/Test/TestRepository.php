<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/22/2016
 * Time: 5:32 PM
 */

namespace App\Backend\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;

class TestRepository implements TestRepositoryInterface
{
    public function getObjs()
    {
        $objs = Service::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new Service())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }

    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($paramObj)
    {
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        try {
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $tempObj = Service::find($id);
        $tempObj = Utility::addDeletedBy($tempObj);
        $tempObj->deleted_at = date('Y-m-d H:m:i');
        $tempObj->save();
    }

    public function getObjByID($id){
        $role = Service::find($id);
        return $role;
    }

    public function getServiceNameByID($id){
        $result = Service::find($id)->value('name');
        return $result;
    }

    public function makeLog($rawDate, $message){
        $date = date("Y-m-d",strtotime($rawDate));
//        $fileName = "custom-laravel-" . $date . '.log';
        $fileName = "api-log-laravel-" . $date . '.txt';
        $dir        = storage_path('logs');
        $fileNameWithPath = $dir . '/' . $fileName;
        $rawFiles   = scandir($dir);
        $files = array();
        foreach($rawFiles as $rawFile){
            if (0 === strpos($rawFile, 'api-log-laravel')) {
                array_push($files,$rawFile);
            }
        }

        if(count($files)>0){

            if(in_array($fileName, $files)){

                foreach($message as $msg){

                    // Open the file to get existing content
                    $current = file_get_contents($fileNameWithPath);
                    // Append a new person to the file
                    $current .= "\n\n\n=================================================================================\n";
                    $current .= $rawDate."\n";
                    $current .= "---------------------------------------------------------------------------------\n";
                    $current .= $msg->dob."\n";
                    $current .= "=================================================================================\n";

                    // Write the contents back to the file
                    file_put_contents($fileNameWithPath, $current);
                }


            }
            else{
                //$this::writeFile($fileName,$message);
                $myfile = fopen($fileNameWithPath, "w") or die("Unable to open file!");
                foreach($message as $msg){
                    $current = "=================================================================================\n";
                    $current .= $rawDate."\n";
                    $current .= "---------------------------------------------------------------------------------\n";
                    $current .= $msg->dob."\n";
                    $current .= "=================================================================================\n";
                    fwrite($myfile, $current);
                }

                fclose($myfile);

            }
        }

        else{
            // $this::writeFile($fileName,$message);
            $myfile = fopen($fileNameWithPath, "w") or die("Unable to open file!");
            foreach($message as $msg){
                $current = "=================================================================================\n";
                $current .= $rawDate."\n";
                $current .= "---------------------------------------------------------------------------------\n";
                $current .= $msg->dob."\n";
                $current .= "=================================================================================\n";
                fwrite($myfile, $current);
            }

            fclose($myfile);
        }
    }
}