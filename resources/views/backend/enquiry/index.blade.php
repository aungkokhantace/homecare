@extends('layouts.master')
@section('title','Enquiry')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Enquiry List</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <div class="buttons pull-right">
                <button type="button" onclick='create_setup("enquiry");' class="btn btn-default btn-md first_btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <button type="button" onclick='edit_setup("enquiry");' class="btn btn-default btn-md second_btn">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                {{--<button type="button" onclick="delete_setup('enquiry');" class="btn btn-default btn-md third_btn">--}}
                    {{--<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>--}}
                {{--</button>--}}
            </div>
        </div>

    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="enquiry_status">Enquiry Status</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <select class="form-control" name="enquiry_status" id="enquiry_status">
                <option value="all" {{($enquiry_status == 'all')? 'selected' : ''}}>All statuses</option>
                <option value="new" {{($enquiry_status == 'new')? 'selected' : ''}}>New</option>
                <option value="confirm" {{($enquiry_status == 'confirm')? 'selected' : ''}}>Confirm</option>
                <option value="complete" {{($enquiry_status == 'complete')? 'selected' : ''}}>Complete</option>
                <option value="cancel" {{($enquiry_status == 'cancel')? 'selected' : ''}}>Cancel</option>
            </select>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="enquiry_case_type">Emergency</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <select class="form-control" name="enquiry_case_type" id="enquiry_case_type">
                <option value="all" {{($enquiry_case_type == 'all')? 'selected' : ''}}>All statuses</option>
                <option value="1" {{($enquiry_case_type == '1')? 'selected' : ''}}>Yes</option>
                <!-- <option value="2" {{($enquiry_case_type == '2')? 'selected' : ''}}>No</option> -->
                <option value="0" {{($enquiry_case_type == '0')? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="from_date">From Date</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker">
                <input type="text" class="form-control" id="from_date" name="from_date" value="{{isset($from_date)? $from_date : ''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('from_date')}}</p>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="to_date">To Date</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker">
                <input type="text" class="form-control" id="to_date" name="date" value="{{isset($to_date)? $to_date : ''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('to_date')}}</p>
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <button type="button" onclick='enquiry_search();' class="form-control btn-primary">SHOW</button>
        </div>
    </div>

    {!! Form::open(array('id'=> 'frm_enquiry' ,'url' => 'enquiry/destroy', 'class'=> 'form-horizontal')) !!}
    {{ csrf_field() }}
    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    {!! Form::close() !!}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>Created Date</th>
                        <th>Received By</th>
                        <th>Patient Name</th>
                        <th>Service</th>
                        {{--<th>Phone No.</th>--}}
                        {{--<th>Type</th>--}}
                        {{--<th>Gender</th>--}}
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="date">Date</th>
                        <th class="search-col" con-id="name">Received By</th>
                        <th class="search-col" con-id="name">Patient Name</th>
                        <th class="search-col" con-id="service">Service</th>
                        {{--<th class="search-col" con-id="phone_no">Phone No.</th>--}}
                        {{--<th class="search-col" con-id="patient_type_id">Patient Type</th>--}}
                        {{--<th class="search-col" con-id="gender">Gender</th>--}}
                        <th class="search-col" con-id="status">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($enquiries as $key=>$enquiry)
                        <tr>
                            <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $enquiry->id }}" id="all"></td>
                            <td><a href="/enquiry/edit/{{$enquiry->id}}">{{$enquiry->created_at}}</a></td>
                            <td>{{$enquiry->received_by}}</td>
                            <td>{{$enquiry->name}}</td>
                            <td>{{$enquiry->services}}</td>
                            {{--<td>{{$enquiry->phone_no}}</td>--}}
{{--                            <td>{{$enquiry->patient_type}}</td>--}}
                            {{--<td>{{strtoupper($enquiry->gender)}}</td>--}}
                            <td>{{strtoupper($enquiry->status)}}</td>
                            <td>
                                @if($enquiry->status == 'new')
                                    <form id="frm_enquiry_confirm_{{$enquiry->id}}" method="post" action="/schedule/create">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="enquiry_confirm_id" name="enquiry_confirm_id"  value="{{$enquiry->id}}">
                                        <button type="button" onclick="enquiry_confirm('{{$enquiry->id}}');" class="btn btn-primary">
                                            CONFIRM
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if($enquiry->status == 'new')
                                    <form id="frm_enquiry_cancel_{{$enquiry->id}}" method="post" action="/enquiry/cancel">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="enquiry_cancel_id" name="enquiry_cancel_id" value="{{$enquiry->id}}">
                                        <button type="button" onclick="enquiry_cancel('{{$enquiry->id}}');" class="btn btn-danger">
                                            CANCEL
                                        </button>
                                    </form>
                                @endif
                            </td>
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
                "order": [[ 1, "desc" ]],
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

            $('.dateTimePicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true
            });
        });
    </script>
@stop