<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 8/16/2016
 * Time: 2:52 PM
 */

namespace App\Backend\Invoice;


interface InvoiceRepositoryInterface
{
    public function getObjs();
    public function getArrays();
    public function getObjByID($id);
    public function getInvoiceID($id);
    public function getInvoiceByPatientID($id);
    public function getInvoiceHeaderByPatientID($id);
    public function getDetails($id);
    public function getInvoicesWithSchedules();
    public function getIncomeSummary($type, $from_date, $to_date);
}