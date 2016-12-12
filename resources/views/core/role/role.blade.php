@extends('layouts.master')
@section('title','Role')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($roles) ?  'Role Edit' : 'Role Entry' }}</h1>

    @if(isset($roles))
        {!! Form::open(array('url' => 'role/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'roleForm')) !!}

    @else
        {!! Form::open(array('url' => 'role/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'roleForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($roles)? $roles->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Role Name" value="{{ isset($roles)? $roles->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Role Description" rows="5" cols="50">{{ isset($roles)? $roles->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($roles)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('role')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Role Entry and Edit Form
            $('#roleForm').validate({
                rules: {
                    name          : 'required',
                    description   : 'required'
                },
                messages: {
                    name          : 'Role Name is required',
                    description   : 'Description is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Role Entry and Edit Form
        });

    </script>
@stop