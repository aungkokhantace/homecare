<?php
/**
 * Created by PhpStorm.
 * Author: Wai Ya Aung
 * Date: 8/29/2016
 * Time: 3:28 PM
 */
?>

@extends('layouts.master')
@section('title','Patient Surgery History')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($patientsurgeryhistory) ?  'Patient Surgery History Edit' : 'Patient Surgery History Entry' }}</h1>

    @if(isset($patientsurgeryhistory))
        {!! Form::open(array('url' => 'patientsurgeryhistory/update', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => 'patientsurgeryhistory/store', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($patientsurgeryhistory)? $patientsurgeryhistory->id:''}}"/>
    <input type="hidden" name="patient_id" value="{{isset($patient_id)? $patient_id:'0'}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Patient Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" required class="form-control" id="name" name="name" value="{{ isset($patient)? $patient->name:'' }}"/>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description">Surgery Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Surgery Description" value="{{ isset($patientsurgeryhistory)? $patientsurgeryhistory->description:Request::old('description') }}"/>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($patientsurgeryhistory)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup_with_url('/patient/detail/{{isset($patient_id)? $patient_id:'0'}}')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
@stop