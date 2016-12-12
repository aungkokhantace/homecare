@extends('layouts.master')
@section('title','User')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">
        @if(isset($profile))
            Update Profile
        @else
            {{ isset($user) ?  'Staff Edit' : 'Staff Entry' }}
        @endif
    </h1>

    {{--check new or edit--}}
    @if(isset($user))
        {!! Form::open(array('url' => 'user/update', 'class'=> 'form-horizontal user-form-border','files' => true, 'id'=>'userForm')) !!}

    @else
        {!! Form::open(array('url' => '/user/store', 'class'=> 'form-horizontal user-form-border','files' => true, 'id'=>'userForm')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($user)? $user->id:''}}"/>
    <br/>

    @if(isset($profile))
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="staff_id" class="text_bold_black">Staff ID</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="text" readonly class="form-control" id="staff_id" name="staff_id" placeholder="Enter Staff ID No" value="{{ isset($user)? $user->id:Request::old('staff_id') }}"/>
            </div>
        </div>
    @endif
    <br>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name" class="text_bold_black">Staff Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Staff Name" value="{{ isset($user)? $user->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            {{--Start File Upload--}}
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <label for="code" class="text_bold_black">Photo</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
                    @if(isset($user))
                        <div class="add_image_div add_image_div_red" style="background-image: url({{'/images/users/'.$user->display_image}});background-position:center;background-size:cover">
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

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="phone" class="text_bold_black">Phone</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Staff Phone" value="{{ isset($user)? $user->phone:Request::old('phone') }}"/>
            <p class="text-danger">{{$errors->first('phone')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="email" class="text_bold_black">Email<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Staff Email" value="{{ isset($user)? $user->email:Request::old('email') }}"/>
            <input type="text" style="display: none"/>
            <input type="password" style="display: none"/>
            <p class="text-danger">{{$errors->first('email')}}</p>
        </div>
    </div>

    @if(!isset($user))
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="discount" class="text_bold_black">Password<span class="require">*</span></label>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="new-password"/>
                <p class="text-danger">{{$errors->first('password')}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="discount" class="text_bold_black">Confirm Password<span class="require">*</span></label>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Enter Confirm Password"/>
                <p class="text-danger">{{$errors->first('conpassword')}}</p>
            </div>
        </div>
    @endif

    {{--comes from profile--}}
    @if(isset($profile))
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="active" class="text_bold_black">Change Password</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="checkbox" name="active" id="active" value="1" @if(Input::old('active')=="1")checked @endif>
            </div>
        </div>
        <br>
        <div class="row password">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="password" class="password" class="text_bold_black">Password<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="password" class="form-control password" id="password" name="password" placeholder="Enter Password"/>
                <p class="text-danger">{{$errors->first('password')}}</p>
            </div>
        </div>

        <div class="row password">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="discount" class="password" class="text_bold_black">Confirm Password<span class="require">*</span></label>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="password" class="form-control password" id="conpassword" name="conpassword" placeholder="Enter Confirm Password"/>
                <p class="text-danger">{{$errors->first('conpassword')}}</p>
            </div>
        </div>
    @endif

    {{--comes from profile with superadmin role // patient role is hidden--}}
    @if(isset($profile) && $superAdmin)
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="discount" class="text_bold_black">Staff Role<span class="require">*</span></label>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                @if(isset($user))
                    <select class="form-control" name="role_id" id="role_id">
                        @foreach($roles as $role)
                            @if($role->id == 5)
                                @continue
                            @elseif($role->id == $user->role_id)
                                <option value="{{$user->role_id}}" selected>{{$user->role->name}}</option>
                            @else
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="" selected disabled>Select Staff Role</option>

                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                @endif
                <p class="text-danger">{{$errors->first('role_id')}}</p>
            </div>
        </div>

    {{--comes from profile with admin role  // superadmin and patient roles are hidden--}}
    @elseif(isset($profile) && $admin)
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="discount" class="text_bold_black">Staff Role<span class="require">*</span></label>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                @if(isset($user))
                    <select class="form-control" name="role_id" id="role_id">
                        @foreach($roles as $role)
                            @if(($role->id == 1) || ($role->id == 5))
                                @continue
                            @elseif($role->id == $user->role_id)
                                <option value="{{$user->role_id}}" selected>{{$user->role->name}}</option>
                            @else
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="" selected disabled>Select Staff Role</option>

                        @foreach($roles as $role)
                            @if(($role->id == 1) || ($role->id == 5))
                                @continue
                            @else
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                @endif
                <p class="text-danger">{{$errors->first('role_id')}}</p>
            </div>
        </div>
        <br>

     {{--comes from profile with normaluser role(neither superadmin nor admin)  // role edit is not allowed--}}
    @elseif(isset($profile) && $normalUser)
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="staff_role" class="text_bold_black">Staff Role</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input type="text" readonly class="form-control" id="staff_role" name="staff_role" placeholder="Enter Staff Role" value="{{ isset($user)? $user->role->name:Request::old('staff_role') }}"/>
            </div>
        </div>
        <br>

    {{--this is staff entry/edit case(not from profile)--}}
    @else
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="discount" class="text_bold_black">Staff Role<span class="require">*</span></label>
            </div>

            {{--comes with superadmin role  //patient role is hidden --}}
            @if($superAdmin)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                {{--staff edit case(with superadmin role)--}}
                @if(isset($user))
                    <select class="form-control" name="role_id" id="role_id">
                        @foreach($roles as $role)
                            @if($role->id == 5)
                                @continue
                            @elseif($role->id == $user->role_id)
                                <option value="{{$user->role_id}}" selected>{{$user->role->name}}</option>
                            @else
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                {{--staff entry case(with superadmin role)--}}
                @else
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="" selected disabled>Select Staff Role</option>

                        @foreach($roles as $role)
                            @if($role->id == 5)
                                @continue
                            @else
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                @endif
                <p class="text-danger">{{$errors->first('role_id')}}</p>
            </div>

            {{--comes with admin role  //superadmin and patient roles are hidden --}}
            @elseif($admin)
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    {{--staff edit case(with admin role)--}}
                    @if(isset($user))
                        <select class="form-control" name="role_id" id="role_id">
                            @foreach($roles as $role)
                                @if(($role->id == 1) || ($role->id == 5))
                                    @continue
                                @elseif($role->id == $user->role_id)
                                    <option value="{{$user->role_id}}" selected>{{$user->role->name}}</option>
                                @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    {{--staff entry case(with admin role)--}}
                    @else
                        <select class="form-control" name="role_id" id="role_id">
                            <option value="" selected disabled>Select Staff Role</option>

                            @foreach($roles as $role)
                                @if(($role->id == 1) || ($role->id == 5))
                                    @continue
                                @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    @endif
                    <p class="text-danger">{{$errors->first('role_id')}}</p>
                </div>

            {{--comes with normal user role(neither superadmin nor admin)    //superadmin, admin and patient roles are hidden--}}
            @else
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    {{--staff edit case(with normal user role)--}}
                    @if(isset($user))
                        <select class="form-control" name="role_id" id="role_id">
                            @foreach($roles as $role)
                                @if(($role->id == 1) || ($role->id == 2) || ($role->id == 5))
                                    @continue
                                @elseif($role->id == $user->role_id)
                                    <option value="{{$user->role_id}}" selected>{{$user->role->name}}</option>
                                @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    {{--staff entry case(with normal user role)--}}
                    @else
                        <select class="form-control" name="role_id" id="role_id">
                            <option value="" selected disabled>Select Staff Role</option>

                            @foreach($roles as $role)
                                @if(($role->id == 1) || ($role->id == 2) || ($role->id == 5))
                                    @continue
                                @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    @endif
                    <p class="text-danger">{{$errors->first('role_id')}}</p>
                </div>
            @endif
        </div>
    @endif

    @if(isset($user) && $user->role_id == 7)
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 fees_div">
                <label for="fees" class="text_bold_black">Fees<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fees_div">
                <input type="text" class="form-control" id="fees" name="fees" placeholder="Enter Consultant Fees" value="{{ isset($user)? $user->fees:Request::old('fees') }}"/>
                <p class="text-danger">{{$errors->first('fees')}}</p>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 fees_div" style="display:none;">
                <label for="fees" class="text_bold_black">Fees<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fees_div" style="display:none;">
                <input type="text" class="form-control" id="fees" name="fees" placeholder="Enter Consultant Fees" value="{{ isset($user)? $user->fees:Request::old('fees') }}"/>
                <p class="text-danger">{{$errors->first('fees')}}</p>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="address" class="text_bold_black">Address</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
             <textarea rows="5" cols="50"class="form-control" id="address" name="address" placeholder="Enter Staff Address">{{ isset($user)? $user->address:Request::old('address') }}</textarea>
            <p class="text-danger">{{$errors->first('address')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($user)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('user')">
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
            $(".password").hide();

            //Start fileupload js
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
            });
            //End fileupload js


            $(':checkbox').checkboxpicker().change(function() {
                if (document.getElementById('active').checked)
                {
                    $(".password").show();
                } else {
                    $(".password").hide();
                }
            });

            //Start Validation for Staff Entry and Edit Form
            $('#userForm').validate({
                rules: {
                    name          : 'required',
                    email         : {
                        required  : true,
                        email     : true
                    },
                    password      : {
                        required  : true,
                        minlength : 8
                    },
                    conpassword   : {
                        required  : true,
                        minlength : 8,
                        equalTo   : "#password"
                    },
                    role_id       : 'required',
                    fees          : 'required'
                },
                messages: {
                    name          : 'Name is required',
                    email         : {
                        required  : "Email is required",
                        email     : "Email is not valid"
                    },
                    password      : {
                        required  : "Password is required",
                        minlength : "Password must be at least 8 characters"
                    },
                    conpassword   : {
                        required  : "Confirm Password is required",
                        minlength : "Password must be at least 8 characters",
                        equalTo   : "Password and Confirm Password must match"
                    },
                    role_id       : "Role is required",
                    fees          : "Fees is required"
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }

            });
            //End Validation for Staff Entry and Edit Form

            $('#role_id').change(function(){
                if($('#role_id').val()== 7){
                    var data = $('#role_id').val();
                    $('.fees_div').show();
                }
                else{
                    var data = $('#role_id').val();
                    $('.fees_div').hide();
                }
            });
        });

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
    </script>
@stop