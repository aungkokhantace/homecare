<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/21/2016
 * Time: 5:36 PM
 */

?>

@extends('layouts.master')
@section('title','Car Type Setup')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($carTypeSetup) ?  'Car Price Setup Edit' : 'Car Price Setup Entry' }}</h1>

    @if(isset($carTypeSetup))
        {!! Form::open(array('url' => 'cartypesetup/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'carTypeSetupForm')) !!}

    @else
        {!! Form::open(array('url' => 'cartypesetup/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'carTypeSetupForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($carTypeSetup)? $carTypeSetup->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="car_type_id" class="text_bold_black">Car Type<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($carTypeSetup))
                <select class="form-control" name="car_type_id" id="car_type_id">
                    @foreach($carTypes as $carType)
                        @if($carType->id == $carTypeSetup->car_type_id)
                            <option value="{{$carTypeSetup->car_type_id}}" selected>{{$carTypeSetup->car_type->name}}</option>
                        @else
                            <option value="{{$carType->id}}">{{$carType->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="car_type_id" id="car_type_id">
                    <option value="" selected disabled>Select Car Type</option>

                    @foreach($carTypes as $carType)
                        <option value="{{$carType->id}}">{{$carType->name}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('car_type_id')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="zone_id" class="text_bold_black">Zone<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($carTypeSetup))
                <select class="form-control" name="zone_id" id="zone_id">
                    @foreach($zones as $zone)
                        @if($zone->id == $carTypeSetup->zone_id)
                            <option value="{{$carTypeSetup->zone_id}}" selected>{{$carTypeSetup->zone->name}}</option>
                        @else
                            <option value="{{$zone->id}}">{{$zone->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="zone_id" id="zone_id">
                    <option value="" selected disabled>Select Zone</option>

                    @foreach($zones as $zone)
                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('zone_id')}}</p>
        </div>
    </div>

    <input type="hidden" id="patient_type_id" name="patient_type_id" value="1">
    {{--<div class="row">--}}
        {{--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">--}}
            {{--<label for="patient_type_id" class="text_bold_black">Patient Type<span class="require">*</span></label>--}}
        {{--</div>--}}

        {{--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">--}}
            {{--@if(isset($carTypeSetup))--}}
                {{--<select class="form-control" name="patient_type_id" id="patient_type_id">--}}
                    {{--@foreach($patientTypes as $key => $patientType)--}}
                        {{--@if($key == $carTypeSetup->patient_type_id)--}}
                            {{--<option value="{{$key}}" selected>{{$patientType}}</option>--}}
                        {{--@else--}}
                            {{--<option value="{{$key}}">{{$patientType}}</option>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--@else--}}
                {{--<select class="form-control" name="patient_type_id" id="patient_type_id">--}}
                    {{--<option value="" selected disabled>Select Patient Type</option>--}}

                    {{--@foreach($patientTypes as $key => $patientType)--}}
                        {{--<option value="{{$key}}">{{$patientType}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--@endif--}}
            {{--<p class="text-danger">{{$errors->first('patient_type_id')}}</p>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="price" class="text_bold_black">Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Car Type Setup Price" value="{{ isset($carTypeSetup)? $carTypeSetup->price:Request::old('price') }}"/>
            <p class="text-danger">{{$errors->first('price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="remark" class="text_bold_black">Remark</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="remark" name="remark" placeholder="Enter Remark" rows="5" cols="50">{{ isset($carTypeSetup)? $carTypeSetup->remark:Request::old('remark') }}</textarea>
            <p class="text-danger">{{$errors->first('remark')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($carTypeSetup)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('cartypesetup')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Car Type Setup Entry and Edit Form
            $('#carTypeSetupForm').validate({
                rules: {
                    price           : {
                        required    : true,
                        number      : true
                    },
                    car_type_id     : 'required',
                    patient_type_id : 'required',
                    zone_id         : 'required'
                },
                messages: {
                    price         : {
                        required  : 'Car Type Set up Price is required',
                        number    : 'Car Type Set up Price must be numeric'
                    },
                    car_type_id     : 'Car Type is required',
                    patient_type_id : 'Patient Type is required',
                    zone_id         : 'Zone is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Car Type Setup Entry and Edit Form
        });
    </script>
@stop
