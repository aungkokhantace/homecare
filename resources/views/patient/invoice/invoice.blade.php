@extends('layouts.master_patient')
@section('title','Invoice')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Invoice</h1>

    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">
                    <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Patient Name</th>
                        <th>Township</th>
                        <th>Car Type</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="invoice_id">Invoice ID</th>
                        <th class="search-col" con-id="patient_name">Patient Name</th>
                        <th class="search-col" con-id="township">Township</th>
                        <th class="search-col" con-id="cartype">Car Type</th>
                        <th class="search-col" con-id="date">Date</th>
                        <th class="search-col" con-id="total_amount">Total Amount</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td><a href="/patient/invoicedetail/{{$invoice->id}}">{{$invoice->id}}</a></td>
                                <td>{{$invoice->patient->name}}</td>
                                <td>{{$invoice->patient->township->name}}</td>
                                <td>
                                    @if(isset($carTypeArray) && count($carTypeArray)>0)
                                        {{$carTypeArray[$invoice->id]}}
                                    @endif
                                </td>
                                <td>{{$invoice->date}}</td>
                                <td>{{$invoice->total_nett_amt_wo_disc - $invoice->total_disc_amt}}</td>
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