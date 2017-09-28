<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:48 AM
 */
?>

@extends('layouts.master')
@section('title','Schedule API Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">
    <h1 class="page-header">API List</h1>
    <div class="row">
        <ul class="nav nav-tabs">
            <li><a href="/apilist/syncdownapi" class="api-tab">Sync Down API</a></li>
            <li><a href="/apilist/invoiceapi" class="api-tab">Invoice API</a></li>
            <li><a href="/apilist/enquiryapi" class="api-tab">Enquiry API</a></li>
            <li class="active"><a href="#" class="api-active-tab">Schedule API</a></li>
            <li><a href="/apilist/patientpackageapi" class="api-tab">Patient Package API</a></li>
            <li><a href="/apilist/waytrackingapi" class="api-tab">Way Tracking API</a></li>
            <li><a href="/apilist/patientapi" class="api-tab">Patient API</a></li>
            <li><a href="/apilist/companyinformationapi" class="api-tab">Company Information API</a></li>
        </ul>
    </div>

    <div class="row">
        <h4>URL</h4>
        <p><b>http://localhost:8000/api/schedule/upload/v3</b></p>
    </div>
    <hr>
    <div class="row">
        <h4>Description</h4>
        <p>This API is for uploading schedule data from tablet to server.</p>
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
            <li>After commit, for return data, check if schedules exist.</li>
            <li>If schedules exist, schedules with future dates and status='new or processing' and leader_id='user_id' are retrieved and returned.</li>
            <li>Check if enquiries exist.</li>
            <li>If enquiries exist, enquiries within last three days and status='new' are retrieved and returned.</li>
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
                schedules
                <ul style="list-style-type:none">
                    <li>schedule_detail</li>
                </ul>
            </li>
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
                    <li>core_users</li>
                </ul>
            </li>
        </ul>
    </div>
    <hr>
    <div class="row">
        <h4>Sample Input JSON</h4>
        <pre>
            {
            "site_activation_key": "1234567",
            "tablet_activation_key": "eee",
            "user_id": "U0002",
            "data": [
            {
            "schedules": [
            {
            "id": "U0051",
            "enquiry_id": "U0052",
            "patient_id": "U0051",
            "patient_package_id": "0",
            "date": "2016-11-16",
            "time": "02:23:32",
            "phone_no": "09456456456",
            "township_id": "1",
            "zone_id": "1",
            "car_type": "1",
            "car_type_id": "0",
            "car_type_setup_id": "1",
            "status": "New",
            "remark": "remark",
            "leader_id": "U0002",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": "",
            "schedule_detail": [
            {
            "schedule_id": "U0051",
            "package_id": "0",
            "service_id": "1",
            "user_id": "0",
            "type": "service"
            },
            {
            "schedule_id": "U0051",
            "package_id": "0",
            "service_id": "2",
            "user_id": "0",
            "type": "service"
            },
            {
            "schedule_id": "U0051",
            "package_id": "0",
            "service_id": "0",
            "user_id": "U0001",
            "type": "user"
            }
            ]
            }
            ],
            "enquiries": [
            {
            "id": "U0052",
            "name": "Mg Mg",
            "nrc_no": "1122334455",
            "is_new_patient": "1",
            "patient_id": "U0052",
            "patient_type_id": "1",
            "date": "2016-06-06",
            "time": "02:23:32",
            "gender": "male",
            "dob": "1990-06-06",
            "phone_no": "0934534543",
            "address": "Yangon",
            "township_id": "1",
            "zone_id": "1",
            "case_type": "1",
            "car_type": "1",
            "car_type_id": "0",
            "enquiry1": "1",
            "enquiry2": "1",
            "enquiry3": "0",
            "enquiry4": "0",
            "having_allergy": "0",
            "status": "new",
            "remark": "",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": "",
            "enquiry_detail": [
            {
            "enquiry_id": "U0052",
            "package_id": "1",
            "service_id": "1",
            "allergy_id": "1",
            "type": "service"
            },
            {
            "enquiry_id": "U0052",
            "package_id": "2",
            "service_id": "2",
            "allergy_id": "1",
            "type": "service"
            }
            ]
            },
            {
            "id": "U0052",
            "name": "Aung Aung",
            "nrc_no": "1122334455",
            "is_new_patient": "1",
            "patient_id": "U0052",
            "patient_type_id": "1",
            "date": "2016-06-06",
            "time": "02:23:32",
            "gender": "male",
            "dob": "1990-06-06",
            "phone_no": "0934534543",
            "address": "Yangon",
            "township_id": "1",
            "zone_id": "1",
            "case_type": "1",
            "car_type": "1",
            "car_type_id": "0",
            "enquiry1": "1",
            "enquiry2": "1",
            "enquiry3": "0",
            "enquiry4": "0",
            "having_allergy": "0",
            "status": "new",
            "remark": "",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": "",
            "enquiry_detail": [
            {
            "enquiry_id": "U0052",
            "package_id": "1",
            "service_id": "1",
            "allergy_id": "1",
            "type": "service"
            },
            {
            "enquiry_id": "U0052",
            "package_id": "2",
            "service_id": "2",
            "allergy_id": "1",
            "type": "service"
            }
            ]
            }
            ],
            "patients": [
            {
            "user_id": "U0052",
            "name": "Aung Yin",
            "nrc_no": "sdfsfds2323",
            "email": "aungyin@gmail.com",
            "patient_type_id": "1",
            "gender": "male",
            "phone_no": "23423",
            "address": "yangon",
            "township_id": "1",
            "zone_id": "1",
            "dob": "8.8.1990",
            "remark": "1",
            "case_scenario": "ww",
            "having_allergy": "1",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 10:33:35",
            "updated_at": "2016-10-09 10:33:35",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0052",
            "allergy_id": "1"
            }
            ],
            "log_patient_case_summary": [
            {
            "id": "U0052",
            "patient_id": "U0052",
            "case_summary": "wwwwww",
            "created_by": "",
            "updated_by": "U0002",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 10:33:35",
            "deleted_at": ""
            }
            ],
            "core_users": {
            "id": "U0052",
            "name": "Aung Yin",
            "password": "11111111",
            "phone": "123456",
            "email": "aungyin54646@gmail.com",
            "fees": "",
            "display_image": "img0000.png",
            "mobile_image": "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",
            "role_id": "5",
            "address": "Yangon",
            "active": "1",
            "created_by": "U0001",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": ""
            }
            },
            {
            "user_id": "U0054",
            "name": "May Lay Nwe",
            "nrc_no": "sdfsfds2323",
            "email": "maylaynwefs@gmail.com",
            "patient_type_id": "1",
            "gender": "female",
            "phone_no": "23423",
            "address": "yangon",
            "township_id": "1",
            "zone_id": "1",
            "dob": "9.9.1990",
            "remark": "1",
            "case_scenario": "test test",
            "having_allergy": "1",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0052",
            "allergy_id": "1"
            },
            {
            "patient_id": "U0052",
            "allergy_id": "2"
            }
            ],
            "log_patient_case_summary": [
            {
            "id": "U0003",
            "patient_id": "U00011",
            "case_summary": "test test",
            "created_by": "",
            "updated_by": "U0002",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": ""
            }
            ],
            "core_users": {
            "id": "U0054",
            "name": "May Lay Nwe",
            "password": "11111111",
            "phone": "123456",
            "email": "maylaynwe43242@gmail.com",
            "fees": "",
            "display_image": "img00008.png",
            "mobile_image": "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",
            "role_id": "5",
            "address": "Yangon",
            "active": "1",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
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
            "tabletId": "U006",
            "max_key": [
            {
            "table_name": "schedules",
            "max_key_id": 0
            },
            {
            "table_name": "enquiries",
            "max_key_id": 2
            },
            {
            "table_name": "patients",
            "max_key_id": 2
            },
            {
            "table_name": "core_users",
            "max_key_id": 2
            }
            ],
            "data": [
            {
            "schedules": [],
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
            "enquiry_detail": []
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
            ]
            }
            ],
            "patients": [
            {
            "user_id": "U0009",
            "name": "Mg Mg Zaw Latt",
            "nrc_no": "12312312",
            "email": "U0009@gmail.com",
            "patient_type_id": 1,
            "gender": "male",
            "phone_no": "12312312",
            "address": "Detail Address",
            "township_id": 8,
            "zone_id": 2,
            "dob": "1981-02-04",
            "remark": "",
            "case_scenario": "this is case summary for MMZL",
            "having_allergy": 1,
            "created_by": "U0001",
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": "2016-11-30 14:36:44",
            "updated_at": "2016-11-30 14:36:44",
            "deleted_at": "",
            "patient_allergy": [],
            "core_users": {
            "id": "U0009",
            "name": "Mg Mg Zaw Latt",
            "password": "Vm0wd2VFMUdiRmRpUm1SWFYwZG9WbGx0ZUV0WFJteDBZM3BHVjFKdGVGWlZNbkJU",
            "phone": "12312312",
            "email": "U0009@gmail.com",
            "fees": "0.00",
            "display_image": "",
            "mobile_image": null,
            "role_id": 5,
            "address": "Detail Address",
            "active": 1,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0001",
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": "2016-11-30 14:36:44",
            "updated_at": "2016-11-30 14:36:44",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
            },
            {
            "user_id": "U0011",
            "name": "tvy",
            "nrc_no": "",
            "email": "U0011@gmail.com",
            "patient_type_id": 1,
            "gender": "male",
            "phone_no": "123",
            "address": "gyvu",
            "township_id": 1,
            "zone_id": 1,
            "dob": "1956-01-01",
            "remark": "",
            "case_scenario": "case scenario",
            "having_allergy": 0,
            "created_by": "U0002",
            "updated_by": "U0002",
            "deleted_by": null,
            "created_at": "2016-12-01 10:58:04",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [],
            "core_users": {
            "id": "U0011",
            "name": "tvy",
            "password": "Vm0weGQxSXhWWGhTV0d4VFYwZG9WVll3WkRSWFJteHlXa1pPYWxKc1dqQlVWbU0x",
            "phone": "123",
            "email": "U0011@gmail.com",
            "fees": "0.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "gyvu",
            "active": 0,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-12-01 10:58:04",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
            },
            {
            "user_id": "U0012",
            "name": "U Aung",
            "nrc_no": "12/AAA(N)123456",
            "email": "U0012@gmail.com",
            "patient_type_id": 1,
            "gender": "male",
            "phone_no": "0950505050",
            "address": "Hlaing,Yangon",
            "township_id": 8,
            "zone_id": 2,
            "dob": "1971-01-01",
            "remark": "Remark for U Aung",
            "case_scenario": "case scenario",
            "having_allergy": 1,
            "created_by": "U0002",
            "updated_by": "U0002",
            "deleted_by": null,
            "created_at": "2016-12-01 11:35:49",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0012",
            "allergy_id": 2
            }
            ],
            "core_users": {
            "id": "U0012",
            "name": "U Aung",
            "password": "Vm0wd2VHUXhTWGhXV0doVFYwZDRWRll3Wkc5V1ZsbDNXa1JTV0ZKdGVIbFhhMXBQ",
            "phone": "0950505050",
            "email": "U0012@gmail.com",
            "fees": "0.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "Hlaing,Yangon",
            "active": 0,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-12-01 11:35:49",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
            },
            {
            "user_id": "U0013",
            "name": "William Turner",
            "nrc_no": "www@12344555643",
            "email": "U0013@gmail.com",
            "patient_type_id": 2,
            "gender": "male",
            "phone_no": "0945613888",
            "address": "Will turner addr",
            "township_id": 4,
            "zone_id": 1,
            "dob": "1981-01-01",
            "remark": "will turner",
            "case_scenario": "case scenario",
            "having_allergy": 0,
            "created_by": "U0002",
            "updated_by": "U0002",
            "deleted_by": null,
            "created_at": "2016-12-01 14:03:34",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [],
            "core_users": {
            "id": "U0013",
            "name": "William Turner",
            "password": "Vm1wR1UxRXlSWGhUV0d4WFlrZFNjRlZ0TVc5VU1WbDNWbXQwVmsxV1dubFdiWGhy",
            "phone": "0945613888",
            "email": "U0013@gmail.com",
            "fees": "0.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "Will turner addr",
            "active": 0,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-12-01 14:03:34",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
            },
            {
            "user_id": "U0014",
            "name": "Sam",
            "nrc_no": "sam-123456",
            "email": "U0014@gmail.com",
            "patient_type_id": 2,
            "gender": "male",
            "phone_no": "096663322",
            "address": "Shire",
            "township_id": 11,
            "zone_id": 3,
            "dob": "1996-04-01",
            "remark": "sam remark",
            "case_scenario": "case scenario",
            "having_allergy": 0,
            "created_by": "U0002",
            "updated_by": "U0002",
            "deleted_by": null,
            "created_at": "2016-12-01 14:57:05",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [],
            "core_users": {
            "id": "U0014",
            "name": "Sam",
            "password": "VjFSQ2ExSXlWbGRpUm1oT1YwVktVMVZyVmxkT1ZsSlpXWHBzVVZWWE9Eaz0=",
            "phone": "096663322",
            "email": "U0014@gmail.com",
            "fees": "0.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "Shire",
            "active": 0,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-12-01 14:57:05",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
            },
            {
            "user_id": "U0015",
            "name": "smith",
            "nrc_no": "www234567",
            "email": "U0015@gmail.com",
            "patient_type_id": 1,
            "gender": "male",
            "phone_no": "0954545454",
            "address": "addr",
            "township_id": 8,
            "zone_id": 2,
            "dob": "1984-01-01",
            "remark": "remark",
            "case_scenario": "case scenario",
            "having_allergy": 0,
            "created_by": "U0002",
            "updated_by": "U0002",
            "deleted_by": null,
            "created_at": "2016-12-01 17:56:19",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [],
            "core_users": {
            "id": "U0015",
            "name": "smith",
            "password": "V1RCa1IyVldiRmhOV0VKU1VrVldOVlJZWXpsUVVXODk=",
            "phone": "0954545454",
            "email": "U0015@gmail.com",
            "fees": "0.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "addr",
            "active": 0,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-12-01 17:56:19",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
            },
            {
            "user_id": "U0016",
            "name": "Davy Jones",
            "nrc_no": "12r214wdw13",
            "email": "U0016@gmail.com",
            "patient_type_id": 2,
            "gender": "male",
            "phone_no": "0946567955",
            "address": "underwater",
            "township_id": 3,
            "zone_id": 1,
            "dob": "1966-01-01",
            "remark": "rental car",
            "case_scenario": "case scenario",
            "having_allergy": 0,
            "created_by": "U0002",
            "updated_by": "U0002",
            "deleted_by": null,
            "created_at": "2016-12-01 17:57:04",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [],
            "core_users": {
            "id": "U0016",
            "name": "Davy Jones",
            "password": "WTBkR2VWbFhNWEJSUkVWNVRYYzlQUW89",
            "phone": "0946567955",
            "email": "U0016@gmail.com",
            "fees": "0.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "underwater",
            "active": 0,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-12-01 17:57:04",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
            },
            {
            "user_id": "U0061",
            "name": "David",
            "nrc_no": "1122334455",
            "email": "U0062@gmail.com",
            "patient_type_id": 2,
            "gender": "male",
            "phone_no": "0978787878",
            "address": "Yangon",
            "township_id": 1,
            "zone_id": 1,
            "dob": "1990-10-06",
            "remark": "remark",
            "case_scenario": "scenario",
            "having_allergy": 1,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0061",
            "allergy_id": 1
            },
            {
            "patient_id": "U0061",
            "allergy_id": 2
            }
            ],
            "core_users": {
            "id": "U0061",
            "name": "David",
            "password": "MTExMTExMTE=",
            "phone": "0978787878",
            "email": "U0062@gmail.com",
            "fees": "50000.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "Yangon",
            "active": 1,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": [
            {
            "id": "U0061",
            "patient_id": "U0061",
            "case_summary": "summary",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "0000-00-00 00:00:00",
            "deleted_at": ""
            }
            ]
            },
            {
            "user_id": "U0062",
            "name": "David",
            "nrc_no": "1122334455",
            "email": "david123@gmail.com",
            "patient_type_id": 2,
            "gender": "male",
            "phone_no": "0978787878",
            "address": "Yangon",
            "township_id": 1,
            "zone_id": 1,
            "dob": "1990-10-06",
            "remark": "remark",
            "case_scenario": "scenario",
            "having_allergy": 1,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0062",
            "allergy_id": 1
            },
            {
            "patient_id": "U0062",
            "allergy_id": 2
            }
            ],
            "core_users": {
            "id": "U0062",
            "name": "David",
            "password": "MTExMTExMTE=",
            "phone": "0978787878",
            "email": "U00624@gmail.com",
            "fees": "50000.00",
            "display_image": "",
            "mobile_image": "",
            "role_id": 5,
            "address": "Yangon",
            "active": 1,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "",
            "deleted_at": ""
            },
            "log_patient_case_summary": [
            {
            "id": "U0062",
            "patient_id": "U0062",
            "case_summary": "summary",
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-30 09:47:41",
            "updated_at": "0000-00-00 00:00:00",
            "deleted_at": ""
            }
            ]
            },
            {
            "user_id": "U0052",
            "name": "Aung Yin",
            "nrc_no": "sdfsfds2323",
            "email": "aungyin@gmail.com",
            "patient_type_id": 1,
            "gender": "male",
            "phone_no": "23423",
            "address": "yangon",
            "township_id": 1,
            "zone_id": 1,
            "dob": "0000-00-00",
            "remark": "1",
            "case_scenario": "ww",
            "having_allergy": 1,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 10:33:35",
            "updated_at": "2016-10-09 10:33:35",
            "deleted_at": "",
            "patient_allergy": [
            {
            "patient_id": "U0052",
            "allergy_id": 1
            },
            {
            "patient_id": "U0052",
            "allergy_id": 1
            },
            {
            "patient_id": "U0052",
            "allergy_id": 2
            }
            ],
            "core_users": {
            "id": "U0052",
            "name": "Aung Yin",
            "password": "MTExMTExMTE=",
            "phone": "123456",
            "email": "aungyin54646@gmail.com",
            "fees": "0.00",
            "display_image": "58412be777df7.jpg",
            "mobile_image": "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",
            "role_id": 5,
            "address": "Yangon",
            "active": 1,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0001",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": ""
            },
            "log_patient_case_summary": [
            {
            "id": "U0052",
            "patient_id": "U0052",
            "case_summary": "wwwwww",
            "created_by": "",
            "updated_by": "U0002",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 10:33:35",
            "deleted_at": ""
            }
            ]
            },
            {
            "user_id": "U0054",
            "name": "May Lay Nwe",
            "nrc_no": "sdfsfds2323",
            "email": "maylaynwefs@gmail.com",
            "patient_type_id": 1,
            "gender": "female",
            "phone_no": "23423",
            "address": "yangon",
            "township_id": 1,
            "zone_id": 1,
            "dob": "0000-00-00",
            "remark": "1",
            "case_scenario": "test test",
            "having_allergy": 1,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": "",
            "patient_allergy": [],
            "core_users": {
            "id": "U0054",
            "name": "May Lay Nwe",
            "password": "MTExMTExMTE=",
            "phone": "123456",
            "email": "maylaynwe43242@gmail.com",
            "fees": "0.00",
            "display_image": "58412be80ba65.jpg",
            "mobile_image": "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",
            "role_id": 5,
            "address": "Yangon",
            "active": 1,
            "last_activity": null,
            "remember_token": null,
            "created_by": "U0002",
            "updated_by": "",
            "deleted_by": "",
            "created_at": "2016-10-09 09:47:41",
            "updated_at": "2016-10-09 09:47:41",
            "deleted_at": ""
            },
            "log_patient_case_summary": []
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