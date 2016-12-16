<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:48 AM
 */
?>

@extends('layouts.master')
@section('title','Enquiry API Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">
    <h1 class="page-header">API List</h1>
    <div class="row">
        <ul class="nav nav-tabs">
            <li><a href="/apilist/syncdownapi" class="api-tab">Sync Down API</a></li>
            <li><a href="/apilist/invoiceapi" class="api-tab">Invoice API</a></li>
            <li class="active"><a href="#" class="api-active-tab">Enquiry API</a></li>
            <li><a href="/apilist/scheduleapi" class="api-tab">Schedule API</a></li>
            <li><a href="/apilist/patientpackageapi" class="api-tab">Patient Package API</a></li>
            <li><a href="/apilist/waytrackingapi" class="api-tab">Way Tracking API</a></li>
            <li><a href="/apilist/patientapi" class="api-tab">Patient API</a></li>
        </ul>
    </div>

    <div class="row">
        <h4>URL</h4>
        <p><b>http://localhost:8000/api/enquiry/uploadEnquiry/v2</b></p>
    </div>
    <hr>
    <div class="row">
        <h4>Description</h4>
        <p>This API is for uploading enquiry data from tablet to server.</p>
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
            <li>After commit, for return data, check if enquiries exist.</li>
            <li>If enquiries exist, only enquiries within last three days and status='new' are retrieved and returned to tablet.</li>
            <li>enquiry_detail data are retrieved according to header data.</li>
            <li>For patient return data, compare 'user_id' of patients table with 'user_id' from input json.</li>
            <li>Patient allergy and core_user data are returned according to patient header data.</li>
            <li>If 'created_at,updated_at,deleted_at' fields are null, they are set to "".</li>
            <li>API logs are recorded.</li>
        </ol>
    </div>
    <hr>
    <div class="row">
        <h4>Input Format</h4>
        <ul style="list-style-type:circle">
            <li>
                enquiries
                <ul style="list-style-type:none">
                    <li>enquiry_detail</li>
                </ul>
            </li>
            <li>
                patients
                <ul style="list-style-type:none">
                    <li>patient_allergy</li>
                    <li>log_patient_case_summary</li>
                </ul>
            </li>
            <li>core_users</li>
        </ul>
    </div>
    <hr>
    <div class="row">
        <h4>Sample Input JSON</h4>
        <pre>
            {
            "site_activation_key": "1234567",
            "tablet_activation_key": "fff",
            "user_id": "U0002",
            "data": [
            {
            "enquiries": [
            {
            "id": "U0061",
            "name": "David",
            "nrc_no": "1122334455",
            "is_new_patient": "1",
            "patient_id": "U0061",
            "patient_type_id": "2",
            "date": "2016-10-06",
            "time": "09:47:41",
            "gender": "male",
            "dob": "1990-10-06",
            "phone_no": "0978787878",
            "address": "Yangon",
            "township_id": "1",
            "zone_id": "1",
            "case_type": "1",
            "car_type": "1",
            "car_type_id": "0",
            "enquiry1": "1",
            "enquiry2": "1",
            "enquiry3": "1",
            "enquiry4": "1",
            "having_allergy": "1",
            "status": "New",
            "remark": "remark",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": "",
            "enquiry_detail": [
            {
            "enquiry_id": "U0061",
            "package_id": "0",
            "service_id": "1",
            "allergy_id": "0",
            "type": "service"
            },
            {
            "enquiry_id": "U0061",
            "package_id": "0",
            "service_id": "2",
            "allergy_id": "0",
            "type": "service"
            }
            ],
            "patients": {
            "user_id": "U0061",
            "name": "David",
            "nrc_no": "1122334455",
            "email": "U0062@gmail.com",
            "patient_type_id": "2",
            "gender": "male",
            "phone_no": "0978787878",
            "address": "Yangon",
            "township_id": "1",
            "zone_id": "1",
            "dob": "1990-10-06",
            "remark": "remark",
            "case_scenario": "scenario",
            "having_allergy": "1",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0061",
            "allergy_id": "1"
            },
            {
            "patient_id": "U0061",
            "allergy_id": "2"
            }
            ],
            "log_patient_case_summary": [
            {
            "id": "U0061",
            "patient_id": "U0061",
            "case_summary": "summary",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": ""
            }
            ]
            },
            "core_users": {
            "id": "U0061",
            "name": "David",
            "password": "11111111",
            "phone": "0978787878",
            "email": "U0062@gmail.com",
            "fees": "50000.0",
            "display_image": "",
            "mobile_image": "",
            "role_id": "5",
            "address": "Yangon",
            "active": "1",
            "last_activity": "",
            "remember_token": "",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": ""
            }
            },
            {
            "id": "U0062",
            "name": "David",
            "nrc_no": "1122334455",
            "is_new_patient": "1",
            "patient_id": "U0062",
            "patient_type_id": "2",
            "date": "2016-10-06",
            "time": "09:47:41",
            "gender": "male",
            "dob": "1990-10-06",
            "phone_no": "0978787878",
            "address": "Yangon",
            "township_id": "1",
            "zone_id": "1",
            "case_type": "1",
            "car_type": "1",
            "car_type_id": "0",
            "enquiry1": "1",
            "enquiry2": "1",
            "enquiry3": "1",
            "enquiry4": "1",
            "having_allergy": "1",
            "status": "1",
            "remark": "remark",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": "",
            "enquiry_detail": [
            {
            "enquiry_id": "U0062",
            "package_id": "0",
            "service_id": "1",
            "allergy_id": "0",
            "type": "service"
            },
            {
            "enquiry_id": "U0062",
            "package_id": "0",
            "service_id": "2",
            "allergy_id": "0",
            "type": "service"
            }
            ],
            "patients": {
            "user_id": "U0062",
            "name": "David",
            "nrc_no": "1122334455",
            "email": "david123@gmail.com",
            "patient_type_id": "2",
            "gender": "male",
            "phone_no": "0978787878",
            "address": "Yangon",
            "township_id": "1",
            "zone_id": "1",
            "dob": "1990-10-06",
            "remark": "remark",
            "case_scenario": "scenario",
            "having_allergy": "1",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0062",
            "allergy_id": "1"
            },
            {
            "patient_id": "U0062",
            "allergy_id": "2"
            }
            ],
            "log_patient_case_summary": [
            {
            "id": "U0062",
            "patient_id": "U0062",
            "case_summary": "summary",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": ""
            }
            ]
            },
            "core_users": {
            "id": "U0062",
            "name": "David",
            "password": "11111111",
            "phone": "0978787878",
            "email": "U00624@gmail.com",
            "fees": "50000.0",
            "display_image": "",
            "mobile_image": "",
            "role_id": "5",
            "address": "Yangon",
            "active": "1",
            "last_activity": "",
            "remember_token": "",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": ""
            }
            }
            ]
            }
            ]
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
            "tabletId": "U005",
            "user_id": "U0002",
            "max_key": [
            {
            "table_name": "enquiries",
            "max_key_id": 0
            },
            {
            "table_name": "patients",
            "max_key_id": 0
            },
            {
            "table_name": "core_users",
            "max_key_id": 0
            }
            ],
            "data": [
            {
            "enquiries": [
            {
            "id": "U0002",
            "name": "Tu Tu",
            "nrc_no": "123123123",
            "is_new_patient": 1,
            "patient_id": "",
            "patient_type_id": 1,
            "date": "2016-12-01",
            "time": "11:44:16",
            "gender": "male",
            "dob": "1989-07-27",
            "phone_no": "0965757576",
            "address": "Detail Address",
            "township_id": 18,
            "zone_id": 4,
            "case_type": 0,
            "car_type": 1,
            "car_type_id": 0,
            "enquiry1": 0,
            "enquiry2": 0,
            "enquiry3": 0,
            "enquiry4": 0,
            "having_allergy": 0,
            "status": "new",
            "remark": "This is remark",
            "created_by": "U0001",
            "updated_by": "U0001",
            "deleted_by": "",
            "created_at": "2016-12-01 11:44:16",
            "updated_at": "",
            "deleted_at": "",
            "enquiry_detail": [],
            "patients": {
            "patient_allergy": []
            },
            "core_users": {}
            },
            {
            "id": "U0013",
            "name": "Jack Sparrrow",
            "nrc_no": "werwerrwer223242424",
            "is_new_patient": 1,
            "patient_id": "",
            "patient_type_id": 2,
            "date": "2016-12-01",
            "time": "13:56:11",
            "gender": "male",
            "dob": "1971-01-05",
            "phone_no": "0969996696",
            "address": "Black Pearl",
            "township_id": 5,
            "zone_id": 1,
            "case_type": 0,
            "car_type": 3,
            "car_type_id": 3,
            "enquiry1": 0,
            "enquiry2": 0,
            "enquiry3": 1,
            "enquiry4": 0,
            "having_allergy": 0,
            "status": "new",
            "remark": "jack sparrow remark",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-12-01 13:56:11",
            "updated_at": "",
            "deleted_at": "",
            "enquiry_detail": [
            {
            "enquiry_id": "U0013",
            "package_id": 0,
            "service_id": 1,
            "allergy_id": 0,
            "type": "service"
            },
            {
            "enquiry_id": "U0013",
            "package_id": 0,
            "service_id": 0,
            "allergy_id": 1,
            "type": "allergy"
            },
            {
            "enquiry_id": "U0013",
            "package_id": 0,
            "service_id": 0,
            "allergy_id": 2,
            "type": "allergy"
            },
            {
            "enquiry_id": "U0013",
            "package_id": 0,
            "service_id": 1,
            "allergy_id": 0,
            "type": "service"
            }
            ],
            "patients": {
            "patient_allergy": []
            },
            "core_users": {}
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