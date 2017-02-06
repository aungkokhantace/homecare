@extends('layouts.master')
@section('title','Configs')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Configs Edit</h1>
    @if(count(Session::get('message')) != 0)
        <div>
        </div>
    @endif

    {!! Form::open(array('url' => 'config', 'class'=> 'form-horizontal user-form-border','files' => true, 'id' => 'configForm')) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="SETTING_COMPANY_NAME" class="text_bold_black">Company Name</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="SETTING_COMPANY_NAME" name="SETTING_COMPANY_NAME" placeholder="Enter Company Name" value="{{ isset($configs)? $configs['SETTING_COMPANY_NAME']:Request::old('SETTING_COMPANY_NAME') }}"/>
            <p class="text-danger">{{$errors->first('SETTING_COMPANY_NAME')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="SETTING_SITE_ACTIVATION_KEY" class="text_bold_black">Site Activation Key</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="SETTING_SITE_ACTIVATION_KEY" name="SETTING_SITE_ACTIVATION_KEY" placeholder="Enter Site Activation Key" value="{{ isset($configs)? $configs['SETTING_SITE_ACTIVATION_KEY']:Request::old('SETTING_SITE_ACTIVATION_KEY') }}"/>
            <p class="text-danger">{{$errors->first('SETTING_SITE_ACTIVATION_KEY')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="TAX_RATE" class="text_bold_black">Tax Percent</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="TAX_RATE" name="TAX_RATE" placeholder="Enter Company Name" value="{{ isset($configs)? $configs['TAX_RATE']:Request::old('TAX_RATE') }}"/>
            <p class="text-danger" id="error_lbl_TAX_RATE">{{$errors->first('TAX_RATE')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="code" class="text_bold_black">Site Logo</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="add_image_div add_image_div_red" style="background-image: url({{$configs['SETTING_LOGO']}});background-position:center;background-size:cover">
            </div>
            <input type="hidden" id="removeImageFlag" value="0" name="removeImageFlag">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="button" class="form-control image_remove_btn" value="Remove Image" id="removeImage" name="removeImage">
        </div>
    </div>
    <br /><br />

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($configs)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('config')">
        </div>
    </div>


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

                                <img id='site_logoPopUp' src="" alt="Load Image"/>
                            </div>
                            <div data-provides="fileinput">
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new" data-trigger="fileinput">Select image</span>
                            <span class="fileinput-exists">Change</span>

                            <input id="site_logo" type="file" name="site_logo" accept="image.*" />
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
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
<script>
    $(document).ready(function() {

        //Start Validation for Config Form
        $('#configForm').validate({
            rules: {
                SETTING_COMPANY_NAME         : 'required',
                TAX_RATE: {
                    required: false,
                    digits: true,
                    max: 100
                }
            },
            messages: {
                SETTING_COMPANY_NAME         : 'Company Name is required',
                TAX_RATE   : {
                    digits      : "Tax Rate must be number only !",
                    max         : "Tax Rate maximum is 100 !"
                },
            }
        });
        //End Validation for Config Form

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
                //$('#site_logoPopUp').attr('src') = '';
                $('#site_logoPopUp').attr('src','');
                $('#site_logo').val(null);
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
                    //$('#site_logoPopUp').attr('src') = '';
                    $('#site_logoPopUp').attr('src','');
                    $('#site_logo').val(null);
            }
            //}

        });
    });

    function saveConfig(action) {
        var rate = $("#TAX_RATE").val();
        $("#error_lbl_TAX_RATE").text("");
        var errorCount = 0;
        if(isNaN(rate)){
            $("#error_lbl_TAX_RATE").text("Invalid Tax Rate !. It allow Number only !");
            errorCount++;
        }

        if(errorCount>0) {
            return;
        }
        else{
            $("#configForm").submit();
        }
    }

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

</script>
@stop