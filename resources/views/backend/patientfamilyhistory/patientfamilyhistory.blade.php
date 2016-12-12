<?php
/**
 * Created by PhpStorm.
 * Author: Wai Ya Aung
 * Date: 8/29/2016
 * Time: 3:28 PM
 */
?>

@extends('layouts.master')
@section('title','Patient Family History')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($patientfamilyhistory) ?  'Patient Family History Edit' : 'Patient Family History Entry' }}</h1>

    @if(isset($patientfamilyhistory))
        {!! Form::open(array('url' => 'patientfamilyhistory/update', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => 'patientfamilyhistory/store', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($patientfamilyhistory)? $patientfamilyhistory->id:''}}"/>
    <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient_id)? $patient_id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Family History<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($patientfamilyhistory))
                <input type="hidden" name="family_history_id" id="family_history_id" value="{{isset($patientfamilyhistory->family_history_id)? $patientfamilyhistory->family_history_id:'0'}}"/>
                <input type="text" readonly name="medical_history_name" id="medical_history_name" value="{{$familyHistories[$patientfamilyhistory->family_history_id]->name}}"  class="form-control"/>
            @else
                <select class="form-control" name="family_history_id" id="family_history_id">
                    @foreach($familyHistories as $familyHistory)
                        <option value="{{$familyHistory->id}}">{{$familyHistory->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <p class="text-danger">{{$errors->first('name')}}</p>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Family Member<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($patientfamilyhistory))
                <input type="hidden" name="family_member_id" id="family_member_id" value="{{isset($patientfamilyhistory->family_member_id)? $patientfamilyhistory->family_member_id:'0'}}"/>
                <input type="text" readonly name="medical_history_name" id="medical_history_name" value="{{$familyMembers[$patientfamilyhistory->family_member_id]->name}}"  class="form-control"/>
            @else
                <select class="form-control" name="family_member_id" id="family_member_id">
                    @foreach($familyMembers as $familyMember)
                        <option value="{{$familyMember->id}}">{{$familyMember->name}}</option>
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
            <input type="submit" name="submit" value="{{isset($patientfamilyhistory)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
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