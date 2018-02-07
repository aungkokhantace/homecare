<?php
namespace App\CSVImport;
use App\Backend\Allergy\Allergy;
use App\Backend\Familyhistory\Familyhistory;
use App\Backend\Medicalhistory\Medicalhistory;
use App\Backend\Product\Product;
use App\Backend\Provisionaldiagnosis\Provisionaldiagnosis;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/25/2016
 * Time: 11:02 AM
 */
class CSVImportRepository implements CSVImportRepositoryInterface
{
    public function createProductCategories($data,$user_id,$today){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $values = $data."','".$user_id."','".$user_id."','".$today."','".$today;

            DB::insert("INSERT INTO product_categories (name,description,created_by,updated_by,created_at,updated_at) VALUES ('$values')");

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }catch (\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }

    }

    public function createProducts($p_name,$category_id,$price,$description,$user_id,$today){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $prefix = Utility::getTerminalId();
            $table = (new Product())->getTable();
            $col = "id";
            $offset = 1;

            $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

            //$values = $generatedId."','".$data."','".$user_id."','".$user_id."','".$today."','".$today;

            DB::insert("INSERT INTO products (id,product_category_id,product_name,price,description,created_by,updated_by,created_at,updated_at) VALUES ('$generatedId','$category_id','$p_name','$price','$description','$user_id','$user_id','$today','$today')");

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }catch (\Exception $e){
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createFamilyHistories($data,$user_id,$today){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $prefix = Utility::getTerminalId();
            $table = (new Familyhistory())->getTable();
            $col = "id";
            $offset = 1;

            $generatedId = Utility::generatedId($prefix,$table,$col,$offset);
            $values = $generatedId."','".$data."','".$user_id."','".$user_id."','".$today."','".$today;

            DB::insert("INSERT INTO family_histories (id,name,description,created_by,updated_by,created_at,updated_at) VALUES ('$values')");

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }catch (\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createMedicalHistory($data,$user_id,$today){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $prefix = Utility::getTerminalId();
            $table = (new Medicalhistory())->getTable();
            $col = "id";
            $offset = 1;

            $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

            $values = $generatedId."','".$data."','".$user_id."','".$user_id."','".$today."','".$today;

            DB::insert("INSERT INTO medical_history(id,name,description,created_by,updated_by,created_at,updated_at) VALUES ('$values')");

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }catch (\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createProvisionalDiagnosis($data,$user_id,$today){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $prefix = Utility::getTerminalId();
            $table = (new Provisionaldiagnosis())->getTable();
            $col = "id";
            $offset = 1;

            $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

            $values = $generatedId."','".$data."','".$user_id."','".$user_id."','".$today."','".$today;

            DB::insert("INSERT INTO provisional_diagnosis(id,name,description,created_by,updated_by,created_at,updated_at) VALUES ('$values')");

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }catch (\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createAllergies($data,$user_id,$today){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $values = $data."','".$user_id."','".$user_id."','".$today."','".$today;

            DB::insert("INSERT INTO allergies(name,type,description,created_by,updated_by,created_at,updated_at) VALUES ('$values')");

            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }catch (\Exception $e){

            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }

    public function createInvestigationLabs($data,$user_id,$today){
        $returnedObj = array();
        $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $values = $data."','".$user_id."','".$user_id."','".$today."','".$today;
            // dd('val',$values);
            DB::insert("INSERT INTO investigation_labs(id,service_name,description,routine_price,urgent_price,created_by,updated_by,created_at,updated_at) VALUES ('$values')");
            // dd('here');
            $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
            return $returnedObj;

        }catch (\Exception $e){
            // dd('except',$e);
            $returnedObj['aceplusStatusMessage'] = $e->getMessage(). " ----- line " .$e->getLine(). " ----- " .$e->getFile();
            return $returnedObj;
        }
    }


}
