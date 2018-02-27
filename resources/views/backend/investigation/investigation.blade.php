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

    <h1 class="page-header">{{isset($investigation) ?  'Investigation Edit' : 'Investigation Entry' }}</h1>

    @if(isset($investigation))
        {!! Form::open(array('url' => 'investigation/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'investigationForm')) !!}

    @else
        {!! Form::open(array('url' => 'investigation/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'investigationForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($investigation)? $investigation->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <!-- <input readonly type="text" required class="form-control" id="name" name="name" placeholder="Enter Investigation Name" value="{{ isset($investigation)? $investigation->name:Request::old('name') }}"/> -->
            <input type="text" required class="form-control" id="service_name" name="service_name" placeholder="Enter Service Name" value="{{ isset($investigation)? $investigation->service_name:Request::old('service_name') }}"/>
            <p class="text-danger">{{$errors->first('service_name')}}</p>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="group_name">Group Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" required class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name" value="{{ isset($investigation)? $investigation->group_name:Request::old('group_name') }}"/>
            <p class="text-danger">{{$errors->first('group_name')}}</p>
        </div>
    </div> -->


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Routine Request<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="routine_request" name="routine_request" placeholder="Enter Routine Request" value="{{ isset($investigation)? $investigation->routine_request:Request::old('routine_request') }}"/>
            <p class="text-danger">{{$errors->first('routine_request')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Urgent Request<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="urgent_request" name="urgent_request" placeholder="Enter Urgent Request" value="{{ isset($investigation)? $investigation->urgent_request:Request::old('urgent_request') }}"/>
            <p class="text-danger">{{$errors->first('urgent_request')}}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Routine Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="routine_price" name="routine_price" placeholder="Enter Routine Price" value="{{ isset($investigation)? $investigation->routine_price:Request::old('routine_price') }}"/>
            <p class="text-danger">{{$errors->first('routine_price')}}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Urgent Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="urgent_price" name="urgent_price" placeholder="Enter Urgent Price" value="{{ isset($investigation)? $investigation->urgent_price:Request::old('urgent_price') }}"/>
            <p class="text-danger">{{$errors->first('urgent_price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Investigation Description" rows="5" cols="50">{{isset($investigation)? $investigation->description:Input::old('description')}}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($investigation)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('investigation')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Investigation Entry and Edit Form
            $('#investigationForm').validate({
                rules: {
                    service_name                  : 'required',
                    routine_request                 : {
                        required          : true,
                        number            : true
                    },
                    urgent_request                 : {
                        required          : true,
                        number            : true
                    },
                    routine_price                 : {
                        required          : true,
                        number            : true
                    },
                    urgent_price                 : {
                        required          : true,
                        number            : true
                    },
                },
                messages: {
                    service_name                  : 'Service Name is required',
                    routine_request                 : {
                        required          : 'Routine Request is required',
                        number            : 'Routine Request must be numeric'
                    },
                    urgent_request                 : {
                        required          : 'Urgent Request is required',
                        number            : 'Urgent Request must be numeric'
                    },
                    routine_price                 : {
                        required          : 'Routine Price is required',
                        number            : 'Routine Price must be numeric'
                    },
                    urgent_price                 : {
                        required          : 'Urgent Price is required',
                        number            : 'Urgent Price must be numeric'
                    },
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
