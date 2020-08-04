@extends('layouts.master')
@section('title','Schedule Tracking Report Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Schedule Tracking Report Detail</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif
    <br />
    <h3><a href="/scheduletrackingreport">Back to Schedule Tracking Report</a></h3>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <table class="table table-striped">
            <tr>
              <td>Patient Name</td>
              <td>{{$scheduleTracking->patient_name}}</td>
            </tr>
            <tr>
              <td>Doctor Name</td>
              <td>{{$scheduleTracking->doctor_name}}</td>
            </tr>
            <tr>
              <td>Date</td>
              <td>{{$scheduleTracking->date}}</td>
            </tr>
            <tr>
              <td>Township</td>
              <td>{{$scheduleTracking->township}}</td>
            </tr>
            <tr>
              <td>Zone</td>
              <td>{{$scheduleTracking->zone}}</td>
            </tr>
            <tr>
              <td>Preparation Start Time (Time)</td>
              <td>{{$scheduleTracking->preparation_start_time}}</td>
            </tr>
            <tr>
              <td>Preparation Duration (Duration)</td>
              <td>{{$scheduleTracking->preparation_duration}}</td>
            </tr>
            <tr>
              <td>Preparation End Time (Time)</td>
              <td>{{$scheduleTracking->preparation_end_time}}</td>
            </tr>
            <tr>
              <td>Transportation Duration (Duration)</td>
              <td>{{$scheduleTracking->transportation_duration}}</td>
            </tr>
            <tr>
              <td>Arrived to patient at (Time)</td>
              <td>{{$scheduleTracking->arrived_to_patient_time}}</td>
            </tr>
            <tr>
              <td>Treatment Duration (Duration)</td>
              <td>{{$scheduleTracking->treatment_duration}}</td>
            </tr>
            <tr>
              <td>Left from patient at (Time)</td>
              <td>{{$scheduleTracking->leave_from_patient_time}}</td>
            </tr>
          </table>
        </div>
    </div>

</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {
        });
    </script>
@stop
