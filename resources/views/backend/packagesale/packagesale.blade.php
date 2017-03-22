@extends('layouts.master')
@section('title','Package Sale')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{"Package Sale Entry"}}</h1>

        {!! Form::open(array('url' => 'packagesale/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'packageSaleForm')) !!}
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Patient Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select class="form-control" name="name" id="name" onchange="autofill(value)">
                    <option value="" selected disabled>Select Patient Name</option>
                    @foreach($patients as $patient)
                        <option value="{{$patient->user_id}}">{{$patient->name}}</option>
                    @endforeach
                </select>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="gender" class="text_bold_black">Patient Gender</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="gender" name="gender" placeholder="Enter Patient Gender" value="{{Request::old('gender')}}"/>
            {{--<label id="gender">Patient Gender</label>--}}
            <input type="hidden" name="gender_id" id="gender_id" value="">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="patient_type" class="text_bold_black">Patient Type</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="patient_type" name="patient_type" placeholder="Enter Patient Type" value="{{Request::old('patient_type')}}"/>
            {{--<label id="patient_type">Patient Type</label>--}}
            <input type="hidden" name="type_id" id="type_id" value="">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="phone" class="text_bold_black">Patient Phone</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="phone" name="phone" placeholder="Enter Patient Phone" value="{{Request::old('phone')}}"/>
            {{--<label id="phone">Patient Phone</label>--}}
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="address" class="text_bold_black">Patient Address</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-4">
            <textarea readonly autocomplete="off" class="form-control" id="address" name="address" placeholder="Enter Patient Address" rows="4" cols="40">{{Input::old('address')}}</textarea>
            {{--<label id="address">Patient Address</label>--}}
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="package" class="text_bold_black">Package<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" name="package" id="package" onchange="getOriginalPrice(value);">
                <option value="" selected disabled>Select Package</option>
                @foreach($packages as $package)
                    <option value="{{$package->id}}">{{$package->package_name}}</option>
                @endforeach
            </select>
            <p class="text-danger">{{$errors->first('package')}}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="have_discount_coupon" class="text_bold_black">Have Discount Coupon</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" name="have_discount_coupon" id="have_discount_coupon" onchange="showHideCouponCode(value)">
                {{--<option value="" selected disabled>Select Patient Name</option>--}}
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
            <p class="text-danger">{{$errors->first('have_discount_coupon')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="coupon_code" class="text_bold_black coupon_code">Coupon Code</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control coupon_code" id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code" value="{{Request::old('coupon_code')}}"/>
            <p class="text-danger coupon_code">{{$errors->first('coupon_code')}}</p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <button type="button" class="btn btn-primary coupon_code" onclick="checkCouponCode();">Check Coupon Code</button>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <span class="glyphicon glyphicon-ok" id="valid-sign"></span>
            <span class="glyphicon glyphicon-remove" id="invalid-sign"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="remark" class="text_bold_black">Remark</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="remark" name="remark" placeholder="Enter Remark" rows="5" cols="50">{{Input::old('remark')}}</textarea>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="original_price" class="text_bold_black">Original Price</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="original_price" name="original_price" placeholder="Original Price" value="{{Request::old('original_price')}}"/>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="discount_amount" class="text_bold_black">Discount Amount</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="discount_amount" name="discount_amount" placeholder="Discount Amount" value="{{Request::old('discount_amount')}}"/>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="total_payable_amount" class="text_bold_black">Total Payable Amount</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="total_payable_amount" name="total_payable_amount" placeholder="Total Payable Amount" value="{{Request::old('total_payable_amount')}}"/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="CREATE" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('packagesale')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
//            $('.coupon_code').hide();

            $("#services").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter();

            //Start Validation for Package Sale Entry Form
            $('#packageSaleForm').validate({
                rules: {
                    name     : 'required',
                    package  : 'required',
                    coupon_code  : 'required',
                },
                messages: {
                    name     : 'Patient Name is required',
                    package  : 'Package is required',
                    coupon_code  : 'Coupon Code is required',
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Package Sale Entry Form
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

        function showHideCouponCode(value){
            if(value == "yes"){
                $('.coupon_code').show();
            }
            else{
                $('#valid-sign').hide();
                $('#invalid-sign').hide();
                $('.coupon_code').hide();
            }
        }

        function checkCouponCode()
        {
            code = $('#coupon_code').val();
            package = $('#package').val();

            original_price = $('#original_price').val();

            if(package == null){
                sweetAlert("Oops...", "Please Choose the Package !");
            }
            else if(code == ""){
                sweetAlert("Oops...", "Please Enter the Coupon Code !");
            }
            else{
                // Set request
                var request = $.get('/packagesale/checkcouponcode/'+package+'/'+code);

                // When it's done
                request.done(function(response) {
                    console.log(response);
                    if(response == false){
                        $('#valid-sign').hide();
                        $('#invalid-sign').show();
                        sweetAlert("Oops...", "Coupon Code is invalid !");
                    }
                    else{
                        $('#invalid-sign').hide();
                        $('#valid-sign').show();
                        discount_amount = original_price-response;
                        $('#discount_amount').val(discount_amount.toFixed(2));
                        $('#total_payable_amount').val(response);
                    }
                });
            }
        }

        function getOriginalPrice(value){
            // Set request
            var request = $.get('/packagesale/getoriginalprice/'+value);

            // When it's done
            request.done(function(response) {
                $('#valid-sign').hide();
                $('#invalid-sign').hide();
                $('#coupon_code').val("");
                $('#original_price').val(response);
                $('#discount_amount').val(0.00.toFixed(2));
                $('#total_payable_amount').val(response);
            });
        }
    </script>
@stop