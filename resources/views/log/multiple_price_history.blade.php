<?php
/**
 * Created by PhpStorm.
 * User: william
 * Author: Wai Yan Aung
 * Date: 12/5/2016
 * Time: 3:25 PM
 */
?>

@extends('layouts.master')
@section('title','History')
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
    </style>
    <h1 class="page-header">{{ 'Multiple Price History' }}</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    {!! Form::open(array('url' => '', 'class'=> 'form-horizontal user-form-border','files' => true , 'id' => 'priceHistoryForm')) !!}

    <br/>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="table_name" class="text_bold_black">Table Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" id="table_name" name="table_name">
                <option value="all" @if($type == 'all') selected @endif>All setup prices</option>
                <option value="investigation_labs" @if($type == 'investigation_labs') selected @endif>Investigation Labs</option>

            </select>
            <p class="text-danger">{{$errors->first('table_name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <input type="button" name="btn_preview" id="btn_preview" value="Preview" class="form-control btn-primary">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th><input type='checkbox'/></th>
                        <th>Type</th>
                        <th>Type ID</th>
                        <th>Type Name</th>
                        <th>Old Price</th>
                        <th>New Price</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Created By</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="table_name">Type</th>
                        <th class="search-col" con-id="table_id">Type ID</th>
                        <th class="search-col" con-id="table_id">Type Name</th>
                        <th class="search-col" con-id="old_price">Old Price</th>
                        <th class="search-col" con-id="new_price">New Price</th>
                        <th class="search-col" con-id="new_price">Type</th>
                        <th class="search-col" con-id="action">Action</th>
                        <th class="search-col" con-id="created_by">Created by</th>
                        <th class="search-col" con-id="created_at">Created at</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($priceHistories as $key=>$priceHistory)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><a href="/multiplepricehistory/{{$priceHistory->table_name}}/{{$priceHistory->table_id}}">{{$priceHistory->table_name}}</a></td>
                            <td>{{$priceHistory->table_id}}</td>
                            <td>{{$priceHistory->setup_name}}</td>
                            <td>{{$priceHistory->old_price}}</td>
                            <td>{{$priceHistory->new_price}}</td>
                            <td>{{$priceHistory->type}}</td>
                            <td>{{$priceHistory->action}}</td>
                            <td>{{strtoupper($priceHistory->created_by)}}</td>
                            <td>{{strtoupper($priceHistory->created_at)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
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

            $( "#btn_preview" ).click(function() {

                var type = $("#table_name").val();
                var form_action = "/multiplepricehistory/" + type + "/0";
                window.location = form_action;
            });
        });


    </script>
@stop