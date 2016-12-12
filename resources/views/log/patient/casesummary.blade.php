@extends('layouts.master')
@section('title','Patient Log')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Log Patient Case Summary List</h1>

    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif
    <br /><br />

    {!! Form::open(array('url' => 'patient/log/search', 'class'=> 'form-horizontal user-form-border', 'id' => 'patientForm', 'files' => true)) !!}
    <div class="row">
        <div class="col-md-4">
            <select class="form-control" name="patient_type_id" id="patient_type_id">
                <option value="all" >all</option>
                @foreach($patient as  $patient)
                    <option value="{{$patient->user_id}}" @if($selected_value == $patient->user_id) selected @endif>{{$patient->name}}  ---  {{$patient->dob}}  ---  {{$patient->nrc_no}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" name="submit" value="PREVIEW" class="form-control btn-primary">
        </div>
        <div class="col-md-6"></div>
    </div>
    {!! Form::close() !!}

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">
                    <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th style="width:300px">Case Summary</th>
                        <th>Updated By</th>
                        <th>Updated Date</th>
                        <th>Created By</th>
                        <th>Created Date</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($result as $r)
                        <tr>
                            <td>{{$r->patient_id}}</td>
                            <td style="width:300px">{{$r->case_summary}}</td>
                            <td>{{$r->updated_by}}</td>
                            <td>{{$r->updated_at}}</td>
                            <td>{{$r->created_by}}</td>
                            <td>{{$r->created_at}}</td>
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