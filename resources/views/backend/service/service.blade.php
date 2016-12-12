<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 5:24 PM
 */
?>

@extends('layouts.master')
@section('title','Service')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($service) ?  'Service Edit' : 'Service Entry' }}</h1>

    @if(isset($service))
        {!! Form::open(array('url' => 'service/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'serviceForm')) !!}

    @else
        {!! Form::open(array('url' => 'service/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'serviceForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($service)? $service->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly required class="form-control" id="name" name="name" placeholder="Enter Service Name" value="{{ isset($service)? $service->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="price" class="text_bold_black">Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="price" name="price" placeholder="Enter Service Price" value="{{ isset($service)? $service->price:Request::old('price') }}"/>
            <p class="text-danger">{{$errors->first('price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Service Description" rows="5" cols="50">{{ isset($service)? $service->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($service)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('service')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Service Entry and Edit Form
            $('#serviceForm').validate({
                rules: {
                    name                  : 'required',
                    price                 : {
                        required          : true,
                        number            : true
                    }
                },
                messages: {
                    name                  : 'Service Name is required',
                    price                 : {
                        required          : 'Service Price is required',
                        number            : 'Service Price must be numeric'
                    }
                },submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Service Entry and Edit Form
        });
    </script>
@stop