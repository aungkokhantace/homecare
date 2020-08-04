<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:46 AM
 */
?>

@extends('layouts.master')
@section('title','Allergy')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($allergy) ?  'Allergy Edit' : 'Allergy Entry' }}</h1>

    @if(isset($allergy))
        {!! Form::open(array('url' => 'allergy/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'allergyForm')) !!}
    @else
        {!! Form::open(array('url' => 'allergy/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'allergyForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($allergy)? $allergy->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Allergy Name" value="{{ isset($allergy)? $allergy->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="type" class="text_bold_black">Type<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" id="type" name="type">
                <option value="food" @if(isset($allergy) && $allergy->type == 'food')? selected @endif>FOOD</option>
                <option value="drug" @if(isset($allergy) && $allergy->type == 'drug')? selected @endif>DRUG</option>
                <option value="environment" @if(isset($allergy) && $allergy->type == 'environment')? selected @endif>ENVIRONMENT</option>
            </select>
            <p class="text-danger">{{$errors->first('type')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Allergy Description" rows="5" cols="50">{{ isset($allergy)? $allergy->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($allergy)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('allergy')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Allergy Entry and Edit Form
            $('#allergyForm').validate({
                rules: {
                    name   : 'required',
                    type   : 'required'
                },
                messages: {
                    name   : 'Allergy Name is required',
                    type   : 'Allergy Type is required'
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