<?php
namespace App\Api\Invoice;
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 9/15/2016
 * Time: 5:19 PM
 */
interface InvoiceApiRepositoryInterface
{
    public function getObjById($invoiceId);
    public function create($paramObj,$invoice_details);
    public function update($paramObj,$invoice_details,$invoiceId);
    public function createInvoice($params);
}