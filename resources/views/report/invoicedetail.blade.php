@extends('layouts.master')
@section('title','Invoice Detail')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Invoice Detail</h1>

    <br/>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                    <tr>
                        <td height="20" width="20%">Name</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->patient->name}}</td>
                        <td height="20" width="20%">Voucher No.</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->id}}</td>
                    </tr>
                    <tr>
                        <td height="20" width="20%">Age/Sex</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$age}}/{{$patient_gender}}</td>
                        <td height="20" width="20%">Date</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->created_at->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <td height="20" width="20%">Address</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->patient->address}}</td>
                        <td height="20" width="20%">Contact Phone</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->patient->phone_no}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                @if($invoice->type == "package")
                    <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                        <tr bgcolor="#cccccc">
                            <td height="20" width="25%">Item</td>
                            <td height="20" width="25%">Description</td>
                            <td height="20" width="25%">Expiry Date</td>
                            <td height="20" width="25%" align="right">Amount</td>
                        </tr>
                        <tr>
                            <td height="20">1</td>
                            <td height="20">{{$invoice->package->package_name}}</td>
                            <td height="20">{{$expiryDate}}</td>
                            <td height="20" align="right">{{$invoice->package->price}}</td>
                        </tr>
                    </table>

                    <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                        <tr>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                            <td height="20"></td>
                            <td height="20">Total</td>
                            <td height="20" align="right">{{$invoice->total_nett_amt_wo_disc}}</td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                            <td height="20"></td>
                            <td height="20">Discount</td>
                            <td height="20" align="right">{{$invoice->total_disc_amt}}</td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                            <td height="20"></td>
                            <td height="20">Grand Total</td>
                            <td height="20" align="right">{{$invoice->total_payable_amt}}</td>
                        </tr>
                        <tr>
                            <td height="20">Remark</td>
                            @if(isset($invoice->packagesale))
                            <td height="20">{{$invoice->packagesale->remark}}</td>
                            @endif
                        </tr>
                    </table>
                @else
                    <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                        <tr bgcolor="#cccccc">
                            <th height="20" width="10%">Item</th>
                            <th height="20" width="65%">Description</th>
                            <th height="20" width="25%" style="text-align: right;">Amount</th>
                        </tr>
                        <tr>
                            <td height="20">1</td>
                            <td height="20">Service Charges</td>
                            <td height="20" align="right">{{$invoice->total_service_amount}}</td>
                        </tr>
                        <tr>
                            <td height="20">2</td>
                            <td height="20">Consulation Fees</td>
                            <td height="20" align="right">{{$invoice->total_consultant_fee}}</td>
                        </tr>
                        <tr>
                            <td height="20">3</td>
                            <td height="20">Medications
                                <table class="table">
                                    @foreach($medicationArray as $medication)
                                        <tr>
                                            <td>{{$medication['name']}}</td>
                                            <td>{{$medication['qty']}}</td>
                                            <td align="right">{{$medication['price']}}</td>
                                            <td align="right">{{$medication['amount']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td height="20" align="right">{{$invoice->total_medication_amount}}</td>
                        </tr>
                        <tr>
                            <td height="20">4</td>
                            <td height="20">Investigation Charges
                                <table class="table">
                                    @foreach($investigationArray as $investigation)
                                        <tr>
                                            <td>{{$investigation['name']}}</td>
                                            <td align="right">{{$investigation['price']}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td height="20" align="right">{{$invoice->total_investigation_amount}}</td>
                        </tr>
                        <tr>
                            <td height="20">5</td>
                            <td height="20">Transportation Charges</td>
                            <td height="20" align="right">{{$invoice->total_car_amount}}</td>
                        </tr>
                        <tr>
                            <td height="20">6</td>
                            <td height="20">Others</td>
                            <td height="20" align="right">{{$invoice->total_other_service_amount}}</td>
                        </tr>
                        <tr>
                            <td height="20">7</td>
                            <td height="20"></td>
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td height="20">8</td>
                            <td height="20"></td>
                            <td height="20"></td>
                        </tr>
                    </table>

                    <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                        <tr>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="25%"></td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                            <td height="20"></td>
                            <td height="20">Total</td>
                            <td height="20" align="right">{{$invoice->total_nett_amt_wo_disc}}</td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                            <td height="20"></td>
                            <td height="20">Discount</td>
                            <td height="20" align="right">{{$invoice->total_disc_amt}}</td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                            <td height="20"></td>
                            <td height="20">Grand Total</td>
                            <td height="20" align="right">{{$invoice->total_payable_amt}}</td>
                        </tr>
                        <tr>
                            <td>Remark</td>
                            <td colspan="3">{{$invoice->status}}</td>
                        </tr>
                    </table>
                @endif
            </div>
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
                <table class="table table-striped list-table" id="list-table" style="word-wrap: break-word; table-layout: fixed;">
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
                        @if($invoiceDetail->type != "")
                        <tr>
                            <td>{{$invoiceDetail->type}}</td>
                            <td>{{$invoiceDetail->product_qty}}</td>
                            <td>{{$invoiceDetail->product_price}}</td>
                            <td>{{$invoiceDetail->consultant_discount_amount}}</td>
                            <td>{{$invoiceDetail->product_amount}}</td>
                        </tr>
                        @endif
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
            <a target="_blank" href="/salesummaryreport/invoice_export/{{$invoice->id}}"><button class="form-control btn btn-primary">Print</button></a>
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