<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:46 AM
 */
?>

@extends('layouts.master')
@section('title','Import')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">
    <style>
        .fileUpload {
            position: relative;
            overflow: hidden;
            margin: 10px;
        }
        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .product_categories,.products,.family_histories,.medical_history,.provisional_diagnosis,.allergies{
            display: none;
        }
    </style>
    <h1 class="page-header">{{ 'CSV Import' }}</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    {!! Form::open(array('url' => 'import/store', 'class'=> 'form-horizontal user-form-border','files' => true , 'id' => 'importForm')) !!}

    <br/>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="table_name" class="text_bold_black">Table Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" id="table_name" name="table_name" onchange="show_sample(value)">
                <option selected disabled>Select Table Name</option>
                <option value="product_categories">product_categories</option>
                <option value="products">products</option>
                <option value="family_histories">family_histories</option>
                <option value="medical_history">medical_history</option>
                <option value="provisional_diagnosis">provisional_diagnosis</option>
                <option value="allergies">allergies</option>

            </select>
            <p class="text-danger">{{$errors->first('table_name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="csv" class="text_bold_black">CSV File<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            {{--<input id="csv_file" type="file" name="csv_file" />--}}
            {{--<p class="text-danger">{{$errors->first('csv_file')}}</p>--}}
            <div class="fileUpload btn btn-primary">
                <span>Choose</span>
                <input type="file" class="upload" id="csv_file" name="csv_file"/>
            </div>
            <p class="text-danger">{{$errors->first('csv_file')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <input type="submit" name="submit" value="ADD" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <input type="reset" value="CANCEL" class="form-control cancel_btn" onclick="">
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row product_categories">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h4>Sample product_categories CSV</h4>
            <img src="/images/sampleCSV/ProductCategories.jpg" class="pull-left height-full m-r-5">
        </div>
    </div>
    <div class="row product_categories">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <ol>
                <li>Product Category Name</li>
                <li>Product Category Description</li>
            </ol>
        </div>
    </div>
    <div class="row products">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h4>Sample products CSV</h4>
            <img src="/images/sampleCSV/Products.jpg" class="pull-left height-full m-r-5">
        </div>
    </div>
    <div class="row products">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <ol>
                <li>Product Category Name (must be category names from product_categories table)</li>
                <li>Product Name</li>
                <li>Product Price</li>
                <li>Product Description</li>
            </ol>
        </div>
    </div>
    <div class="row family_histories">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h4>Sample family_histories CSV</h4>
            <img src="/images/sampleCSV/FamilyHistories.jpg" class="pull-left height-full m-r-5">
        </div>
    </div>
    <div class="row family_histories">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <ol>
                <li>Family History Name</li>
                <li>Family History Description</li>
            </ol>
        </div>
    </div>
    <div class="row medical_history">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h4>Sample medical_history CSV</h4>
            <img src="/images/sampleCSV/MedicalHistories.jpg" class="pull-left height-full m-r-5">
        </div>
    </div>
    <div class="row medical_history">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <ol>
                <li>Medical History Name</li>
                <li>Medical History Description</li>
            </ol>
        </div>
    </div>
    <div class="row provisional_diagnosis">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h4>Sample provisional_diagnosis CSV</h4>
            <img src="/images/sampleCSV/ProvisionalDiagnosis.jpg" class="pull-left height-full m-r-5">
        </div>
    </div>
    <div class="row provisional_diagnosis">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <ol>
                <li>Provisional Diagnosis Name</li>
                <li>Provisional Diagnosis Description</li>
            </ol>
        </div>
    </div>
    <div class="row allergies">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <h4>Sample allergies CSV</h4>
            <img src="/images/sampleCSV/Allergies.jpg" class="pull-left height-full m-r-5">
        </div>
    </div>
    <div class="row allergies">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <ol>
                <li>Allergy Name</li>
                <li>Allergy Type</li>
                <li>Allergy Description</li>
            </ol>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#importForm').validate({
                rules: {
                    table_name: 'required',
                    csv_file : {
                        required: true,
                        extension: "csv"
                    }
                },
                messages: {
                    table_name: 'Table Name is required!',
                    csv_file : {
                        required: 'CSV file is required!',
                        extension: 'Please upload a csv file!'
                    }
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
        });

        function show_sample(value)
        {
            //hide all rows
            $('.product_categories').hide();
            $('.products').hide();
            $('.family_histories').hide();
            $('.medical_history').hide();
            $('.provisional_diagnosis').hide();
            $('.allergies').hide();

            //display selected row
            $('.'+value).show();
        }
    </script>
@stop