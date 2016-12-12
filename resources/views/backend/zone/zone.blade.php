@extends('layouts.master')
@section('title','Zone')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($zone) ?  'Zone Edit' : 'Zone Entry' }}</h1>

    @if(isset($zone))
        {!! Form::open(array('url' => 'zone/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'zoneForm')) !!}

    @else
        {!! Form::open(array('url' => 'zone/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'zoneForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($zone)? $zone->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Zone Name" value="{{ isset($zone)? $zone->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="townships" class="text_bold_black">Townships<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

            @if(isset($zone))
                <select id="townships" name="townships[]" multiple="multiple" class="form-control">
                    @foreach($zone['townships'] as $township)
                        @if($township->selected == 1)
                            <option value="{{$township->id}}" selected>{{$township->name}}</option>
                        @else
                            <option value="{{$township->id}}">{{$township->name}}</option>
                        @endif
                    @endforeach
                </select>
            @else
            <select id="townships" name="townships[]" multiple="multiple" class="form-control">
                    @foreach($townships as $township)
                        <option value="{{$township->id}}">{{$township->name}}</option>
                    @endforeach
            </select>
            @endif
            <p class="text-danger">{{$errors->first('townships')}}</p>
        </div>
    </div>

    {{--For Townships error placement--}}
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="beforeTownshipError" style="margin-right: 10px;">
        </div>
    </div>
    {{--For Townships error placement--}}

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Zone Description" rows="5" cols="50">{{ isset($zone)? $zone->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($zone)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('zone')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#townships").multiselect({
                show: ["bounce", 100],
                hide: ["explode", 600]
            }).multiselectfilter().on('change',function(){
                $('#zoneForm').valid();
            });;

            //Start Validation for Zone Entry and Edit Form
            $('#zoneForm').validate({
                rules: {
                    name          : 'required',
                    'townships[]' : 'required',
                    price         : {
                        required  : true,
                        number    : true
                    }
                },
                messages: {
                    name          : 'Zone Name is required',
                    'townships[]' : 'Townships are required',
                    price         : {
                        required  : 'Price is required',
                        number    : 'Price must be numeric'
                    }
                },
                ignore: ':hidden:not("#townships")', // Tells the validator to check the hidden select
                errorPlacement: function (error, element) { //Positioning Jquery Validation Errors after checkbox value
                    if (element.attr("id") == "townships") {
                        error.insertAfter($('#beforeTownshipError'));
                    }else {
                        error.insertAfter( element ); // standard behaviour
                    }
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Zone Entry and Edit Form
        });
    </script>
@stop