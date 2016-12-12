<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:46 AM
 */
?>

@extends('layouts.master')
@section('title','Medical History')
@section('content')

        <!-- begina #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($medicalhistory) ?  'Medical History Edit' : 'Medical History Entry' }}</h1>

    @if(isset($medicalhistory))
        {!! Form::open(array('url' => 'medicalhistory/update', 'class'=> 'form-horizontal user-form-border' , 'id' => 'medicalHistoryForm')) !!}

    @else
        {!! Form::open(array('url' => 'medicalhistory/store', 'class'=> 'form-horizontal user-form-border' , 'id' => 'medicalHistoryForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($medicalhistory)? $medicalhistory->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Medical History Name" value="{{ isset($medicalhistory)? $medicalhistory->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Medical History Description" rows="5" cols="50">{{ isset($medicalhistory)? $medicalhistory->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($medicalhistory)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('medicalhistory')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop


@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Allergy Entry and Edit Form
            $('#medicalHistoryForm').validate({
                rules: {
                    name   : 'required'
                },
                messages: {
                    name   : 'Medical history Name is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Allergy Entry and Edit Form
        });
    </script>
@stop