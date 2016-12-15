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
@section('title','Tablet Error Log')
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
    <h1 class="page-header">{{ 'Tablet Error Log' }}</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    {!! Form::open(array('url' => '', 'class'=> 'form-horizontal user-form-border','files' => true , 'id' => 'priceHistoryForm')) !!}

    <br/>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="table_name" class="text_bold_black">Tablet ID</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" id="tablet_id" name="tablet_id">
                <option value="all" @if($type == 'all') selected @endif>All tablets</option>
                @foreach($tabletIdsArray as $key=>$tabletId)
                    <option value={{$key}} @if($key == $type) selected @endif>{{$tabletId}}</option>
                @endforeach
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
                        <th>User ID</th>
                        <th>Tablet ID</th>
                        <th>Exception</th>
                        <th>Date</th>
                        <th>Created By</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="table_name">User ID</th>
                        <th class="search-col" con-id="table_id">Tablet ID</th>
                        <th class="search-col" con-id="table_id">Exception</th>
                        <th class="search-col" con-id="old_price">Date</th>
                        <th class="search-col" con-id="created_by">Created by</th>
                        <th class="search-col" con-id="created_at">Created at</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($tabletIssues as $key=>$tabletIssue)
                        <tr>
                            <td><input type="checkbox"></td>
                            {{--<td><a href="/pricehistory/{{$tabletIssue->user_id}}/{{$tabletIssue->user_id}}">{{$tabletIssue->user_id}}</a></td>--}}
                            <td>{{$tabletIssue->user_id}}</td>
                            <td>{{$tabletIssue->tablet_id}}</td>
                            <td>{{$tabletIssue->exception}}</td>
                            <td>{{$tabletIssue->date}}</td>
                            <td>{{strtoupper($tabletIssue->created_by)}}</td>
                            <td>{{strtoupper($tabletIssue->created_at)}}</td>
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

                var type = $("#tablet_id").val();
                var form_action = "/tabletissues/" + type;
                window.location = form_action;
            });
        });


    </script>
@stop