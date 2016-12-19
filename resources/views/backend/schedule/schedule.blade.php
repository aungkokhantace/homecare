@extends('layouts.master')
@section('title','Schedule')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <div class="row">

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <h1 class="page-header">{{isset($schedule) ?  'Schedule Edit' : 'Schedule Entry' }}</h1>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" align="right">
            <h4 style="color:blueviolet;">
            @if($is_enquiry_confirm != '')
                Schedule come from enquiry [ {{$enquiry_confirm_id}} ]
            @elseif($patient_package_id !== "")
                @if($patient_package_schedule_no == "")
                        Schedule come from package [ {{$patient_package_info->package_name}} of schedule ]
                @else
                        Schedule come from package [ {{$patient_package_info->package_name}} of schedule No. {{$patient_package_schedule_no}} ]
                @endif
            @else
                    New created schedule
            @endif
            </h4>
        </div>
    </div>


    @if(isset($schedule))
        {!! Form::open(array('id' => 'frm_schedule', 'url' => 'schedule/update', 'class'=> 'form-horizontal')) !!}
    @else
        {!! Form::open(array('id' => 'frm_schedule', 'url' => 'schedule/store', 'class'=> 'form-horizontal')) !!}
    @endif

    <input type="hidden" id="enquiry_id" name="enquiry_id" value="{{$enquiry_confirm_id}}"/>
    <input type="hidden" name="is_new_patient" id="is_new_patient" value="{{ $is_new_patient }}"/>
    <input type="hidden" id="id" name="id" value="{{isset($schedule)? $schedule_id:''}}"/>
    <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient_id }}"/>

    <input type="hidden" name="is_new" id="is_new" value="{{ $is_new }}"/>
    <input type="hidden" name="is_edit" id="is_edit" value="{{ $is_edit }}"/>
    <input type="hidden" name="is_enquiry_confirm" id="is_enquiry_confirm" value="{{ $is_enquiry_confirm }}"/>
    <input type="hidden" name="patient_package_id" id="patient_package_id" value="{{ $patient_package_id }}"/>

    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Patient Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            @if($is_enquiry_confirm == 1)
                <input type="text" readonly class="form-control" id="name" name="name" value="{{ $enquiry->name }}"/>
            @elseif($is_schedule_package == 1)
                <input type="text" readonly class="form-control" id="name" name="name" value="{{ $patient->name }}"/>
            @elseif($is_edit == 1 && isset($schedule) && $schedule->enquiry_id === "" && $patient_package_id == 0)
                <select class="form-control" id="name" name="name" placeholder="Enter Patient Name"  onchange="getPatient(value)">
                    <option value="">Select Patient</option>
                    @foreach($patients as $patientObj)
                        @if($schedule->patient_id == $patientObj->user_id)
                            <option value="{{$patientObj->user_id}}" selected>{{$patientObj->name}}</option>
                        @else
                            <option value="{{$patientObj->user_id}}">{{$patientObj->name}}</option>
                        @endif
                    @endforeach
                </select>
            @elseif($is_edit == 1 && isset($schedule) && $schedule->enquiry_id !== "")
                <input type="text" readonly class="form-control" id="name" name="name" value="{{ $patient->name }}"/>
            @elseif($is_new == 1)
                <select class="form-control" id="name" name="name" placeholder="Enter Patient Name"  onchange="getPatient(value)">
                    <option value="">Select Patient</option>
                    @foreach($patients as $patientObj)
                        <option value="{{$patientObj->user_id}}">{{$patientObj->name}}</option>
                    @endforeach
                </select>
            @else

                <select class="form-control" id="name" name="name" placeholder="Enter Patient Name"  onchange="getPatient(value)">
                    <option value="">Select Patient</option>
                    @foreach($patients as $patientObj)
                        <option value="{{$patientObj->user_id}}">{{$patientObj->name}}</option>
                    @endforeach
                </select>
            @endif

                <p class="text-danger">{{$errors->first('name')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="div_lbl_staff_id">
            <label id="lbl_staff_id" name="lbl_staff_id" class="text_bold_black">Patient Registration No.</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="div_staff_id">
                @if($is_enquiry_confirm == 1 && $enquiry->is_new_patient == 0)
                    <label id="staff_id" name="staff_id" class="text_big_blue"> {{$enquiry->patient_id}}  </label>
                @elseif($is_schedule_package == 1)
                    <label id="staff_id" name="staff_id" class="text_big_blue"> {{$patient->user_id}}  </label>
                @else
                    <label id="staff_id" name="staff_id" class="text_big_blue">
                        @if(isset($enquiry->patient_id) && $enquiry->patient_id != "")
                            {{$enquiry->patient_id}}
                        @else
                            New Patient
                        @endif
                    </label>
                @endif

        </div>

    </div>

    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="date" class="text_bold_black">Date<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="input-group date futureDates" data-provide="datepicker">
                <input type="hidden" id="date_hidden" name="date_hidden"  value="{{ isset($schedule)? $schedule->date:'' }}">
                <input autocomplete="off" required type="text" class="form-control" id="date" name="date"  value="{{ isset($schedule)? $schedule->date:Request::old('date') }}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('date')}}</p>

        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="phone_no" class="text_bold_black">Phone Number</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            @if($is_enquiry_confirm == 1)

                @if($is_new_patient == 1)
                    <label id="phone_no_lbl" name="phone_no_lbl" class="text_big_blue">{{ $enquiry->phone_no }}</label>
                    <input type="hidden" id="phone_no" name="phone_no" value="{{ $enquiry->phone_no }}"/>
                @endif

                @if($is_new_patient == 0)
                    <label id="phone_no_lbl" name="phone_no_lbl" class="text_big_blue">{{ $patient->phone_no }}</label>
                    <input type="hidden" id="phone_no" name="phone_no" value="{{ $patient->phone_no }}"/>
                @endif
            @elseif($is_schedule_package == 1)
                <label id="phone_no_lbl" name="phone_no_lbl" class="text_big_blue">{{$patient->phone_no}}</label>
                <input type="hidden" id="phone_no" name="phone_no" value="{{ $patient->phone_no }}"/>
            @elseif($is_edit == 1)
                <label id="phone_no_lbl" name="phone_no_lbl" class="text_big_blue">{{ $patient->phone_no }}</label>
                <input type="hidden" id="phone_no" name="phone_no" value="{{ $patient->phone_no }}"/>
            @else
                <label id="phone_no_lbl" name="phone_no_lbl" class="text_big_blue"></label>
                <input type="hidden" id="phone_no" name="phone_no" value=""/>
            @endif



        </div>

    </div>

    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="time" class="text_bold_black">Time</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="input-group bootstrap-timepicker timepicker">
                <input id="time" name="time" type="text" class="form-control input-small"  value="{{ isset($schedule)?
    $schedule->time:Request::old('time') }}">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            </div>
            <p class="text-danger">{{$errors->first('time')}}</p>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="nrc_no" class="text_bold_black">NRC No. / Passport No.</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if($is_enquiry_confirm == 1)
                @if($is_new_patient == 1)
                    <label id="nrc_no" name="nrc_no" class="text_big_blue">{{ $enquiry->nrc_no }}</label>
                @endif

                @if($is_new_patient == 0)
                    <label id="nrc_no" name="nrc_no" class="text_big_blue">{{ $patient->nrc_no }}</label>
                @endif
            @elseif($is_schedule_package == 1)
                <label id="nrc_no" class="text_big_blue">{{$patient->nrc_no}}</label>
            @elseif($is_edit == 1)
                <label id="nrc_no" name="nrc_no" class="text_big_blue">{{ $patient->nrc_no }}</label>
            @else
                    <label id="nrc_no" name="nrc_no" class="text_big_blue"></label>
            @endif
        </div>
    </div>

    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="leader_id" class="text_bold_black">Leader</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select class="form-control" id="leader_id" name="leader_id">
                @if($is_edit == 1 && isset($schedule))
                    @foreach($hhcsPersonals as $hhcsPersonalLeader)
                        @if($schedule->leader_id == $hhcsPersonalLeader->id)
                            <option value="{{$hhcsPersonalLeader->id}}" selected>{{$hhcsPersonalLeader->name}}</option>
                        @else
                            <option value="{{$hhcsPersonalLeader->id}}">{{$hhcsPersonalLeader->name}}</option>
                        @endif
                    @endforeach
                @else
                    @foreach($hhcsPersonals as $hhcsPersonalLeader)
                        @if($currentUserID == $hhcsPersonalLeader->id)
                            <option value="{{$hhcsPersonalLeader->id}}" selected>{{$hhcsPersonalLeader->name}}</option>
                        @else
                            <option value="{{$hhcsPersonalLeader->id}}">{{$hhcsPersonalLeader->name}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="discount" class="text_bold_black">Nationality</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if($is_enquiry_confirm == 1)
                @if($is_new_patient == 1)
                    <label id="patient_type_id" name="patient_type_id" class="text_big_blue">{{ $patientTypes[$enquiry->patient_type_id] }}</label>
                @endif

                @if($is_new_patient == 0)
                        <label id="patient_type_id" name="patient_type_id" class="text_big_blue">{{ $patientTypes[$patient->patient_type_id] }}</label>
                @endif
            @elseif($is_schedule_package == 1)
                <label id="patient_type_id" name="patient_type_id" class="text_big_blue">{{ $patientTypes[$patient->patient_type_id] }}</label>
            @elseif($is_edit == 1)
                <label id="patient_type_id" name="patient_type_id" class="text_big_blue">{{ $patientTypes[$patient->patient_type_id] }}</label>
            @else
                <label id="patient_type_id" name="patient_type_id" class="text_big_blue"></label>
            @endif
        </div>
    </div>
    <br/>

    <div class="row">


        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="hhcs_personnel" class="text_bold_black">HHCS Personnel</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <select id="hhcs_personnel" name="hhcs_personnel[]" multiple="multiple" class="form-control">
                @if($is_edit == 1)
                    @if(isset($schedule['hhcsPersonals']) && count($schedule['hhcsPersonals'])>0)
                        @foreach($schedule['hhcsPersonals'] as $hhcsPersonal)
                            @if($hhcsPersonal->selected == 1)
                                <option value="{{$hhcsPersonal->id}}" selected>{{$hhcsPersonal->name}}</option>
                            @else
                                <option value="{{$hhcsPersonal->id}}">{{$hhcsPersonal->name}}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($hhcsPersonals as $hhcsPersonal2)
                            <option value="{{$hhcsPersonal2->id}}">{{$hhcsPersonal2->name}}</option>
                        @endforeach
                    @endif
                @elseif($is_enquiry_confirm == 1)
                    @foreach($hhcsPersonals as $hhcsPersonal)
                        <option value="{{$hhcsPersonal->id}}">{{$hhcsPersonal->name}}</option>
                    @endforeach
                @elseif($is_new == 1)
                    @foreach($hhcsPersonals as $hhcsPersonal)
                        <option value="{{$hhcsPersonal->id}}">{{$hhcsPersonal->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="gender" class="text_bold_black">Gender</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            @if($is_enquiry_confirm == 1)
                @if($is_new_patient == 1)
                    <label id="gender" name="gender" class="text_big_blue">{{ strtoupper($enquiry->gender) }}</label>
                @endif

                @if($is_new_patient == 0)
                        <label id="gender" name="gender" class="text_big_blue">{{ strtoupper($patient->gender) }}</label>
                @endif
            @elseif($is_schedule_package == 1)
                <label id="gender" name="gender" class="text_big_blue">{{ strtoupper($patient->gender) }}</label>
            @elseif($is_edit == 1)
                <label id="gender" name="gender"  class="text_big_blue">{{ strtoupper($patient->gender) }}</label>
            @elseif($is_new == 1)
                <label id="gender" name="gender" class="text_big_blue"></label>
            @endif
        </div>
    </div>
    <br />

    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="services" class="text_bold_black">Services</label>
        </div>

        {{--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">--}}
            {{--@if($is_edit == 1)--}}
                {{--<select id="services" name="services[]" multiple="multiple" class="form-control">--}}
                    {{--@foreach($schedule['services'] as $service)--}}
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

        {{--
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            @if($is_edit == 1)
                <select id="services" name="services[]" class="form-control">
                    @foreach($schedule['services'] as $service)
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

        </div>--}}
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if($is_enquiry_confirm == 1)
                @if(isset($enquiry))
                    <select id="services" name="services[]" class="form-control">
                        <option>Select Service</option>
                        @foreach($enquiry->services as $enqService)
                            @if($enqService->selected == 1)
                                <option value="{{$enqService->id}}" selected>{{$enqService->name}}</option>
                            @else
                                <option value="{{$enqService->id}}">{{$enqService->name}}</option>
                            @endif
                        @endforeach
                    </select>
                @endif
            @elseif($is_edit == 1)
                <select id="services" name="services[]" class="form-control">
                    <option>Select Service</option>
                    @foreach($schedule['services'] as $service)
                        @if($service->selected == 1)
                            <option value="{{$service->id}}" selected>{{$service->name}}</option>
                        @else
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endif
                    @endforeach
                </select>

            @elseif($is_schedule_package == 1)
                <select id="services" name="services[]" class="form-control">
                    <option>Select Service</option>
                    @foreach($servicesArray as $key=>$service)
                        <option value="{{$key}}">{{$service}}</option>
                    @endforeach
                </select>

            @else
                <select id="services" name="services[]" class="form-control">
                    <option>Select Service</option>
                    @foreach($services as $service)
                        <option value="{{$service->id}}">{{$service->name}}</option>
                    @endforeach
                </select>
            @endif

        </div>



        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="dob" class="text_bold_black">Date of Birth</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if($is_enquiry_confirm == 1)
                @if($is_new_patient == 1)
                    <label id="dob" name="dob" class="text_big_blue">{{ $enquiry->dob }}</label>
                @endif

                @if($is_new_patient == 0)
                    <label id="dob" name="dob" class="text_big_blue">{{ $patient->dob }}</label>
                @endif
            @elseif($is_schedule_package == 1)
                <label id="dob" name="dob" class="text_big_blue">{{ $patient->dob }}</label>
            @elseif($is_edit == 1)
                <label id="dob" name="dob" class="text_big_blue">{{ $patient->dob }}</label>
            @elseif($is_new == 1)
                <label id="dob" name="dob" class="text_big_blue"></label>
            @endif
        </div>
    </div>
    <br/>

    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="car_type" class="text_bold_black">Car Type<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if($is_edit == 1)
                @if($schedule->car_type == 1)
                    <input type="radio" name="car_type" value="1" checked> Patient Owned Vehicle
                @else
                    <input type="radio" name="car_type" value="1"> Patient Owned Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="1" checked> Patient Owned Vehicle
            @endif

            <br/>

            @if($is_edit == 1)
                @if($schedule->car_type == 2)
                    <input type="radio" name="car_type" value="2" checked> Rental Vehicle
                @else
                    <input type="radio" name="car_type" value="2"> Rental Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="2"> Rental Vehicle
            @endif

            <br />

            @if($is_edit == 1)
                @if($schedule->car_type == 3)
                    <input type="radio" name="car_type" value="3" checked> HHCS Vehicle
                @else
                    <input type="radio" name="car_type" value="3"> HHCS Vehicle
                @endif
            @else
                <input type="radio" name="car_type" value="3"> HHCS Vehicle
            @endif
            <p class="text-danger">{{$errors->first('car_type')}}</p><br/>

        </div>


        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="having_allergy" class="text_bold_black">Allergies</label>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 allergies_div" id ="allergies_div">
            @if($is_enquiry_confirm == 1)
                @if(isset($enquiry))
                    @foreach($enquiry->allergies as $enqAllergy)
                        @if($enqAllergy->selected == 1 && $enqAllergy->type == 'food')
                            <label class="text_big_blue">[Food] - {{$enqAllergy->name}}</label><br/>
                        @elseif($enqAllergy->selected == 1 && $enqAllergy->type == 'drug')
                            <label class="text_big_blue">[Drug] - {{$enqAllergy->name}}</label><br/>
                        @endif
                    @endforeach
                @endif
            @elseif($is_edit == 1)
                @if(isset($patient->allergies))
                    @foreach($patient->allergies['food'] as $allergyFood)
                        @if($allergyFood->selected == 1 && $allergyFood->type == 'food')
                            <label id="{{$allergyFood->id}}" name="{{$allergyFood->id}}" class="text_big_blue">[Food] - {{$allergyFood->name}}</label><br/>
                        @endif
                    @endforeach
                @endif

                @if(isset($patient->allergies))
                    @foreach($patient->allergies['drug'] as $allergyDrug)
                        @if($allergyDrug->selected == 1 && $allergyDrug->type == 'drug')
                            <label id="{{$allergyDrug->id}}" name="{{$allergyDrug->id}}" class="text_big_blue">[Drug] - {{$allergyDrug->name}}</label><br/>
                        @endif
                    @endforeach
                @endif

            @elseif($is_schedule_package == 1)
                @if($patient->having_allergy == 1)
                    @foreach($patient['allergies']['food'] as $allergy)
                        @if($allergy->selected == 1)
                            <label for="allergy" class="text_big_blue">[Food] - {{$allergy->name}}</label><br/>
                        @endif
                    @endforeach

                    @foreach($patient['allergies']['drug'] as $allergy)
                        @if($allergy->selected == 1)
                            <label for="allergy" class="text_big_blue">[Drug] - {{$allergy->name}}</label><br/>
                        @endif
                    @endforeach
                @endif
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if($is_edit == 1)
                <select class="form-control" name="car_type_id" id="car_type_id">
                    @foreach($carTypes as $key => $carType)
                        @if($key == $schedule->car_type_id)
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

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="township_id" class="text_bold_black">Township</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            @if($is_enquiry_confirm == 1)
                @if($is_new_patient == 1)
                    <label id="township_id_lbl" name="township_id_lbl" class="text_big_blue">{{ $townships[$enquiry->township_id] }}</label>
                    <input type="hidden" id="township_id" name="township_id" value="{{ $enquiry->township_id }}"/>
                @endif

                @if($is_new_patient == 0)
                    <label id="township_id_lbl" name="township_id_lbl" class="text_big_blue">{{ $townships[$enquiry->township_id] }}</label>
                    <input type="hidden" id="township_id" name="township_id" value="{{ $enquiry->township_id }}"/>
                @endif
            @elseif($is_edit == 1)
                <label id="township_id_lbl" name="township_id_lbl" class="text_big_blue">{{ $townships[$schedule->township_id] }}</label>
                <input type="hidden" id="township_id" name="township_id" value="{{ $schedule->township_id }}"/>
            @elseif($is_schedule_package == 1)
                <label id="township_id_lbl" name="township_id_lbl" class="text_big_blue">{{ $townships[$patient->township_id] }}</label>
                <input type="hidden" id="township_id" name="township_id" value="{{ $patient->township_id }}"/>
            @else
                <label id="township_id_lbl" name="township_id_lbl" class="text_big_blue"></label>
                <input type="hidden" id="township_id" name="township_id" value=""/>
            @endif

        </div>

    </div>
    <br/>

    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="address" class="text_bold_black">Detail Address</label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if($is_enquiry_confirm == 1)
                @if($is_new_patient == 1)
                    <label id="address_lbl" name="address_lbl" class="text_big_blue">{{ $enquiry->address }}</label>
                    <input type="hidden" id="address" name="address" value="{{ $enquiry->address }}"/>
                @endif

                @if($is_new_patient == 0)
                        <label id="address_lbl" name="address_lbl" class="text_big_blue">{{ $patient->address }}</label>
                        <input type="hidden" id="address" name="address" value="{{ $patient->address }}"/>
                @endif
            @elseif($is_schedule_package == 1)
                <label id="address_lbl" name="address_lbl" class="text_big_blue">{{ $patient->address }}</label>
                <input type="hidden" id="address" name="address" value="{{ $patient->address }}"/>
            @elseif($is_edit == 1)
                <label id="address_lbl" name="address_lbl" class="text_big_blue">{{ $patient->address }}</label>
                <input type="hidden" id="address" name="address" value="{{ $patient->address }}"/>
            @else
                <label id="address_lbl" name="address_lbl" class="text_big_blue"></label>
                <input type="hidden" id="address" name="address" value=""/>
            @endif
        </div>

    </div>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="remark" class="text_bold_black">Remark</label>
        </div>

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        <textarea class="form-control" id="remark" name="remark" placeholder="Enter Remark" rows="7" cols="40">{{isset($schedule)?
        $schedule->remark:Input::old('remark')}}</textarea>
            <p class="text-danger">{{$errors->first('remark')}}</p>
        </div>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            @if(isset($schedule))
                @if($schedule->status != 'cancel' && $schedule->status != 'complete' && $schedule->status != 'processing')
                <input type="submit" name="submit" value="UPDATE" class="form-control btn-primary">
                @endif
            @else
                <input type="submit" name="submit" value="ADD" class="form-control btn-primary">
            @endif
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('schedule')">
        </div>
    </div>

    {!! Form::close() !!}
</div>
@stop
@section('page_script')
    <script type="text/javascript">

        $(document).ready(function() {

            var is_enquiry_confirm = $("#is_enquiry_confirm").val();
            if(is_enquiry_confirm == 0){
                //$("#name").select2({});
            }

            var car_type = $("input[name=car_type]:checked").val();
            if(car_type != 3){
                $('#car_type_id').hide();
            }

//            $("#services").multiselect({
//                show: ["bounce", 100],
//                hide: ["explode", 600]
//            }).multiselectfilter();

            $("#hhcs_personnel").multiselect({
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

            //disabling past date from datepicker
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

            $(".dateTimePicker").keypress(function(event) {event.preventDefault();});

            if($("#date_hidden").val() == ""){
                $(".dateTimePicker").datepicker("setDate", new Date());
            }

            // ScheduleQuestion
            $(':checkbox').checkboxpicker();
            $('input#enquiry4').change(function () {

                if(this.checked) {
                    $("#enquiry_question4").delay(3000).css("background-color","red");
                    $("#case_type").prop('checked','checked');

                }
                else{
                    $("#enquiry_question4").delay(3000).css("background-color","#D9E0E7");
                    $("#case_type").prop('checked','');
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

            //Start Validation for Schedule Entry and Edit Form
            $('#frm_schedule').validate({
                rules: {
                    name          : 'required',
                    date          : 'required'
                },
                messages: {
                    name          : 'Patient Name is required',
                    date          : 'Schedule Date is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Schedule Entry and Edit Form

        });

        //Ajax Method
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
                $('#zone').val(response);
                $data=response;
            });
        }

            //Ajax Method
        function getPatient(id)
        {
            $id=id;
            if($id != ""){
                // Set request
                var request = $.get('/patient/profile/'+$id);

                // When it's done
                request.done(function(patient) {
                    $('#patient_id').val(patient.user_id);
                    $('#staff_id').text(patient.user_id);
                    //$('#staff_id').text(  patient.staff_id);
                    $('#nrc_no').text(  patient.nrc_no);
                    $('#phone_no_lbl').text(patient.phone_no);
                    $('#phone_no').val(patient.phone_no);

                    if(patient.patient_type_id == 1) {
                        $('#patient_type_id').text("LOCAL");
                    }
                    if(patient.patient_type_id == 2){
                        $('#patient_type_id').text("FOREIGNER");
                    }

                    var genderRaw = patient.gender;
                    var genderString = genderRaw.toUpperCase();
                    $('#gender').text(genderString);

                    $('#dob').text  (patient.dob);
                    $('#is_new_patient').val(0);

                    $('#township_id').val(patient.township_id);
                    $('#township_id_lbl').text(patient.township.name);
                    $('#address').text(patient.address);

                    $("#allergies_div").html("");
                    var allergies = patient.allergies;
                    var strAllergies = "";
                    i = 0, size = Object.keys(allergies).length;

                    $.each(allergies['food'],function(i,item){
                        if(item.selected ==1){
                            var allergyType = "[Food] - ";
                            strAllergies += "<label class='text_big_blue'>"  + allergyType + " " + item.name + "</label><br/>";
                        }
                    });

                    $.each(allergies['drug'],function(i,item){
                        if(item.selected ==1){
                            var allergyType = "[Drug] - ";
                            strAllergies += "<label class='text_big_blue'>"  + allergyType + " " + item.name + "</label><br/>";
                        }
                    });

                    $("#allergies_div").html(strAllergies);
                });
            }
            else{
                $('#patient_id').val("");
                $('#staff_id').text("");
                $('#nrc_no').text("");
                $('#phone_no_lbl').text("");
                $('#phone_no').val("");
                $('#patient_type_id').text("");
                $('#gender').text("");
                $('#dob').text("");
                $('#is_new_patient').val(0);
                $('#township_id').val(0);
                $('#township_id_lbl').text("");
                $('#address').text("");
                $("#allergies_div").html("");
            }

        }

        $(document).ready(function() {

            $('#frm_schedule').validate({
                rules: {

                    name                : "required",
                    date                : "required",
                    time                : "required"
                },
                messages: {
                    name                : "Patient Name is required.",
                    date                : "Date is required.",
                    time                : "time is required."
                }
            });

        });
    </script>
@stop