@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center my-2">
                    <h4 class="section-header">General Settings</h4>
                </div>
            </div>
            <div class="col-6">
                <div class="card department-card">
                    <div class="card-body">
                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="header-title ">Add Contact Details</h4>
                        </div>
                        <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_add_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                            
                            <div class="mb-2">
                                <label for="heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="heading" id="heading" value="{{ old('heading', !empty($general_settings->heading) ? $general_settings->heading : '') }}">
                            </div>
                            
                            <div class="mb-2 description">
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', !empty($general_settings->description) ? $general_settings->description : '') }}</textarea>
                            </div>
                            
                            <div class="mb-2">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email', !empty($general_settings->email) ? $general_settings->email : '') }}" >
                                @if($errors->has('email'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('email')}}</span>
                                @endif
                            </div>
                            
                            <div class="mb-2">
                                <label for="mobile" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="{{ old('mobile', !empty($general_settings->mobile) ? $general_settings->mobile : '') }}">
                                @if($errors->has('mobile'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('mobile')}}</span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="address" class="form-label">Address <span class="text-danger"></span></label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{!empty($general_settings->address) ? $general_settings->address : ''}}">
                                @if($errors->has('address'))
                                <span class="text-danger"><b>*</b> {{$errors->first('address')}}</span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Map URL <span class="text-danger"></span></label>
                                <input type="text" class="form-control" id="map_link" name="map_link" value="{{ old('map_link', !empty($general_settings->map_link) ? $general_settings->map_link : '') }}">
                            </div>
                            
                            <button type="submit" name="contact_settings" id="submit_btn" class="btn btn-success"> {{ !empty($general_settings) ? 'Update' : 'Submit' }} </button>
                            @if(empty($general_settings)) <button type="reset" class="btn btn-danger">Cancel</button> @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card " style="height: calc(100% - 1.5rem);">
                    <div class="card-body">
                        <div class="mb-3 justify-content-between d-flex align-items-center">
                            <h4 class="header-title ">Add Social Media Details</h4>
                        </div>
                        <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                            <div class="row">
                                <div class="mb-2 col-12">
                                    <label for="facebook_url" class="form-label">Facebook Url</label>
                                    <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="Facebook URL" value="{{!empty($general_settings->facebook_url) ? $general_settings->facebook_url : ''}}">
                                    @if($errors->has('facebook_url'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('facebook_url')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-2 col-12">
                                    <label for="linkedin_url" class="form-label">LinkedIn Url</label>
                                    <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="LinkedIn URL" value="{{!empty($general_settings->linkedin_url) ? $general_settings->linkedin_url : ''}}">
                                    @if($errors->has('linkedin_url'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('linkedin_url')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-2 col-12">
                                    <label for="instagram_url" class="form-label">Instagram Url</label>
                                    <input type="text" class="form-control" name="instagram_url" id="instagram_url" placeholder="Instagram URL" value="{{!empty($general_settings->instagram_url) ? $general_settings->instagram_url : ''}}">
                                    @if($errors->has('instagram_url'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('instagram_url')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-2 col-12">
                                    <label for="twitter_url" class="form-label">Twitter Url</label>
                                    <input type="text" class="form-control" name="twitter_url" id="twitter_url" placeholder="Twitter URL" value="{{!empty($general_settings->twitter_url) ? $general_settings->twitter_url : ''}}">
                                    @if($errors->has('twitter_url'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('twitter_url')}}</span>
                                    @endif
                                </div>
                            </div>
                             <div class="row">
                                <div class="mb-2 col-12">
                                    <label for="app_store_url" class="form-label">YouTube Url</label>
                                    <input type="text" class="form-control" name="youtube_url" id="youtube_url" placeholder="YouTube URL" value="{{!empty($general_settings->youtube_url) ? $general_settings->youtube_url : ''}}">
                                    @if($errors->has('youtube_url'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('youtube_url')}}</span>
                                    @endif
                                </div>
                            </div>

                            {{--
                            <div class="row">
                                <div class="mb-2 col-12">
                                    <label for="google_play_url" class="form-label">Play Store Url</label>
                                    <input type="text" class="form-control" name="google_play_url" id="google_play_url" placeholder="Twitter URL" value="{{!empty($general_settings->google_play_url) ? $general_settings->google_play_url : ''}}">
                                    @if($errors->has('google_play_url'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('google_play_url')}}</span>
                                    @endif
                                </div>
                            </div> --}}

                            <button type="submit" name="social_media_settings" id="submit_btn" class="btn btn-success"> {{ !empty($general_settings) ? 'Update' : 'Submit' }} </button>
                            @if(empty($general_settings)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                        </form>
                    </div>
                </div> <!-- end card-body -->
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="header-title ">Entrepreneurs Summit</h4>
                        </div>
                        <form action="{{route('geraral.settings.store')}}" method="post" id="entrepreneurs_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-2">
                                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="ent_heading" id="ent_heading" value="{{ old('ent_heading', !empty($general_settings->ent_heading) ? $general_settings->ent_heading : '') }}">
                                        @if($errors->has('ent_heading'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('ent_heading')}}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="mb-2 ent_description">
                                        <label for="ban_sub_heading" class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="ent_description" id="ent_description" class="form-control" rows="4">{{ old('ent_description', !empty($general_settings->ent_description) ? $general_settings->ent_description : '') }}</textarea>
                                        @if($errors->has('ent_description'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('ent_description')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2 ent_image_path">
                                        <label class="form-label">Image <span class="text-danger"> * Note: image size: less than 5MB,<br> image type: jpg, jpeg, png.</span></label>
                                        <input type="file" name="ent_image_path" id="ent_image_path" class="form-control" data-show-remove="false" data-plugins="dropify" accept="image/*" data-default-file="{{!empty($general_settings->ent_image_path) ? url('/').Storage::url($general_settings->ent_image_path) : ''}}" />
                                        @if($errors->has('ent_image_path'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('ent_image_path')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="entrepreneurs" id="submit_btn" class="btn btn-success"> {{ !empty($general_settings) ? 'Update' : 'Submit' }} </button>
                            @if(empty($general_settings)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $(".setting").addClass("menuitem-active");
        $(".general-setting").addClass("menuitem-active");
    </script>



<script>
    $(document).ready(function () {

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    
        $('#heading, #description, #address,#ent_heading').on('input', function() {
            var currentValue = $(this).val();
            $(this).val(capitalizeFirstLetter(currentValue));
        });

           // Mobile number validation: remove any non-numeric characters
        $('#mobile').on('input', function() {
            this.value = this.value.replace(/\D/g, ''); // Remove any non-numeric characters
        });

        $.validator.addMethod("mobileValid", function(value, element) {
                return value.length === 10 && /^\d+$/.test(value); // Check if value consists only of digits and has exactly 10 digits
            }, "Please enter a valid 10-digit mobile number");
        
            $.validator.addMethod("checkFileType", function(value, element) {
                if (!element.files || !element.files[0]) {
                    return true;
                }
                var fileType = element.files[0]['type'];
                var validExtensions = ['image/jpeg', 'image/jpg', 'image/png'];
                return validExtensions.includes(fileType);
            }, "Please select a valid image file (jpg, jpeg, png).");
        
            $.validator.addMethod("domainValidation", function(value, element) {
                return this.optional(element) || /^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+(?:com|in)$/.test(value);
            }, "Please enter a valid email address.");


                 // Custom method to validate YouTube link
        $.validator.addMethod("youtubeUrl", function(value, element) {
            // Regular expression to match valid YouTube URLs
            var youtubePattern = /^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/;
            return this.optional(element) || youtubePattern.test(value);
        }, "Please enter a valid YouTube URL.");

    
        $("#general_settings_contact_add_form").validate({
            ignore: ".note-editor *",
            debug: false,
            rules: {
                heading: {
                    required: true,
                },
                description: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                    domainValidation: true,
                },
                mobile: {
                required: true,
                mobileValid: true,
            },
            map_link: {
                        url: true
                    },
            },
            messages: {
            mobile: {
                minlength: "Please enter at least 10 digits.",
            }
        },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                if (element.attr("name") == "description") {
                    error.insertAfter($(".description"));
                } else {
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                $(element).valid();
            },
        });



        $("#general_settings_contact_form").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
          
            facebook_url: {
                        url: true
                    },
                    youtube_url: {
                        url: true,
                        youtubeUrl: true // Custom method to validate YouTube URL
                    },
                    instagram_url: {
                        url: true
                    },
                    linkedin_url: {
                        url: true
                    },
                    twitter_url: {
                        url: true
                    },
    
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "ban_image_path") {
                error.addClass("text-danger");
                error.insertAfter($(".upload-file"));
            }else if (element.attr("name") == "description") {
                error.addClass("text-danger");
                error.insertAfter($(".description-home-sec-1"));
            }else{
                error.addClass("text-danger");
                error.insertAfter(element);
            }
        },
         onkeyup: function(element) {
            $(element).valid();
         },
         onfocusout: function(element) {
            if ($(element).attr("name") !== "ban_image_path") {
                $(element).valid();
            }
           
         },
       
    });


        $("#entrepreneurs_form").validate({
            ignore: ".note-editor *",
            debug: false,
            rules: {
                ent_heading: {
                    required: true,
                },
                ent_description: {
                    required: true,
                },
                ent_image_path: {
                    required: function(element) {
                    return $(element).data('dropify').settings.defaultFile === '';
                },
                checkFileType: true,  
                },
            },
          
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                if (element.attr("name") == "ent_description") {
                    error.insertAfter($(".ent_description"));
                } else if (element.attr("name") == "ent_image_path") {
                    error.insertAfter($(".ent_image_path"));
                } else {
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "ent_image_path") {
                $(element).valid();
            }
            },
        });

    });
    </script>


    @endsection