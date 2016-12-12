@extends('layouts.master_patient')
@section('title','Invoice Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Invoice Detail</h1>

    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="invoice_id">Invoice ID</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->id}}</label>
        </div>

        <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <a href="/patient/invoice"><input type="button" class="btn btn-primary" name="back_to_invoice" value="Back to Invoice" style="width: 100%"></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="date">Date</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->date}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="schedule_id">Schedule ID</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->schedule_id}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="schedule_start_time">Schedule Start Time</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->schedule_start_time}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="schedule_end_time">Schedule End Time</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->schedule_end_time}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="patient_id">Patient ID</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->patient->staff_id}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="patient_name">Patient Name</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->patient->name}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="address">Patient Address</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->patient->address}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="township">Township</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->patient->township->name}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="zone">Zone</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->patient->zone->name}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="total_amount">Total Amount</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->total_nett_amt_wo_disc}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="discount_amount">Discount Amount</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$invoice->total_disc_amt}}</label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="grand_total_amount">Grand Total Amount</label>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label>:</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$grandTotalAmount}}</label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr style="margin-bottom: 0px;">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount Amount</th>
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="type">Type</th>
                        <th class="search-col" con-id="qty">Qty</th>
                        <th class="search-col" con-id="price">Price</th>
                        <th class="search-col" con-id="discount_amount">Discount Amount</th>
                        <th class="search-col" con-id="total_amount">Total Amount</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($invoiceDetails as $invoiceDetail)
                        <tr>
                            <td>{{$invoiceDetail->type}}</td>
                            <td>{{$invoiceDetail->product_qty}}</td>
                            <td>{{$invoiceDetail->product_price}}</td>
                            <td>{{$invoiceDetail->consultant_discount_amount}}</td>
                            <td>{{$invoiceDetail->product_amount}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <a target="_blank" href="/patient/invoice_export/{{$invoice->id}}"><button class="form-control btn btn-primary">Print</button></a>
        </div>
    </div>

</div>
@stop

@section('page_script')
    <script type="text/javascript">
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

        function autofill(value)
        {
            console.log(value);
            $id=value;
            // Add loading state
            $('#gender').val('Loading please wait ...');
            $('#patient_type').val('Loading please wait ...');
            $('#phone').val('Loading please wait ...');
            $('#address').val('Loading please wait ...');

            // Set request
            var request = $.get('/packagesale/autofill/'+$id);

            // When it's done
            request.done(function(response) {
                $('#gender').val(response['gender']);
                $('#gender_id').val(response['gender_id']);
                $('#patient_type').val(response['type']);
                $('#type_id').val(response['type_id']);
                $('#phone').val(response['phone']);
                $('#address').val(response['address']);
                $data=response;
            });
        }

    </script>
@stop