<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:12 PM
 */
?>

@extends('layouts.master')
@section('title','Medication')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($product) ?  'Medication Edit' : 'Medication Entry' }}</h1>

    @if(isset($product))
        {!! Form::open(array('url' => 'product/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'productForm')) !!}
    @else
        {!! Form::open(array('url' => 'product/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'productForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($product)? $product->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Medication Name" value="{{ isset($product)? $product->product_name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="product_category_id" class="text_bold_black">Category<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($category_edit_block_flag) && $category_edit_block_flag == 1)
                <select class="form-control" name="product_category_id" id="product_category_id">
                    <option value="{{$product->product_category_id}}">{{$product->productcategories->name}}</option>
                </select>
            @else
                @if(isset($product))
                    <select class="form-control" name="product_category_id" id="product_category_id">
                        @foreach($categories as $categories)
                            @if($categories->id == $product->product_category_id)
                                <option value="{{$product->product_category_id}}" selected>{{$product->productcategories->name}}</option>
                            @else
                                <option value="{{$categories->id}}">{{$categories->name}}</option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <select class="form-control" name="product_category_id" id="product_category_id">
                        <option value="" selected disabled>Select Medication Category</option>
                        @foreach($categories as $categories)
                            <option value="{{$categories->id}}">{{$categories->name}}</option>
                        @endforeach
                    </select>
                @endif
            @endif
            <p class="text-danger">{{$errors->first('product_category_id')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="price" name="price" placeholder="Enter Medication Price" value="{{ isset($product)? $product->price:Request::old('price') }}"/>
            <p class="text-danger">{{$errors->first('price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          @if(isset($category_edit_block_flag) && $category_edit_block_flag == 1)
            <textarea disabled class="form-control" id="description" name="description" placeholder="Enter Medication Description" rows="5" cols="50">{{isset($product)? $product->description:Input::old('description')}}</textarea>
          @else
            <textarea class="form-control" id="description" name="description" placeholder="Enter Medication Description" rows="5" cols="50">{{isset($product)? $product->description:Input::old('description')}}</textarea>
          @endif
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($product)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('product')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Medication Entry and Edit Form
            $('#productForm').validate({
                rules: {
                    name                  : 'required',
                    product_category_id   : 'required',
                    price                 : {
                        required          : true,
                        number            : true
                    }
                },
                messages: {
                    name                  : 'Medication Name is required',
                    product_category_id   : 'Medication Category is required',
                    price                 : {
                        required          : 'Medication Price is required',
                        number            : 'Medication Price must be numeric'
                    }
                },submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Medication Entry and Edit Form
        });
    </script>
@stop
