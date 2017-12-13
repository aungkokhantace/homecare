@extends('layouts.master')
@section('title','Sale Income Report Invoice List')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Sale Income Report Invoice List</h1>
    <br />

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table list-table" id="list-table">
                    <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Invoice Date</th>
                        <th>Patient Name</th>
                        <th>Service</th>
                        <th>Doctor</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="invoice_id">Invoice ID</th>
                        <th class="search-col" con-id="invoice_date">Invoice Date</th>
                        <th class="search-col" con-id="patient_name">Patient Name</th>
                        <th class="search-col" con-id="service">Service</th>
                        <th class="search-col" con-id="doctor">Doctor</th>
                        <th class="search-col" con-id="total">Total</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @foreach($invoiceArray as $invoice)
                            <tr>
                                <td><a href="/saleincomereport/invoice/{{$invoice['invoice_id']}}">{{$invoice['invoice_id']}}</a></td>
                                <td>{{$invoice['date']}}</td>
                                <td>{{$invoice['patient_name']}}</td>
                                <td>{{$invoice['services']}}</td>
                                <td>{{$invoice['doctor']}}</td>
                                <td>{{$invoice['total']}}</td>
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

            //Start Daypickers
            $('#datepicker_from').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true
            });

            $('#datepicker_to').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
                minDate: "20-08-2016"
            });
            //End Daypickers

            //Start Monthpickers
            $('#monthpicker_from').datepicker({
                format: 'mm-yyyy',
                viewMode: "months",
                minViewMode: "months",
                allowInputToggle: true,
                autoclose: true
            });

            $('#monthpicker_to').datepicker({
                format: "mm-yyyy",
                viewMode: "months",
                minViewMode: "months",
                allowInputToggle: true,
                autoclose: true
            });
            //End Monthpickers

            //Start Yearpickers
            $('#yearpicker_from').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                allowInputToggle: true,
                autoclose: true
            });

            $('#yearpicker_to').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                allowInputToggle: true,
                autoclose: true
            });
            //End Yearpickers

            var currentType = document.getElementById("type").value;
            if(currentType == "yearly"){
                $('.days').hide();
                $('.months').hide();
                $('.years').show();
            }
            else if(currentType == "monthly"){
                $('.days').hide();
                $('.months').show();
                $('.years').hide();
            }
            else{
                $('.days').show();
                $('.months').hide();
                $('.years').hide();
            }

        });

        function switchPicker(){
            var type = document.getElementById("type").value;
            if(type == "yearly"){
                $('.days').hide();
                $('.months').hide();
                $('.years').show();
            }
            else if(type == "monthly"){
                $('.days').hide();
                $('.months').show();
                $('.years').hide();
            }
            else{
                $('.days').show();
                $('.months').hide();
                $('.years').hide();
            }
        }
    </script>
@stop
