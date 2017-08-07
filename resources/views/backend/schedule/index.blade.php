@extends('layouts.master')
@section('title','Schedule')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Schedule List</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <div class="buttons pull-right">
                <button type="button" onclick='create_setup("schedule");' class="btn btn-default btn-md first_btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <button type="button" onclick='edit_setup("schedule");' class="btn btn-default btn-md second_btn">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
            </div>
        </div>

    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="schedule_status">Schedule Status</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <select class="form-control" name="schedule_status" id="schedule_status">
                <option value="all" {{($schedule_status == 'all')? 'selected' : ''}}>All statuses</option>
                <option value="new" {{($schedule_status == 'new')? 'selected' : ''}}>New</option>
                <option value="complete" {{($schedule_status == 'complete')? 'selected' : ''}}>Complete</option>
                <option value="processing" {{($schedule_status == 'processing')? 'selected' : ''}}>Processing</option>
                <option value="cancel" {{($schedule_status == 'cancel')? 'selected' : ''}}>Cancel</option>
            </select>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
    </div>

    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="from_date">From Date</label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date dateTimePicker" data-provide="datepicker" id="datepicker_from">
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
            <div class="input-group date dateTimePicker" data-provide="datepicker"  id="datepicker_to">
                <input type="text" class="form-control" id="to_date" name="date" value="{{isset($to_date)? $to_date : ''}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('to_date')}}</p>
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <button type="button" onclick='schedule_search();' class="form-control btn-primary">SHOW</button>
        </div>
    </div>

    {!! Form::open(array('id'=> 'frm_schedule' ,'url' => 'schedule/destroy', 'class'=> 'form-horizontal')) !!}
    {{ csrf_field() }}
    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    {!! Form::close() !!}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table list-table" id="list-table">

                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Patient Name</th>
                        {{--<th>Phone No.</th>--}}
                        {{--<th>Type</th>--}}
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="date">Date</th>
                        <th class="search-col" con-id="time">Time</th>
                        <th class="search-col" con-id="name">Patient Name</th>
                        {{--<th class="search-col" con-id="phone_no">Phone No.</th>--}}
                        {{--<th class="search-col" con-id="patient_type_id">Patient Type</th>--}}
                        <th class="search-col" con-id="status">Status</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($schedules as $key=>$schedule)
                        @if($schedule->status == "new")
                            <tr bgcolor="#63abf3">
                        @elseif($schedule->status == "complete")
                            <tr bgcolor="#6ce9a5">
                        @elseif($schedule->status == "cancel")
                            <tr bgcolor="#f57a7d">
                        @else
                            <tr bgcolor="#f2d380">
                        @endif
                            <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $schedule->id }}" id="all"></td>
                            <td><a href="/schedule/edit/{{$schedule->id}}">{{$schedule->date}}</a></td>
                            <td>{{$schedule->time}}</td>
                            <td>{{$schedule->patient_name}}</td>
                            {{--<td>{{$schedule->phone_no}}</td>--}}
                            {{--<td>{{$schedule->patient_type}}</td>--}}
                            <td>{{strtoupper($schedule->status)}}</td>
                            <td>
                                @if($schedule->status == 'new')
                                    <form id="frm_schedule_cancel_{{$schedule->id}}" method="post" action="/schedule/cancel">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="schedule_cancel_id" name="schedule_cancel_id" value="{{$schedule->id}}">
                                        <button type="button" onclick="schedule_cancel('{{$schedule->id}}');" class="btn btn-danger">
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

            $('#datepicker_from').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
            });

            $('#datepicker_to').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
                minDate: "20-08-2016",

            });
        });
    </script>
@stop