<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:12 PM
 */
?>

@extends('layouts.master')
@section('title','Package Promotion')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{count($promotions)>0 ?  'Package Promotion (Discount) Edit' : 'Package Promotion (Discount) Create' }}</h1>

    <label for="package_name"><h3>{{isset($package)? $package->package_name:''}}</h3></label>

    @if(count($promotions)>0)
        {!! Form::open(array('url' => 'package/updatePromotion', 'class'=> 'form-horizontal user-form-border', 'id' => 'packagepromotionForm')) !!}
    @else
        {!! Form::open(array('url' => 'package/createPromotion', 'class'=> 'form-horizontal user-form-border', 'id' => 'packagepromotionForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($package)? $package->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="first_time_price">First Time Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" class="form-control" id="first_time_price" name="first_time_price" placeholder="Enter First Time Price" value="{{ isset($package)? $package->price:Request::old('first_time_price') }}"/>
            <p class="text-danger">{{$errors->first('first_time_price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="second_time_price">Second Time Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="second_time_price" name="second_time_price" placeholder="Enter Second Time Price" value="{{ $second_time_price !== 0 ? $second_time_price:Request::old('second_time_price') }}"/>
            <p class="text-danger">{{$errors->first('second_time_price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="third_time_price">Third Time Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="third_time_price" name="third_time_price" placeholder="Enter Third Time Price" value="{{ $third_time_price !== 0 ? $third_time_price:Request::old('third_time_price') }}"/>
            <p class="text-danger">{{$errors->first('third_time_price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{count($promotions)>0 ? 'UPDATE' : 'CREATE'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('package')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Entry and Edit Form
            $('#packagepromotionForm').validate({
                rules: {
                    second_time_price     : {
                        required          : true,
                        number            : true
                    },
                    third_time_price     : {
                        required          : true,
                        number            : true
                    },
                },
                messages: {
                    second_time_price       : {
                        required          : 'Second Time Price is required',
                        number            : 'Second Time Price must be numeric'
                    },
                    third_time_price       : {
                        required          : 'Third Time Price is required',
                        number            : 'Third Time Price must be numeric'
                    },
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form
        });
    </script>
@stop