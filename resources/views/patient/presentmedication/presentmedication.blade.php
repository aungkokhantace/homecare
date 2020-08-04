@extends('layouts.master_patient')
@section('title','Present Medications')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Present Medications</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th>Medication Name</th>
                        <th>Dosage</th>
                        <th>Frequency</th>
                        <th>Days</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="medication_name">Medication Name</th>
                        <th class="search-col" con-id="dosage">Dosage</th>
                        <th class="search-col" con-id="frequency">Frequency</th>
                        <th class="search-col" con-id="days">Days</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @foreach($presentMedications as $presentMedication)
                            <tr>
                                <td>{{$presentMedication->product->product_name}}</td>
                                <td>{{$presentMedication->total_dosage}}</td>
                                <td>{{$presentMedication->frequency}}</td>
                                <td>{{$presentMedication->days}}</td>
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
                    [10,15,25, 50, 100, 200, -1],
                    [10,15,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 1, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',
                "pageLength": 15
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
