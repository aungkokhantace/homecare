@extends('layouts.master')
@section('title','Patient Family History')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Patient Family History List</h1>

    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif


    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <div class="buttons pull-right">
                <button type="button" onclick='create_setup_with_patient_id("patientfamilyhistory");' class="btn btn-default btn-md first_btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <button type="button" onclick='edit_setup_with_params("patientfamilyhistory");' class="btn btn-default btn-md second_btn">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                <button type="button" onclick="delete_setup_with_params('patientfamilyhistory');" class="btn btn-default btn-md third_btn">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
        </div>

    </div>

    {!! Form::open(array('id'=> 'frm_patientfamilyhistory' ,'url' => 'patientfamilyhistory/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
    {{ csrf_field() }}
    <input type="hidden" id="patientfamilyhistory_selected_checkboxes" name="patientfamilyhistory_selected_checkboxes" value="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient_id)? $patient_id:''}}"/>
                <table class="table table-striped list-table" id="list-table">
                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>Family Member Name</th>
                        <th>Family History Name</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="familyMember">Family Member Name</th>
                        <th class="search-col" con-id="familyHistory">Family History Name</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($patientfamilyhistories as $patientfamilyhistory)
                        <tr>
                            <td><input type="checkbox" class="check_source" name="patientfamilyhistory_edit_check" value="{{ $patientfamilyhistory->patient_id . '___' . $patientfamilyhistory->family_history_id . '___' . $patientfamilyhistory->family_member_id }}" id="all"></td>
                            <td><a href="/patientfamilyhistory/edit/{{ $patientfamilyhistory->patient_id . '___' . $patientfamilyhistory->family_history_id . '___' . $patientfamilyhistory->family_member_id }}">{{$patientfamilyhistory->familyMember}}</a></td>
                            <td><a href="/patientfamilyhistory/edit/{{ $patientfamilyhistory->patient_id . '___' . $patientfamilyhistory->family_history_id . '___' . $patientfamilyhistory->family_member_id }}">{{$patientfamilyhistory->familyHistory}}</a></td>
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
                "order": [[ 1, "asc" ]],
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