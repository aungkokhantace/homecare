<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:12 PM
 */
?>

@extends('layouts.master')
@section('title','Investigation')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($investigationImaging) ?  'Investigation Imaging Edit' : 'Investigation Imaging Entry' }}</h1>

    @if(isset($investigationImaging))
        {!! Form::open(array('url' => 'investigationimaging/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'investigationImagingForm')) !!}
    @else
        {!! Form::open(array('url' => 'investigationimaging/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'investigationImagingForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($investigationImaging)? $investigationImaging->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Service Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter Service Name" value="{{ isset($investigationImaging)? $investigationImaging->service_name:Request::old('service_name') }}"/>
            <p class="text-danger">{{$errors->first('service_name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="group_name">Group Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name" value="{{ isset($investigationImaging)? $investigationImaging->group_name:Request::old('group_name') }}"/>
            <p class="text-danger">{{$errors->first('group_name')}}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Service Charges<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="service_charges" name="service_charges" placeholder="Enter Service Charges" value="{{ isset($investigationImaging)? $investigationImaging->service_charges:Request::old('service_charges') }}"/>
            <p class="text-danger">{{$errors->first('service_charges')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($investigationImaging)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('investigationimaging')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Investigation Entry and Edit Form
            $('#investigationImagingForm').validate({
                rules: {
                    service_name          : 'required',
                    group_name            : 'required',
                    service_charges       : {
                        required          : true,
                        number            : true
                    }
                },
                messages: {
                    service_name          : 'Service Name is required',
                    group_name            : 'Group Name is required',
                    service_charges       : {
                        required          : 'Service Charges is required',
                        number            : 'Service Charges must be numeric'
                    }
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Investigation Entry and Edit Form
        });
    </script>
@stop