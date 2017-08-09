<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/26/2016
 * Time: 2:18 PM
 */
?>

@extends('layouts.master')
@section('title','Patient Detail')
@section('content')

    <!-- begin #content -->
<div id="content" class="content" xmlns="http://www.w3.org/1999/html">

        <h1 class="page-header">Patient Detail</h1>

        @if(count(Session::get('message')) != 0)
            <div>
            </div>
        @endif

        <br/>
        <div class="row">
            <div class="panel panel-default">
                <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
                <div class="panel-heading patient_detail_heading">
                    <h4 class="center_aligned"><strong>Personal Information</strong></h4>
                </div>
                <div class="panel-body">
                    @if(isset($patient->user->display_image))
                    <div class="row">
                        <img src="/images/users/{{$patient->user->display_image}}" class="center_image">
                    </div>
                    <br>
                    @endif
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="25%"><label>Patient ID </label></td>
                            <td width="25%">{{isset($patient)? $patient->user_id:''}}</td>
                            <td width="25%"><label>Name </label></td>
                            <td width="25%">{{isset($patient)? $patient->name:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Age </label></td>
                            <td>{{isset($patient)? $patient->age["value"].' '.$patient->age["unit"]:''}}</td>
                            <td><label>NRC/Passport No. </label></td>
                            <td>{{isset($patient)? $patient->nrc_no:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Gender </label></td>
                            <td>{{isset($patient)? ucwords($patient->gender):''}}</td>
                            <td><label>Patient Type</label></td>
                            <td>{{isset($patient)? $patient->patient_type:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Phone No.</label></td>
                            <td>{{isset($patient)? $patient->phone_no:''}}</td>
                            <td><label>Email</label></td>
                            <td>{{isset($patient)? $patient->email:''}}</td>
                        </tr>
                        <tr>
                            <td><label>Address</label></td>
                            <td colspan="3">{{isset($patient)? $patient->address:''}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                        <h4><label><strong>Case Summary</strong></label></h4>
                        {{isset($patient)? $patient->case_scenario:''}}
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h4><label><strong>Remark</strong></label></h4>
                            {{isset($patient)? $patient->remark:''}}
                        </div>
                    </div>
                    <hr>

                    {{--start displaying allergies--}}
                    <div class="row">
                        <div class="col-md-12">
                            <h4><label><strong>Allergies</strong></label></h4>
                            @if($patient->having_allergy == 1)
                                @foreach($patient['allergies']['food'] as $allergy)
                                    @if($allergy->selected == 1)
                                        <label for="allergy">[Food] - {{$allergy->name}}</label><br/>
                                    @endif
                                @endforeach

                                @foreach($patient['allergies']['drug'] as $allergy)
                                    @if($allergy->selected == 1)
                                        <label for="allergy">[Drug] - {{$allergy->name}}</label><br/>
                                    @endif
                                @endforeach

                                @foreach($patient['allergies']['environment'] as $allergy)
                                    @if($allergy->selected == 1)
                                        <label for="allergy">[Environment] - {{$allergy->name}}</label><br/>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{--end displaying allergies--}}
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
                <div class="panel-heading patient_detail_heading">
                    <h4 class="center_aligned"><strong>Patient History</strong></h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="4" class="info"><label><strong>MO SERVICE</strong></label></td>
                        </tr>
                        <tr>
                            <td width="45%"><strong>Medical History</strong>
                                @foreach($patientmedicalhistories as $patientmedicalhistory)
                                    <br><label>{{$patientmedicalhistory->medicalHistory}}</label>
                                @endforeach
                            </td>
                            <td class="red_text" width="5%"><a target="_blank" href="/patientmedicalhistory/{{$patient->user_id}}">Edit</a></td>

                            <td width="45%"><strong>Surgery History</strong>
                                @foreach($patientsurgeryhistories as $patientsurgeryhistory)
                                    <br><label>{{$patientsurgeryhistory->description}}</label>
                                @endforeach
                            </td>
                            <td class="red_text" width="5%"><a target="_blank" href="/patientsurgeryhistory/{{$patient->user_id}}">Edit</a></td>
                        </tr>
                        <tr>
                            <td><strong>Family History</strong>
                                @foreach($patientfamilyhistories as $patientfamilyhistory)
                                    <br><label>{{$patientfamilyhistory->familyMember}} - {{$patientfamilyhistory->familyHistory}}</label>
                                @endforeach
                            </td>
                            <td class="red_text"><a target="_blank" href="/patientfamilyhistory/{{$patient->user_id}}">Edit</a></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="4" class="info"><label><strong>MUSCULAR ACCESSMENT</strong></label></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="4" class="info"><label><strong>NEURO ACCESSMENT</strong></label></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="4" class="info"><label><strong>NUTRITION</strong></label></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="4" class="info"><label><strong>BLOOD DRAWING</strong></label></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
        <div class="panel panel-default">
            <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
            <div class="panel-heading patient_detail_heading">
                <h4 class="center_aligned"><strong>Patient Visit Records</strong></h4>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr class="info">
                        <td>Date</td>
                        <td>Doctor</td>
                        <td>Service</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2017-08-08</td>
                        <td>Dr. Myint Than Htike</td>
                        <td>MO</td>
                        <td>Detail</td>
                        <td>Invoice</td>
                    </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
    </div>
    </div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {

            $('#list-table tfoot th.search-col').each( function () {
                var title = $('#list-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table = $('#list-table').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $('#list-table2 tfoot th.search-col').each( function () {
                var title = $('#list-table2 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table2 = $('#list-table2').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table2.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table2.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table2
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });


            $('#list-table3 tfoot th.search-col').each( function () {
                var title = $('#list-table3 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table3 = $('#list-table3').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table3.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table3.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table3
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $('#list-table4 tfoot th.search-col').each( function () {
                var title = $('#list-table4 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table4 = $('#list-table4').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table4.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table4.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table4
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $('#list-table5 tfoot th.search-col').each( function () {
                var title = $('#list-table5 thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table5 = $('#list-table5').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });

            // Apply the search
            table5.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table5.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table5
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });

            $("#check_all_patientfamilyhistory").click(function(event){
                if(this.checked) {
                    $('.check_source_patientfamilyhistory').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"
                    });
                }else{
                    $('.check_source_patientfamilyhistory').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"
                    });
                }
            });

            $("#check_all_patientsurgeryhistory").click(function(event){
                if(this.checked) {
                    $('.check_source_patientsurgeryhistory').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"
                    });
                }else{
                    $('.check_source_patientsurgeryhistory').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"
                    });
                }
            });

        });
    </script>
@stop