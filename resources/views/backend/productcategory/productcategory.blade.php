<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:12 PM
 */
?>

@extends('layouts.master')
@section('title','Medication Category')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($productCategory) ?  'Medication Category Edit' : 'Medication Category Entry' }}</h1>

    @if(isset($productCategory))
        {!! Form::open(array('url' => 'productcategory/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'productCategoryForm')) !!}

    @else
        {!! Form::open(array('url' => 'productcategory/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'productCategoryForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($productCategory)? $productCategory->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Medication Category Name" value="{{ isset($productCategory)? $productCategory->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Medication Category Description" rows="5" cols="50">{{isset($productCategory)? $productCategory->description:Input::old('description')}}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($productCategory)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('productcategory')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Medication Category Entry and Edit Form
            $('#productCategoryForm').validate({
                rules: {
                    name   : 'required'
                },
                messages: {
                    name   : 'Medication Category Name is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Medication Category Entry and Edit Form
        });
    </script>
@stop