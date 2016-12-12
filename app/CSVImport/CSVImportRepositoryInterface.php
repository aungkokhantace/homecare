<?php
namespace App\CSVImport;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/25/2016
 * Time: 11:01 AM
 */
interface CSVImportRepositoryInterface
{
    public function createProductCategories($data,$user_id,$today);
    public function createProducts($p_name,$category_id,$price,$description,$user_id,$today);
    public function createFamilyHistories($data,$user_id,$today);
    public function createMedicalHistory($data,$user_id,$today);
    public function createProvisionalDiagnosis($data,$user_id,$today);
}