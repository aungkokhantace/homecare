<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 10/6/2016
 * Time: 5:43 PM
 */

?>

@extends('layouts.master')
@section('title','Route')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($route) ?  'Route Edit' : 'Route Entry' }}</h1>

    @if(isset($route))
        {!! Form::open(array('url' => 'route/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'routeForm')) !!}
    @else
        {!! Form::open(array('url' => 'route/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'routeForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($route)? $route->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Route Name" value="{{ isset($route)? $route->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Route Description" rows="5" cols="50">{{isset($route)? $route->description:Input::old('description')}}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($route)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('route')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Route Entry and Edit Form
            $('#routeForm').validate({
                rules: {
                    name                  : 'required',
                    route_category_id   : 'required',
                    price                 : {
                        required          : true,
                        number            : true
                    }
                },
                messages: {
                    name                  : 'Route Name is required',
                    route_category_id   : 'Route Category is required',
                    price                 : {
                        required          : 'Route Price is required',
                        number            : 'Route Price must be numeric'
                    }
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Route Entry and Edit Form
        });
    </script>
@stop