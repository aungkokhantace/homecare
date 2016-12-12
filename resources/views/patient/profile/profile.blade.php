@extends('layouts.master_patient')
@section('title','Profile')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{"Profile"}}</h1>

    {!! Form::open(array('url' => 'patient/profile', 'class'=> 'form-horizontal user-form-border','files' => true, 'id' => 'patientProfileForm')) !!}

    <input type="hidden" name="id" value="{{isset($patient)? $patient->user_id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="staff_id" class="text_bold_black">Patient ID<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" readonly class="form-control" id="patient_id" name="patient_id" placeholder="Enter Staff ID No" value="{{ isset($patient)? $patient->user_id:Request::old('staff_id') }}"/>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Enter Patient Name" maxlength="45" value="{{ isset($patient)? $patient->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="nrc_no" class="text_bold_black">NRC No/Passport</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" autocomplete="off" class="form-control" id="nrc_no" name="nrc_no" placeholder="Enter NRC No/Passport" value="{{ isset($patient)? $patient->nrc_no:Request::old('nrc_no') }}"/>
            <p class="text-danger">{{$errors->first('nrc_no')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="status" class="text_bold_black">Change Password</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="checkbox" name="status" id="status" value="1" @if(Input::old('status')=="1")checked @endif>
        </div>
    </div>
    <br>

    <div class="row password">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="password" class="text_bold_black">Password</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="password" autocomplete="off" class="form-control" id="password" name="password" placeholder="Enter Password" maxlength="45" value="{{ isset($patient)? '':Request::old('password') }}"/>
            <p class="text-danger">{{$errors->first('password')}}</p>
        </div>
    </div>

    <div class="row password">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="conpassword" class="password text_bold_black">Confirm Password<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="password" class="form-control password " id="conpassword" name="conpassword" placeholder="Enter Confirm Password"/>
            <p class="text-danger">{{$errors->first('conpassword')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="email" class="text_bold_black">Email</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" autocomplete="off" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="45" value="{{ isset($patient)? $patient->email:Request::old('email') }}"/>
            <p class="text-danger">{{$errors->first('email')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="dob" class="text_bold_black">DOB</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" autocomplete="off" class="form-control" id="dob" name="dob" placeholder="Enter DOB" value="{{ isset($patient)? $patientDob : Request::old('dob') }}"/>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="gender" class="text_bold_black">Gender</label>
        </div>
        @if(isset($patient))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if($patient->gender == "male")
                    <input type="radio" name="gender" value="male" checked> Male
                @else
                    <input type="radio" name="gender" value="male"> Male
                @endif
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if($patient->gender == "female")
                    <input type="radio" name="gender" value="female" checked> Female
                @else
                    <input type="radio" name="gender" value="female"> Female
                @endif
            </div>
        @else
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="gender" value="male"> Male
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="gender" value="female" checked> Female
            </div>
        @endif
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="phone_no" class="text_bold_black">Phone No<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" autocomplete="off" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone Number" maxlength="45" value="{{ isset($patient)? $patient->phone_no:Request::old('phone_no') }}"/>
            <p class="text-danger">{{$errors->first('phone_no')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="townships" class="text_bold_black">Township<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($patient))
                <select class="form-control" name="townships" id="townships" onchange="check_zone(value)">
                    @foreach($townships as $township)
                        @if($township->id == $patient->township_id)
                            <option value="{{$township->id}}" selected>{{$township->name}}</option>
                        @else
                            <option value="{{$township->id}}">{{$township->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="townships" id="townships" onchange="check_zone(value)">
                    <option value="" selected disabled>Select Township</option>
                    @foreach($townships as $township)
                        <option value="{{$township->id}}">{{$township->name}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('townships')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="having_allergy" class="text_bold_black">Allergies</label>
        </div>
        @if(isset($patient))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if($patient->having_allergy == 1)
                    <input type="radio" name="having_allergy" value="yes" checked> Yes
                @else
                    <input type="radio" name="having_allergy" value="yes"> Yes
                @endif
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if($patient->having_allergy == 0)
                    <input type="radio" name="having_allergy" value="no" checked> No
                @else
                    <input type="radio" name="having_allergy" value="no"> No
                @endif
            </div>
        @else
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="having_allergy" value="yes"> Yes
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="having_allergy" value="no" checked> No
            </div>
        @endif
    </div>
    <br/>

    <div class="row">
        @if((isset($patient)) && ($patient->having_allergy == 1))

            <div class="col-lg-offset-2 col-lg-6 col-md-6 col-sm-6 col-xs-6 allergy_div" style="display:block">
                <select id="allergies" name="allergies[]" multiple="multiple" class="form-control" style="width:307px;">

                    <optgroup label="Food Allergy">
                        @if(isset($patient['allergies']['food']))
                            @foreach($patient['allergies']['food'] as $allergy)
                                @if($allergy->selected == 1)
                                    <option value="{{$allergy->id}}" selected>{{$allergy->name}}</option>
                                @else
                                    <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                                @endif
                            @endforeach
                        @endif

                    </optgroup>
                    <optgroup label="Drug Allergy">

                        @if(isset($patient['allergies']['drug']))
                            @foreach($patient['allergies']['drug'] as $allergy)
                                @if($allergy->selected == 1)
                                    <option value="{{$allergy->id}}" selected>{{$allergy->name}}</option>
                                @else
                                    <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                                @endif
                            @endforeach
                        @endif

                    </optgroup>
                </select>
            </div>
        @else

            <div class="col-lg-offset-2 col-lg-6 col-md-6 col-sm-6 col-xs-6 allergy_div" style="display:none">
                <select id="allergies" name="allergies[]" multiple="multiple" class="form-control" style="width:307px;">

                    <optgroup label="Food Allergy">
                        @if(isset($allergies['food']))
                            @foreach($allergies['food'] as $allergy)
                                <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                            @endforeach
                        @endif

                    </optgroup>
                    <optgroup label="Drug Allergy">

                        @if(isset($allergies['drug']))
                            @foreach($allergies['drug'] as $allergy)
                                <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                            @endforeach
                        @endif
                    </optgroup>


                </select>
            </div>
        @endif
    </div>
    {{--For Allergy error placement--}}
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="beforeAllergyError" style="margin-right: 10px;">
        </div>
    </div>
    {{--For Allergy error placement--}}
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="registration" class="text_bold_black">Registration Date</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label>{{$registrationDate}}</label>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="address" class="text_bold_black">Address<span class="require">*</span></label>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <textarea autocomplete="off" class="form-control" id="address" name="address" placeholder="Enter Detail Address" rows="10" cols="40">{{isset($patient)? $patient->address:Input::old('address')}}</textarea>
            <p class="text-danger">{{$errors->first('address')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-lg-offset-7 col-md-offset-7 col-sm-offset-7 col-xs-offset-7">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($patient)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="reset" value="CANCEL" class="form-control cancel_btn" onclick="cancel_profile();">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {

            $(".password").hide();

            $('input[type=radio][name="having_allergy"]').on('change', function() {
                if($('input[name="having_allergy"]:checked').val()=="yes"){
                    var data = $('input[name="having_allergy"]:checked').val();
                    $('.allergy_div').show();
                    console.log(data);
                }
                else if($('input[name="having_allergy"]:checked').val()=="no"){
                    var data = $('input[name="having_allergy"]:checked').val();
                    $('.allergy_div').hide();
                    console.log(data);
                }
            });

            $(':checkbox').checkboxpicker().change(function() {
                if (document.getElementById('status').checked)
                {
                    $(".password").show();
                } else {
                    $(".password").hide();
                }
            });

            $("#services").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter();

            $("#allergies").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter();

            $('#dob').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
            });

            $('#registration').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
            });

            //Start Validation for Patient Entry and Edit Form
            $('#patientProfileForm').validate({
                rules: {
                    name          : 'required',
                    password      : {
                        required  : true,
                        minlength : 8
                    },
                    conpassword   : {
                        required  : true,
                        minlength : 8,
                        equalTo   : "#password"
                    },
                    townships     : 'required',
                    address       : 'required',
                    phone_no      : 'required',
                    email         : 'email',
                    "allergies[]" : "required",
                },
                messages: {
                    name          : 'Patient Name is required',
                    password      : {
                        required  : "Password is required",
                        minlength : "Password must be at least 8 characters"
                    },
                    conpassword   : {
                        required  : "Confirm Password is required",
                        minlength : "Password must be at least 8 characters",
                        equalTo   : "Password and Confirm Password must match"
                    },
                    townships     : 'Township is required',
                    address       : 'Address is required',
                    phone_no      : 'Phone Number is required',
                    email         : 'Email is not valid',
                    "allergies[]" : "Allergy is required",
                },
                ignore: ':hidden:not("#allergies")', // Tells the validator to check the hidden select
                errorPlacement: function (error, element) { //Positioning Jquery Validation Errors after checkbox value
                    if (element.attr("id") == "allergies") {
                        error.insertAfter($('#beforeAllergyError'));
                    }else {
                        error.insertAfter( element ); // standard behaviour
                    }
                }
            });

            //End Validation for Patient Entry and Edit Form
        });
    </script>
@stop