<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/17/2016
 * Time: 10:19 AM
 */

namespace App\Api\Product;


interface ProductApiV2RepositoryInterface
{
    public function products($data);
    public function getProductArray();
}