@extends('layouts.master')
@section('title','Package')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($package) ?  'Package Edit' : 'Package Entry' }}</h1>

    @if(isset($package))
        {!! Form::open(array('url' => 'package/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'packageForm')) !!}

    @else
        {!! Form::open(array('url' => 'package/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'packageForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($package)? $package->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Package Name" value="{{ isset($package)? $package->package_name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="services" class="text_bold_black">Service<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            @if(isset($package))
                <!-- <select id="services" name="services[]" multiple="multiple" class="form-control">
                    @foreach($package['services'] as $service)
                        @if($service->selected == 1)
                            <option value="{{$service->id}}" selected>{{$service->name}}</option>
                        @else
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endif
                    @endforeach
                </select> -->
                <select id="services" name="services[]" class="form-control">
                    @foreach($package['services'] as $service)
                        @if($service->selected == 1)
                            <option value="{{$service->id}}" selected>{{$service->name}}</option>
                        @else
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <!-- <select id="services" name="services[]" multiple="multiple" class="form-control">
                    @foreach($services as $service)
                        <option value="{{$service->id}}">{{$service->name}}</option>
                    @endforeach
                </select> -->
                <select id="services" name="services[]" class="form-control">
                    @foreach($services as $service)
                        <option value="{{$service->id}}">{{$service->name}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('services')}}</p>
        </div>
    </div>

    {{--For Services error placement--}}
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="beforeServiceError" style="margin-right: 10px;">
        </div>
    </div>
    {{--For Services error placement--}}
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="price" class="text_bold_black">Price<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Package Price" value="{{isset($package)? $package->price:Request::old('price') }}"/>
            <p class="text-danger">{{$errors->first('price')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="schedule_no" class="text_bold_black">No of Schedule<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="schedule_no" name="schedule_no" placeholder="Enter No of Schedule" value="{{ isset($package)? $package->schedule_no:Request::old('schedule_no') }}"/>
            <p class="text-danger">{{$errors->first('schedule_no')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="expiry_date" class="text_bold_black">Expiry Date<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="Enter Expiry Date" value="{{ isset($package)? $package->expiry_date:Request::old('expiry_date') }}"/>
            <p class="text-danger">{{$errors->first('expiry_date')}}</p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="expiry_date">By Months</label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="inclusive_transport_charge" class="text_bold_black">Inclusive Transport Charge</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($package))
                <input type="checkbox" name="inclusive_transport_charge" value="1" @if($package->inclusive_transport_charge == 1)checked @endif>
            @else
                <input type="checkbox" name="inclusive_transport_charge" value="1" @if(Input::old('inclusive_transport_charge')=="1")checked @endif>
            @endif
            <p class="text-danger">{{$errors->first('expiry_date')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Package Description" rows="5" cols="50">{{isset($package)? $package->description:Input::old('description')}}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($package)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('package')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            // $("#services").multiselect({
            //     show: ["bounce", 100],
            //     hide: ["explode", 600]
            // }).multiselectfilter().on('change',function(){
            //     $('#packageForm').valid();
            // });

            $(':checkbox').checkboxpicker();

            //Start Validation for Package Entry and Edit Form
            $('#packageForm').validate({
                rules: {
                    name          : 'required',
                    'services[]' : 'required',
                    price         : {
                        required  : true,
                        number    : true
                    },
                    schedule_no   : {
                        required  : true,
                        number    : true
                    },
                    expiry_date   : {
                        required  : true,
                        number    : true
                    }
                },
                messages: {
                    name          : 'Package Name is required',
                    'services[]'  : 'Services are required',
                    price         : {
                        required  : 'Price is required',
                        number    : 'Price must be numeric'
                    },
                    schedule_no   : {
                        required  : 'Schedule No is required',
                        number    : 'Schedule No must be numeric'
                    },
                    expiry_date   : {
                        required  : 'Expiry Date is required',
                        number    : 'Expiry Date must be numeric'
                    }
                },
                ignore: ':hidden:not("#services")', // Tells the validator to check the hidden select
                errorPlacement: function (error, element) { //Positioning Jquery Validation Errors after checkbox value
                    if (element.attr("id") == "services") {
                        error.insertAfter($('#beforeServiceError'));
                    }else {
                        error.insertAfter( element ); // standard behaviour
                    }
                },
                submitHandler: function(form) {
                $('input[type="submit"]').attr('disabled','disabled');
                form.submit();
            }
            });
            //End Validation for Package Entry and Edit Form
        });
    </script>
@stop
