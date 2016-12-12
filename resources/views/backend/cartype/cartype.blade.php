<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:12 PM
 */
?>

@extends('layouts.master')
@section('title','Car Type')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($carType) ?  'Car Type Edit' : 'Car Type Entry' }}</h1>

    @if(isset($carType))
        {!! Form::open(array('url' => 'cartype/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'carTypeForm')) !!}

    @else
        {!! Form::open(array('url' => 'cartype/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'carTypeForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($carType)? $carType->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Car Type Name" value="{{ isset($carType)? $carType->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Car Type Description" rows="5" cols="50">{{ isset($carType)? $carType->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($carType)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('cartype')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Car Type Entry and Edit Form
            $('#carTypeForm').validate({
                rules: {
                    name   : 'required'
                },
                messages: {
                    name   : 'Car Type Name is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Car Type Entry and Edit Form
        });
    </script>
@stop