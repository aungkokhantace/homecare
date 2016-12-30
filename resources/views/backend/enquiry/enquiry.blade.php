@extends('layouts.master')
@section('title','Enquiry')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($enquiry) ?  'Enquiry Edit' : 'Enquiry Entry' }}</h1>

    @if(isset($enquiry))
        {!! Form::open(array('url' => 'enquiry/update', 'class'=> 'form-horizontal user-form-border', 'id'=>'enquiryEntryForm')) !!}

    @else
        {!! Form::open(array('url' => 'enquiry/store', 'class'=> 'form-horizontal user-form-border', 'id'=>'enquiryEntryForm')) !!}
    @endif
    <input type="hidden" id="id" name="id" value="{{isset($enquiry)? $enquiry_id:''}}"/>
    <input type="hidden" id="patient_id" name="patient_id" value="{{isset($enquiry)? $enquiry->patient_id:''}}"/>
    <input type="hidden" name="is_new_patient" id="is_new_patient" value="{{isset($enquiry)? $enquiry->is_new_patient:'1'}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Enquiry Name" value="{{ isset
($enquiry)? $enquiry->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="div_lbl_staff_id">
            <label id="lbl_staff_id" name="lbl_staff_id" class="text_bold_black">Patient Registration No.</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="div_staff_id">
            <label id="staff_id" name="staff_id" class="text_bold_black">
                @if(isset($enquiry))
                    {{$enquiry->patient_id}}
                @endif
            </label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="discount" class="text_bold_black">Nationality<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                <select class="form-control" name="patient_type_id" id="patient_type_id">
                    @foreach($patientTypes as $key => $patientType)
                        @if($key == $enquiry->patient_type_id)
                            <option value="{{$key}}" selected>{{$patientType}}</option>
                        @else
                            <option value="{{$key}}">{{$patientType}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="patient_type_id" id="patient_type_id">
                    @foreach($patientTypes as $key => $patientType)
                        <option value="{{$key}}">{{$patientType}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('patient_type_id')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="gender" class="text_bold_black">Gender<span class="require">*</span></label>
        </div>

        @if(isset($enquiry))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if(isset($enquiry) && $enquiry->gender == 'male')
                    <input type="radio" name="gender" id="gender_male" value="male" checked> Male
                @else
                    <input type="radio" name="gender" id="gender_male" value="male"> Male
                @endif
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if(isset($enquiry) && $enquiry->gender == 'female')
                    <input type="radio" name="gender" id="gender_female"  value="female" checked> Female
                @else
                    <input type="radio" name="gender" id="gender_female"  value="female"> Female
                @endif
            </div>
        @endif

        @if(!isset($enquiry))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="gender" id="gender_male" value="male" checked> Male
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="gender" id="gender_female"  value="female"> Female
            </div>
        @endif

    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="nrc_no" class="text_bold_black">NRC No. / Passport No.</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="nrc_no" name="nrc_no" placeholder="Enter Nrc No" value="{{ isset($enquiry)?
    $enquiry->nrc_no:Request::old('nrc_no') }}"/>
            <p class="text-danger">{{$errors->first('nrc_no')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="having_allergy" class="text_bold_black">Allergies</label>
        </div>

        @if(isset($enquiry))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if(isset($enquiry) && $enquiry->having_allergy == 1)
                    <input type="radio" name="having_allergy" value="1" id="having_allergy_yes" checked> Yes
                @else
                    <input type="radio" name="having_allergy" id="having_allergy_yes" value="1"> Yes
                @endif
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if(isset($enquiry) && $enquiry->having_allergy == 0)
                    <input type="radio" name="having_allergy" value="0" id="having_allergy_no" checked> No
                @else
                    <input type="radio" name="having_allergy" value="0" id="having_allergy_no"> No
                @endif
            </div>
        @endif

        @if(!isset($enquiry))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="having_allergy" value="1" id="having_allergy_yes" checked> Yes
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="having_allergy" value="0" id="having_allergy_no"> No
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="current_using_package" class="text_bold_black">Current Using Package</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div id="packages" name="packages"></div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <input type="hidden" class="form-control">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 allergies_div">
            @if(isset($enquiry))
                <select id="allergies" name="allergies[]" multiple="multiple" class="form-control">

                    <optgroup label="Food Allergy" class="text_bold_black">
                        @if(isset($enquiry['allergies']['food']))
                            @foreach($enquiry['allergies']['food'] as $allergy)
                                @if($allergy->selected == 1)
                                    <option value="{{$allergy->id}}" selected>{{$allergy->name}}</option>
                                @else
                                    <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                                @endif
                            @endforeach
                        @endif
                    </optgroup>

                    <optgroup label="Drug Allergy" class="text_bold_black">
                        @if(isset($enquiry['allergies']['drug']))
                            @foreach($enquiry['allergies']['drug'] as $allergy)
                                @if($allergy->selected == 1)
                                    <option value="{{$allergy->id}}" selected>{{$allergy->name}}</option>
                                @else
                                    <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                                @endif
                            @endforeach
                        @endif
                    </optgroup>

                </select>
            @else
                <select id="allergies" name="allergies[]" multiple="multiple" class="form-control">

                    <optgroup label="Food Allergy" class="text_bold_black">
                        @if(isset($allergies['food']))
                            @foreach($allergies['food'] as $allergy)
                                <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                            @endforeach
                        @endif

                    </optgroup>
                    <optgroup label="Drug Allergy" class="text_bold_black">

                        @if(isset($allergies['drug']))
                            @foreach($allergies['drug'] as $allergy)
                                <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                            @endforeach
                        @endif
                    </optgroup>

                </select>
            @endif
        </div>

    </div>
    {{--For Allergy error placement--}}
    <div class="row">
        <div class="col-lg-offset-6 col-lg-2 col-md-2 col-sm-2 col-xs-2" id="beforeAllergyError" style="margin-right: 10px;">
        </div>
    </div>
    {{--For Allergy error placement--}}
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="phone_no" class="text_bold_black">Phone Number<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input required type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone No" value="{{ isset
        ($enquiry)? $enquiry->phone_no:Request::old('phone_no') }}"/>
            <p class="text-danger">{{$errors->first('phone_no')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="phone_no" class="text_bold_black">Transportations</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                @if($enquiry->car_type == 1)
                    <input type="radio" name="car_type" value="1" checked> Patient Owned Vehicle
                @else
                    <input type="radio" name="car_type" value="1"> Patient Owned Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="1" checked> Patient Owned Vehicle
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="dob" class="text_bold_black">Date of Birth<span class="require">*</span></label>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="input-group date pastDates" data-provide="datepicker">
                <input required autocomplete="off" type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="{{ isset($enquiry)? $enquiry->dob:Request::old('dob') }}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('dob')}}</p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <input required type="number" max="150" class="form-control" id="age" name="age" placeholder="Age" value="{{ isset($enquiry)? $age['value']:Request::old('age') }}"/>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <label id="unit" name="unit" style="margin-top: 8px;">
                    @if(isset($enquiry))
                        {{$age['unit']}}
                    @endif
                </label>
            </div>
            <p class="text-danger">{{$errors->first('dob')}}</p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                @if($enquiry->car_type == 2)
                    <input type="radio" name="car_type" value="2" checked> Rental Vehicle
                @else
                    <input type="radio" name="car_type" value="2"> Rental Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="2"> Rental Vehicle
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            {{--<label for="age" class="text_bold_black">Age</label>--}}
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            {{--<label class="text_big_blue" id="age" name="age">--}}
                {{--@if(isset($enquiry))--}}
                    {{--{{$age}}--}}
                {{--@endif--}}
            {{--</label>--}}
            {{--<input required type="text" class="form-control" id="age" name="age" placeholder="Enter Age" value="{{ isset($enquiry)? $age:Request::old('age') }}"/>--}}
            {{--<p class="text-danger">{{$errors->first('age')}}</p>--}}
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            {{--@if(isset($enquiry))--}}
                {{--@if($enquiry->car_type == 3)--}}
                    {{--<input type="radio" name="car_type" value="3" checked> HHCS Vehicle--}}
                {{--@else--}}
                    {{--<input type="radio" name="car_type" value="3"> HHCS Vehicle--}}
                {{--@endif--}}
            {{--@else--}}
                {{--<input type="radio" name="car_type" value="3"> HHCS Vehicle--}}
            {{--@endif--}}
            {{--<p class="text-danger">{{$errors->first('car_type')}}</p><br/>--}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="services" class="text_bold_black">Services</label>
        </div>

        {{--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">--}}
        {{--@if(isset($enquiry))--}}
        {{--<select id="services" name="services[]" multiple="multiple" class="form-control">--}}
        {{--@foreach($enquiry['services'] as $service)--}}
        {{--@if($service->selected == 1)--}}
        {{--<option value="{{$service->id}}" selected>{{$service->name}}</option>--}}
        {{--@else--}}
        {{--<option value="{{$service->id}}">{{$service->name}}</option>--}}
        {{--@endif--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--@else--}}
        {{--<select id="services" name="services[]" multiple="multiple" class="form-control">--}}
        {{--@foreach($services as $service)--}}
        {{--<option value="{{$service->id}}">{{$service->name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--@endif--}}
        {{--</div>--}}

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                <select id="services" name="services[]" class="form-control">
                    @foreach($enquiry['services'] as $service)
                        @if($service->selected == 1)
                            <option value="{{$service->id}}" selected>{{$service->name}}</option>
                        @else
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select id="services" name="services[]" class="form-control">
                    @foreach($services as $service)
                        <option value="{{$service->id}}">{{$service->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-2 col-md-2 col-sm-2 col-xs-2">
            @if(isset($enquiry))
                @if($enquiry->car_type == 3)
                    <input type="radio" name="car_type" value="3" checked> HHCS Vehicle
                @else
                    <input type="radio" name="car_type" value="3"> HHCS Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="3"> HHCS Vehicle
            @endif
            <p class="text-danger">{{$errors->first('car_type')}}</p><br/>
        </div>

        <div class="col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-xs-offset-8 col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                <select class="form-control" name="car_type_id" id="car_type_id">
                    @foreach($carTypes as $key => $carType)
                        @if($key == $enquiry->car_type_id)
                            <option value="{{$key}}" selected>{{$carType}}</option>
                        @else
                            <option value="{{$key}}">{{$carType}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="car_type_id" id="car_type_id">
                    @foreach($carTypes as $key => $carType)
                        <option value="{{$key}}">{{$carType}}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="township_id" class="text_bold_black">Township<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                <select class="form-control" name="township_id" id="township_id">
                    @foreach($townships as $township)
                        @if($township->id == $enquiry->township_id)
                            <option value="{{$enquiry->township_id}}" selected>{{$enquiry->township->name}}</option>
                        @else
                            <option value="{{$township->id}}">{{$township->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="township_id" id="township_id">
                    @foreach($townships as $township)
                        <option value="{{$township->id}}">{{$township->name}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('township_id')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="div_case_type">
            <label for="case_type" class="text_bold_black">Emergency<span class="require">*</span></label>
        </div>

        @if(isset($enquiry))
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                @if(isset($enquiry) && $enquiry->case_type == 1)
                    <input type="checkbox" name="case_type" id="case_type" checked>
                @elseif(isset($enquiry) && $enquiry->case_type == 0)
                    <input type="checkbox" name="case_type" id="case_type">
                @else
                    <input type="checkbox" name="case_type" id="case_type">
                @endif
            </div>
        @endif

        @if(!isset($enquiry))
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="checkbox" name="case_type" id="case_type">
            </div>
        @endif
    </div>
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="address" class="text_bold_black">Detail Address<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea required class="form-control" id="address" name="address" placeholder="Enter Detail Address" rows="10" cols="40">{{isset($enquiry)? $enquiry->address:Input::old('address')}}</textarea>
            <p class="text-danger">{{$errors->first('address')}}</p>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <table width="100%">
                <tr>
                    <td><img id="enquiry_question1" src="/images/backend/enquiry_question1.png" alt="" /></td>
                    <td>
                        @if(isset($enquiry))
                            @if($enquiry->enquiry1 == 1)
                                <input type="checkbox" id="enquiry1" name="enquiry1" checked><br><br>
                            @else
                                <input type="checkbox" id="enquiry1" name="enquiry1"><br><br>
                            @endif
                        @else
                            <input type="checkbox" id="enquiry1" name="enquiry1"><br><br>
                        @endif

                    </td>
                </tr>

                <tr>
                    <td><img id="enquiry_question2" src="/images/backend/enquiry_question2.png" alt="" /></td>
                    <td>
                        @if(isset($enquiry))
                            @if($enquiry->enquiry2 == 1)
                                <input type="checkbox" id="enquiry2" name="enquiry2" checked><br><br>
                            @else
                                <input type="checkbox" id="enquiry2" name="enquiry2"><br><br>
                            @endif
                        @else
                            <input type="checkbox" id="enquiry2" name="enquiry2"}><br><br>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td><img id="enquiry_question3" src="/images/backend/enquiry_question3.png" alt="" /></td>
                    <td>
                        @if(isset($enquiry))
                            @if($enquiry->enquiry3 == 1)
                                <input type="checkbox" id="enquiry3" name="enquiry3" checked><br><br>
                            @else
                                <input type="checkbox" id="enquiry3" name="enquiry3"><br><br>
                            @endif
                        @else
                            <input type="checkbox" id="enquiry3" name="enquiry3"><br><br>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td><img id="enquiry_question4" src="/images/backend/enquiry_question4.png" alt="" /></td>
                    <td>
                        @if(isset($enquiry))
                            @if($enquiry->enquiry4 == 1)
                                <input type="checkbox" id="enquiry4" name="enquiry4" checked><br><br>
                            @else
                                <input type="checkbox" id="enquiry4" name="enquiry4"><br><br>
                            @endif
                        @else
                            <input type="checkbox" id="enquiry4" name="enquiry4"><br><br>
                        @endif
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="remark" class="text_bold_black">Remark</label>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        <textarea class="form-control" id="remark" name="remark" placeholder="Enter Remark" rows="7" cols="40">{{isset($enquiry)?
        $enquiry->remark:Input::old('remark')}}</textarea>
            <p class="text-danger">{{$errors->first('remark')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            @if(isset($enquiry))
                @if($enquiry->status == 'confirm')

                @elseif($enquiry->status == 'complete')

                @else
                    <input type="submit" name="submit" value="UPDATE" class="form-control btn-primary">
                @endif

            @else
                <input type="submit" name="submit" value="ADD" class="form-control btn-primary">
            @endif
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('enquiry')">
        </div>
    </div>
    {{--
    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="date" class="text_bold_black">Date<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            <div class="input-group date futureDates" data-provide="datepicker">
                <input required autocomplete="off"  type="text" class="form-control" id="date" name="date"  value="{{ isset($enquiry)? $enquiry->date:Request::old('date') }}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('date')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="car_type" class="text_bold_black">Car Type<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                @if($enquiry->car_type == 1)
                    <input type="radio" name="car_type" value="1" checked> Patient Owned Vehicle
                @else
                    <input type="radio" name="car_type" value="1"> Patient Owned Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="1" checked> Patient Owned Vehicle
            @endif
        </div>
    </div>
    --}}

    {{--<div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="time" class="text_bold_black">Time</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="input-group bootstrap-timepicker timepicker">
                <input id="time" name="time" type="text" class="form-control input-small"  value="{{ isset($enquiry)?
        $enquiry->time:Request::old('time') }}">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            </div>
            <p class="text-danger">{{$errors->first('time')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($enquiry))
                @if($enquiry->car_type == 2)
                    <input type="radio" name="car_type" value="2" checked> Rental Vehicle
                @else
                    <input type="radio" name="car_type" value="2"> Rental Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="2"> Rental Vehicle
            @endif
        </div>
    </div>   --}}
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

            //var enquiry4 = $("input[name=enquiry4]:checked").val();
            if($("#enquiry4").is(':checked')){
                $("#enquiry_question4").delay(3000).css("background-color","red");
            }

//    $("#services").multiselect({
//        show: ["bounce", 100],
//        hide: ["explode", 600]
//    }).multiselectfilter();

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
                allowInputToggle: true,
            });

            //disabling date from datepicker
            var nowDate = new Date();
            var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
            //initializing datepicker
            $('.futureDates').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
                startDate: today
            });

            //for Age autocompletion when Dob is entered
            $('.pastDates').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                allowInputToggle: true,
                endDate: today
            }).on('changeDate', function (date) {
                var dob = date.format().split("-");
                var dobYear = dob[2];
                var d = new Date(dob[2], dob[1] - 1, dob[0]);
                var age_year = today.getFullYear() - dobYear;

                if(age_year == 1){
//                    $('#age').text(age_year + " year");
                    $('#age').val(age_year);
                    $('#unit').text("year");
                }
                else if(age_year == 0){
                    var dobMonth = dob[1];
                    var age_month = today.getMonth()+1 - dobMonth;

                    if(age_month == 1){
//                        $('#age').text(age_month + " month");
                        $('#age').val(age_month);
                        $('#unit').text("month");
                    }
                    else if(age_month == 0){
                        var dobDay = dob[0];
                        var age_day = today.getDate() - dobDay;
                        if(age_day == 0 || age_day == 1){
//                            $('#age').text(age_day + " day");
                            $('#age').val(age_day);
                            $('#unit').text("day");
                        }
                        else{
//                            $('#age').text(age_day + " days");
                            $('#age').val(age_day);
                            $('#unit').text("days");
                        }
                    }
                    else{
//                        $('#age').text(age_month + " months");
                        $('#age').val(age_month);
                        $('#unit').text("months");
                    }
                }
                else{
//                    $('#age').text(age_year + " years");
                    $('#age').val(age_year);
                    $('#unit').text("years");
                }
            });

            //for Dob autocompletion when age is entered
            $( "#age" ).focusout(function() {
                if($("#age").val() < 0){
                    sweetAlert("Oops...", "Age must be positive number !");
                    return;
                }
                else if($.isNumeric($("#age").val()) == false){
                    sweetAlert("Oops...", "Age must be numeric !");
                    return;
                }
                var dobY = new Date().getFullYear() - $("#age").val();
                var dobDate = new Date(dobY,0,1,1,0,0,0);
                $('.pastDates').datepicker('setDate', dobDate);
                $('.pastDates').datepicker('update');
            });

            $(".dateTimePicker").keypress(function(event) {event.preventDefault();});

            // Enquiry Question
            $(':checkbox').checkboxpicker();
            $('input#enquiry4').change(function () {

                if(this.checked) {
                    $("#enquiry_question4").delay(3000).css("background-color","red");
                    //$("#div_case_type").delay(3000).css("background-color","red");
                    if($('#case_type').prop('checked') == false ){
                        $("#case_type").prop('checked','checked');
                    }

                }
                else{
                    $("#enquiry_question4").delay(3000).css("background-color","#D9E0E7");
                    //$("#div_case_type").delay(3000).css("background-color","#D9E0E7");
                    $("#case_type").prop('checked','');
                }
            });

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

            $("#name").autocomplete({
                source: "/enquiry/autocompletepatient",
                select: function(event, ui) {
                    $('#name').val(ui.item.value);
                    $('#nrc_no').val(ui.item.nrc_no);
                    $('#phone_no').val(ui.item.phone_no);
                    $('#dob').val(ui.item.dob);
                    $('#is_new_patient').val(0);
                    $('#patient_id').val(ui.item.patient_id);
                    $('#packages').html(ui.item.packages);

                    var dob         = new Date(ui.item.dob);
                    var dob_year    = dob.getFullYear();
                    var current     = new Date();
                    var current_year= current.getFullYear();
                    var age_year    = current_year - dob_year;
                    if(age_year == 1){
//                        $('#age').text(age_year + " year");
                        $('#age').val(age_year + " year");
                    }
                    else if(age_year == 0){
                        var dob_month        = dob.getMonth() + 1;
                        var current_month    = current.getMonth() + 1;
                        var age_month        = current_month - dob_month;
                        if(age_month == 1){
//                            $('#age').text(age_month + " month");
                            $('#age').val(age_month + " month");
                        }
                        else if(age_month == 0){
                            var dob_day        = dob.getDate();
                            var current_day    = current.getDate();
                            var age_day        = current_day - dob_day;
                            if(age_day == 0 || age_day == 1){
//                                $('#age').text(age_day + " day");
                                $('#age').val(age_day);
                                $('#unit').text("day");
                            }
                            else{
//                                $('#age').text(age_day + " days");
                                $('#age').val(age_day);
                                $('#unit').text("days");
                            }
                        }
                        else{
//                            $('#age').text(age_month + " months");
                            $('#age').val(age_month);
                            $('#unit').text("months");
                        }
                    }
                    else{
//                        $('#age').text(age_year + " years");
                        $('#age').val(age_year);
                        $('#unit').text("years");
                    }

                    if(ui.item.patient_type_id == 1) {
                        $("#patient_type_id").val('1');
                    }

                    if(ui.item.patient_type_id == 2) {
                        $("#patient_type_id").val('2');
                    }

                    if(ui.item.gender == 'male') {
                        $("#gender_male").prop("checked", true);
                    }

                    if(ui.item.gender == 'female') {
                        $("#gender_female").prop("checked", true);
                    }

                    if(ui.item.having_allergy == 1){
                        $('#having_allergy_yes').prop("checked",true);
                    }
                    if(ui.item.having_allergy == 0){
                        $('#having_allergy_no').prop("checked",true);
                        $('.allergies_div').hide();
                    }

                    var allergies = ui.item.allergies;
                    i = 0, size = allergies.length;
                    for(i; i < size; i++){
                        $("#allergies").multiselect("widget").find(":checkbox[value='"+allergies[i]+"']").attr("checked","checked");
                        $("#allergies option[value='" + allergies[i] + "']").attr("selected", 1);
                        $("#allergies").multiselect("refresh");
                    }

                    $("#nrc_no").css({"background-color": "skyblue"});
                    $("#phone_no").css({"background-color": "skyblue"});
                    $("#patient_type_id").css({"background-color": "skyblue"});
                    $("#dob").css({"background-color": "skyblue"});
                    $("#allergies").css({"background-color": "skyblue"});
                    $("#packages").css({"background-color": "skyblue"});
                    $("#age").css({"background-color": "skyblue"});

                    $('#staff_id').text(ui.item.staff_id);
                    $("#div_staff_id").css({"background-color": "skyblue"});
                    $("#div_lbl_staff_id").css({"background-color": "skyblue"});
                }
            });

            $( "#name" ).keyup(function() {
                $('#nrc_no').val("");
                $('#phone_no').val("");
                $('#dob').val("");
                $('#is_new_patient').val(1);
                $('#patient_id').val("");
                $('#packages').html("");

                $("#nrc_no").css({"background-color": "white"});
                $("#phone_no").css({"background-color": "white"});
                $("#patient_type_id").css({"background-color": "white"});
                $("#dob").css({"background-color": "white"});
                $("#age").text("");
                $("#packages").css({"background-color": "#D9E0E7"});

                $("#allergies").multiselect("uncheckAll");


                $('#staff_id').text("");
                $("#div_staff_id").css({"background-color": "#D9E0E7"});
                $("#div_lbl_staff_id").css({"background-color": "#D9E0E7"});

            });
            /*
             $( "#date" ).change(function() {
             $('#enquiryEntryForm').valid();
             });*/

            //Start Validation for Enquiry Entry Form
            $('#enquiryEntryForm').validate({
                rules: {
                    name          : 'required',
                    gender        : 'required',
                    dob           : 'required',
                    age         : {
                        required  : true
//                        number    : true
                    },
                    phone_no      : 'required',
                    address       : 'required',
                    township_id   : 'required',
                    'allergies[]' : {
                        required    :'#having_allergy_yes:checked'   //If having_allergy is checked, valid allergies
                    }
                },
                messages: {
                    name          : 'Name is required',
                    gender        : 'Gender is required',
                    dob           : 'Date of Birth is required',
                    age         : {
                        required  : 'Age is required'
//                        number    : 'Age must be numeric'
                    },
                    phone_no      : 'Phone Number is required',
                    address       : 'Address is required',
                    township_id   : 'Township is required',
                    'allergies[]' : 'Allergy is required',
                },
                ignore: ':hidden:not("#allergies")', // Tells the validator to check the hidden select
                errorPlacement: function (error, element) { //Positioning Jquery Validation Errors after checkbox value
                    if (element.attr("id") == "allergies") {
                        error.insertAfter($('#beforeAllergyError'));
                    }else {
                        error.insertAfter( element ); // standard behaviour
                    }
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
//            $.validator.addMethod('age',
//                    function (value) {
//                        return Number(value) > 0;
//                    }, 'Enter a positive number.');
            //End Validation for Enquiry Entry Form

        });
    </script>
@stop