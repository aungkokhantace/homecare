@extends('layouts.master')
@section('title','Patient')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Patient List</h1>

    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif


    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <div class="buttons pull-right">
                <button type="button" onclick='create_setup("patient");' class="btn btn-default btn-md first_btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <button type="button" onclick='edit_setup("patient");' class="btn btn-default btn-md second_btn">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                <button type="button" onclick="delete_setup('patient');" class="btn btn-default btn-md third_btn">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
        </div>

    </div>

    {!! Form::open(array('id'=> 'frm_patient' ,'url' => 'patient/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
    {{ csrf_field() }}
    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">
                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        {{--<th>Patient Type</th>--}}
                        {{--<th>Gender</th>--}}
                        <th>Dob</th>
                        <th>Township</th>
                        {{--<th>Zone</th>--}}
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="user_id">Patient ID</th>
                        <th class="search-col" con-id="name">Patient Name</th>
                        {{--<th class="search-col" con-id="patient_type">Patient Type</th>--}}
                        {{--<th class="search-col" con-id="gender">Gender</th>--}}
                        <th class="search-col" con-id="dob">Dob</th>
                        <th class="search-col" con-id="township">Township</th>
                        {{--<th class="search-col" con-id="zone">Zone</th>--}}
                        <th class="search-col" con-id="status"></th>
                        <!-- <th class="search-col" con-id="status"></th> -->
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($patient as $patient)

                        <tr>
                            <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $patient->user_id }}" id="all"></td>
                            <td><a href="/patient/edit/{{$patient->user_id}}">{{$patient->user_id}}</a></td>
                            <td><a href="/patient/edit/{{$patient->user_id}}">{{$patient->name}}</a></td>
                            {{--<td>{{$patientTypes[$patient->patient_type_id]}}</td>--}}
                            {{--@if($patient->gender == "male")--}}
                                {{--<td>Male</td>--}}
                            {{--@else--}}
                                {{--<td>Female</td>--}}
                            {{--@endif--}}
                            <td>{{$patient->dob}}</td>
                            <td>{{$patient->township->name}}</td>
                            {{--<td>{{$patient->zone['name']}}</td>--}}
                            <!-- <td><a href="/patient/detail/{{$patient->user_id}}">Detail</a></td> -->
                            <td><a href="/patient/patient_detail/{{$patient->user_id}}">Detail</a></td>
                            <!-- <td><a href="/patient/detailvisit/{{$patient->user_id}}">Detail Visit</a></td> -->
                            <!-- <td><a href="/patient/patientSchedule/{{$patient->user_id}}">Detail Visit</a></td> -->
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

        });
    </script>
@stop