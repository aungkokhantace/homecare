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
    <div id="content" class="content">

        <h1 class="page-header">Patient Detail Visit Record</h1>

        @if(count(Session::get('message')) != 0)
            <div>
            </div>
        @endif

        <br/>
        <div class="row">

            <div class="panel panel-default">
                <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
                <div class="panel-heading">
                    <h5><strong>Patient Information</strong></h5>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><label>Patient Name </label></td>
                            <td>{{isset($patient)? $patient->name:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Registration ID </label></td>
                            <td>{{isset($patient)? $patient->user_id:''}}</td>
                        </tr>
                        <tr>
                            <td><label>NRC/Passport No. </label></td>
                            <td>{{isset($patient)? $patient->nrc_no:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Date of Birth</label></td>
                            <td>{{isset($patient)? $patient->dob:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Phone No.</label></td>
                            <td>{{isset($patient)? $patient->phone_no:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Address</label></td>
                            <td>{{isset($patient)? $patient->address:''}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Start Vital Accordion -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#vital">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Vital
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="vital" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Vital</h3>
                                @if(isset($vitals) && count($vitals)>0)
                                <table class="table table-condensed">
                                    <tr class="detail_visit_vital">
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Blood Pressure</th>
                                        <th>SPO2</th>
                                        <th>Pulse Rate</th>
                                        <th>Body Temperature</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Blood Sugar</th>
                                    </tr>
                                    @foreach($vitals as $vital)
                                        <tr class="detail_visit_vital_row">
                                            <td>{{$vital->date}}</td>
                                            <td>{{$vital->time}}</td>
                                            <td>
                                                {{$vital->blood_pressure_sbp}}<br/>
                                                {{$vital->blood_pressure_dbp}}<br/>
                                                {{$vital->blood_pressure_map}}
                                            </td>
                                            <td>{{$vital->spo2 . '%'}}</td>
                                            <td>{{$vital->pulse_rate . '/min'}}</td>
                                            <td>{{$vital->body_temperature_farenheit}}&#8457;</td>
                                            <td>{{$vital->weight_pound}}lb</td>
                                            <td>{{$vital->height_feet}}&#39;{{$vital->height_inches}}&#34;</td>
                                            <td>{{$vital->blood_sugar . 'mg%'}}</td>
                                        </tr>
                                    @endforeach
                                </table>

                                <div class="row">
                                    <div class="col-sm-1"><label>Remark</label></div>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" id="remark" rows="3" cols="5"> {{$vital->remark}} </textarea>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Vital Accordion -->

        <!-- Start Chief Complaint Accordion -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#chief_complaint">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Chief Complaint
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="chief_complaint" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Chief Complaint</h3>
                                @if(isset($chief_complaints) && count($chief_complaints)>0)
                                <table class="table table-condensed">
                                    <tr class="detail_visit_vital">
                                        <th>Description</th>
                                        <th>Duration</th>
                                    </tr>
                                    @foreach($chief_complaints as $chief_complaint)
                                        <tr class="detail_visit_vital_row">
                                            <td>{{$chief_complaint->chief_complaint_comment}}</td>
                                            <td>{{$chief_complaint->duration_days.'Days '.$chief_complaint->duration_months.'Months'}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="row">
                                    <div class="col-md-3"><label>History of Present Illness</label></div>
                                    <div class="col-md-9"><textarea class="form-control" id="remark" rows="3" cols="5">@if(isset($chief_complaints) && count($chief_complaints)>0){{$chief_complaint->hopi}}@endif</textarea></div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Chief Complaint Accordion -->

        <!-- Start Physical Examination Accordion -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#physical_examination">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Physical Examination
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="physical_examination" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Physical Examination</h3>
                                @if(isset($gph) && count($gph)>0)
                                <!-- Start General Condition -->
                                <div class="row">
                                    <div class="col-md-3"><label>General Condition</label></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($gph->alert == 1) <input type="checkbox" checked>{{'Alert'}}
                                                @else <input type="checkbox">{{'Alert'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($gph->unconscious == 1) <input type="checkbox" checked>{{'Unconscious'}}
                                                @else <input type="checkbox">{{'Unconscious'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($gph->semiconscious == 1) <input type="checkbox" checked>{{'Semiconscious'}}
                                                @else <input type="checkbox">{{'Semiconscious'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($gph->drowsy == 1) <input type="checkbox" checked>{{'Drowsy'}}
                                                @else <input type="checkbox">{{'Drowsy'}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5"> {{$gph->general_remark}}</textarea>
                                    </div>
                                </div>
                                <!-- End General Condition -->
                                <br/>
                                <!-- Start Pupils -->
                                <div class="row">
                                    <div class="col-md-3"><label>Pupils</label></div>
                                    <div class="col-md-8">
                                        <!-- Start Normal or Abnormal -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($gph->pupils_normal == 1)<input type="radio" checked>{{'Normal'}}
                                                @else <input type="radio">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($gph->pupils_abnormal == 1)<input type="radio" checked>{{'Abnormal'}}
                                                @else <input type="radio">{{'Abnormal'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Normal or Abnormal -->
                                        <br/>
                                        @if($gph->pupils_abnormal == 1)
                                            <div class="row">
                                                <div class="col-md-4"><b>{{'Left'}}</b></div>
                                                <div class="col-md-4"><b>{{'Right'}}</b></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if($gph->pupils_left_pinpoint_pupil == 1) <input type="radio" checked>{{'Pinpoint Pupil'}}
                                                    @else <input type="radio">{{'Pinpoint Pupil'}}
                                                    @endif
                                                    <br/>
                                                    @if($gph->pupils_left_reactive == 1) <input type="radio" checked>{{'Reactive'}}
                                                    @else <input type="radio">{{'Reactive'}}
                                                    @endif
                                                    <br/>
                                                    @if($gph->pupils_left_not_reactive == 1) <input type="radio" checked>{{'Not Reactive to light'}}
                                                    @else <input type="radio">{{'Not Reactive to light'}}
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @if($gph->pupils_right_pinpoint_pupil == 1) <input type="radio" checked>{{'Pinpoint Pupil'}}
                                                    @else <input type="radio">{{'Pinpoint Pupil'}}
                                                    @endif
                                                    <br>
                                                    @if($gph->pupils_right_reactive == 1) <input type="radio" checked>{{'Reactive'}}
                                                    @else <input type="radio">{{'Reactive'}}
                                                    @endif
                                                    <br/>
                                                    @if($gph->pupils_right_not_reactive == 1) <input type="radio" checked>{{'Not Reactive to light'}}
                                                    @else <input type="radio">{{'Not Reactive to light'}}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5">{{$gph->pupils_remark}}</textarea>
                                    </div>
                                </div>
                                <!-- End Remark -->
                                <!-- End Pupil -->
                                <br/>
                                <!-- Start Head and Neck -->
                                <div class="row">
                                    <div class="col-md-3"><label>Head and Neck</label></div>
                                    <div class="col-md-8">
                                        <!-- Start Normal or Abnormal -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($gph->head_normal == 1)<input type="radio" checked>{{'Normal'}}
                                                @else <input type="radio">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($gph->head_abnormal == 1)<input type="radio" checked>{{'Abnormal'}}
                                                @else <input type="radio">{{'Abnormal'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Normal or Abnormal -->
                                        @if($gph->head_abnormal == 1)
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($gph->head_JVD == 1)<input type="checkbox" checked>{{'JVD'}}
                                                @else <input type="checkbox">{{'JVD'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($gph->head_Goiter == 1)<input type="checkbox" checked>{{'Goiter'}}
                                                @else <input type="checkbox">{{'Goiter'}}
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                @if($gph->head_Lympha == 1)<input type="checkbox" checked>{{'Lymphadenopathy'}}
                                                @else <input type="checkbox">{{'Lymphadenopathy'}}
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5"> {{$gph->head_remark}} </textarea>
                                    </div>
                                </div>
                                <!-- End Remark -->
                                <!-- End Head and Neck -->
                                @endif
                                <br/>
                                @if(isset($hl) && count($hl)>0)
                                <!-- Start Heart -->
                                <div class="row">
                                    <div class="col-md-3"><label>Heart</label></div>
                                    <div class="col-md-8">
                                        <!-- Start Normal or Abnormal -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($hl->heart_normal == 1)<input type="radio" checked>{{'Normal'}}
                                                @else <input type="radio">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($hl->heart_abnormal == 1)<input type="radio" checked>{{'Abnormal'}}
                                                @else <input type="radio">{{'Abnormal'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Normal or Abnormal -->
                                        @if($hl->heart_abnormal == 1)
                                        <!-- Start Heart Rate -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <b>{{'Rate'}}</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($hl->heart_rate_normal == 1)<input type="checkbox" checked>{{'Normal'}}
                                                @else <input type="checkbox">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($hl->heart_rate_brady == 1)<input type="checkbox" checked>{{'Brady'}}
                                                @else <input type="checkbox">{{'Brady'}}
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                @if($hl->heart_rate_tachy == 1)<input type="checkbox" checked>{{'Tachy'}}
                                                @else <input type="checkbox">{{'Tachy'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Heart Rate -->
                                        <br/>
                                        <!-- Start Heart Rhythm -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <b>{{'Rhythm'}}</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($hl->heart_rhythm_regular == 1)<input type="checkbox" checked>{{'Regular'}}
                                                @else <input type="checkbox">{{'Regular'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($hl->heart_rhythm_irregular == 1)<input type="checkbox" checked>{{'Irregular'}}
                                                @else <input type="checkbox">{{'Irregular'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Heart Rhythm -->
                                        <br/>
                                        <!-- Start Heart Sound -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <b>{{'Sound'}}</b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($hl->heart_sound_s1 == 1)<input type="checkbox" checked>{{'S1'}}
                                                @else <input type="checkbox">{{'S1'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($hl->heart_sound_s2 == 1)<input type="checkbox" checked>{{'S2'}}
                                                @else <input type="checkbox">{{'S2'}}
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                @if($hl->heart_sound_systolic == 1)<input type="checkbox" checked>{{'Systolic Murmur'}}
                                                @else <input type="checkbox">{{'Systolic Murmur'}}
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                @if($hl->heart_sound_diastolic == 1)<input type="checkbox" checked>{{'Diastolic Murmur'}}
                                                @else <input type="checkbox">{{'Diastolic Murmur'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Heart Sound -->
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5"> {{$hl->heart_remark}} </textarea>
                                    </div>
                                </div>
                                <!-- End Remark -->
                                <!-- End Heart -->
                                <br/>
                                <!-- Start Lungs -->
                                <div class="row">
                                    <div class="col-md-3"><label>Lungs</label></div>
                                    <div class="col-md-8">
                                        <!-- Start Normal or Abnormal -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($hl->lungs_normal == 1)<input type="radio" checked>{{'Normal'}}
                                                @else <input type="radio">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($hl->lungs_abnormal == 1)<input type="radio" checked>{{'Abnormal'}}
                                                @else <input type="radio">{{'Abnormal'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Normal or Abnormal -->
                                        <br/>
                                        @if($hl->lungs_abnormal == 1)
                                            <div class="row">
                                                <div class="col-md-4"><b>{{'Left'}}</b></div>
                                                <div class="col-md-4"><b>{{'Right'}}</b></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if($hl->lungs_left_chest == 1) <input type="checkbox" checked>{{'Chest Wall Tenderness'}}
                                                    @else <input type="checkbox">{{'Chest Wall Tenderness'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_left_dullness == 1) <input type="checkbox" checked>{{'Dullness on Percussion'}}
                                                    @else <input type="checkbox">{{'Dullness on Percussion'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_left_reduced == 1) <input type="checkbox" checked>{{'Reduced BS'}}
                                                    @else <input type="checkbox">{{'Reduced BS'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_left_absent == 1) <input type="checkbox" checked>{{'Absent BS'}}
                                                    @else <input type="checkbox">{{'Absent BS'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_left_crepitations == 1) <input type="checkbox" checked>{{'Crepitations'}}
                                                    @else <input type="checkbox">{{'Crepitations'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_left_wheezing == 1) <input type="checkbox" checked>{{'Wheezing'}}
                                                    @else <input type="checkbox">{{'Wheezing'}}
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @if($hl->lungs_right_chest == 1) <input type="checkbox" checked>{{'Chest Wall Tenderness'}}
                                                    @else <input type="checkbox">{{'Chest Wall Tenderness'}}
                                                    @endif
                                                    <br>
                                                    @if($hl->lungs_right_dullness == 1) <input type="checkbox" checked>{{'Dullness on Percussion'}}
                                                    @else <input type="checkbox">{{'Dullness on Percussion'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_right_reduced == 1) <input type="checkbox" checked>{{'Reduced BS'}}
                                                    @else <input type="checkbox">{{'Reduced BS'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_right_absent == 1) <input type="checkbox" checked>{{'Absent BS'}}
                                                    @else <input type="checkbox">{{'Absent BS'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_right_crepitations == 1) <input type="checkbox" checked>{{'Crepitations'}}
                                                    @else <input type="checkbox">{{'Crepitations'}}
                                                    @endif
                                                    <br/>
                                                    @if($hl->lungs_right_wheezing == 1) <input type="checkbox" checked>{{'Wheezing'}}
                                                    @else <input type="checkbox">{{'Wheezing'}}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5"> {{$hl->lungs_remark}}</textarea>
                                    </div>
                                </div>
                                <!-- End Remark -->
                                <!-- End Lungs -->
                                @endif
                                <br/>
                                @if(isset($aen) && count($aen)>0)
                                <!-- Start Abdomen -->
                                <div class="row">
                                    <div class="col-md-3"><label>Abdomen</label></div>
                                    <div class="col-md-8">
                                        <!-- Start Normal or Abnormal -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($aen->abdomen_normal == 1)<input type="radio" checked>{{'Normal'}}
                                                @else <input type="radio">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($aen->abdomen_abnormal == 1)<input type="radio" checked>{{'Abnormal'}}
                                                @else <input type="radio">{{'Abnormal'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Normal or Abnormal -->
                                        <br/>
                                        @if($aen->abdomen_abnormal == 1)
                                            <div class="row">
                                                <div class="col-md-8">
                                                    @if($aen->abdomen_tenderness == 1)<input type="checkbox" checked>{{'Tenderness'}}
                                                    @else <input type="checkbox">{{'Tenderness'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->abdomen_distension == 1)<input type="checkbox" checked>{{'Distension'}}
                                                    @else <input type="checkbox">{{'Distension'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->abdomen_mass == 1)<input type="checkbox" checked>{{'Mass'}}
                                                    @else <input type="checkbox">{{'Mass'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->abdomen_hernia == 1)<input type="checkbox" checked>{{'Hernia'}}
                                                    @else <input type="checkbox">{{'Hernia'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->abdomen_bowel_sound == 1)<input type="checkbox" checked>{{'Bowel Sound'}}
                                                    @else <input type="checkbox">{{'Bowel Sound'}}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5">{{$aen->abdomen_remark}}</textarea>
                                    </div>
                                </div>
                                <!-- End Remark -->
                                <!-- End Abdomen -->
                                <br/>
                                <!-- Start Extremities -->
                                <div class="row">
                                    <div class="col-md-3"><label>Extremities</label></div>
                                    <div class="col-md-8">
                                        <!-- Start Normal or Abnormal -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($aen->extre_normal == 1)<input type="radio" checked>{{'Normal'}}
                                                @else <input type="radio">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($aen->extre_abnormal == 1)<input type="radio" checked>{{'Abnormal'}}
                                                @else <input type="radio">{{'Abnormal'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Normal or Abnormal -->
                                        <br/>
                                        @if($aen->extre_abnormal == 1)
                                            <div class="row">
                                                <div class="col-md-8">
                                                    @if($aen->extre_edema == 1)<input type="checkbox" checked>{{'Edema'}}
                                                    @else <input type="checkbox">{{'Edema'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->extre_varicose == 1)<input type="checkbox" checked>{{'Varicose Vein'}}
                                                    @else <input type="checkbox">{{'Varicose Vein'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->extre_ulcer == 1)<input type="checkbox" checked>{{'Ulcer'}}
                                                    @else <input type="checkbox">{{'Ulcer'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->extre_gangrene == 1)<input type="checkbox" checked>{{'Gangrene'}}
                                                    @else <input type="checkbox">{{'Gangrene'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->extre_calf_tenderness == 1)<input type="checkbox" checked>{{'Calf Tenderness'}}
                                                    @else <input type="checkbox">{{'Calf Tenderness'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->extre_ampulation == 1)<input type="checkbox" checked>{{'Amputation'}}
                                                    @else <input type="checkbox">{{'Amputation'}}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5">{{$aen->extre_remark}}</textarea>
                                    </div>
                                </div>
                                <!-- End Remark -->
                                <!-- End Extremities -->
                                <br/>
                                <!-- Start Neurology -->
                                <div class="row">
                                    <div class="col-md-3"><label>Neurology</label></div>
                                    <div class="col-md-8">
                                        <!-- Start Normal or Abnormal -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                @if($aen->neuro_normal == 1)<input type="radio" checked>{{'Normal'}}
                                                @else <input type="radio">{{'Normal'}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                @if($aen->neuro_abnormal == 1)<input type="radio" checked>{{'Abnormal'}}
                                                @else <input type="radio">{{'Abnormal'}}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Normal or Abnormal -->
                                        <br/>
                                        @if($aen->neuro_abnormal == 1)
                                            <div class="row">
                                                <div class="col-md-8">
                                                    @if($aen->neuro_motor_weakness == 1)<input type="checkbox" checked>{{'Motor Weakness'}}
                                                    @else <input type="checkbox">{{'Motor Weakness'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->neuro_sensory_loss == 1)<input type="checkbox" checked>{{'Sensory Loss'}}
                                                    @else <input type="checkbox">{{'Sensory Loss'}}
                                                    @endif
                                                    <br/>
                                                    @if($aen->neuro_abnormal_movement == 1)<input type="checkbox" checked>{{'Abnormal Movement'}}
                                                    @else <input type="checkbox">{{'Abnormal Movement'}}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <!-- Start Remark -->
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-1"><label>Remark</label></div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="2" cols="5">{{$aen->neuro_remark}}</textarea>
                                    </div>
                                </div>
                                <!-- End Remark -->
                                <!-- End Neurology -->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Physical Examination Accordion -->

        <!-- Start Investigation Labs -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#investigaion_labs">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Investigation Labs
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="investigaion_labs" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Investigation Labs</h3><br/>
                                @if(isset($investigations) && count($investigations)>0)
{{--                                    @foreach($investigations as $investigationKey => $investigationValue)--}}
                                    @foreach($investigations as $investigationValue)
                                        {{--<h4 style="color: #418DD8;">{{$investigationKey}}</h4>--}}
                                        {{--@foreach($investigationValue as $name)--}}
                                            {{--<i class="fa fa-circle circle" aria-hidden="true"></i> {{$name}}<hr style="margin: 5px 0 5px 0;border-color: #5bc0de;"/>--}}
                                        {{--@endforeach--}}
                                        <i class="fa fa-circle circle" aria-hidden="true"></i> {{$investigationValue}}<hr style="margin: 5px 0 5px 0;border-color: #5bc0de;"/>
                                    @endforeach
                                @endif

                                <div class="row">
                                    <div class="col-md-1">
                                        Remark
                                    </div>
                                    <div class="col-md-7">
                                        <textarea class="form-control" id="remark" rows="3" cols="5"> @if(isset($investigation_lab_remark) && count($investigation_lab_remark) >0 ){{$investigation_lab_remark}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Investigation Labs -->

        <!-- Start Investigation Imaging -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#investigaion_imaging">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Investigation Imaging
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="investigaion_imaging" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Investigation Imaging</h3><br/>
                                @if(isset($investigation_imaging) && count($investigation_imaging)>0)
                                    <div class="row">
                                        <div class="col-md-1"><label>{{'X-RAY'}}</label></div>
                                        <div class="col-md-10"><b>:</b> {{$investigation_imaging['X-RAY']}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><label>{{'USG'}}</label></div>
                                        <div class="col-md-10"><b>:</b> {{$investigation_imaging['USG']}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><label>{{'CT'}}</label></div>
                                        <div class="col-md-10"><b>:</b> {{$investigation_imaging['CT']}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><label>{{'MRI'}}</label></div>
                                        <div class="col-md-10"><b>:</b> {{$investigation_imaging['MRI']}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><label>{{'Others'}}</label></div>
                                        <div class="col-md-10"><b>:</b> {{$investigation_imaging['Others']}}</div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-1"><label>Remark</label></div>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" id="remark" rows="3" cols="5"> @if(isset($investigation_imaging_remark) && $investigation_imaging_remark != null){{$investigation_imaging_remark}}@endif</textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Investigation Imaging -->
        <!-- Start Investigation ECG -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#investigaion_ecg">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Investigation ECG
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="investigaion_ecg" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Investigation ECG</h3><br/>
                                @if(isset($investigation_ecg))
                                    <p>{{$investigation_ecg}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Investigation ECG -->

        <!-- Start Investigation Other -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#investigaion_other">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Investigation Other
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="investigaion_other" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Investigation Other</h3><br/>
                                @if(isset($investigation_other))
                                    <p>{{$investigation_other}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Investigation Other -->

        <!-- Start Provisional Diagnosis -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#provisional_diagnosis">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Provisional Diagnosis
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="provisional_diagnosis" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Provisional Diagnosis</h3><br/>
                                @if(isset($provisional_diagnosis) && count($provisional_diagnosis)>0)
                                    @foreach($provisional_diagnosis as $provisional)
                                        <i class="fa fa-circle circle" aria-hidden="true"></i> {{$provisional->name}}<hr style="margin: 5px 0 5px 0;border-color: #5bc0de;"/>
                                    @endforeach
                                @endif

                                <div class="row">
                                    <div class="col-md-1">
                                        Remark
                                    </div>
                                    <div class="col-md-7">
                                        <textarea class="form-control" id="remark" rows="3" cols="5"> @if(isset($provisional_diagnosis_remark) && count($provisional_diagnosis_remark) >0 ){{$provisional_diagnosis_remark}}@endif</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Provisional Diagnosis -->

        <!-- Start Treatment -->
        @if(isset($service_type) && ($service_type == 1 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#treatment">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Treatment
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="treatment" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Treatment</h3><br/>
                                @if(isset($treatments) && count($treatments) > 0 )
                                <table class="table table-condensed">
                                    <tr class="detail_visit_vital">
                                        <th>Medicine</th>
                                        <th>Dosage</th>
                                        <th>Frequency</th>
                                        <th>Duration</th>
                                        <th>Time</th>
                                        <th>Sold Qty.</th>
                                        <th>Price</th>
                                    </tr>
                                    <?php $totalDosage=0; $totalSold =0; $totalPrice = 0.0; ?>
                                        @foreach($treatments as $treatment)
                                            <tr class="detail_visit_vital_row">
                                                <td>{{$treatment->product_name}}</td>
                                                <td>{{$treatment->total_dosage}}</td>
                                                <td>{{$treatment->frequency}}</td>
                                                <td>{{$treatment->days}}</td>
                                                <td>{{$treatment->time}}</td>
                                                <td>{{$treatment->sold_dosage}}</td>
                                                <td style="text-align: right;">{{number_format($treatment->price * $treatment->sold_dosage)}}</td>
                                            </tr>
                                            <?php
                                                $totalDosage += $treatment->total_dosage;
                                                $totalSold   += $treatment->sold_dosage;
                                                $totalPrice  += $treatment->price * $treatment->sold_dosage;
                                            ?>
                                        @endforeach
                                        <tr class="detail_visit_vital_row">
                                            <td><b>Total</b></td>
                                            <td><b>{{$totalDosage}}</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>{{$totalSold}}</b></td>
                                            <td style="text-align: right;"><b>{{number_format($totalPrice)}}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">
                                                <div class="row">
                                                    <div class="col-sm-1"><label>Remark</label></div>
                                                    <div class="col-sm-4">
                                                        <textarea class="form-control" id="remark" rows="3" cols="5"> @if(isset($treatments) && count($treatments) >0 ){{$treatment->remark}}@endif</textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Treatment -->

        <!-- Start Neurological Treament Record -->
        @if(isset($service_type) && ($service_type == 3 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#neurological_treatment_record">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Neurological Treatment Record
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="neurological_treatment_record" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Neurological Treatment Record</h3><br/>
                                @if(isset($neurological) && count($neurological)>0)
                                    @foreach($neurological as $neuro)
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Resting <br> BP/HR/SP O2</label>
                                            </div>
                                            <div class="col-md-8">

                                                <div class="row">
                                                    <div class="col-md-1">

                                                        <?php
                                                        if (strpos($neuro->resting_bp, ',') !== false){
                                                            $bp = array();
                                                            $bp = explode(',',$neuro->resting_bp);
                                                            echo $bp[0].",<br/>".$bp[1]."<br/>".$bp[2];

                                                            }
                                                        else{
                                                            $bp = $neuro->resting_bp;
                                                            echo $bp.',';
                                                        }

                                                        ?>

                                                    </div>
                                                    <div class="col-md-1">{{$neuro->resting_hr}} ,</div>
                                                    <div class="col-md-1">{{$neuro->resting_spo2}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Passive ROM exercise <br> U/L & L/L</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->passive_rom_exercise == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Visual Exercise</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->visual_exercise == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Oral Motor Exercise</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->oral_motor_exercise == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Active Assisted ROM exercise <br/> U/L & L/L</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->active_assisted_rom_exercise == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Bridging/ Inner range of quadriceps/ dorsiflexion</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->bridging_inner_range == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Transfer bed &#8596; chair</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->transfer_bed == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Sitting balance</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->sitting_balance == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Sit to Stand</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->sit_to_stand == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Standing balance</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->standing_balance == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Stepping (10cm/15cm)</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->stepping == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Single Leg balance</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->single_leg_balance == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>March on spot</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->march_on_spot == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Ambulation<br/>
                                                <span style="line-height: 30px;">&#9679;Parallel Bar</span><br/>
                                                <span style="line-height: 30px;">&#9679;Walk + ball throw + kick ball</span><br/>
                                                <span style="line-height: 30px;">&#9679;Outdoor with walking aids</span><br/>
                                                <span style="line-height: 30px;">&#9679;Tandem walk/ cross walk</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <br/>
                                                <span style="line-height: 30px;">@if($neuro->ambulation_parallel_bar == 1) <input type="checkbox" checked><br/>
                                                @else <input type="checkbox"><br/>
                                                @endif</span>
                                                <span style="line-height: 30px;">@if($neuro->ambulation_walk == 1) <input type="checkbox" checked><br/>
                                                @else <input type="checkbox"><br/>
                                                @endif</span>
                                                <span style="line-height: 30px;">@if($neuro->ambulation_outdoor == 1) <input type="checkbox" checked><br/>
                                                @else <input type="checkbox"><br/>
                                                @endif</span>
                                                <span style="line-height: 30px;">@if($neuro->ambulation_tandem_walk == 1) <input type="checkbox" checked><br/>
                                                @else <input type="checkbox"><br/>
                                                @endif</span>
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Stair &#8595; &#8593;</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->stair == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Arm pedal/ Leg pedal</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->arm_pedal == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Treadmil (km/h, duration)</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->treadmill == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hand exercise (opposition/ fisting/ writing/ active assisted exercise)</label>
                                            </div>
                                            <div class="col-md-8">
                                                @if($neuro->hand_exercise == 1) <input type="checkbox" checked>
                                                @else <input type="checkbox">
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="margin: 5px 0 5px 0;"/>
                                    @endforeach
                                        <div class="row">
                                            <div class="col-md-3"><label>Remark</label></div>
                                            <div class="col-md-8"><textarea class="form-control" id="remark" rows="3" cols="5">@if(isset($neurological) && count($neurological)>0){{$neuro->remark}}@endif</textarea></div>
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Neurological Treatment Record -->

        <!-- Start Musculo Intercention Record -->
        @if(isset($service_type) && ($service_type == 2 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#musculo_intercention_record">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Musculo Intercention Record
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="musculo_intercention_record" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Musculo Intercention Record</h3><br/>
                                @if(isset($musculo_intercention) && count($musculo_intercention)>0)
                                    @foreach($musculo_intercention as $musculo)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>1. Electrotherapy</h5>
                                            <div class="row">
                                                <div class="col-md-3"><label>&emsp; (a) Ultrasound</label></div>
                                                <div class="col-md-8">
                                                    @if($musculo->ultrasound == 1) <label><input type="checkbox" checked></label><br/>
                                                    @else <input type="checkbox"><br/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><label>&emsp; (b) Hot-magner/ Hot Packs</label></div>
                                                <div class="col-md-8">
                                                    @if($musculo->hot_manager == 1) <label><input type="checkbox" checked></label><br/>
                                                    @else <input type="checkbox"><br/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><label>&emsp; (c) Traction(Cervical/ Lumbar)</label></div>
                                                <div class="col-md-8">
                                                    @if($musculo->traction == 1) <label></label><input type="checkbox" checked><br/>
                                                    @else <input type="checkbox"><br/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><label>&emsp; (d) Electrical Stimulation</label></div>
                                                <div class="col-md-8">
                                                    @if($musculo->electrical_stimulation == 1) <input type="checkbox" checked><br/>
                                                    @else <input type="checkbox"><br/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><label>&emsp; (e) Infra-red</label></div>
                                                <div class="col-md-8">
                                                    @if($musculo->infra_red == 1) <input type="checkbox" checked><br/>
                                                    @else <input type="checkbox"><br/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><label>&emsp; (f) Laser</label></div>
                                                <div class="col-md-8">
                                                    @if($musculo->laser == 1) <input type="checkbox" checked><br/>
                                                    @else <input type="checkbox"><br/>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>2. Exercise therapy</h5>
                                            <textarea class="form-control" id="remark" rows="3" cols="5">{{$musculo->exercise_therapy}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>3. Health Education</h5>
                                            <label> &emsp; (a) How to correct posture (i) Lying (ii) Sitting</label>
                                            <textarea class="form-control" id="remark" rows="3" cols="5">{{$musculo->health_education}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>4. Others</h5>
                                            <textarea class="form-control" id="remark" rows="3" cols="5">{{$musculo->others}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Intervention/ Progress Note</h5>
                                            <textarea class="form-control" id="remark" rows="5" cols="5">{{$musculo->progress_note}}</textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Musculo Intercention Record -->

        <!-- Start Nutrition Assesment Form -->
        @if(isset($service_type) && ($service_type == 4 || $service_type == 0))
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse">
                <!-- Panel Heading -->
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#nutrition_assessment_form">
                            <i class="fa fa-plus-circle pull-right"></i>
                            Nutrition Assessment Form
                        </a>
                    </h3>
                </div>
                <!-- End Panel Heading -->

                <!-- Start Panel Body -->
                <div id="nutrition_assessment_form" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Nutrition Assessment Form</h3><br/>
                                @if(isset($nutritions) && count($nutritions) > 0)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Risk Factors Conditions</h5>
                                    </div>
                                </div>
                                @foreach($nutritions as $nutrition)
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->about_acceptable_weight == 1)
                                            <input type="checkbox" checked> Above acceptable weight
                                        @else <input type="checkbox"> Above acceptable weight
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->uti == 1)
                                            <input type="checkbox" checked> UTI
                                        @else <input type="checkbox"> UTI
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->htn_stroke_chf_cvd == 1)
                                            <input type="checkbox" checked> HTN/Stroke/CHF/CVD
                                        @else <input type="checkbox"> HTN/Stroke/CHF/CVD
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->belowaceptable_weight == 1)
                                            <input type="checkbox" checked> Below acceptable weight
                                        @else <input type="checkbox"> Below acceptable weight
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->poor_intake == 1)
                                            <input type="checkbox" checked> Poor intake/<75%
                                        @else <input type="checkbox"> Poor intake/<75%
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->wieght_loss == 1)
                                            <input type="checkbox" checked> Weight Loss
                                        @else <input type="checkbox"> Weight Loss
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->difficulty_swallowing == 1)
                                            <input type="checkbox" checked> Difficulty swallowing
                                        @else <input type="checkbox"> Difficulty swallowing
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->no_poordentition == 1)
                                            <input type="checkbox" checked> No/poor definition
                                        @else <input type="checkbox"> No/poor definition
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->clear_full_liquid == 1)
                                            <input type="checkbox" checked> Clear/full liquid
                                        @else <input type="checkbox"> Clear/full liquid
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->skin_breakthrough == 1)
                                            <input type="checkbox" checked> Skin breakthrough
                                        @else <input type="checkbox"> Skin breakthrough
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->recent_fracture_trauma == 1)
                                            <input type="checkbox" checked> Recent fracture/trauma
                                        @else <input type="checkbox"> Recent fracture/trauma
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->recent_surgery == 1)
                                            <input type="checkbox" checked> Recent surgery
                                        @else <input type="checkbox"> Recent surgery
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->edema == 1)
                                            <input type="checkbox" checked> Edema
                                        @else <input type="checkbox"> Edema
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->diabetes == 1)
                                            <input type="checkbox" checked> Diabetes
                                        @else <input type="checkbox"> Diabetes
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->rental_dieases_dialysis == 1)
                                            <input type="checkbox" checked> Rental disease/dialysis
                                        @else <input type="checkbox"> Rental disease/dialysis
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->drug_nutinteraction == 1)
                                            <input type="checkbox" checked> Drug/nut.interaction
                                        @else <input type="checkbox"> Drug/nut.interaction
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->dx_hol_nutrition == 1)
                                            <input type="checkbox" checked> Dx/Ho Malnutrition
                                        @else <input type="checkbox"> Dx/Ho Malnutrition
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->dx_ho_cancer == 1)
                                            <input type="checkbox" checked> Dx/Ho Cancer
                                        @else <input type="checkbox"> Dx/Ho Cancer
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->dx_hodehydration == 1)
                                            <input type="checkbox" checked> Dx/Ho Dehydration
                                        @else <input type="checkbox"> Dx/Ho Dehydration
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->dx_ho_dementia == 1)
                                            <input type="checkbox" checked> Dx/Ho Dementia
                                        @else <input type="checkbox"> Dx/Ho Dementia
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        @if($nutrition->dx_ho_mentaldx == 1)
                                            <input type="checkbox" checked> Dx/Ho Mental dx
                                        @else <input type="checkbox"> Dx/Ho Mental dx
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-1"><label>Other</label></div>
                                    <div class="col-md-10">
                                        <textarea class="form-control" row="1" col="7">{{$nutrition->other}}</textarea>
                                    </div>
                                </div>

                                {{--Start Old Design--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<h6><b>Estimated Nutritional Needs</b></h6>--}}
                                        {{--<h6>Male</h6>--}}
                                        {{--<b>66+13.7 X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_field1}}" class="text_box">--}}
                                        {{--<b>(wt/kg)+5 X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_field2}}" class="text_box">--}}
                                        {{--<b>(ht/cm)+6.8 X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_field3}}" class="text_box">--}}
                                        {{--<b>age</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_age}}" class="text_box">--}}
                                        {{--<b>kcal X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_field8}}" class="text_box">--}}
                                        {{--<b>AF</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_field5}}" class="text_box">--}}
                                        {{--<b>XRF</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_field6}}" class="text_box">--}}
                                        {{--<b>Kcal</b>--}}
                                        {{--<input type="text" value="{{$nutrition->male_nutrition_field7}}" class="text_box">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<br/>--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<h6>Female</h6>--}}
                                        {{--<b>665+9.6 X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_field1}}" class="text_box">--}}
                                        {{--<b>(wt/kg)+1.8 X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_field2}}" class="text_box">--}}
                                        {{--<b>(ht/cm)+4.7 X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_field3}}" class="text_box">--}}
                                        {{--<b>age</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_age}}" class="text_box">--}}
                                        {{--<b>kcal X</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_field8}}" class="text_box">--}}
                                        {{--<b>AF</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_field5}}" class="text_box">--}}
                                        {{--<b>XRF</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_field6}}" class="text_box">--}}
                                        {{--<b>Kcal</b>--}}
                                        {{--<input type="text" value="{{$nutrition->female_nutrition_field7}}" class="text_box">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<br/>--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-1"> <b>Protein</b> </div>--}}
                                    {{--<div class="col-md-2">--}}
                                        {{--<input type="text" value="{{$nutrition->protient_field1}}" class="text_box">--}}
                                        {{--<b> Kg X </b>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-1">--}}
                                        {{--<input type="text" value="{{$nutrition->protient_field2}}" class="text_box">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-2">--}}
                                        {{--<b>gm/Kg (based on RF)</b>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-2">--}}
                                        {{--<input type="text" value="{{$nutrition->protient_field3}}" class="text_box">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<br/>--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-1"><b>Fluid</b></div>--}}
                                    {{--<div class="col-md-2">--}}
                                        {{--<input type="text" value="{{$nutrition->fluid_field1}}" class="text_box">--}}
                                        {{--<b> Kg X </b>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-1">--}}
                                        {{--<input type="text" value="{{$nutrition->fluid_field2}}" class="text_box">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-2">--}}
                                        {{--<b> cc/Kg </b>--}}
                                        {{--<input type="text" value="{{$nutrition->fluid_field3}}" class="text_box">--}}
                                        {{--<b> + </b>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<input type="text" value="{{$nutrition->fluid_field4}}" class="text_box">--}}
                                        {{--<b> (dehydration/N/V,diarrhea) </b>--}}
                                        {{--<input type="text" value="{{$nutrition->fluid_field5}}" class="text_box">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                 {{--End Old Design   --}}

                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($nutrition->gender == "male")
                                            <input type="radio" name="gender" value="male" checked> <b>Male</b>
                                            <input type="radio" name="gender" value="female"> <b>Female</b>
                                        @else
                                            <input type="radio" name="gender" value="male"> Male
                                            <input type="radio" name="gender" value="female" checked> Female
                                        @endif
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <b>Weight</b>
                                        <input type="text" value="@if($nutrition->weight > 0){{$nutrition->weight}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-2">
                                        <b>Height</b>
                                        <input type="text" value="@if($nutrition->height > 0){{$nutrition->height}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-2">
                                        <b>Age</b>
                                        <input type="text" value="@if($nutrition->age > 0) {{$nutrition->age}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" value="@if($nutrition->calorie > 0) {{$nutrition->calorie}} @endif" class="text_box">
                                        <b>KCal</b>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if((isset($nutrition->activity_factor) && $nutrition->activity_factor > 0) || (isset($nutrition->totalCalorie) && $nutrition->totalCalorie > 0))
                                            <input type="checkbox" checked> <b>Calculate Total Calorie</b>
                                        @else <input type="checkbox"> <b>Calculate Total Calorie</b>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <b>Activity Factor</b>
                                        <input type="text" value="@if($nutrition->activity_factor > 0) {{$nutrition->activity_factor}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" value="@if($nutrition->totalCalorie > 0) {{$nutrition->totalCalorie}} @endif" class="text_box">
                                        <b>KCal</b>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Protein :</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <input type="text" value="@if($nutrition->protein_kg > 0) {{$nutrition->protein_kg}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" value="@if($nutrition->protein_gm > 0) {{$nutrition->protein_gm}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" value="@if($nutrition->protein_result > 0) {{$nutrition->protein_result}} @endif" class="text_box">
                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Fluid :</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <input type="text" value="@if($nutrition->fluid_kg > 0) {{$nutrition->fluid_kg}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" value="@if($nutrition->fluid_cm > 0) {{$nutrition->fluid_cm}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" value="@if($nutrition->fluid_result > 0) {{$nutrition->fluid_result}} @endif" class="text_box">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if((isset($nutrition->dehydration) && $nutrition->dehydration > 0) || (isset($nutrition->total_fluid) && $nutrition->total_fluid > 0))
                                            <input type="checkbox" checked> <b>Add Dehydration</b>
                                        @else <input type="checkbox"> <b>Add Dehydration</b>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <b>Dehydration</b>
                                        <input type="text" value="@if($nutrition->dehydration > 0) {{$nutrition->dehydration}} @endif" class="text_box">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" value="@if($nutrition->total_fluid > 0) {{$nutrition->total_fluid}} @endif" class="text_box">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-1"><label>Evaluation</label></div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="remark" rows="3" cols="5"> {{$nutrition->evaluation}} </textarea>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-4"><label>Plan of Action/Recommendation for Care Plan</label></div>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="remark" rows="3" cols="5"> {{$nutrition->plan_of_action_or_recommendation_for_care_plan}} </textarea>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-1"><label>Remark</label></div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="remark" rows="3" cols="5"> {{$nutrition->remark}} </textarea>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Nutrition Assesment Form -->

        <!-- Start Blood Drawing Accordion -->
        @if(isset($service_type) && ($service_type == 5 || $service_type == 0))
            <div class="panel-group" id="accordion">
                <div class="panel panel-inverse">
                    <!-- Panel Heading -->
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#blood_drawing">
                                <i class="fa fa-plus-circle pull-right"></i>
                                Blood Drawing
                            </a>
                        </h3>
                    </div>
                    <!-- End Panel Heading -->

                    <!-- Start Panel Body -->
                    <div id="blood_drawing" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Blood Drawing</h3>
                                    @if(isset($blood_drawings) && count($blood_drawings)>0)
                                        <table class="table table-condensed">
                                            <tr class="detail_visit_vital">
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Urgent Price</th>
                                                <th>Routine Price</th>
                                            </tr>
                                            @foreach($blood_drawings as $blood_drawing)
                                                <tr class="detail_visit_vital_row">
                                                    <td>{{$blood_drawing->service_name}}</td>
                                                    <td>{{$blood_drawing->description}}</td>
                                                    <td>@if($blood_drawing->investigation_labs_type == "urgent"){{number_format($blood_drawing->investigation_labs_price,2)}}@else 0 @endif</td>
                                                    <td>@if($blood_drawing->investigation_labs_type == "routine"){{number_format($blood_drawing->investigation_labs_price,2)}}@else 0 @endif</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <div class="row">
                                            <div class="col-md-3"><label>Remark</label></div>
                                            <div class="col-md-9"><textarea class="form-control" id="remark" rows="3" cols="5">@if(isset($blood_drawings_remark) && count($blood_drawings_remark)>0){{$blood_drawings_remark}}@endif</textarea></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        <!-- End Blood Drawing Accordion -->

        {!! Form::open(array('url' => 'addendum/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'addendumForm', 'files' => true)) !!}
        {{--Start Addendum--}}
        <h1 class="page-header">Addendum</h1>
        <input type="hidden" name="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
        <input type="hidden" name="schedule_id" value="{{isset($schedule_id)? $schedule_id:''}}"/>
        {{--Start Addendum List--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="listing">
                    <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                    <table class="table table-striped list-table" id="list-table">

                        <thead>
                        <tr>
                            <th>Addendum</th>
                            <th>Added By</th>
                            <th>Added At</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="search-col" con-id="addendum">Addendum</th>
                            <th class="search-col" con-id="added_by">Added By</th>
                            <th class="search-col" con-id="added_at">Added At</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($addendums as $addendum)
                            <tr>
                                <td>{{$addendum->addendum_text}}</td>
                                <td>{{$addendum->user->name}}</td>
                                <td>{{$addendum->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--End Addendum List--}}
        <br>
        <hr>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <label for="addendum" class="text_bold_black">Addendum</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <textarea autocomplete="off" class="form-control" id="addendum" name="addendum" placeholder="Enter addendum" rows="15" cols="50">{{Input::old('addendum')}}</textarea>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                <input type="submit" name="add_addendum" id="add_addendum" value="ADD" class="form-control btn-primary">
            </div>
        </div>
        {{--End Addendum--}}
    </div>
    {!! Form::close() !!}
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