<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:48 AM
 */
?>

@extends('layouts.master')
@section('title','Sync Down API Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">
    <h1 class="page-header">API List</h1>
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#" class="api-active-tab">Sync Down API</a></li>
            <li><a href="/apilist/invoiceapi" class="api-tab">Invoice API</a></li>
            <li><a href="/apilist/enquiryapi" class="api-tab">Enquiry API</a></li>
            <li><a href="/apilist/scheduleapi" class="api-tab">Schedule API</a></li>
            <li><a href="/apilist/patientpackageapi" class="api-tab">Patient Package API</a></li>
            <li><a href="/apilist/waytrackingapi" class="api-tab">Way Tracking API</a></li>
            <li><a href="/apilist/patientapi" class="api-tab">Patient API</a></li>
        </ul>
    </div>

    <div class="row">
        <h4>URL</h4>
        <p><b>http://localhost:8000/api/syncs/down</b></p>
    </div>
    <hr>
    <div class="row">
        <h4>Description</h4>
        <p>This API is for synchronizing backend server data and frontend tablet data. Tablet upload it's data to server and download data from server.</p>
        <ol>
            <li>Tablet uploads table names and versions.</li>
            <li>In server side, activation keys from input json are checked. If valid, proceeds to next step. Else,stops by returning error message.</li>
            <li>In server, data from 'core_syncs_table' are retrieved.</li>
            <li>Compare versions of tables from tablet and retrieved versions.</li>
            <li>Tables that have version lower than server version are downloaded from server.</li>
            <li>For the tables that have the same version, empty array with key is returned.</li>
        </ol>
    </div>
    <hr>
    {{--<div class="row">--}}
        {{--<h4>Input Format</h4>--}}
        {{--<p>--}}
        {{--</p>--}}
    {{--</div>--}}
    {{--<hr>--}}
    <div class="row">
        <h4>Sample Input JSON</h4>
        <pre>
            {
            "site_activation_key": "1234567",
            "tablet_activation_key": "aaaaa",
            "user_id": "U0004",
            "data": [
            {
            "name": "allergies",
            "version": "4"
            },
            {
            "name": "schedules",
            "version": "3"
            },
            {
            "name": "schedule_detail",
            "version": "0"
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
            "tabletId": "U003",
            "user_id": "U0004",
            "data": {
            "allergies": [],
            "schedules": [],
            "schedule_detail": [],
            "core_syncs_tables": [
            {
            "id": 1,
            "name": "core_configs",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 2,
            "name": "core_permissions",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 3,
            "name": "core_permission_role",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 4,
            "name": "core_roles",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 5,
            "name": "core_users",
            "version": 70,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:28:41",
            "deleted_at": null
            },
            {
            "id": 6,
            "name": "core_settings",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 7,
            "name": "cities",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 8,
            "name": "townships",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 9,
            "name": "car_types",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-08 11:15:41",
            "deleted_at": null
            },
            {
            "id": 10,
            "name": "zones",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-08 11:13:12",
            "deleted_at": null
            },
            {
            "id": 11,
            "name": "zone_detail",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 12,
            "name": "car_type_setup",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-08 11:22:18",
            "deleted_at": null
            },
            {
            "id": 13,
            "name": "product_categories",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-08 10:59:22",
            "deleted_at": null
            },
            {
            "id": 14,
            "name": "products",
            "version": 33,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:53",
            "deleted_at": null
            },
            {
            "id": 15,
            "name": "packages",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-08 11:10:04",
            "deleted_at": null
            },
            {
            "id": 16,
            "name": "package_detail",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 17,
            "name": "investigations",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 18,
            "name": "physical_exams",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 19,
            "name": "services",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-08 11:08:23",
            "deleted_at": null
            },
            {
            "id": 20,
            "name": "allergies",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-08 12:04:25",
            "deleted_at": null
            },
            {
            "id": 21,
            "name": "family_histories",
            "version": 34,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:53",
            "deleted_at": null
            },
            {
            "id": 22,
            "name": "medical_history",
            "version": 37,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:53",
            "deleted_at": null
            },
            {
            "id": 23,
            "name": "patients",
            "version": 66,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:28:41",
            "deleted_at": null
            },
            {
            "id": 24,
            "name": "patient_allergy",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 25,
            "name": "patient_family_history",
            "version": 9,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:50",
            "deleted_at": null
            },
            {
            "id": 26,
            "name": "patient_medical_history",
            "version": 5,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:50",
            "deleted_at": null
            },
            {
            "id": 27,
            "name": "patient_package",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-10 16:02:14",
            "deleted_at": null
            },
            {
            "id": 28,
            "name": "patient_package_detail",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 29,
            "name": "patient_surgery_history",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 30,
            "name": "provisional_diagnosis",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-13 11:28:20",
            "deleted_at": null
            },
            {
            "id": 31,
            "name": "patient_family_member",
            "version": 36,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-02 09:37:40",
            "deleted_at": null
            },
            {
            "id": 32,
            "name": "route",
            "version": 15,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:53",
            "deleted_at": null
            },
            {
            "id": 33,
            "name": "schedule_treatment_histories",
            "version": 12,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:51",
            "deleted_at": null
            },
            {
            "id": 34,
            "name": "enquiries",
            "version": 79,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:53",
            "deleted_at": null
            },
            {
            "id": 35,
            "name": "enquiry_detail",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 36,
            "name": "schedules",
            "version": 40,
            "active": 1,
            "created_by": null,
            "updated_by": "U0001",
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:53",
            "deleted_at": null
            },
            {
            "id": 37,
            "name": "schedule_detail",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
            },
            {
            "id": 38,
            "name": "patient_physiotherapy_neuro_general",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-13 16:03:32",
            "deleted_at": null
            },
            {
            "id": 39,
            "name": "patient_physiotherapy_neuro_limb",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-13 16:03:32",
            "deleted_at": null
            },
            {
            "id": 40,
            "name": "patient_physiotherapy_neuro_functional_performance1",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-13 16:03:32",
            "deleted_at": null
            },
            {
            "id": 41,
            "name": "patient_physiotherapy_neuro_functional_performance2",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-13 16:03:32",
            "deleted_at": null
            },
            {
            "id": 42,
            "name": "patient_physiotherapy_neuro_functional_performance3",
            "version": 1,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-11-13 16:03:32",
            "deleted_at": null
            },
            {
            "id": 43,
            "name": "patient_physiothreapy_musculo_1_and_2",
            "version": 8,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:49",
            "deleted_at": null
            },
            {
            "id": 44,
            "name": "patient_physiotherapy_musculo_3_sitting",
            "version": 8,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:49",
            "deleted_at": null
            },
            {
            "id": 45,
            "name": "patient_physiotherapy_musculo_3_standing",
            "version": 8,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:49",
            "deleted_at": null
            },
            {
            "id": 46,
            "name": "patient_physiotherapy_musculo_4_1and2",
            "version": 8,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:49",
            "deleted_at": null
            },
            {
            "id": 47,
            "name": "patient_physiotherapy_musculo_4_3",
            "version": 6,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:49",
            "deleted_at": null
            },
            {
            "id": 48,
            "name": "patient_physiotherapy_musculo_4_4and5",
            "version": 6,
            "active": 1,
            "created_by": null,
            "updated_by": null,
            "deleted_by": null,
            "created_at": null,
            "updated_at": "2016-12-01 18:29:50",
            "deleted_at": null
            }
            ],
            "max_key": [
            {
            "table_name": "patients",
            "max_key_id": 0
            },
            {
            "table_name": "core_users",
            "max_key_id": 0
            },
            {
            "table_name": "schedules",
            "max_key_id": 0
            },
            {
            "table_name": "enquiries",
            "max_key_id": 0
            },
            {
            "table_name": "patient_family_history",
            "max_key_id": 0
            },
            {
            "table_name": "patient_medical_history",
            "max_key_id": 0
            },
            {
            "table_name": "patient_surgery_history",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_treatment_histories",
            "max_key_id": 0
            },
            {
            "table_name": "products",
            "max_key_id": 0
            },
            {
            "table_name": "route",
            "max_key_id": 0
            },
            {
            "table_name": "invoices",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_physiotherapy_musculo",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_physiotherapy_neuro",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_patient_vitals",
            "max_key_id": 0
            },
            {
            "table_name": "medical_history",
            "max_key_id": 0
            },
            {
            "table_name": "family_histories",
            "max_key_id": 0
            },
            {
            "table_name": "patient_family_member",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_physical_exams_abdomen_extre_neuro",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_physical_exams_heart_lungs",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_physical_exams_general_pupils_head",
            "max_key_id": 0
            },
            {
            "table_name": "way_tracking",
            "max_key_id": 0
            },
            {
            "table_name": "patient_package",
            "max_key_id": 0
            },
            {
            "table_name": "schedule_patient_chief_complaint",
            "max_key_id": 0
            },
            {
            "table_name": "log_patient_case_summary",
            "max_key_id": 0
            }
            ]
            }
            }
            </pre>

    </div>
    <hr>
</div>
@stop

@section('page_script')

@stop