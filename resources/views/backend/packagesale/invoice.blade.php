@extends('layouts.master')
@section('title','Package Invoice')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{"Package Invoice"}}</h1>
    <br/>

    <div class="row">

        <div class="panel panel-default">
            <input type="hidden" name="patient_id" id="patient_id" value="{{isset($patient)? $patient->user_id:''}}"/>
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Patient Package Invoice</strong></h3>
            </div>
            <div class="panel-body">

                <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                    <tr>
                        <td height="20" width="20%">Name / Reg No.</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->patient->name}} / {{$invoice->patient->user_id}}</td>
                        <td height="20" width="20%">Voucher No.</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->id}}</td>
                    </tr>
                    <tr>
                        <td height="20" width="20%">DOB(Age) / Sex</td>
                        <td height="20" width="5%">-</td>
                        <td height="20" width="25%">{{$invoice->patient->dob}}({{$age['value']." ".$age['unit']}}) / {{$patient_gender}}</td>
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

                <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                    <tr>
                        <td width="25%">Coupon Code</td>
                        <td width="75%">{{$couponCode}}</td>
                    </tr>
                </table>

                <table class="table" style="word-wrap: break-word; table-layout: fixed;">
                    <tr bgcolor="#cccccc">
                        <td height="20" width="25%">Item</td>
                        <td height="20" width="25%">Description</td>
                        <td height="20" width="25%">Expiry Date</td>
                        <td height="20" width="25%">Amount</td>
                    </tr>
                    <tr>
                        <td height="20">1</td>
                        <td height="20">{{$package->package_name}}</td>
                        <td height="20">{{$expiryDate}}</td>
                        <td height="20">{{number_format($package->price,2)}}</td>
                    </tr>
                    <tr>
                        <td height="20">2</td>
                        <td height="20">Transportation Price</td>
                        <td height="20">-</td>
                        <td height="20">{{number_format($invoice->total_car_amount,2)}}</td>
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
                        <td height="20">Remark</td>
                        <td height="20">{{$invoice->packagesale->remark}}</td>
                        <td height="20">Total</td>
                        <td height="20">{{number_format($invoice->total_nett_amt_wo_disc,2)}}</td>
                        <!-- <td height="20">{{$package->price + $invoice->total_car_amount}}</td> -->
                    </tr>
                    <tr>
                        <td height="20"></td>
                        <td height="20"></td>
                        <td height="20">Discount</td>
                        <td height="20">{{number_format($invoice->total_disc_amt,2)}}</td>
                    </tr>
                    <tr>
                        <td height="20"></td>
                        <td height="20"></td>
                        <td height="20">Tax Amount</td>
                        <td height="20">{{number_format($invoice->total_tax_amt,2)}}</td>
                    </tr>
                    <tr>
                        <td height="20"></td>
                        <td height="20"></td>
                        <td height="20">Grand Total</td>
                        <td height="20">{{number_format($invoice->total_payable_amt,2)}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <br/>
    {{--start new row--}}
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <a href="/packagesale"><input type="button" value="GO TO PACKAGE USAGE LIST" class="form-control btn-primary" style="padding:0px;"></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <a href={{"/packagesale/schedule/".$invoice->patient_package_id}}> <input type="button" value="GO TO PACKAGE SCHEDULE MANAGEMENT" class="form-control btn-primary" style="padding:0px;"></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <a target="_blank" href={{"/packagesale/export/".$invoice->patient_package_id.'/'.$couponCode}}><button class="form-control btn-primary" style="padding:0px;">EXPORT INVOICE</button></a>
        </div>

    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#services").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter();
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

                /*    document.getElementById('gender').innerHTML = response['gender'];
                 document.getElementById('patient_type').innerHTML = response['type'];
                 document.getElementById('phone').innerHTML = response['phone'];
                 document.getElementById('address').innerHTML = response['address'];  */
                $data=response;
            });
        }

    </script>
@stop
