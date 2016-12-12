@extends('layouts.master')
@section('title','Township')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($township) ?  'Township Edit' : 'Township Entry' }}</h1>

    @if(isset($township))
        {!! Form::open(array('url' => 'township/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'townshipForm')) !!}

    @else
        {!! Form::open(array('url' => 'township/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'townshipForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($township)? $township->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Township Name" value="{{ isset($township)? $township->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="city_id" class="text_bold_black">Township City<span class="require">*</span></label>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($township))
                <select class="form-control" name="city_id" id="city_id">
                    @foreach($cities as $city)
                        @if($city->id == $township->city_id)
                            <option value="{{$township->city_id}}" selected>{{$township->city->name}}</option>
                        @else
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
                <select class="form-control" name="city_id" id="city_id">
                    <option value="" selected disabled>Select City</option>

                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            @endif
            <p class="text-danger">{{$errors->first('city_id')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="remark" class="text_bold_black">Remark</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="remark" name="remark" placeholder="Enter Township Remark" rows="5" cols="50">{{ isset($township)? $township->remark:Request::old('remark') }}</textarea>
            <p class="text-danger">{{$errors->first('remark')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($township)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('township')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Township Entry and Edit Form
            $('#townshipForm').validate({
                rules: {
                    name          : 'required',
                    city_id       : 'required'
                },
                messages: {
                    name          : 'Township Name is required',
                    city_id       : 'Township City is required'
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Township Entry and Edit Form

        });
    </script>
@stop