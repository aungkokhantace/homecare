@extends('layouts.master')
@section('title','Patient Package')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Patient Package Usage List</h1>

    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif


    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <div class="buttons pull-right">
                <button type="button" onclick='create_setup("packagesale");' class="btn btn-default btn-md first_btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
            </div>
        </div>

    </div>

    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">
                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>Patient Name</th>
                        <th>Patient ID</th>
                        <th>Package Name</th>
                        <!-- <th>Remark</th> -->
                        <th>Date</th>
                        <th>Detail</th>
                        <th>Export</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="patient_name">Patient Name</th>
                        <th class="search-col" con-id="patient_id">Patient ID</th>
                        <th class="search-col" con-id="package_name">Package Name</th>
                        <!-- <th class="search-col" con-id="remark">Remark</th> -->
                        <th class="search-col" con-id="date">Date</th>
                        <th class="search-col"></th>
                        <th class="search-col"></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($packagesales as $packagesale)
                        <tr>
                            <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $packagesale->id }}" id="all"></td>
                            <td>{{$packagesale->patient->name}}</td>
                            <td>{{$packagesale->patient->user_id}}</td>
                            <td>{{$packagesale->package->package_name}}</td>
                            <!-- <td>{{$packagesale->remark}}</td> -->
                            <td>{{$packagesale->sold_date}}</td>
                            <td><a href={{"/packagesale/schedule/".$packagesale->id}}>Detail</a></td>
                            <td><a target="_blank" href={{"/packagesale/export/".$packagesale->id."/".$packagesale->promotion_code}}>Export</a></td>
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
                "order": [[ 4, "desc" ]],
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