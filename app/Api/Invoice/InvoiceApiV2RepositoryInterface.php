<?php
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/12/2016
 * Time: 2:16 PM
 */

namespace App\Api\Invoice;


interface InvoiceApiV2RepositoryInterface
{
    public function invoices($data);
}