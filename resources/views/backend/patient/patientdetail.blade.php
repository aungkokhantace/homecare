<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/26/2016
 * Time: 2:18 PM
 */
?>

@extends('layouts.master')
@section('title','Patient Detail')
@section('content')

    <!-- begin #content -->
<div id="content" class="content" xmlns="http://www.w3.org/1999/html">

        <h1 class="page-header">Patient Detail</h1>

        @if(count(Session::get('message')) != 0)
            <div>
            </div>
        @endif

        <br/>
        <div class="row">
            <div class="panel panel-default">
                <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
                <div class="panel-heading patient_detail_heading">
                    <h4 class="center_aligned"><strong>Personal Information</strong></h4>
                </div>
                <div class="panel-body">
                    @if(isset($patient->user->display_image))
                    <div class="row">
                        <img src="/images/users/{{$patient->user->display_image}}" class="center_image">
                    </div>
                    <br>
                    @endif
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="25%"><label>Name </label></td>
                            <td width="25%">{{isset($patient)? $patient->name:''}}</td>
                            <td width="25%"><label>Patient ID </label></td>
                            <td width="25%">{{isset($patient)? $patient->user_id:''}}</td>
                        </tr>
                        <tr>
                            <td width="25%"><label>DOB </label></td>
                            <td width="25%">{{isset($patient)? $patient->dob:''}}</td>
                            <td><label>Age </label></td>
                            <td>{{isset($patient)? $patient->age["value"].' '.$patient->age["unit"]:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Gender </label></td>
                            <td>{{isset($patient)? ucwords($patient->gender):''}}</td>
                            <!-- <td><label>Patient Type</label></td>
                            <td>{{isset($patient)? $patient->patient_type:''}}</td> -->
                            <td><label>NRC/Passport No. </label></td>
                            <td>{{isset($patient)? $patient->nrc_no:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Phone No.</label></td>
                            <td>{{isset($patient)? $patient->phone_no:''}}</td>
                            <td><label>Email</label></td>
                            <td>{{isset($patient)? $patient->email:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Address</label></td>
                            <td colspan="3">{{isset($patient)? $patient->address:''}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                        <h4><label><strong>Case Summary</strong></label></h4>
                        {{isset($patient)? $patient->case_scenario:''}}
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h4><label><strong>Remark</strong></label></h4>
                            {{isset($patient)? $patient->remark:''}}
                        </div>
                    </div>
                    <hr>

                    {{--start displaying allergies--}}
                    <div class="row">
                        <div class="col-md-12">
                            <h4><label><strong>Allergies</strong></label></h4>
                            <!-- if patient has allergies, display by allergy category -->
                            @if($patient->having_allergy == 1)
                                @foreach($patient['allergies']['food'] as $allergy)
                                    @if($allergy->selected == 1)
                                        <label for="allergy">[Food] - {{$allergy->name}}</label><br/>
                                    @endif
                                @endforeach

                                @foreach($patient['allergies']['drug'] as $allergy)
                                    @if($allergy->selected == 1)
                                        <label for="allergy">[Drug] - {{$allergy->name}}</label><br/>
                                    @endif
                                @endforeach

                                @foreach($patient['allergies']['environment'] as $allergy)
                                    @if($allergy->selected == 1)
                                        <label for="allergy">[Environment] - {{$allergy->name}}</label><br/>
                                    @endif
                                @endforeach
                            <!-- patient has no allergy -->
                            @else
                            <label for="allergy"><b>No</b></label>
                            @endif
                        </div>
                    </div>
                    {{--end displaying allergies--}}
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
                <div class="panel-heading patient_detail_heading">
                    <h4 class="center_aligned"><strong>Patient History</strong></h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="4" class="info"><label><strong>MO SERVICE</strong></label></td>
                        </tr>
                        <tr>
                            <td width="45%"><strong>Medical History</strong>
                                @foreach($patientmedicalhistories as $patientmedicalhistory)
                                    <br><label>{{$patientmedicalhistory->medicalHistory}}</label>
                                @endforeach
                            </td>
                            <td class="red_text" width="5%"><a target="_blank" href="/patientmedicalhistory/{{$patient->user_id}}">Edit</a></td>

                            <td width="45%"><strong>Surgery History</strong>
                                @foreach($patientsurgeryhistories as $patientsurgeryhistory)
                                    <br><label>{{$patientsurgeryhistory->description}}</label>
                                @endforeach
                            </td>
                            <td class="red_text" width="5%"><a target="_blank" href="/patientsurgeryhistory/{{$patient->user_id}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td><strong>Family History</strong>
                                @foreach($patientfamilyhistories as $patientfamilyhistory)
                                    <br><label>{{$patientfamilyhistory->familyMember}} - {{$patientfamilyhistory->familyHistory}}</label>
                                @endforeach
                            </td>
                            <td class="red_text"><a target="_blank" href="/patientfamilyhistory/{{$patient->user_id}}">Edit</a></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <!-- <tr>
                            <td colspan="4" class="info"><label><strong>MUSCULAR ACCESSMENT</strong></label></td>
                        </tr> -->
                        <tr>
                            <td colspan="4">
                                <!-- Start Muscular Accessment -->
                                    <div class="panel-group patient-detail-panel-group" id="accordion">
                                        <div class="panel panel-inverse">
                                            <!-- Panel Heading -->
                                            <div class="panel-heading light-blue-panel-heading">
                                                <h3 class="panel-title panel-title-black">
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#muscular_accessment">
                                                        <i class="fa fa-plus-circle pull-right"></i>
                                                        MUSCULAR ACCESSMENT
                                                    </a>
                                                </h3>
                                            </div>
                                            <!-- End Panel Heading -->

                                            <!-- Start Panel Body -->
                                            <div id="muscular_accessment" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h3>MUSCULAR ACCESSMENT</h3><br/>
                                                            @if(isset($musculo) && count($musculo)>0)
                                                                @if(isset($musculo['musculo_1_2']) && count($musculo['musculo_1_2']) > 0)
                                                                    @foreach($musculo['musculo_1_2'] as $musculo_1_2)
                                                                        <div class="row">
                                                                            <div class="col-md-1">
                                                                                <label>Diagnosis </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="text" class="form-control" value="{{$musculo_1_2->diagnosis}}">
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <label>Referred By </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="text" class="form-control" value="{{$musculo_1_2->referred_by}}">
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <label>History </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="text" class="form-control" value="{{$musculo_1_2->previous_medical_history}}">
                                                                            </div>
                                                                        </div>
                                                                        <hr style="border-color: #0f0f0f;"/>
                                                                        <div class="row">
                                                                            <div class="col-md-12"><h5><b>Subjective Assessment</b></h5></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12"><h5><b>1. Chief Complaint</b></h5></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>On Set</label></div>
                                                                            <div class="col-md-6"><input type="text" class="form-control" value="{{$musculo_1_2->chief_complaint_onset}}"></div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Duration</label></div>
                                                                            <div class="col-md-6"><input type="text" class="form-control" value="{{$musculo_1_2->chief_complaint_duration}}"></div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Site and spread of pain</label></div>
                                                                            <div class="col-md-6"><input type="text" class="form-control" value="{{$musculo_1_2->chief_complaint_site_and_spread_of_pain}}"></div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Behavior of Pain</label></div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_constant == 1) <input type="checkbox" checked> Constant
                                                                                @else <input type="checkbox"> Constant
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_sharp == 1) <input type="checkbox" checked> Sharp
                                                                                @else <input type="checkbox"> Sharp
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_thorbbing == 1) <input type="checkbox" checked> Throbbing
                                                                                @else <input type="checkbox"> Throbbing
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_intermittent == 1) <input type="checkbox" checked> Intermittent
                                                                                @else <input type="checkbox"> Intermittent
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_dull_ache == 1) <input type="checkbox" checked> Dull ache
                                                                                @else <input type="checkbox"> Dull ache
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_night_pain == 1) <input type="checkbox" checked> Night Pain
                                                                                @else <input type="checkbox"> Night Pain
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-1">
                                                                                @if(!empty($musculo_1_2->chief_complaint_others))
                                                                                    <input type="checkbox" checked> Others
                                                                                @else <input type="checkbox"> Others
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="text" class="form-control" value="{{isset($musculo_1_2->chief_complaint_others)?$musculo_1_2->chief_complaint_others:''}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Pain(grade)</label></div>
                                                                            <div class="col-md-4">
                                                                                <input type="range" min="1" max="10" step="2" value="{{isset($musculo_1_2->chief_complaint_pain_grade)?$musculo_1_2->chief_complaint_pain_grade:0}}" disabled="disabled">
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <input type="text" value="{{isset($musculo_1_2->chief_complaint_pain_grade)?$musculo_1_2->chief_complaint_pain_grade:0}}" class="pain_grade" >
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Aggravating Factors</label></div>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" value="{{$musculo_1_2->chief_complaint_aggravating_factors}}">
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Allevating Factors</label></div>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" value="{{$musculo_1_2->chief_complaint_alternating_factors}}">
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Sensation</label></div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_pin_and_needles == 1) <input type="checkbox" checked> Pin and Needles
                                                                                @else <input type="checkbox"> Pin and Needles
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_tingling == 1) <input type="checkbox" checked> Tingling
                                                                                @else <input type="checkbox"> Tingling
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_numbness == 1) <input type="checkbox" checked> Numbness
                                                                                @else <input type="checkbox"> Numbness
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_locking == 1) <input type="checkbox" checked> Locking
                                                                                @else <input type="checkbox"> Locking
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_popping == 1) <input type="checkbox" checked> Popping
                                                                                @else <input type="checkbox"> Popping
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->chief_complaint_giving_way == 1) <input type="checkbox" checked> Giving way of the knee
                                                                                @else <input type="checkbox"> Giving way of the knee
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-1">
                                                                                @if(!empty($musculo_1_2->cheif_comlaint_sensation_others))
                                                                                    <input type="checkbox" checked> Others
                                                                                @else <input type="checkbox"> Others
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="text" class="form-control" value="{{isset($musculo_1_2->cheif_comlaint_sensation_others)?$musculo_1_2->cheif_comlaint_sensation_others:''}}">
                                                                            </div>
                                                                        </div>
                                                                        <hr style="border-color: #0f0f0f;"/>
                                                                        <div class="row">
                                                                            <div class="col-md-12"><h5><b>Physical Assessment</b></h5></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12"><h5><b>1. Observation and Palpation</b></h5></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Posture</label></div>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" value="{{isset($musculo_1_2->observation_posture)?$musculo_1_2->observation_posture:''}}">
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Deformity</label></div>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" value="{{isset($musculo_1_2->observation_deformity)?$musculo_1_2->observation_deformity:''}}">
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Gait</label></div>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" value="{{isset($musculo_1_2->observation_gait)?$musculo_1_2->observation_gait:''}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-3"><label>Inflammation</label></div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->observation_swelling == 1) <input type="checkbox" checked> Swelling
                                                                                @else <input type="checkbox"> Swelling
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->observation_heat == 1) <input type="checkbox" checked> Heat
                                                                                @else <input type="checkbox"> Heat
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->observation_tendemess == 1) <input type="checkbox" checked> Tenderness
                                                                                @else <input type="checkbox"> Tenderness
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-offset-3 col-md-2">
                                                                                @if($musculo_1_2->observation_loss_of_function == 1) <input type="checkbox" checked> Loss of function
                                                                                @else <input type="checkbox"> Lost of function
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @if($musculo_1_2->observation_muscule_spasm == 1) <input type="checkbox" checked> Muscle spasm
                                                                                @else <input type="checkbox"> Muscle spasm
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <hr style="border-color: #0f0f0f;"/>
                                                                @endif

                                                                @if(isset($musculo['musculo_3_sitting']) && count($musculo['musculo_3_sitting']) > 0)
                                                                    <div class="row">
                                                                        <div class="col-md-12"><h5><b>Examination</b></h5></div>
                                                                    </div>
                                                                    @foreach($musculo['musculo_3_sitting'] as $sitting)
                                                                        <div class="row">
                                                                            <div class="col-md-12"><h5><b>Active Sitting</b></h5></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-1"><label>Joint:</label></div>
                                                                            <div class="col-md-3"><input type="text" class="form-control" value="{{$sitting->joint}}"></div>
                                                                            <div class="col-md-1"><label>Normal</label></div>
                                                                            <div class="col-md-1"><label>Minimum</label></div>
                                                                            <div class="col-md-1"><label>Moderate</label></div>
                                                                            <div class="col-md-1"><label>Maximum</label></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Flexion</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->flexion_normal == 1) <input type="radio" name="sitting_flexion" checked>
                                                                                @else <input type="radio" name="sitting_flexion">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->flexion_minimum == 1) <input type="radio" name="sitting_flexion" checked>
                                                                                @else <input type="radio" name="sitting_flexion">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->flexion_moderate == 1) <input type="radio" name="sitting_flexion" checked>
                                                                                @else <input type="radio" name="sitting_flexion">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->flexion_maximum == 1) <input type="radio" name="sitting_flexion" checked>
                                                                                @else <input type="radio" name="sitting_flexion">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Extension</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->extension_normal == 1) <input type="radio" name="sitting_extension" checked>
                                                                                @else <input type="radio" name="sitting_extension">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->extension_minimum == 1) <input type="radio" name="sitting_extension" checked>
                                                                                @else <input type="radio" name="sitting_extension">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->extension_moderate == 1) <input type="radio" name="sitting_extension" checked>
                                                                                @else <input type="radio" name="sitting_extension">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->extension_maximum == 1) <input type="radio" name="sitting_extension" checked>
                                                                                @else <input type="radio" name="sitting_extension">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Abduction</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->abduction_normal == 1) <input type="radio" name="sitting_abuction" checked>
                                                                                @else <input type="radio" name="sitting_abuction">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->abduction_minimum == 1) <input type="radio" name="sitting_abuction" checked>
                                                                                @else <input type="radio" name="sitting_abuction">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->abduction_moderate == 1) <input type="radio" name="sitting_abuction" checked>
                                                                                @else <input type="radio" name="sitting_abuction">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->abduction_maximum == 1) <input type="radio" name="sitting_abuction" checked>
                                                                                @else <input type="radio" name="sitting_abuction">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Adduction</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->adduction_normal == 1) <input type="radio" name="sitting_adduction" checked>
                                                                                @else <input type="radio" name="sitting_adduction">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->adduction_minimum == 1) <input type="radio" name="sitting_adduction" checked>
                                                                                @else <input type="radio" name="sitting_adduction">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->adduction_moderate == 1) <input type="radio" name="sitting_adduction" checked>
                                                                                @else <input type="radio" name="sitting_adduction">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->adduction_maximum == 1) <input type="radio" name="sitting_adduction" checked>
                                                                                @else <input type="radio" name="sitting_adduction">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Medical rotation</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->medical_rotation_normal == 1) <input type="radio" name="sitting_medical" checked>
                                                                                @else <input type="radio" name="sitting_medical">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->medical_rotation_minimum == 1) <input type="radio" name="sitting_medical" checked>
                                                                                @else <input type="radio" name="sitting_medical">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->medical_rotation_moderate == 1) <input type="radio" name="sitting_medical" checked>
                                                                                @else <input type="radio" name="sitting_medical">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->medical_rotation_maximum == 1) <input type="radio" name="sitting_medical" checked>
                                                                                @else <input type="radio" name="sitting_medical">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Lateral rotation</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->lateral_rotation_normal == 1) <input type="radio" name="sitting_lateral" checked>
                                                                                @else <input type="radio" name="sitting_lateral">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->lateral_rotation_minimum == 1) <input type="radio" name="sitting_lateral" checked>
                                                                                @else <input type="radio" name="sitting_lateral">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->lateral_rotation_moderate == 1) <input type="radio" name="sitting_lateral" checked>
                                                                                @else <input type="radio" name="sitting_lateral">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->lateral_rotation_maximum == 1) <input type="radio" name="sitting_lateral" checked>
                                                                                @else <input type="radio" name="sitting_lateral">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Side flexion</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->side_flexion_normal == 1) <input type="radio" name="sitting_side" checked>
                                                                                @else <input type="radio" name="sitting_side">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->side_flexion_minimum == 1) <input type="radio" name="sitting_side" checked>
                                                                                @else <input type="radio" name="sitting_side">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->side_flexion_moderate == 1) <input type="radio" name="sitting_side" checked>
                                                                                @else <input type="radio" name="sitting_side">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->side_flexion_maximum == 1) <input type="radio" name="sitting_side" checked>
                                                                                @else <input type="radio" name="sitting_side">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Rotation to right</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_right_normal == 1) <input type="radio" name="sitting_right" checked>
                                                                                @else <input type="radio" name="sitting_right">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_right_minimum == 1) <input type="radio" name="sitting_right" checked>
                                                                                @else <input type="radio" name="sitting_right">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_right_moderate == 1) <input type="radio" name="sitting_right" checked>
                                                                                @else <input type="radio" name="sitting_right">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_right_maximum == 1) <input type="radio" name="sitting_right" checked>
                                                                                @else <input type="radio" name="sitting_right">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="row">
                                                                            <div class=col-md-4><label>Rotation to left</label></div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_left_normal == 1) <input type="radio" name="sitting_left" checked>
                                                                                @else <input type="radio" name="sitting_left">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_left_minimum == 1) <input type="radio" name="sitting_left" checked>
                                                                                @else <input type="radio" name="sitting_left">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_left_moderate == 1) <input type="radio" name="sitting_left" checked>
                                                                                @else <input type="radio" name="sitting_left">
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($sitting->rotation_to_left_maximum == 1) <input type="radio" name="sitting_left" checked>
                                                                                @else <input type="radio" name="sitting_left">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <hr style="border-color: #0f0f0f;"/>
                                                                    @endif

                                                                            <!-- Active Standing -->
                                                                    @if(isset($musculo['musculo_3_standing']) && count($musculo['musculo_3_standing']) > 0)
                                                                        @foreach($musculo['musculo_3_standing'] as $standing)
                                                                            <div class="row">
                                                                                <div class="col-md-12"><h5><b>Active Standing</b></h5></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-1"><label>Joint:</label></div>
                                                                                <div class="col-md-3"><input type="text" class="form-control" value="{{$standing->joint}}"></div>
                                                                                <div class="col-md-1"><label>Normal</label></div>
                                                                                <div class="col-md-1"><label>Minimum</label></div>
                                                                                <div class="col-md-1"><label>Moderate</label></div>
                                                                                <div class="col-md-1"><label>Maximum</label></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Flexion</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->flexion_normal == 1) <input type="radio" name="standing_flexion" checked>
                                                                                    @else <input type="radio" name="standing_flexion">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->flexion_minimum == 1) <input type="radio" name="standing_flexion" checked>
                                                                                    @else <input type="radio" name="standing_flexion">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->flexion_moderate == 1) <input type="radio" name="standing_flexion" checked>
                                                                                    @else <input type="radio" name="standing_flexion">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->flexion_maximum == 1) <input type="radio" name="standing_flexion" checked>
                                                                                    @else <input type="radio" name="standing_flexion">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Extension</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->extension_normal == 1) <input type="radio" name="standing_extension" checked>
                                                                                    @else <input type="radio" name="standing_extension">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->extension_minimum == 1) <input type="radio" name="standing_extension" checked>
                                                                                    @else <input type="radio" name="standing_extension">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->extension_moderate == 1) <input type="radio" name="standing_extension" checked>
                                                                                    @else <input type="radio" name="standing_extension">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->extension_maximum == 1) <input type="radio" name="standing_extension" checked>
                                                                                    @else <input type="radio" name="standing_extension">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Abduction</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->abduction_normal == 1) <input type="radio" name="standing_abduction" checked>
                                                                                    @else <input type="radio" name="standing_abduction">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->abduction_minimum == 1) <input type="radio" name="standing_abduction" checked>
                                                                                    @else <input type="radio" name="standing_abduction">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->abduction_moderate == 1) <input type="radio" name="standing_abduction" checked>
                                                                                    @else <input type="radio" name="standing_abduction">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->abduction_maximum == 1) <input type="radio" name="standing_abduction" checked>
                                                                                    @else <input type="radio" name="standing_abduction">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Adduction</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->adduction_normal == 1) <input type="radio" name="standing_adduction" checked>
                                                                                    @else <input type="radio" name="standing_adduction">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->adduction_minimum == 1) <input type="radio" name="standing_adduction" checked>
                                                                                    @else <input type="radio" name="standing_adduction">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->adduction_moderate == 1) <input type="radio" name="standing_adduction" checked>
                                                                                    @else <input type="radio" name="standing_adduction">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->adduction_maximum == 1) <input type="radio" name="standing_adduction" checked>
                                                                                    @else <input type="radio" name="standing_adduction">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Medical rotation</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->medical_rotation_normal == 1) <input type="radio" name="standing_medical" checked>
                                                                                    @else <input type="radio" name="standing_medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->medical_rotation_minimum == 1) <input type="radio" name="standing_medical" checked>
                                                                                    @else <input type="radio" name="standing_medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->medical_rotation_moderate == 1) <input type="radio" name="standing_medical" checked>
                                                                                    @else <input type="radio" name="standing_medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->medical_rotation_maximum == 1) <input type="radio" name="standing_medical" checked>
                                                                                    @else <input type="radio" name="standing_medical">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Lateral rotation</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->lateral_rotation_normal == 1) <input type="radio" name="standing_lateral" checked>
                                                                                    @else <input type="radio" name="standing_lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->lateral_rotation_minimum == 1) <input type="radio" name="standing_lateral" checked>
                                                                                    @else <input type="radio" name="standing_lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->lateral_rotation_moderate == 1) <input type="radio" name="standing_lateral" checked>
                                                                                    @else <input type="radio" name="standing_lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->lateral_rotation_maximum == 1) <input type="radio" name="standing_lateral" checked>
                                                                                    @else <input type="radio" name="standing_lateral">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Side flexion</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->side_flexion_normal == 1) <input type="radio" name="standing_side" checked>
                                                                                    @else <input type="radio" name="standing_side">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->side_flexion_minimum == 1) <input type="radio" name="standing_side" checked>
                                                                                    @else <input type="radio" name="standing_side">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->side_flexion_moderate == 1) <input type="radio" name="standing_side" checked>
                                                                                    @else <input type="radio" name="standing_side">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->side_flexion_maximum == 1) <input type="radio" name="standing_side" checked>
                                                                                    @else <input type="radio" name="standing_side">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Rotation to right</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_right_normal == 1) <input type="radio" name="standing_right" checked>
                                                                                    @else <input type="radio" name="standing_right">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_right_minimum == 1) <input type="radio" name="standing_right" checked>
                                                                                    @else <input type="radio" name="standing_right">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_right_moderate == 1) <input type="radio" name="standing_right" checked>
                                                                                    @else <input type="radio" name="standing_right">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_right_maximum == 1) <input type="radio" name="standing_right" checked>
                                                                                    @else <input type="radio" name="standing_right">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Rotation to left</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_left_normal == 1) <input type="radio" name="standing_left" checked>
                                                                                    @else <input type="radio" name="standing_left">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_left_minimum == 1) <input type="radio" name="standing_left" checked>
                                                                                    @else <input type="radio" name="standing_left">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_left_moderate == 1) <input type="radio" name="standing_left" checked>
                                                                                    @else <input type="radio" name="standing_left">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($standing->rotation_to_left_maximum == 1) <input type="radio" name="standing_left" checked>
                                                                                    @else <input type="radio" name="standing_left">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                        <hr style="border-color: #0f0f0f;"/>
                                                                    @endif

                                                                    @if(isset($musculo['musculo_4_1_2']) && count($musculo['musculo_4_1_2']) > 0)
                                                                        <div class="row"><div class="col-md-12"><h5><b>Tests</b></h5></div></div>
                                                                        <div class="row"><div class="col-md-12"><h5><b>Special Tests</b></h5></div></div>
                                                                        @foreach($musculo['musculo_4_1_2'] as $musculo4_1_2)
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>SLR</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->slr_plus == 1) <input type="radio" name="slr" checked> +
                                                                                    @else <input type="radio" name="slr"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->slr_minus == 1) <input type="radio" name="slr" checked> -
                                                                                    @else <input type="radio" name="slr"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>EHL</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->ehl_plus == 1) <input type="radio" name="ehl" checked> +
                                                                                    @else <input type="radio" name="ehl"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->ehl_minus == 1) <input type="radio" name="ehl" checked> -
                                                                                    @else <input type="radio" name="ehl"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Femoral nerve stretch test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->femoral_nerve_plus == 1) <input type="radio" name="femoral" checked> +
                                                                                    @else <input type="radio" name="femoral"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->femoral_nerve_minus == 1) <input type="radio" name="femoral" checked> -
                                                                                    @else <input type="radio" name="femoral"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Empty can test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->empty_can_test_plus == 1) <input type="radio" name="empty" checked> +
                                                                                    @else <input type="radio" name="empty"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->empty_can_test_minus == 1) <input type="radio" name="empty" checked> -
                                                                                    @else <input type="radio" name="empty"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Neer's test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->neer_test_plus == 1) <input type="radio" name="neer" checked> +
                                                                                    @else <input type="radio" name="neer"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->neer_test_minus == 1) <input type="radio" name="neer" checked> -
                                                                                    @else <input type="radio" name="neer"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Hawkin's test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->hawkin_test_plus == 1) <input type="radio" name="hawkin" checked> +
                                                                                    @else <input type="radio" name="hawkin"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->hawkin_test_minus == 1) <input type="radio" name="hawkin" checked> -
                                                                                    @else <input type="radio" name="hawkin"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Gerber's life-off test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->gerber_life_off_test_plus == 1) <input type="radio" name="gerber" checked> +
                                                                                    @else <input type="radio" name="gerber"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->gerber_life_off_test_minus == 1) <input type="radio" name="gerber" checked> -
                                                                                    @else <input type="radio" name="gerber"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Drop-arm test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->drop_arm_test_plus == 1) <input type="radio" name="drop" checked> +
                                                                                    @else <input type="radio" name="drop"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->drop_arm_test_minus == 1) <input type="radio" name="drop" checked> -
                                                                                    @else <input type="radio" name="drop"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Crank test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->crank_test_plus == 1) <input type="radio" name="crank" checked> +
                                                                                    @else <input type="radio" name="crank"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->crank_test_minus == 1) <input type="radio" name="crank" checked> -
                                                                                    @else <input type="radio" name="crank"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Apprehension test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->apprehension_test_plus == 1) <input type="radio" name="apprehension" checked> +
                                                                                    @else <input type="radio" name="apprehension"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->apprehension_test_minus == 1) <input type="radio" name="apprehension" checked> -
                                                                                    @else <input type="radio" name="apprehension"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Yergason's test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->yergason_test_plus == 1) <input type="radio" name="yergason" checked> +
                                                                                    @else <input type="radio" name="yergason"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->yergason_test_minus == 1) <input type="radio" name="yergason" checked> -
                                                                                    @else <input type="radio" name="yergason"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Anterior drawer test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->anterior_drawer_test_plus == 1) <input type="radio" name="anterior" checked> +
                                                                                    @else <input type="radio" name="anterior"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->anterior_drawer_test_minus == 1) <input type="radio" name="anterior" checked> -
                                                                                    @else <input type="radio" name="anterior"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Posterior drawer test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->posterior_drawer_test_plus == 1) <input type="radio" name="posterior" checked> +
                                                                                    @else <input type="radio" name="posterior"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->posterior_drawer_test_minus == 1) <input type="radio" name="posterior" checked> -
                                                                                    @else <input type="radio" name="posterior"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Varus stress test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->varus_stress_test_plus == 1) <input type="radio" name="varus" checked> +
                                                                                    @else <input type="radio" name="varus"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->varus_stress_test_minus == 1) <input type="radio" name="varus" checked> -
                                                                                    @else <input type="radio" name="varus"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>Valgus test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->valgus_stress_test_plus == 1) <input type="radio" name="valgus" checked> +
                                                                                    @else <input type="radio" name="valgus"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->valgus_stress_test_minus == 1) <input type="radio" name="valgus" checked> -
                                                                                    @else <input type="radio" name="valgus"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3"><label>MC murray test</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->mc_murray_test_plus == 1) <input type="radio" name="mc" checked> +
                                                                                    @else <input type="radio" name="mc"> +
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_1_2->mc_murray_test_minus == 1) <input type="radio" name="mc" checked> -
                                                                                    @else <input type="radio" name="mc"> -
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <hr style="border-color: #0f0f0f;"/>
                                                                            <div class="row">
                                                                                <div class="col-md-12"><h5><b>Resisted m/s tests</b></h5></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-1"><label>Flexion</label></div>
                                                                                <div class="col-md-3">
                                                                                    <input type="text" class="form-control" value="{{$musculo4_1_2->flexion}}">
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class="col-md-1"><label>Extension</label></div>
                                                                                <div class="col-md-3">
                                                                                    <input type="text" class="form-control" value="{{$musculo4_1_2->extension}}">
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class="col-md-1"><label>Abduction</label></div>
                                                                                <div class="col-md-3">
                                                                                    <input type="text" class="form-control" value="{{$musculo4_1_2->abduction}}">
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class="col-md-1"><label>Adduction</label></div>
                                                                                <div class="col-md-3">
                                                                                    <input type="text" class="form-control" value="{{$musculo4_1_2->adduction}}">
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                        <hr style="border-color: #0f0f0f;"/>
                                                                    @endif

                                                                    @if(isset($musculo['musculo_4_3']) && count($musculo['musculo_4_3']) > 0)
                                                                        <div class="row">
                                                                            <div class="col-md-12"><h5><b>Muscle Power</b></h5></div>
                                                                        </div>
                                                                        @foreach($musculo['musculo_4_3'] as $musculo4_3)
                                                                            <div class="row">
                                                                                <div class="col-md-1"><label>M/S acting on joint:</label></div>
                                                                                <div class="col-md-3"><input type="text" class="form-control" value="{{$musculo4_3->ms_acting_on_joint}}"></div>
                                                                                <div class="col-md-1"><label>0</label></div>
                                                                                <div class="col-md-1"><label>1</label></div>
                                                                                <div class="col-md-1"><label>2</label></div>
                                                                                <div class="col-md-1"><label>3</label></div>
                                                                                <div class="col-md-1"><label>4</label></div>
                                                                                <div class="col-md-1"><label>5</label></div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Flexors</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->flexors_0 == 1) <input type="radio" name="flexor" checked>
                                                                                    @else <input type="radio" name="flexor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->flexors_1 == 1) <input type="radio" name="flexor" checked>
                                                                                    @else <input type="radio" name="flexor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->flexors_2 == 1) <input type="radio" name="flexor" checked>
                                                                                    @else <input type="radio" name="flexor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->flexors_3 == 1) <input type="radio" name="flexor" checked>
                                                                                    @else <input type="radio" name="flexor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->flexors_4 == 1) <input type="radio" name="flexor" checked>
                                                                                    @else <input type="radio" name="flexor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->flexors_5 == 1) <input type="radio" name="flexor" checked>
                                                                                    @else <input type="radio" name="flexor">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Extensors</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->extensors_0 == 1) <input type="radio" name="extensor" checked>
                                                                                    @else <input type="radio" name="extensor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->extensors_1 == 1) <input type="radio" name="extensor" checked>
                                                                                    @else <input type="radio" name="extensor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->extensors_2 == 1) <input type="radio" name="extensor" checked>
                                                                                    @else <input type="radio" name="extensor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->extensors_3 == 1) <input type="radio" name="extensor" checked>
                                                                                    @else <input type="radio" name="extensor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->extensors_4 == 1) <input type="radio" name="flexor" checked>
                                                                                    @else <input type="radio" name="flexor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->extensors_5 == 1) <input type="radio" name="extensor" checked>
                                                                                    @else <input type="radio" name="extensor">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Abductors</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->abductors_0 == 1) <input type="radio" name="abductor" checked>
                                                                                    @else <input type="radio" name="abductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->abductors_1 == 1) <input type="radio" name="abductor" checked>
                                                                                    @else <input type="radio" name="abductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->abductors_2 == 1) <input type="radio" name="abductor" checked>
                                                                                    @else <input type="radio" name="abductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->abductors_3 == 1) <input type="radio" name="abductor" checked>
                                                                                    @else <input type="radio" name="abductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->abductors_4 == 1) <input type="radio" name="abductor" checked>
                                                                                    @else <input type="radio" name="abductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->abductors_5 == 1) <input type="radio" name="abductor" checked>
                                                                                    @else <input type="radio" name="abductor">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Adductors</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->adductors_0 == 1) <input type="radio" name="adductor" checked>
                                                                                    @else <input type="radio" name="adductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->adductors_1 == 1) <input type="radio" name="adductor" checked>
                                                                                    @else <input type="radio" name="adductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->adductors_2 == 1) <input type="radio" name="adductor" checked>
                                                                                    @else <input type="radio" name="adductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->adductors_3 == 1) <input type="radio" name="adductor" checked>
                                                                                    @else <input type="radio" name="adductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->adductors_4 == 1) <input type="radio" name="adductor" checked>
                                                                                    @else <input type="radio" name="adductor">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->adductors_5 == 1) <input type="radio" name="adductor" checked>
                                                                                    @else <input type="radio" name="adductor">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Medical Rotators</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->medial_rotators_0 == 1) <input type="radio" name="medical" checked>
                                                                                    @else <input type="radio" name="medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->medial_rotators_1 == 1) <input type="radio" name="medical" checked>
                                                                                    @else <input type="radio" name="medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->medial_rotators_2 == 1) <input type="radio" name="medical" checked>
                                                                                    @else <input type="radio" name="medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->medial_rotators_3 == 1) <input type="radio" name="medical" checked>
                                                                                    @else <input type="radio" name="medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->medial_rotators_4 == 1) <input type="radio" name="medical" checked>
                                                                                    @else <input type="radio" name="medical">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->medial_rotators_5 == 1) <input type="radio" name="medical" checked>
                                                                                    @else <input type="radio" name="medical">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <br/>
                                                                            <div class="row">
                                                                                <div class=col-md-4><label>Lateral Rotators</label></div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->lateral_rotators_0 == 1) <input type="radio" name="lateral" checked>
                                                                                    @else <input type="radio" name="lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->lateral_rotators_1 == 1) <input type="radio" name="lateral" checked>
                                                                                    @else <input type="radio" name="lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->lateral_rotators_2 == 1) <input type="radio" name="lateral" checked>
                                                                                    @else <input type="radio" name="lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->lateral_rotators_3 == 1) <input type="radio" name="lateral" checked>
                                                                                    @else <input type="radio" name="lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->lateral_rotators_4 == 1) <input type="radio" name="lateral" checked>
                                                                                    @else <input type="radio" name="lateral">
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    @if($musculo4_3->lateral_rotators_5 == 1) <input type="radio" name="lateral" checked>
                                                                                    @else <input type="radio" name="lateral">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    <br/>

                                                                    @if(isset($musculo['musculo_4_4_5']) && count($musculo['musculo_4_4_5']) > 0)
                                                                        <div class="row">
                                                                            <div class="col-md-12"><h5><b>Issue that patient have.</b></h5></div>
                                                                        </div>
                                                                        @foreach($musculo['musculo_4_4_5'] as $musculo4_4_5)
                                                                            <div class="row">
                                                                                <div class="col-md-2"><label>Muscle tone</label></div>
                                                                                <div class="col-md-3">
                                                                                    <textarea class="form-control" rows="3">{{$musculo4_4_5->muscle_tone}}</textarea>
                                                                                </div>
                                                                                <div class="col-md-2"><label>Other Investigation</label></div>
                                                                                <div class="col-md-3">
                                                                                    <textarea class="form-control" rows="3">{{$musculo4_4_5->other_investigation}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->skin_conditions == 1) <input type="checkbox" checked> Skin conditions
                                                                                    @else <input type="checkbox"> Skin conditions
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->pregnancy == 1) <input type="checkbox" checked> Pregnancy
                                                                                    @else <input type="checkbox"> Pregnancy
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->malignancy == 1) <input type="checkbox" checked> Malignancy
                                                                                    @else <input type="checkbox"> Malignancy
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->heart_disease == 1) <input type="checkbox" checked> Heart Disease
                                                                                    @else <input type="checkbox"> Heart Disease
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->pacemaker == 1) <input type="checkbox" checked> Pacemaker
                                                                                    @else <input type="checkbox"> Pacemaker
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->arthritis == 1) <input type="checkbox" checked> Arthritis
                                                                                    @else <input type="checkbox"> Arthritis
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->diabetes == 1) <input type="checkbox" checked> Diabetes
                                                                                    @else <input type="checkbox"> Diabetes
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->stroke == 1) <input type="checkbox" checked> Stroke
                                                                                    @else <input type="checkbox"> Stroke
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->numbness == 1) <input type="checkbox" checked> Numbness
                                                                                    @else <input type="checkbox"> Numbness
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->osteoporosis == 1) <input type="checkbox" checked> Osteoporosis
                                                                                    @else <input type="checkbox"> Osteoporosis
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->rapid_weight_loss == 1) <input type="checkbox" checked> Rapid Weight Loss
                                                                                    @else <input type="checkbox"> Rapid Weight Loss
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->joint_replacements == 1) <input type="checkbox" checked> Joint Replacements
                                                                                    @else <input type="checkbox"> Joint Replacements
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    @if($musculo4_4_5->bowelbladder_problems == 1) <input type="checkbox" checked> Bowel/bladder problems
                                                                                    @else <input type="checkbox"> Bowel/bladder problems
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                        <hr style="border-color: #0f0f0f;"/>
                                                                    @endif
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End Muscular Accessment -->
                            </td>
                        </tr>

                        <!-- <tr>
                            <td colspan="4" class="info"><label><strong>NEURO ACCESSMENT</strong></label></td>
                        </tr> -->
                        <tr>
                            <td colspan="4">
                            <!-- Start Neuro Accessment -->
                            <div class="panel-group patient-detail-panel-group" id="accordion">
                                <div class="panel panel-inverse">
                                    <!-- Panel Heading -->
                                    <div class="panel-heading light-blue-panel-heading">
                                        <h3 class="panel-title panel-title-black">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#neuro_accessment">
                                                <i class="fa fa-plus-circle pull-right"></i>
                                                NEURO ACCESSMENT
                                            </a>
                                        </h3>
                                    </div>
                                    <!-- End Panel Heading -->

                                    <!-- Start Panel Body -->
                                    <div id="neuro_accessment" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h3>NEURO ACCESSMENT</h3><br/>
                                                    @if(isset($neuro) && count($neuro)>0)
                                                        @if(isset($neuro['general']) && count($neuro['general'])>0)
                                                            @foreach($neuro['general'] as $general)
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <label>Diagnosis </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$general->diagnosis}}">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label>Relevant </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$general->relevant}}">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label>History </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$general->history}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Pre Morbid Status</label></div>
                                                                    <div class="col-md-10">
                                                                        <label>ADLs</label><br/><label>Mobility(Walking Aid, if any)</label><br/>
                                                                        @if($general->pre_mobid_status_community == 1) <input type="checkbox" checked> Community
                                                                        @else <input type="checkbox"> Community
                                                                        @endif
                                                                        @if($general->pre_mobid_status_home_bound == 1) <input type="checkbox" checked> Home-bound
                                                                        @else <input type="checkbox"> Home-bound
                                                                        @endif
                                                                        @if($general->pre_mobid_status_wheel_chair_bound == 1) <input type="checkbox" checked> Wheel-chair bound
                                                                        @else <input type="checkbox"> Wheel-chair bound
                                                                        @endif
                                                                        @if($general->pre_mobid_status_bed_bound == 1) <input type="checkbox" checked> Bed bound
                                                                        @else <input type="checkbox"> Bed bound
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <hr style="border-color: #0f0f0f;"/>
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <label>Smoking History: Start </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$general->smoking_history_start}}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Stop </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$general->smoking_history_stop}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Mental Status</label></div>
                                                                    <div class="col-md-3"><input type="text" class="form-control" value="{{$general->mental_status}}"></div>
                                                                    <div class="col-md-2"><label>Vision</label></div>
                                                                    <div class="col-md-3"><input type="text" class="form-control" value="{{$general->vision}}"></div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Hearing</label></div>
                                                                    <div class="col-md-3"><input type="text" class="form-control" value="{{$general->hearing}}"></div>
                                                                    <div class="col-md-2"><label>Speech/Swallowing</label></div>
                                                                    <div class="col-md-3"><input type="text" class="form-control" value="{{$general->speech_swallowing}}"></div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Orientation</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($general->orientation_time ==1 ) <input type="checkbox" checked> Time
                                                                        @else <input type="checkbox"> Time
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($general->orientation_place ==1 ) <input type="checkbox" checked> Place
                                                                        @else <input type="checkbox"> Place
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($general->orientation_person ==1 ) <input type="checkbox" checked> Person
                                                                        @else <input type="checkbox"> Person
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Obey Commands:</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$general->obey_ommands}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Follow Gestures:</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$general->follow_gestures}}">
                                                                    </div>
                                                                </div>
                                                                <hr style="border-color: #0f0f0f;"/>
                                                            @endforeach
                                                        @endif
                                                        @if(isset($neuro['limb']) && count($neuro['limb']) > 0)
                                                            @foreach($neuro['limb'] as $limb)
                                                                <div class="row">
                                                                    <div class="col-md-3"><h5><b>Upper Limb</b></h5></div>
                                                                    <div class="col-md-8"><h5><b>Muscle Strength</b></h5></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-3"><h5><b>Left</b></h5></div>
                                                                    <div class="col-md-3"><h5><b>Right</b></h5></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>Shoulder</label></div>
                                                                    <div class="col-md-2"><label>Flexor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->shoulder_flexor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->shoulder_flexor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-offset-1 col-md-2"><label>Extensor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->shoulder_extensor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->shoulder_extensor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-offset-1 col-md-2"><label>Abductor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->shoulder_abductor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->shoulder_abductor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>Elbow</label></div>
                                                                    <div class="col-md-2"><label>Flexor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->elbow_flexor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->elbow_flexor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-offset-1 col-md-2"><label>Extensor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->elbow_extensor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->elbow_extensor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>Gripping</label></div>
                                                                    <div class="col-md-offset-2 col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->gripping_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->gripping_right}}">
                                                                    </div>
                                                                </div>
                                                                <hr style="border-color: #0f0f0f;"/>
                                                                <!-- Lower Limb -->
                                                                <div class="row">
                                                                    <div class="col-md-3"><h5><b>Lower Limb</b></h5></div>
                                                                    <div class="col-md-8"><h5><b>Muscle Strength</b></h5></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-3"><h5><b>Left</b></h5></div>
                                                                    <div class="col-md-3"><h5><b>Right</b></h5></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>Hip</label></div>
                                                                    <div class="col-md-2"><label>Flexor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->hip_flexor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->hip_flexor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-offset-1 col-md-2"><label>Extensor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->hip_extensor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->hip_extensor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-offset-1 col-md-2"><label>Abductor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->hip_abductor_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->hip_abductor_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>Knee</label></div>
                                                                    <div class="col-md-2"><label>Flexor</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->knee_flexion_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->knee_flexion_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-offset-1 col-md-2"><label>Extension</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->knee_extension_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->knee_extension_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>Ankle</label></div>
                                                                    <div class="col-md-2"><label>Dorsiflexion</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->ankle_dorsiflexion_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->ankle_dorsiflexion_right}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-offset-1 col-md-2"><label>Plantarflexion</label></div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->ankle_plantarflexion_left}}">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$limb->ankle_plantarflexion_right}}">
                                                                    </div>
                                                                </div>
                                                                <hr style="border-color: #0f0f0f;"/>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>ROM:</label></div>
                                                                    <div class="col-md-4">
                                                                        <textarea class="form-control" rows="4">{{$limb->rom}}</textarea>
                                                                    </div>
                                                                    <div class="col-md-1"><label>Tone:</label></div>
                                                                    <div class="col-md-4">
                                                                        <textarea class="form-control" rows="4">{{$limb->tone}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-1"><label>Sensation:</label></div>
                                                                    <div class="col-md-4">
                                                                        <textarea class="form-control" rows="4">{{$limb->sensation}}</textarea>
                                                                    </div>
                                                                    <div class="col-md-1"><label>Joint Position Sense:</label></div>
                                                                    <div class="col-md-4">
                                                                        <textarea class="form-control" rows="4">{{$limb->joint_position_sense}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <hr style="border-color: #0f0f0f;"/>
                                                            @endforeach
                                                        @endif

                                                        @if(isset($neuro['functional1']) && count($neuro['functional1']) > 0)
                                                            @foreach($neuro['functional1'] as $functional1)
                                                                <div class="row">
                                                                    <div class="col-md-12"><h5><b>Functional Performance</b></h5></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-offset-2 col-md-1"><lable>I</lable></div>
                                                                    <div class="col-md-1"><label>S</label></div>
                                                                    <div class="col-md-1"><label>Min</label></div>
                                                                    <div class="col-md-1"><label>Mod</label></div>
                                                                    <div class="col-md-1"><label>Max</label></div>
                                                                    <div class="col-md-1"><label>U</label></div>
                                                                    <div class="col-md-1"><label>NT</label></div>
                                                                    <div class="col-md-3"><label>Comments</label></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Rolling</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->rolling_i == 1)<input type="radio" name="rolling" checked>
                                                                        @else <input type="radio" name="rolling">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->rolling_s == 1)<input type="radio" name="rolling" checked>
                                                                        @else <input type="radio" name="rolling">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->rolling_min == 1)<input type="radio" name="rolling" checked>
                                                                        @else <input type="radio" name="rolling">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->rolling_mod == 1)<input type="radio" name="rolling" checked>
                                                                        @else <input type="radio" name="rolling">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->rolling_max == 1)<input type="radio" name="rolling" checked>
                                                                        @else <input type="radio" name="rolling">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->rolling_u == 1)<input type="radio" name="rolling" checked>
                                                                        @else <input type="radio" name="rolling">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->rolling_nt == 1)<input type="radio" name="rolling" checked>
                                                                        @else <input type="radio" name="rolling">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional1->rolling_comment}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Supine Lying &#8596; Sitting</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->supine_lying_sitting_i == 1)<input type="radio" name="supine" checked>
                                                                        @else <input type="radio" name="supine">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->supine_lying_sitting_s == 1)<input type="radio" name="supine" checked>
                                                                        @else <input type="radio" name="supine">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->supine_lying_sitting_min == 1)<input type="radio" name="supine" checked>
                                                                        @else <input type="radio" name="supine">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->supine_lying_sitting_mod == 1)<input type="radio" name="supine" checked>
                                                                        @else <input type="radio" name="supine">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->supine_lying_sitting_max == 1)<input type="radio" name="supine" checked>
                                                                        @else <input type="radio" name="supine">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->supine_lying_sitting_u == 1)<input type="radio" name="supine" checked>
                                                                        @else <input type="radio" name="supine">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->supine_lying_sitting_nt == 1)<input type="radio" name="supine" checked>
                                                                        @else <input type="radio" name="supine">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional1->spine_lying_sitting_comment}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Transfer (Bed &#8596; Chair)</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->transfer_bed_chair_i == 1)<input type="radio" name="transfer" checked>
                                                                        @else <input type="radio" name="transfer">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->transfer_bed_chair_s == 1)<input type="radio" name="transfer" checked>
                                                                        @else <input type="radio" name="transfer">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->transfer_bed_chair_min == 1)<input type="radio" name="transfer" checked>
                                                                        @else <input type="radio" name="transfer">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->transfer_bed_chair_mod == 1)<input type="radio" name="transfer" checked>
                                                                        @else <input type="radio" name="transfer">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->transfer_bed_chair_max == 1)<input type="radio" name="transfer" checked>
                                                                        @else <input type="radio" name="transfer">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->transfer_bed_chair_u == 1)<input type="radio" name="transfer" checked>
                                                                        @else <input type="radio" name="transfer">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->transfer_bed_chair_nt == 1)<input type="radio" name="transfer" checked>
                                                                        @else <input type="radio" name="transfer">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional1->transfer_bed_chair_comment}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Sit &#8596; Stand</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->sit_stand_i == 1)<input type="radio" name="sit_stand" checked>
                                                                        @else <input type="radio" name="sit_stand">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->sit_stand_s == 1)<input type="radio" name="sit_stand" checked>
                                                                        @else <input type="radio" name="sit_stand">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->sit_stand_min == 1)<input type="radio" name="sit_stand" checked>
                                                                        @else <input type="radio" name="sit_stand">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->sit_stand_mod == 1)<input type="radio" name="sit_stand" checked>
                                                                        @else <input type="radio" name="sit_stand">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->sit_stand_max == 1)<input type="radio" name="sit_stand" checked>
                                                                        @else <input type="radio" name="sit_stand">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->sit_stand_u == 1)<input type="radio" name="sit_stand" checked>
                                                                        @else <input type="radio" name="sit_stand">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->sit_stand_nt == 1)<input type="radio" name="sit_stand" checked>
                                                                        @else <input type="radio" name="sit_stand">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional1->sit_stand_comment}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Ambulation</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->ambulation_i == 1)<input type="radio" name="ambulation" checked>
                                                                        @else <input type="radio" name="ambulation">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->ambulation_s == 1)<input type="radio" name="ambulation" checked>
                                                                        @else <input type="radio" name="ambulation">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->ambulation_min == 1)<input type="radio" name="ambulation" checked>
                                                                        @else <input type="radio" name="ambulation">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->ambulation_mod == 1)<input type="radio" name="ambulation" checked>
                                                                        @else <input type="radio" name="ambulation">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->ambulation_max == 1)<input type="radio" name="ambulation" checked>
                                                                        @else <input type="radio" name="ambulation">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->ambulation_u == 1)<input type="radio" name="ambulation" checked>
                                                                        @else <input type="radio" name="ambulation">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional1->ambulation_nt == 1)<input type="radio" name="ambulation" checked>
                                                                        @else <input type="radio" name="ambulation">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional1->ambulation_comment}}">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                        @if(isset($neuro['functional2']) && count($neuro['functional2']) > 0)
                                                            @foreach($neuro['functional2'] as $functional2)
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        @if($functional2->walking_aid == 1) <input type="checkbox" checked> Walking Aid
                                                                        @else <input type="checkbox"> Walking Aid
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        @if($functional2->ws == 1) <input type="checkbox" checked> WS
                                                                        @else <input type="checkbox"> WS
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        @if($functional2->qs == 1) <input type="checkbox" checked> QS
                                                                        @else <input type="checkbox"> QS
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        @if($functional2->wf == 1) <input type="checkbox" checked> WF
                                                                        @else <input type="checkbox"> WF
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        @if($functional2->handroid == 1) <input type="checkbox" checked> Handhold
                                                                        @else <input type="checkbox"> Handhold
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <hr style="border-color: #0f0f0f;"/>
                                                        @endif

                                                        @if(isset($neuro['functional2']) && count($neuro['functional2']) > 0)
                                                            @foreach($neuro['functional2'] as $functional2)
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Stairs</label></div>
                                                                    <div class="col-md-1"><lable>I</lable></div>
                                                                    <div class="col-md-1"><label>S</label></div>
                                                                    <div class="col-md-1"><label>Min</label></div>
                                                                    <div class="col-md-1"><label>Mod</label></div>
                                                                    <div class="col-md-1"><label>Max</label></div>
                                                                    <div class="col-md-1"><label>U</label></div>
                                                                    <div class="col-md-1"><label>NT</label></div>
                                                                    <div class="col-md-3">
                                                                        <label>Reciprocal:</label>
                                                                        @if($functional2->reciprocal_yes == 1)<input type="radio" name="yes" checked> Yes
                                                                        @else <input type="radio" name="yes"> Yes
                                                                        @endif
                                                                        @if($functional2->reciprocal_no == 1)<input type="radio" name="yes" checked> No
                                                                        @else <input type="radio" name="yes"> No
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-offset-9 col-md-3">
                                                                        <label>Rail:</label>
                                                                        @if($functional2->rail_nil == 1)<input type="radio" name="rail" checked> Nil
                                                                        @else <input type="radio" name="rail"> Nil
                                                                        @endif
                                                                        @if($functional2->rail_1 == 1)<input type="radio" name="rail" checked> 1
                                                                        @else <input type="radio" name="yes"> No
                                                                        @endif
                                                                        @if($functional2->rail_2 == 1)<input type="radio" name="rail" checked> 2
                                                                        @else <input type="radio" name="rail"> No
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Writing</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->writing_i == 1)<input type="radio" name="writing" checked>
                                                                        @else <input type="radio" name="writing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->writing_s == 1)<input type="radio" name="writing" checked>
                                                                        @else <input type="radio" name="writing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->writing_min == 1)<input type="radio" name="writing" checked>
                                                                        @else <input type="radio" name="writing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->writing_mod == 1)<input type="radio" name="writing" checked>
                                                                        @else <input type="radio" name="writing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->writing_max == 1)<input type="radio" name="writing" checked>
                                                                        @else <input type="radio" name="writing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->writing_u == 1)<input type="radio" name="writing" checked>
                                                                        @else <input type="radio" name="writing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->writing_nt == 1)<input type="radio" name="writing" checked>
                                                                        @else <input type="radio" name="writing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional2->writing_comment}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Holding</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->holding_i == 1)<input type="radio" name="holding" checked>
                                                                        @else <input type="radio" name="holding">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->holding_s == 1)<input type="radio" name="holding" checked>
                                                                        @else <input type="radio" name="holding">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->holding_min == 1)<input type="radio" name="holding" checked>
                                                                        @else <input type="radio" name="holding">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->holding_mod == 1)<input type="radio" name="holding" checked>
                                                                        @else <input type="radio" name="holding">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->holding_max == 1)<input type="radio" name="holding" checked>
                                                                        @else <input type="radio" name="holding">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->holding_u == 1)<input type="radio" name="holding" checked>
                                                                        @else <input type="radio" name="holding">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->holding_nt == 1)<input type="radio" name="holding" checked>
                                                                        @else <input type="radio" name="holding">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional2->holding_comment}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Picking Up</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->picking_up_i == 1)<input type="radio" name="picking" checked>
                                                                        @else <input type="radio" name="picking">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->picing_up_s == 1)<input type="radio" name="picking" checked>
                                                                        @else <input type="radio" name="picking">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->picking_up_min == 1)<input type="radio" name="picking" checked>
                                                                        @else <input type="radio" name="picking">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->picking_up_mod == 1)<input type="radio" name="picking" checked>
                                                                        @else <input type="radio" name="picking">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->picking_up_max == 1)<input type="radio" name="picking" checked>
                                                                        @else <input type="radio" name="picking">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->picking_up_u == 1)<input type="radio" name="picking" checked>
                                                                        @else <input type="radio" name="picking">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->picking_up_nt == 1)<input type="radio" name="picking" checked>
                                                                        @else <input type="radio" name="picking">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional2->picking_up_comment}}">
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Reaching</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->reaching_i == 1)<input type="radio" name="reaching" checked>
                                                                        @else <input type="radio" name="reaching">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->reaching_s == 1)<input type="radio" name="reaching" checked>
                                                                        @else <input type="radio" name="reaching">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->reaching_min == 1)<input type="radio" name="reaching" checked>
                                                                        @else <input type="radio" name="reaching">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->reaching_mod == 1)<input type="radio" name="reaching" checked>
                                                                        @else <input type="radio" name="reaching">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->reaching_max == 1)<input type="radio" name="reaching" checked>
                                                                        @else <input type="radio" name="reaching">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->reaching_u == 1)<input type="radio" name="reaching" checked>
                                                                        @else <input type="radio" name="reaching">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional2->reaching_nt == 1)<input type="radio" name="reaching" checked>
                                                                        @else <input type="radio" name="reaching">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional2->reaching_comment}}">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <hr style="border-color: #0f0f0f;"/>
                                                        @endif

                                                        @if(isset($neuro['functional3']) && count($neuro['functional3']) > 0)
                                                            @foreach($neuro['functional3'] as $functional3)
                                                                <div class="row">
                                                                    <div class="col-md-offset-2 col-md-1"><label>Good</label></div>
                                                                    <div class="col-md-1"><label>Fair</label></div>
                                                                    <div class="col-md-1"><label>Poor</label></div>
                                                                    <div class="col-md-1"><label>NT</label></div>
                                                                    <div class="col-md-3"><label>Comments</label></div>
                                                                    <div class="col-md-3"><label>Description</label></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Static Sitting</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_sitting_good == 1) <input type="radio" name="static_sitting" checked>
                                                                        @else <input type="radio" name="static_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_sitting_fair == 1) <input type="radio" name="static_sitting" checked>
                                                                        @else <input type="radio" name="static_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_sitting_poor == 1) <input type="radio" name="static_sitting" checked>
                                                                        @else <input type="radio" name="static_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_sitting_nt == 1) <input type="radio" name="static_sitting" checked>
                                                                        @else <input type="radio" name="static_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional3->static_sitting_comment}}">
                                                                    </div>
                                                                    <div class="col-md-3"><label>Fair: Unsupported 5-15 sec</label></div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Dynamic Sitting</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_sitting_good == 1) <input type="radio" name="dynamic_sitting" checked>
                                                                        @else <input type="radio" name="dynamic_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_sitting_fair == 1) <input type="radio" name="dynamic_sitting" checked>
                                                                        @else <input type="radio" name="dynamic_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_sitting_poor == 1) <input type="radio" name="dynamic_sitting" checked>
                                                                        @else <input type="radio" name="dynamic_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_sitting_nt == 1) <input type="radio" name="dynamic_sitting" checked>
                                                                        @else <input type="radio" name="dynamic_sitting">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional3->dynamic_sitting_comment}}">
                                                                    </div>
                                                                    <div class="col-md-3"><label>Fair: Reaches in 2 direction</label></div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Static Standing</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_standing_good == 1) <input type="radio" name="static_standing" checked>
                                                                        @else <input type="radio" name="static_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_standing_fair == 1) <input type="radio" name="static_standing" checked>
                                                                        @else <input type="radio" name="static_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_standing_poor == 1) <input type="radio" name="static_standing" checked>
                                                                        @else <input type="radio" name="static_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->static_standing_nt == 1) <input type="radio" name="static_standing" checked>
                                                                        @else <input type="radio" name="static_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional3->static_standing_comment}}">
                                                                    </div>
                                                                    <div class="col-md-3"><label>Fair: Unsupported 5-15 sec</label></div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Dynamic Standing</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_standing_good == 1) <input type="radio" name="dynamic_standing" checked>
                                                                        @else <input type="radio" name="dynamic_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_standing_fair == 1) <input type="radio" name="dynamic_standing" checked>
                                                                        @else <input type="radio" name="dynamic_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_standing_poor == 1) <input type="radio" name="dynamic_standing" checked>
                                                                        @else <input type="radio" name="dynamic_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->dynamic_standing_nt == 1) <input type="radio" name="dynamic_standing" checked>
                                                                        @else <input type="radio" name="dynamic_standing">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional3->dynamic_standing_comment}}">
                                                                    </div>
                                                                    <div class="col-md-3"><label>Fair: Reaches in 2 direction</label></div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2"><label>Activity Tolerance</label></div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->activity_tolerance_good == 1) <input type="radio" name="activity_tolerance" checked>
                                                                        @else <input type="radio" name="activity_tolerance">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->activity_tolerance_fair == 1) <input type="radio" name="activity_tolerance" checked>
                                                                        @else <input type="radio" name="activity_tolerance">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->activity_tolerance_poor == 1) <input type="radio" name="activity_tolerance" checked>
                                                                        @else <input type="radio" name="activity_tolerance">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        @if($functional3->activity_tolerance_nt == 1) <input type="radio" name="activity_tolerance" checked>
                                                                        @else <input type="radio" name="activity_tolerance">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" value="{{$functional3->activity_tolerance_comment}}">
                                                                    </div>
                                                                    <div class="col-md-3"><label>Fair: Tolerates 15-30 mins</label></div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">Short Term Goal</div>
                                                                    <div class="col-md-8">
                                                                        <textarea class="form-control" rows="3">{{$functional3->short_term_goal}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <div class="row">
                                                                    <div class="col-md-2">Long Term Goal</div>
                                                                    <div class="col-md-8">
                                                                        <textarea class="form-control" rows="3">{{$functional3->long_term_goal}}</textarea>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <!-- End Neuro Accessment -->
                            </td>
                        </tr>

                        <!-- <tr>
                            <td colspan="4" class="info"><label><strong>NUTRITION</strong></label></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="4" class="info"><label><strong>BLOOD DRAWING</strong></label></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr> -->
                        </tbody>
                    </table>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
        <div class="panel panel-default">
            <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
            <div class="panel-heading patient_detail_heading">
                <h4 class="center_aligned"><strong>Patient Visit Records</strong></h4>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr class="info">
                        <td>Date</td>
                        <td>Doctor</td>
                        <td>Service</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    @if(isset($patientSchedules) && count($patientSchedules)>0)
                        @foreach($patientSchedules as $schedule)
                            <tr>
                                <td>{{$schedule['date']}}</td>
                                <td>{{$schedule['leader']}}</td>
                                <td>{{$schedule['service']}}</td>
                                <td><a href="/patient/detailvisit/{{$schedule['id']}}">Detail</a></td>
                                <td><a target="_blank" href="/patient/invoice/{{$schedule['invoice_id']}}">Invoice</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
    </div>
    </div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {

            $('#list-table tfoot th.search-col').each( function () {
                var title = $('#list-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table = $('#list-table').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $('#list-table2 tfoot th.search-col').each( function () {
                var title = $('#list-table2 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table2 = $('#list-table2').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table2.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table2.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table2
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });


            $('#list-table3 tfoot th.search-col').each( function () {
                var title = $('#list-table3 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table3 = $('#list-table3').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table3.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table3.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table3
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $('#list-table4 tfoot th.search-col').each( function () {
                var title = $('#list-table4 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table4 = $('#list-table4').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table4.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table4.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table4
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $('#list-table5 tfoot th.search-col').each( function () {
                var title = $('#list-table5 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table5 = $('#list-table5').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table5.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table5.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table5
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $("#check_all_patientfamilyhistory").click(function(event){
                if(this.checked) {
                    $('.check_source_patientfamilyhistory').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"
                    });
                }else{
                    $('.check_source_patientfamilyhistory').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"
                    });
                }
            });

            $("#check_all_patientsurgeryhistory").click(function(event){
                if(this.checked) {
                    $('.check_source_patientsurgeryhistory').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"
                    });
                }else{
                    $('.check_source_patientsurgeryhistory').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"
                    });
                }
            });

        });
    </script>
@stop