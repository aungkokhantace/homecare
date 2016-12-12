<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/12/2016
 * Time: 5:41 PM
 */
?>

@extends('layouts.master')
@section('title','Provisional Diagnosis')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($provisionaldiagnosis) ?  'Provisional Diagnosis Edit' : 'Provisional Diagnosis Entry' }}</h1>

    @if(isset($provisionaldiagnosis))
        {!! Form::open(array('url' => 'provisionaldiagnosis/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'provisionaldiagnosisForm')) !!}
    @else
        {!! Form::open(array('url' => 'provisionaldiagnosis/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'provisionaldiagnosisForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($provisionaldiagnosis)? $provisionaldiagnosis->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Provisional Diagnosis Name" value="{{ isset($provisionaldiagnosis)? $provisionaldiagnosis->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Provisional Diagnosis Description" rows="5" cols="50">{{isset($provisionaldiagnosis)? $provisionaldiagnosis->description:Input::old('description')}}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($provisionaldiagnosis)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('provisionaldiagnosis')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Provisional Diagnosis Entry and Edit Form
            $('#provisionaldiagnosisForm').validate({
                rules: {
                    name                  : 'required'
                },
                messages: {
                    name                  : 'Provisional Diagnosis Name is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Provisional Diagnosis Entry and Edit Form
        });
    </script>
@stop