<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 2017-09-28
 * Time: 10:46 AM
 */
?>

@extends('layouts.master')
@section('title','Company Information API Detail')
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
            <li><a href="/apilist/waytrackingapi" class="api-tab">Way Tracking API</a></li>
            <li><a href="/apilist/patientapi" class="api-tab">Patient API</a></li>
            <li class="active"><a href="#" class="api-active-tab">Company Information API</a></li>
        </ul>
    </div>

    <div class="row">
        <h4>URL</h4>
        <p><b>http://localhost:8000/api/download/company_information</b></p>
    </div>
    <hr>
    <div class="row">
        <h4>Description</h4>
        <p>This API is for downloading company information from server to tablet.</p>
        <ol>
            <li>Tablet uploads table with data according to API input format.</li>
            <li>In server side, activation keys from input json are checked.</li>
            <li>If valid, proceeds to next step. Else,stops by returning error message.</li>
            <li>Get Company Information from "core_config" table. If not set in core_configs, return default company information.</li>            
        </ol>
    </div>
    <hr>
    <div class="row">
        <h4>Input Format</h4>
        <ul style="list-style-type:circle">
            <li>
                activation_keys only
            </li>
        </ul>
    </div>
    <hr>
    <div class="row">
        <h4>Sample Input JSON</h4>
        <pre>
        {
            "site_activation_key": "1234567",
            "tablet_activation_key": "aaaaa",
            "user_id": "U0004",
            "data": []
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
            "tabletId": "U008",
            "data": [
                {
                    "company_information": {
                        "name": "AcePlus Backend",
                        "address": "No.(60\/A), G-1, New Parami Road, Mayangone Township, Yangon, Myanmar",
                        "contact_phone": "(+95-9) 979909996, 9754013459",
                        "email": "gzp.hhcs@gmail.com"
                    }
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