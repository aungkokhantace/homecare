@extends('layouts.master')
@section('title','Patient')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($patient) ?  'Patient Edit' : 'Patient Entry' }}</h1>

    @if(isset($patient))
        {!! Form::open(array('url' => 'patient/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'patientForm','files' => true)) !!}
    @else
        {!! Form::open(array('url' => 'patient/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'patientForm', 'files' => true)) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($patient)? $patient->user_id:''}}"/>
    <br/>

    @if( isset($patient))
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label class="text_bold_black">Patient Login ID</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input readonly type="text" autocomplete="off" class="form-control" id="user_id" name="user_id" value="{{ $patient->user_id }}"/>
        </div>
    </div>
    @endif
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Enter Patient Name" maxlength="45" value="{{ isset($patient)? $patient->name:Request::old('name') }}"/>
            <input type="text" style="display: none"/>
            <input type="password" style="display: none"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>

        <div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1">
            <label for="active" class="text_bold_black">Active</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($user))
                <input type="checkbox" name="active" value="1" @if($user->active == 1)checked @endif>
            @else
                <input type="checkbox" name="active" value="1" @if(Input::old('active')=="1")checked @endif checked>
            @endif
            <p class="text-danger">{{$errors->first('active')}}</p>
        </div>
    </div>


    <div class="row">
        @if(!isset($user))
            {{--This is create form. So, Password is not hidden--}}
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="password" class="text_bold_black">Password<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="password" autocomplete="new-password" class="form-control" id="password" name="password" placeholder="Enter Password" maxlength="45" value="{{Request::old('password') }}"/>
            </div>
            {{--This is create form. So, Password is not hidden--}}
        @endif

        @if(!isset($user))
            {{--This is create form. So, Phone is not repositioned--}}
            <div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1">
                <label for="phone_no" class="text_bold_black">Phone<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="text" autocomplete="off" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone Number" maxlength="45" value="{{Request::old('phone_no') }}"/>
                <p class="text-danger">{{$errors->first('phone_no')}}</p>
            </div>
            {{--This is create form. So, Phone is not repositioned--}}
        @else
            {{--This is edit form. So, Password is hidden and Phone and Gender are repositioned--}}
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="phone_no" class="text_bold_black">Phone<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="text" autocomplete="off" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone Number" maxlength="45" value="{{isset($patient)? $patient->phone_no:Request::old('name') }}"/>
                <p class="text-danger">{{$errors->first('phone_no')}}</p>
            </div>


            <div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1">
                <label for="gender" class="text_bold_black">Gender</label>
            </div>

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
            {{--This is edit form. So, Password is hidden and Phone and Gender are repositioned--}}
        @endif
    </div>

    <div class="row">
        @if(!isset($user))
            {{--This is create form. So, Confirm Password is not hidden--}}
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="password_confirmation" class="text_bold_black">Confirm Password<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" maxlength="45" value=""/>
                <p class="text-danger">{{$errors->first('password')}}</p>
            </div>
            {{--This is create form. So, Confirm Password is not hidden--}}
        @endif

        <div class="row">
            @if(!isset($user))
                {{--This is create form. So, gender is not repositioned--}}
                <div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1">
                    <label for="gender" class="text_bold_black">Gender</label>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <input type="radio" name="gender" value="male" checked> Male
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <input type="radio" name="gender" value="female"> Female
                </div>
                {{--This is create form. So, gender is not repositioned--}}
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="discount" class="text_bold_black">Patient Type<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($patient))
                <select class="form-control" name="patient_type_id" id="patient_type_id">
                    @foreach($patientTypes as $key => $patientType)
                        @if($key == $patient->patient_type_id)
                            <option value="{{$key}}" selected>{{$patientType}}</option>
                        @else
                            <option value="{{$key}}">{{$patientType}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="patient_type_id" id="patient_type_id">
                    <option value="" selected disabled>Select Patient Type</option>

                    @foreach($patientTypes as $key => $patientType)
                        <option value="{{$key}}">{{$patientType}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('patient_type_id')}}</p>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <label for="email" class="text_bold_black">Email</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" autocomplete="off" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{isset($patient)?$patient->email:Request::old('email')}}"/>
            <p class="text-danger">{{$errors->first('email')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="nrc_no" class="text_bold_black">NRC No/Passport</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <input type="text" autocomplete="off" class="form-control" id="nrc_no" name="nrc_no" placeholder="Enter NRC No/Passport" value="{{ isset($patient)? $patient->nrc_no:Request::old('nrc_no') }}"/>
                    <p class="text-danger">{{$errors->first('nrc_no')}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="dob" class="text_bold_black">Date of Birth</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="text" autocomplete="off" class="form-control" id="dob" name="dob" placeholder="Enter DOB" value="{{ isset($patient)? $patientDob : Request::old('dob') }}"/>
                    <p class="text-danger">{{$errors->first('dob')}}</p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input required type="number" max="150" class="form-control" id="age" name="age" placeholder="Age" value="{{ isset($patient)? $patientAge['value']:Request::old('age') }}"/>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <label id="unit" name="unit" style="margin-top: 8px;">
                            @if(isset($patient))
                                {{$patientAge['unit']}}
                            @endif
                        </label>
                    </div>
                    <p class="text-danger">{{$errors->first('dob')}}</p>
                </div>
            </div>

            <br>
            {{--<div class="row">--}}
                {{--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">--}}
                    {{--<label for="age" class="text_bold_black">Age</label>--}}
                {{--</div>--}}
                {{--<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">--}}
{{--                    <label class="text_big_blue" id="age" name="age">{{ isset($patient)? $patientAge : '' }}</label>--}}
                    {{--<input required type="text" class="form-control" id="age" name="age" placeholder="Enter Age" value="{{ isset($patient)? $patientAge : '' }}"/>--}}
                    {{--<p class="text-danger">{{$errors->first('age')}}</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<br>--}}

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="townships" class="text_bold_black">Township<span class="require">*</span></label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="zone" class="text_bold_black">Zone<span class="require">*</span></label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    @if(isset($patient) && $patient->zone_id != 0)
                        <input type="text" class="form-control" id="zone" name="zone" value="{{$patient->zone->name}}" readonly/>
                    @elseif(isset($patient) && $patient->zone_id == 0)
                        <input type="text" class="form-control" id="zone" name="zone" value="" readonly/>
                    @else
                        <input type="text" class="form-control" id="zone" name="zone" value="{{ Request::old('zone') }}" readonly/>
                    @endif
                    <p class="text-danger">{{$errors->first('zone')}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="address" class="text_bold_black">Detail Address<span class="require">*</span></label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <textarea autocomplete="off" class="form-control" id="address" name="address" placeholder="Enter Detail Address" rows="5" cols="50">{{isset($patient)? $patient->address:Input::old('address')}}</textarea>
                    <p class="text-danger">{{$errors->first('address')}}</p>
                </div>
            </div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            {{--Start File Upload--}}
            <div class="row">
                <div class="col-lg-1 col-lg-offset-2 col-md-1 col-md-offset-2 col-sm-1 col-sm-offset-2 col-xs-1 col-xs-offset-2">
                    <label for="code" class="text_bold_black">Photo</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                    @if(isset($patient))
                        <div class="add_image_div add_image_div_red" style="background-image: url({{'/images/users/'.$user ->display_image}});background-position:center;background-size:cover">
                        </div>
                        <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                    @else
                        <div class="add_image_div add_image_div_red">
                        </div>
                        <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <label></label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
                    <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage" name="removeImage">
                </div>
            </div>
            <br /><br />
            {{--End File Upload--}}
        </div>
    </div>

    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="having_allergy" class="text_bold_black">Allergies</label>
        </div>
        @if(isset($patient))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if($patient->having_allergy == 1)
                    <input type="radio" name="having_allergy" value="1" checked> Yes
                @else
                    <input type="radio" name="having_allergy" value="1"> Yes
                @endif
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                @if($patient->having_allergy == 0)
                    <input type="radio" name="having_allergy" value="0" checked> No
                @else
                    <input type="radio" name="having_allergy" value="0"> No
                @endif
            </div>
        @else
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="having_allergy" value="1"> Yes
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="radio" name="having_allergy" value="0" checked> No
            </div>
        @endif
    </div>
    <br/>
    <div class="row">
        @if((isset($patient)) && ($patient->having_allergy == 1))
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 allergy_div" style="display:block">
                <label for="allergies" class="text_bold_black">Allergies</label>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 allergy_div" style="display:block;">
                <select id="allergies" name="allergies[]" multiple="multiple" class="form-control">

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
                    <optgroup label="Environment Allergy">

                        @if(isset($patient['allergies']['environment']))
                            @foreach($patient['allergies']['environment'] as $allergy)
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
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 allergy_div" style="display:none">
                <label for="allergies" class="text_bold_black">Allergies</label>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 allergy_div" style="display:none;">
                <select id="allergies" name="allergies[]" multiple="multiple" class="form-control">

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
                    <optgroup label="Environment Allergy">

                        @if(isset($allergies['environment']))
                            @foreach($allergies['environment'] as $allergy)
                                <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                            @endforeach
                        @endif
                    </optgroup>
                </select>
            </div>
        @endif
    </div>
    <br />

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="case_scenario" class="text_bold_black">Case Summary</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <textarea class="form-control" autocomplete="off" id="case_scenario" name="case_scenario" placeholder="Enter Case Summary" rows="10" cols="40">{{isset($patient)? $patient->case_scenario:Input::old('case_scenario1')}}</textarea>
            <p class="text-danger">{{$errors->first('case_scenario')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="remark" class="text_bold_black">Remark</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <textarea class="form-control" autocomplete="off" id="remark" name="remark" placeholder="Enter Remark" rows="5" cols="50">{{isset($patient)? $patient->remark:Input::old('remark')}}</textarea>
            <p class="text-danger">{{$errors->first('remark')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($patient)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('patient')">
        </div>
    </div>

    {{--Start Modal--}}
    <div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Upload item image,</h4>
                    <p>Please ensure file is in .jpg, .png, .gif format.</p>
                </div>

                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 380px; height: 220px;">

                                <img id='user_image_PopUp' src="" alt="Load Image"/>
                            </div>
                            <div data-provides="fileinput">
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new" data-trigger="fileinput">Select image</span>
                            <span class="fileinput-exists">Change</span>

                            <input id="user_image" type="file" name="photo" accept="image.*" />
                            {{--{{ Form::file('nric_front_img') }}--}}
                        </span>
                                {{--<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>--}}
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="changeItemImage()" class="btn btn-default" data-dismiss="modal">Save</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-image-remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Remove Image !</h4>
                    <p>Please ensure you want to remove this image .</p>
                </div>

                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        Are you sure want to remove this image ?
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="removeIMG()" class="btn btn-default" data-dismiss="modal">Yes</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="image_error_fileFormat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label class="font-big-red">You can only upload a .jpg / jpeg / png / gif file format.</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="image_error_fileSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <label class="font-big-red">This is not an allowed file size !</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--End Modal--}}
    {!! Form::close() !!}
</div>
@stop
@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
//            Start fileupload js
            $(".add_image_div").click(function(){
                showPopup();
            });

            $("#removeImage").click(function(){
                $('#modal-image-remove').modal();
            });

            $('INPUT[type="file"]').change(function () {

                var ext = this.value.match(/\.(.+)$/)[1];
                var f=this.files[0];
                var fileSize = (f.size||f.fileSize);
                var imgkbytes = Math.round(parseInt(fileSize)/1024);

                if(imgkbytes > 5000){
                    $('#image_error_fileSize').modal('show');
                    //$('#user_image_PopUp').attr('src') = '';
                    $('#user_image_PopUp').attr('src','');
                    $('#user_image').val(null);
                }
                // else{
                switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                        break;
                    default:
                        $('#image_error_fileFormat').modal('show');
                        //$('#user_image_PopUp').attr('src') = '';
                        $('#user_image_PopUp').attr('src','');
                        $('#user_image').val(null);
                }
                //}

            });
//            End fileupload js

//            $('.allergy_div').hide();           //initially hide since no is selected in allergy radio button

            $('input[type=radio][name="having_allergy"]').on('change', function() {
                if($('input[name="having_allergy"]:checked').val()== 1){
                    var data = $('input[name="having_allergy"]:checked').val();
                    $('.allergy_div').show();
                    console.log(data);
                }
                else if($('input[name="having_allergy"]:checked').val()== 0){
                    var data = $('input[name="having_allergy"]:checked').val();
                    $('.allergy_div').hide();
                    console.log(data);
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

//            $('#dob').datepicker({
//                format: 'dd-mm-yyyy',
//                autoclose: true,
//                defaultDate: "+1w",
//                changeMonth: true,
//                numberOfMonths: 1
//            });

            //disabling date from datepicker
            var nowDate = new Date();
            var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
//            $('#dob').datepicker({
//                format: 'dd-mm-yyyy',
//                autoclose: true,
//                defaultDate: "+1w",
//                changeMonth: true,
//                numberOfMonths: 1,
//                allowInputToggle: true,
//                endDate: today
//            });

            //for Age autocompletion when Dob is entered
            $('#dob').datepicker({
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
                $('#dob').datepicker('setDate', dobDate);
                $('#dob').datepicker('update');
            });

            //Start Validation for Patient Entry and Edit Form
            $('#patientForm').validate({
                rules: {
                    name          : 'required',
                    password      : {
                        required  : true,
                        minlength : 8
                    },
                    password_confirmation   : {
                        required  : true,
                        minlength : 8,
                        equalTo   : "#password"
                    },
                    patient_type_id : 'required',
                    townships     : 'required',
                    address       : 'required',
                    phone_no      : 'required',
                    email         : 'email'
                },
                messages: {
                    name          : 'Patient Name is required',
                    password      : {
                        required  : 'Password is required',
                        minlength : 'Password must be at least 8 characters'
                    },
                    password_confirmation    : {
                        required  : 'Password is required',
                        minlength : 'Password must be at least 8 characters',
                        equalTo   : "Password and Confirm Password must match"
                    },
                    patient_type_id : 'Patient Type is required',
                    townships     : 'Township is required',
                    address       : 'Detail Address is required',
                    phone_no      : 'Phone Number is required',
                    email         : 'Email is not valid'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Patient Entry and Edit Form

            $(':checkbox').checkboxpicker();
        });

        function saveConfig(action) {
            var rate = $("#SETTING_TAXRATE").val();
            $("#error_lbl_SETTING_TAXRATE").text("");
            var errorCount = 0;
            if(isNaN(rate)){
                $("#error_lbl_SETTING_TAXRATE").text("Invalid Tax Rate !. It allow Number only !");
                errorCount++;
            }

            if(errorCount>0) {
                return;
            }
            else{
                $("#backend_posconfigs").submit();
            }
        }

        //start js function for fileupload
        function showPopup() {
            $('#modal-image').modal();
        }

        function changeItemImage(){
            var images = $('#modal-image img').attr('src');
            $('.add_image_div').css({"background-image": "url("+images+")", "background-position": "center","background-size":"cover"});
            $('#removeImageFlag').val(0);
        }

        function removeIMG(){
            $('#modal-image img').attr('src','second.jpg');
            $('.add_image_div').css('background-image', 'url()');
            $('#removeImageFlag').val(1);
        }
        //end js function for fileupload

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