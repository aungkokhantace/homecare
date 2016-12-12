<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:46 AM
 */
?>

@extends('layouts.master')
@section('title','Patient Medical History')
@section('content')

        <!-- begina #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($patientmedicalhistory) ?  'Patient Medical History Edit' : 'Patient Medical History Entry' }}</h1>

    @if(isset($patientmedicalhistory))
        {!! Form::open(array('url' => 'patientmedicalhistory/update', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => 'patientmedicalhistory/store', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($patientmedicalhistory)? $patientmedicalhistory->id:''}}"/>
    <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient_id)? $patient_id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($patientmedicalhistory))
                <input type="hidden" name="medical_history_id" id="medical_history_id" value="{{isset($patientmedicalhistory->medical_history_id)? $patientmedicalhistory->medical_history_id:'0'}}"/>
                <input type="text" readonly name="medical_history_name" id="medical_history_name" value="{{$medicalHistories[$patientmedicalhistory->medical_history_id]->name}}"  class="form-control"/>
            @else
                <select class="form-control" name="medical_history_id" id="medical_history_id">
                    @foreach($medicalHistories as $medicalHistory)
                        <option value="{{$medicalHistory->id}}">{{$medicalHistory->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <p class="text-danger">{{$errors->first('name')}}</p>
    </div>
    <br/>


    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($patientmedicalhistory)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup_with_url('/patient/detail/{{isset($patient_id)? $patient_id:'0'}}')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">

        $(document).ready(function() {

            $('.dateTimePicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            allowInputToggle: true,
            });

            $(".dateTimePicker").keypress(function(event) {event.preventDefault();});

            if($("#date_hidden").val() == ""){
            $(".dateTimePicker").datepicker("setDate", new Date());
            }
        });
    </script>
@stop