@extends('layouts.master')
@section('title','Permission')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($permission) ?  'Permission Edit' : 'Permission Entry' }}</h1>

    @if(isset($permission))
        {!! Form::open(array('url' => 'permission/update', 'class'=> 'form-horizontal user-form-border', 'id' => 'permissionForm')) !!}

    @else
        {!! Form::open(array('url' => 'permission/store', 'class'=> 'form-horizontal user-form-border', 'id' => 'permissionForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($permission)? $permission->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Permission Name" value="{{ isset($permission)? $permission->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="module" class="text_bold_black">Module<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="module" name="module" placeholder="Enter Permission Module Name" value="{{ isset($permission)? $permission->module:Request::old('module') }}"/>
            <p class="text-danger">{{$errors->first('module')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="url" class="text_bold_black">Url<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="url" name="url" placeholder="Enter Permission Url" value="{{ isset($permission)? $permission->url:Request::old('url') }}"/>
            <p class="text-danger">{{$errors->first('url')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description" class="text_bold_black">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <textarea class="form-control" id="description" name="description" placeholder="Enter Permission Description" rows="5" cols="50">{{ isset($permission)? $permission->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($permission)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('permission')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Permission Entry and Edit Form
            $('#permissionForm').validate({
                rules: {
                    name          : 'required',
                    module        : 'required',
                    url           : 'required'
                },
                messages: {
                    name          : 'Name is required',
                    module        : 'Module is required',
                    url           : 'URL is required'
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });
            //End Validation for Permission Entry and Edit Form
        });
    </script>
@stop