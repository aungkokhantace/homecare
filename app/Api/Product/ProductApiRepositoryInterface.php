<?php
namespace App\Api\Product;
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/15/2016
 * Time: 11:49 AM
 */
interface ProductApiRepositoryInterface
{
    public function getObjById($productId);
    public function create($paramObj);
    public function update($paramObj);
}