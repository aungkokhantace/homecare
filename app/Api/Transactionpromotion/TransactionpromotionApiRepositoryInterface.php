<?php
namespace App\Api\Transactionpromotion;
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 2017-03-23
 * Time: 03:21 PM
 */
interface TransactionpromotionApiRepositoryInterface
{
    public function create($paramObj);
    public function createMultipleRows($data,$tablet_id,$user_id);
}