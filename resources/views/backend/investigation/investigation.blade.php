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
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Investigation Name" value="{{ isset($investigation)? $investigation->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="group_name">Group Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" required class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name" value="{{ isset($investigation)? $investigation->group_name:Request::old('group_name') }}"/>
            <p class="text-danger">{{$errors->first('group_name')}}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="price" name="price" placeholder="Enter Investigation Price" value="{{ isset($investigation)? $investigation->price:Request::old('price') }}"/>
            <p class="text-danger">{{$errors->first('price')}}</p>
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
                    name                  : 'required',
                    group_name            : 'required',
                    price                 : {
                        required          : true,
                        number            : true
                    }
                },
                messages: {
                    name                  : 'Investigation Name is required',
                    group_name            : 'Group Name is required',
                    price                 : {
                        required          : 'Investigation Price is required',
                        number            : 'Investigation Price must be numeric'
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