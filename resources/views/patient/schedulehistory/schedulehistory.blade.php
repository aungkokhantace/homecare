<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 8/22/2016
 * Time: 10:00 AM
 */
?>

@extends('layouts.master_patient')
@section('title','Schedule History')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Schedule History</h1>

    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th>ScheduleID</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="id">ScheduleID</th>
                        <th class="search-col" con-id="status">Status</th>
                        <th class="search-col" con-id="date">Date</th>
                        <th class="search-col" con-id="time">Time</th>
                        <th class="search-col" con-id="service">Service</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td>{{$schedule->id}}</td>
                            <td>{{$schedule->status}}</td>
                            <td>{{$schedule->date}}</td>
                            <td>{{$schedule->time}}</td>
                            <td>{{$schedule->services}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                    [10,15,25, 50, 100, 200, -1],
                    [10,15,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 1, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',
                "pageLength": 15
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
        });
    </script>
@stop
