@extends('layouts.master_patient')
@section('title','Booking Request')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Booking Request</h1>

    {!! Form::open(array('url' => 'patient/bookingrequest/store', 'id'=> 'frm_schedule_cancel', 'class'=> 'form-horizontal user-form-border')) !!}

    {{ csrf_field() }}

    <br/>

    <input type="hidden" name="user_id" value="{{isset($patient)? $patient->user_id:''}}"/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="patient_name" class="text_bold_black">Patient Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="patient_name" name="patient_name" placeholder="Enter Patient Name" value="{{$patient->name}}"/>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="div_lbl_staff_id">
            <label for="lbl_staff_id" class="text_bold_black">Patient Registration No.</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="div_staff_id">
            <input type="text" readonly class="form-control" id="lbl_staff_id" name="lbl_staff_id" placeholder="Enter Staff Id" value="{{$patient->user_id}}"/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="patient_type" class="text_bold_black">Patient Type<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="patient_type" name="patient_type" placeholder="Enter Patient Type" value="{{$patientType}}"/>
            <br/>
            <input type="hidden" id="patient_type_id" name="patient_type_id" value="{{isset($patient)? $patient->patient_type_id:''}}"/>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="gender" class="text_bold_black">Gender<span class="require">*</span></label>
        </div>

        @if(isset($patient))
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                @if(isset($patient) && $patient->gender == 'male')
                    <label for="gender">Male</label>
                @else
                    <label for="gender">Female</label>
                @endif
                <input type="hidden" id="gender" name="gender" value="{{isset($patient)? $patient->gender:''}}"/>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="nrc_no" class="text_bold_black">NRC No. / Passport No.</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="nrc_no" name="nrc_no" placeholder="Enter Nrc No" value="{{$patient->nrc_no}}"/>
            <p class="text-danger">{{$errors->first('nrc_number')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="having_allergy" class="text_bold_black">Allergies</label>
        </div>

        @if(isset($patient))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if(isset($patient) && $patient->having_allergy == 1)
                    <label>Yes</label>
                @else
                    <label>No</label>
                @endif
                <input type="hidden" name="having_allergy" value="{{isset($patient)? $patient->having_allergy:0}}"/>
            </div>

        @endif
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="current_using_package" class="text_bold_black">Current Using Package</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div id="packages" name="packages">
                @foreach($packageNamesArray as $package)
                    <label>{{$package}}</label><br/>
                @endforeach
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <input type="hidden" class="form-control">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 allergies_div">
            @if(isset($patient)&& ($patient->having_allergy == 1))
                @foreach($patient['allergies']['food'] as $allergy)
                    @if($allergy->selected == 1)
                        <label for="allergy">{{$allergy->name}}<br /></label>
                    @else
                        <?php continue; ?>
                    @endif
                @endforeach
                <br/>
                @foreach($patient['allergies']['drug'] as $allergy)
                    @if($allergy->selected == 1)
                        <label for="allergy">{{$allergy->name}}<br /></label>
                    @else
                        <?php continue; ?>
                    @endif
                @endforeach
            @endif

        </div>
    </div>
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="phone_no" class="text_bold_black">Phone Number<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone Number" value="{{$patient->phone_no}}"/>
            <p class="text-danger">{{$errors->first('phone_no')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="dob" class="text_bold_black">Date of Birth<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="input-group date dateTimePicker" data-provide="datepicker">
                <input readonly autocomplete="off" type="text" class="form-control" id="dob" name="dob" value="{{$patientDob}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('dob')}}</p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="car_type" class="text_bold_black">Car Type<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="radio" name="car_type" value="1" checked> Patient Owned Vehicle
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="township" class="text_bold_black">Township<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly autocomplete="off" type="text" class="form-control" id="township" name="township" value="{{$patient->township->name}}">
            <input type="hidden" id="township_id" name="township_id" value="{{isset($patient)? $patient->township_id:''}}"/>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="radio" name="car_type" value="2"> Rental Owned Vehicle
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="zone" class="text_bold_black">Zone<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($patient) && $patient->zone_id != 0)
                <input type="text" class="form-control" id="zone" name="zone" value="{{$patient->zone->name}}" readonly/>
            @elseif(isset($patient) && $patient->zone_id == 0)
                <input type="text" class="form-control" id="zone" name="zone" value="" readonly/>
            @else
                <input type="text" class="form-control" id="zone" name="zone" value="{{ Request::old('zone') }}" readonly/>
            @endif
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="radio" name="car_type" value="3"> HHCS Vehicle
            <p class="text-danger">{{$errors->first('car_type')}}</p><br/>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="patient_address" class="text_bold_black">Detail Address<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea readonly class="form-control" id="patient_address" name="patient_address" placeholder="Enter Detail Address" rows="10" cols="40">{{$patient->address}}</textarea>
            <p class="text-danger">{{$errors->first('address')}}</p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" name="car_type_id" id="car_type_id">
                @foreach($carTypes as $key => $carType)
                    <option value="{{$key}}">{{$carType}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="services" class="text_bold_black">Services</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select id="services" name="services[]" multiple="multiple" class="form-control">
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}}</option>
                @endforeach
            </select>
            <p class="text-danger">{{$errors->first('services')}}</p>
        </div>
    </div>
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="date" class="text_bold_black">Date<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="input-group date dateTimePicker" data-provide="datepicker">
                <input required autocomplete="off"  type="text" class="form-control" id="date" name="date"  value="{{Request::old('date')}}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('date')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="time" class="text_bold_black">Time</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="input-group bootstrap-timepicker timepicker">
                <input id="time" name="time" type="text" class="form-control input-small"  value="{{Request::old('time')}}">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            </div>
            <p class="text-danger">{{$errors->first('time')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="remark" class="text_bold_black">Remark</label>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <textarea class="form-control" id="remark" name="remark" placeholder="Enter Remark" rows="7" cols="40">{{Input::old('remark')}}</textarea>
            <p class="text-danger">{{$errors->first('remark')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            {{--<input type="button" name="submit" value="SUBMIT" onclick="booking_request_confirm();" class="form-control btn-primary">--}}

            {{--<form id="frm_schedule_cancel" method="post" action="patient/bookingrequest/store">--}}
            {{ csrf_field() }}

            <button type="button"  class="btn btn-primary" id="confirm_button">
                CONFIRM
            </button>
            {{--</form>--}}
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('enquiry')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            var havingAllergy = $("input[name=having_allergy]:checked").val();
            if(havingAllergy == 0){
                $('.allergies_div').hide();
            }

            var car_type = $("input[name=car_type]:checked").val();
            if(car_type != 3){
                $('#car_type_id').hide();
            }


            $("#services").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter();

            $("#allergies").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter();

            $('#time').timepicker();

            $('.dateTimePicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true
            });

            $(".dateTimePicker").keypress(function(event) {event.preventDefault();});

            // Having Allergy Radio Button
            $('input[type=radio][name=having_allergy]').change(function() {

                if (this.value == 1) {
                    $('.allergies_div').show();
                }
                if (this.value == 0) {
                    $('.allergies_div').hide();
                }
            });

            // Car Type Radio Button
            $('input[type=radio][name=car_type]').change(function() {

                if (this.value == 1) {
                    $('#car_type_id').hide();
                }
                if (this.value == 2) {
                    $('#car_type_id').hide();
                }
                if (this.value == 3) {
                    $('#car_type_id').show();
                }
            });

            //Start Validation for Booking Request Form
            $('#frm_schedule_cancel').validate({
                rules: {
                    "date"         : "required",
                    "time"         : "required"
                },
                messages: {
                    "date"         : "Date is required",
                    "time"         : "Time is required"
                }
            });
            $("#confirm_button").click(function(){  // capture the click
                if($("#frm_schedule_cancel").valid()){ //if form is valid, continue to booking_request_confirm
                    booking_request_confirm();
                }
            });
            //End Validation for Booking Request Form
        });

        function check_zone(value)
        {
            console.log(value);
            $id=value;
            // Add loading state
            $('#zone').val('Loading please wait ...');

            // Set request
            var request = $.get('/patient/checkzone/'+$id);

            // When it's done
            request.done(function(response) {
                if ($.isEmptyObject(response)) {
                    $('#zone').val(null);
                }
                else{
                    $('#zone').val(response);
                }

                $data=response;
            });
        }
    </script>
@stop