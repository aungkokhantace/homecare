<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/26/2016
 * Time: 4:51 PM
 */

namespace App\Api\Package;


interface PackageApiRepositoryInterface
{
   
    public function getArrays();
    public function create($packageSaleObj, $invoiceObj);
   
}