@extends('layouts.master')
@section('title','Patient')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Patient's Schedule List</h1>

    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    <br/>
    <div class="row">

        <div class="panel panel-default">
            {{--<input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient_schedules)? $patient_schedules->user_id:''}}"/>--}}
            <div class="panel-heading">
                <h5><strong>Schedules</strong></h5>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><label>Date</label></td>
                            <td><label>Time</label></td>
                            <td><label>Car Type</label></td>
                            <td><label>Leader</label></td>
                            <td><label>Service</label></td>
                            <td></td>
                        </tr>
                        @if(isset($patientSchedules) && count($patientSchedules)>0)
                            @foreach($patientSchedules as $schedule)
                                <tr>
                                    <td>{{$schedule['date']}}</td>
                                    <td>{{$schedule['time']}}</td>
                                    <td>{{$schedule['car_type']}}</td>
                                    <td>{{$schedule['leader']}}</td>
                                    <td>{{$schedule['service']}}</td>
                                    <td>
                                        <td><a href="/patient/detailvisit/{{$schedule['id']}}">Detail Visit</a></td>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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