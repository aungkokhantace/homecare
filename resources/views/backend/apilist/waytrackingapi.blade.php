<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:48 AM
 */
?>

@extends('layouts.master')
@section('title','Way Tracking API Detail')
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
            <li><a href="/apilist/patientpackageapi" class="api-tab">Patient Package API</a></li>
            <li class="active"><a href="#" class="api-active-tab">Way Tracking API</a></li>
            <li><a href="/apilist/patientapi" class="api-tab">Patient API</a></li>
            <li><a href="/apilist/companyinformationapi" class="api-tab">Company Information API</a></li>
        </ul>
    </div>

    <div class="row">
        <h4>URL</h4>
        <p><b>http://localhost:8000/api/waytracking/upload</b></p>
    </div>
    <hr>
    <div class="row">
        <h4>Description</h4>
        <p>This API is for uploading way_tracking data from tablet to server.</p>
        <ol>
            <li>Tablet uploads table with data according to API input format.</li>
            <li>In server side, activation keys from input json are checked.</li>
            <li>If valid, proceeds to next step. Else,stops by returning error message.</li>
            <li>In server side, check if keys of table(table names) exist.</li>
            <li>If key exists, gets IDs from value field and clear data with that IDs from database. Then, insert data into database.</li>
            <li>Else, stop and return with error message.</li>
            <li>If there is an error in data insertion, database is rolled back to its original state.</li>
            <li>After all tables are successfully inserted, commit database.</li>
            <li>After commit, only max key of way_tracking is generated and returned.</li>
            <li>API logs are recorded.</li>
        </ol>
    </div>
    <hr>
    <div class="row">
        <h4>Input Format</h4>
        <ul style="list-style-type:circle">
            <li>
                way_tracking
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
            "way_tracking": [
            {
            "arrival_time": "7 : 24 AM",
            "created_by": "U0002",
            "created_at": "2016-10-31 07:24:37",
            "date": "2016-10-31 07:24:37",
            "deleted_by": "",
            "deleted_at": "",
            "departure_time": "7 : 24 AM",
            "id": "U0011",
            "updated_by": "",
            "updated_at": "",
            "user_id": "U0002"
            },
            {
            "arrival_time": "7 : 40 AM",
            "created_by": "U0002",
            "created_at": "2016-10-31 07:40:30",
            "date": "2016-10-31 07:40:30",
            "deleted_by": "",
            "deleted_at": "",
            "departure_time": "7 : 40 AM",
            "id": "U0012",
            "updated_by": "",
            "updated_at": "",
            "user_id": "U0002"
            }
            ]
            }
            ],
            "site_activation_key": "1234567",
            "tablet_activation_key": "aaa",
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
          "max_key": [
            {
              "table_name": "way_tracking",
              "max_key_id": 0
            }
          ],
          "tabletId": "U004"
        }
        </pre>
    </div>
    <hr>
</div>
@stop

@section('page_script')

@stop