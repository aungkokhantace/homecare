<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:46 AM
 */
?>

@extends('layouts.master')
@section('title','Family History')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($familyhistory) ?  'Family History Edit' : 'Family History Entry' }}</h1>

    @if(isset($familyhistory))
        {!! Form::open(array('url' => 'familyhistory/update', 'class'=> 'form-horizontal user-form-border' , 'id' => 'familyHistoryForm')) !!}

    @else
        {!! Form::open(array('url' => 'familyhistory/store', 'class'=> 'form-horizontal user-form-border' , 'id' => 'familyHistoryForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($familyhistory)? $familyhistory->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Family History Name" value="{{ isset($familyhistory)? $familyhistory->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Family History Description" rows="5" cols="50">{{ isset($familyhistory)? $familyhistory->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($familyhistory)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('familyhistory')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Allergy Entry and Edit Form
            $('#familyHistoryForm').validate({
                rules: {
                    name   : 'required'
                },
                messages: {
                    name   : 'Family Member history Name is required'
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