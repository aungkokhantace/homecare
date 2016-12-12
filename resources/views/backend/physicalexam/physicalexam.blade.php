<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:12 PM
 */
?>

@extends('layouts.master')
@section('title','Physical Examination')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($physicalExam) ?  'Physical Examination Edit' : 'Physical Examination Entry' }}</h1>

    @if(isset($physicalExam))
        {!! Form::open(array('url' => 'physicalexam/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'physicalExamForm')) !!}

    @else
        {!! Form::open(array('url' => 'physicalexam/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'physicalExamForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($physicalExam)? $physicalExam->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Physical Examination Name" value="{{ isset($physicalExam)? $physicalExam->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Type<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="type" name="type" placeholder="Enter Physical Examination Type" value="{{ isset($physicalExam)? $physicalExam->type:Request::old('type') }}"/>
            <p class="text-danger">{{$errors->first('type')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Physical Examination Description" rows="5" cols="50">{{isset($physicalExam)? $physicalExam->description:Input::old('description')}}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($physicalExam)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('physicalexam')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Physical Exam Entry and Edit Form
            $('#physicalExamForm').validate({
                rules: {
                    name   : 'required',
                    type   : 'required'
                },
                messages: {
                    name   : 'Physical Examination Name is required',
                    type   : 'Physical Examination Type is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Physical Exam Entry and Edit Form
        });
    </script>
@stop