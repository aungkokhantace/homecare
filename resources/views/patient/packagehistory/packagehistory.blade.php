<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 8/22/2016
 * Time: 10:00 AM
 */
?>

@extends('layouts.master_patient')
@section('title','Package History')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Package History</h1>

    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>Name</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="name">Status</th>
                        <th class="search-col" con-id="type">Date</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($packages as $package)
                        <tr>
                            <td><input type="checkbox" class="check_source" name="edit_check" value="{{$package->package_id}}" id="all"></td>
                            <td>{{$package->package_name}}</td>
                            <td>{{$package->date}}</td>
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
        });
    </script>
@stop