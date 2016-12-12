@extends('layouts.master_patient')
@section('title','Dashboard')
@section('content')
<style>
    .info-box{
        cursor: pointer;
    }
</style>
<div id="content" class="content">
        <h1 class="page-header">Dashboard</h1>
        <br/>
    <div class="row">
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="name" class="text_bold_black">Patient Name</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <label class="text_big_blue">{{$patient->name}}</label>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="dob" class="text_bold_black">DOB</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <label class="text_big_blue">{{$patientDob}}</label>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="phone_no" class="text_bold_black">Phone No</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <label class="text_big_blue">{{$patient->phone_no}}</label>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="phone_no" class="text_bold_black">Email</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <label class="text_big_blue">{{$patient->email}}</label>
                </div>
            </div>
            <br/>

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="name" class="text_bold_black">Address</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <label class="text_big_blue">{{$patient->address}}</label>
                </div>
            </div>
        </div>
    </div>

    <br/>
    <br/>

    {{--Start showing counts--}}
    <div class="row">
        <div class="col-md-4">
            <div class="info-box" onclick="redirect_to_history('schedule');">
                <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Schedule Count</span>
                    <span class="info-box-number">{{$scheduleCount}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box" onclick="redirect_to_history('service');">
                <span class="info-box-icon bg-red"><i class="fa fa-folder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Service Count</span>
                    <span class="info-box-number">{{$serviceCount}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box" onclick="redirect_to_history('package');">
                <span class="info-box-icon bg-green"><i class="fa fa-folder"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Package Count</span>
                    <span class="info-box-number">{{$packageCount}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    {{--End showing counts--}}
</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        function redirect_to_history(type){
            window.location ='/patient/' + type;
        }
        $(document).ready(function() {

        });
    </script>
@stop