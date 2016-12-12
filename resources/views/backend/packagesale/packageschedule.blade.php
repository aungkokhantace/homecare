@extends('layouts.master')
@section('title','Package Schedule Management')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Package Schedule Management</h1>
    <br/>

    <div class="row">

        <div class="panel panel-default">
            <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Package Schedule Summary</strong></h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <td><label for="name" class="text_bold_black">Patient Name</label></td>
                        <td><label for="name" class="text_big_blue">{{$patient->name}}</label></td>

                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="gender" class="text_bold_black">Patient Gender</label></td>
                        <td>
                            @if(isset($patient)&&$patient->gender=="male")
                                <label for="gender" class="text_big_blue">Male</label>
                            @else
                                <label for="gender" class="text_big_blue">Female</label>
                            @endif
                        </td>

                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="type" class="text_bold_black">Patient Type</label></td>
                        <td>
                            @if(isset($patient) && $patient->patient_type_id == 1)
                                <label for="type" class="text_big_blue">Local</label>
                            @else
                                <label for="type" class="text_big_blue">Foreigner</label>
                            @endif
                        </td>

                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="phone1" class="text_bold_black">Patient Phone</label></td>
                        <td><label for="phone1" class="text_big_blue">{{$patient->phone_no}}</label></td>

                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="remark" class="text_bold_black">Remark</label></td>
                        <td><label for="remark" class="text_big_blue">{{$patient_package->remark}}</label></td>

                        <td></td>
                        <td></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <table class="table table-striped list-table" id="list-table">
                <thead>
                <tr>
                    <th>Total Schedule Count</th>
                    <th>Created Schedule Count</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td height="60" style="text-align:center; vertical-align: middle">{{$patient_package->package_usage_count}}</td>
                        <td height="60" style="text-align:center; vertical-align: middle">{{$patient_package->package_used_count}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <form id="frm_package_schedule_create" method="post" action="/schedule/create">
                {{ csrf_field() }}
                <input type="hidden" id="patient_package_id" name="patient_package_id"  value="{{$patient_package->id}}">
                @if($displayFlag == 1)
                <a href="#"><input  onclick="package_schedule_create();" type="button" value="Create New Schedule" class="form-control btn-primary" style="padding:0px;"></a>
                @endif
            </form>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped list-table" id="list-table">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Township</th>
                    <th>Car Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach($schedules as $schedule)
                        <tr>
                            <td>{{$schedule->status}}</td>
                            <td>{{$schedule->date}}</td>
                            <td>{{$schedule->time}}</td>
                            <td>{{$schedule->township->name}}</td>
                            <td>{{$carTypeArray[$schedule->id]}}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#services").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter();
        });

        function autofill(value)
        {
            console.log(value);
            $id=value;
            // Add loading state
            $('#gender').val('Loading please wait ...');
            $('#patient_type').val('Loading please wait ...');
            $('#phone').val('Loading please wait ...');
            $('#address').val('Loading please wait ...');

            // Set request
            var request = $.get('/packagesale/autofill/'+$id);

            // When it's done
            request.done(function(response) {
                $('#gender').val(response['gender']);
                $('#gender_id').val(response['gender_id']);
                $('#patient_type').val(response['type']);
                $('#type_id').val(response['type_id']);
                $('#phone').val(response['phone']);
                $('#address').val(response['address']);
                $data=response;
            });
        }

    </script>
@stop