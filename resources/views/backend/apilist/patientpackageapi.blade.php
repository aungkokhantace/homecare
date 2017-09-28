<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:48 AM
 */
?>

@extends('layouts.master')
@section('title','Patient Package API Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">
    <h1 class="page-header">API List</h1>
    <div class="row">
        <ul class="nav nav-tabs">
            <li><a href="/apilist/syncdownapi" class="api-tab">Sync Down API</a></li>
            <li><a href="/apilist/invoiceapi" class="api-tab">Invoice API</a></li>
            <li><a href="/apilist/enquiryapi" class="api-tab">Enquiry API</a></li>
            <li><a href="/apilist/scheduleapi" class="api-tab">Schedule API</a></li>
            <li class="active"><a href="#" class="api-active-tab">Patient Package API</a></li>
            <li><a href="/apilist/waytrackingapi" class="api-tab">Way Tracking API</a></li>
            <li><a href="/apilist/patientapi" class="api-tab">Patient API</a></li>
            <li><a href="/apilist/companyinformationapi" class="api-tab">Company Information API</a></li>
        </ul>
    </div>

    <div class="row">
        <h4>URL</h4>
        <p><b>http://localhost:8000/api/patient_package/upload</b></p>
    </div>
    <hr>
    <div class="row">
        <h4>Description</h4>
        <p>This API is for uploading patient package and invoice data from tablet to server.</p>
        <ol>
            <li>Tablet uploads tables with data according to API input format.</li>
            <li>In server side, activation keys from input json are checked.</li>
            <li>If valid, proceeds to next step. Else,stops by returning error message.</li>
            <li>In server side, check if keys of table(table names) exist.</li>
            <li>If key exists, gets IDs from value field and clear data with that IDs from database. Then, insert data into database.</li>
            <li>If tables are in header & detail format, check isset() for header data first, clear detail data first, and insert header data first.</li>
            <li>If there is patients and core_users, check core_user first and proceed only if core_user exists.</li>
            <li>Else, skip that table and continues to next table.</li>
            <li>Repeat this procedure for all tables.</li>
            <li>If there is an error in data insertion, database is rolled back to its original state.</li>
            <li>After all tables are successfully inserted, commit database.</li>
            <li>After commit, only patient_package data are returned(with no condition)//invoices are not returned.</li>
            <li>API logs are recorded.</li>
        </ol>
    </div>
    <hr>
    <div class="row">
        <h4>Input Format</h4>
        <ul style="list-style-type:circle">
            <li>
                patient_package
                <ul style="list-style-type:none">
                    <li>patient_package_detail</li>
                </ul>
            </li>
            <li>
                invoices
                <ul style="list-style-type:none">
                    <li>invoice_detail</li>
                </ul>
            </li>
        </ul>
    </div>
    <hr>
    <div class="row">
        <h4>Sample Input JSON</h4>
        <pre>
            {
            "data": [
            {
            "invoices": [
            {
            "accepted_by": "U0002",
            "created_by": "U0002",
            "created_at": "2016-11-30 13:53:29",
            "deleted_at": "",
            "deleted_by": "",
            "id": "U0011",
            "invoice_detail": [

            ],
            "package_id": 1,
            "package_price": 20000.0,
            "patient_id": "U0011",
            "patient_package_id": "U0012",
            "schedule_end_time": "",
            "schedule_id": "",
            "schedule_start_time": "",
            "status": "",
            "tax_rate": 0.0,
            "total_car_amount": 0.0,
            "total_consultant_discount_amount": 0.0,
            "total_consultant_fee": 0.0,
            "total_disc_amt": 0.0,
            "total_disc_percent": 0.0,
            "total_investigation_amount": 0.0,
            "total_medication_amount": 0.0,
            "total_nett_amt_w_disc": 20000.0,
            "total_nett_amt_wo_disc": 20000.0,
            "total_other_service_amount": 0.0,
            "total_payable_amt": 20000.0,
            "total_service_amount": 0.0,
            "total_tax_amt": 0.0,
            "township_id": 0,
            "type": "package",
            "updated_at": "",
            "updated_by": "",
            "zone_id": 0
            }
            ],
            "patient_package": [
            {
            "created_at": "2016-11-30 13:53:29",
            "created_by": "U0002",
            "deleted_at": "",
            "deleted_by": "",
            "expired_date": "2017-05-30",
            "id": "U0012",
            "package_id": 1,
            "package_price": 20000,
            "package_usage_count": 0,
            "package_used_count": 0,
            "patient_id": "U0011",
            "patient_package_detail": [

            ],
            "remark": "yfvh",
            "sold_date": "2016-11-30 13:53:29",
            "updated_at": "",
            "updated_by": ""
            }
            ]
            }
            ],
            "site_activation_key": "1234567",
            "tablet_activation_key": "836e410ac75e78f9",
            "user_id": "U0002"
            }
        </pre>
    </div>
    <hr>
    <div class="row">
        <h4>Sample Output JSON</h4>
        <pre>
        {
          "aceplusStatusCode": 200,
          "aceplusStatusMessage": "Request success !",
          "tabletId": "U007",
          "max_key": [
            {
              "table_name": "patient_package",
              "max_key_id": 0
            },
            {
                "table_name": "transaction_promotions",
                "max_key_id": 0
            }
          ],
          "data": [
            {
              "patient_package": [
                {
                  "id": "U0012",
                  "patient_id": "U0011",
                  "package_id": 1,
                  "package_price": "20000.00",
                  "package_usage_count": 0,
                  "package_used_count": 0,
                  "sold_date": "2016-11-30",
                  "expired_date": "2017-05-30",
                  "remark": "yfvh",
                  "created_by": "U0002",
                  "updated_by": "",
                  "deleted_by": "",
                  "created_at": "2016-11-30 13:53:29",
                  "updated_at": "",
                  "deleted_at": "",
                  "patient_package_detail": [

                  ]
                }
              ],
            "transaction_promotions": [
                {
                    "id": "U0011",
                    "promotion_code": "U001_20170920140155_1",
                    "reference_type": "package_sale",
                    "reference_id": "U0012",
                    "package_id": 2,
                    "used": 0,
                    "promo_group_code": "U001_20170920140155_1",
                    "promo_group_code_order": 1,
                    "remark": ""
                },
                {
                    "id": "U0012",
                    "promotion_code": "U001_20170920140458_2",
                    "reference_type": "package_sale",
                    "reference_id": "U0013",
                    "package_id": 2,
                    "used": 0,
                    "promo_group_code": "U001_20170920140458_2",
                    "promo_group_code_order": 1,
                    "remark": ""
                }
            ]
            }
          ]
        }
        </pre>
    </div>
    <hr>
</div>
@stop

@section('page_script')

@stop