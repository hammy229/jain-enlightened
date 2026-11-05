@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">About Us Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="post" id="about_us_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($about) ? $about->id : '' }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="about_heading" id="about_heading" value="{{ !empty($about) ? $about->about_heading : '' }}">
                                @if($errors->has('about_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('about_heading') }}</b></span>
                                @endif
                            </div>

                            <div class="mb-2 about_description">
                                <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                <textarea name="about_description" class="summernote" id="about_description" cols="30" rows="10" style="display: none;">
                                    {!! !empty($about) ? $about->about_description : '' !!}</textarea>
                                    @if($errors->has('about_description'))
                                    <span class="text-danger"><b>* {{ $errors->first('about_description') }}</b></span>
                                    @endif
                                </div>
        
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 about_img_1_path">
                                <label class="form-label">Image 1 <span class="text-danger"> * Note: image ratio: 4 x 3, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" class="form-control" name="about_img_1_path" id="about_img_1_path" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($about->about_img_1_path) ? url('/').Storage::url($about->about_img_1_path) : '' }}" accept="image/*" />
                                @if($errors->has('about_img_1_path'))
                                <span class="text-danger"><b>* {{ $errors->first('about_img_1_path') }}</b></span>
                                @endif    
                                
                            </div>
                            <div class="mb-2 about_img_2_path">
                                <label class="form-label">Image 2 <span class="text-danger"> * Note: image ratio: 2 x 2, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" class="form-control" name="about_img_2_path" id="about_img_2_path" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($about->about_img_2_path) ? url('/').Storage::url($about->about_img_2_path) : '' }}" accept="image/*" />
                                @if($errors->has('about_img_2_path'))
                                <span class="text-danger"><b>* {{ $errors->first('about_img_2_path') }}</b></span>
                                @endif 
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="about_us_section"> {{ empty($about) ? 'Submit' : 'Update' }} </button>
                        @if(empty($about)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Vision & Mission Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="post" id="vision_mission_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($about) ? $about->id : '' }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Vision</h5>
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" id="vision_heading" name="vision_heading" class="form-control" value="{{ !empty($about) ? $about->vision_heading : '' }}">
                                @if($errors->has('vision_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('vision_heading') }}</b></span>
                                @endif 
                            </div>
        
                            <div class="mb-2 vision_description">
                                <label for="ban_sub_heading" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="vision_description" id="vision_description" class="form-control" rows="4">{!! !empty($about) ? $about->vision_description : '' !!}</textarea>
                                @if($errors->has('vision_description'))
                                <span class="text-danger"><b>* {{ $errors->first('vision_description') }}</b></span>
                                @endif 
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Icon <span class="text-danger"> * Note: image ratio: 2 x 2, image size: less than 5MB, <br> image type: jpg, jpeg, png, svg.</span></label>
                                <input type="file" name="vision_icon_path" id="vision_icon_path" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($about->vision_icon_path) ? url('/').Storage::url($about->vision_icon_path) : '' }}"  accept="image/*" />
                                @if($errors->has('vision_icon_path'))
                                <span class="text-danger"><b>* {{ $errors->first('vision_icon_path') }}</b></span>
                                @endif 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5>Mission</h5>
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" name="mission_heading" id="mission_heading" class="form-control"  value="{{ !empty($about) ? $about->mission_heading : '' }}">
                                @if($errors->has('mission_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('mission_heading') }}</b></span>
                                @endif 
                            </div>
        
                            <div class="mb-2 mission_description">
                                <label for="ban_sub_heading" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea id="mission_description" name="mission_description" class="form-control" rows="4">{!! !empty($about) ? $about->mission_description : '' !!}</textarea>
                                @if($errors->has('mission_description'))
                                <span class="text-danger"><b>* {{ $errors->first('mission_description') }}</b></span>
                                @endif 
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Icon <span class="text-danger"> * Note: image ratio: 2 x 2, image size: less than 5MB,<br>image type: jpg, jpeg, png, svg.</span></label>
                                <input type="file" name="mission_icon_path" id="mission_icon_path" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($about->mission_icon_path) ? url('/').Storage::url($about->mission_icon_path) : '' }}" accept="image/*" />
                                @if($errors->has('mission_icon_path'))
                                <span class="text-danger"><b>* {{ $errors->first('mission_icon_path') }}</b></span>
                                @endif 
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="vision_mission_section"> {{ empty($about) ? 'Submit' : 'Update' }} </button>
                        @if(empty($about)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Personal Journey Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="post" id="personal_journey_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($about) ? $about->id : '' }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" name="journey_heading" id="journey_heading" class="form-control" value="{{ !empty($about) ? $about->journey_heading : '' }}">
                                @if($errors->has('journey_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('journey_heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 journey_description">
                                <label for="description2" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                <textarea name="journey_description" class="summernote" id="description2" cols="30" rows="10" style="display: none;">
                                {!!  !empty($about) ? $about->journey_description : '' !!}</textarea>
                                @if($errors->has('journey_description'))
                                <span class="text-danger"><b>* {{ $errors->first('journey_description') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="button_url" class="form-label">linkedin URL <span class="text-danger">*</span></label>
                                <input type="text"name="linkedin_url" id="linkedin_url" class="form-control" value="{{ !empty($about) ? $about->linkedin_url : '' }}">
                                @if($errors->has('linkedin_url'))
                                <span class="text-danger"><b>* {{ $errors->first('linkedin_url') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 journey_img_path">
                                <label class="form-label">Image <span class="text-danger"> * Note: image ratio: 2 x 2, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="journey_img_path" id="journey_img_path" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($about->journey_img_path) ? url('/').Storage::url($about->journey_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('journey_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('journey_img_path') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="personal_journey_section"> {{ empty($about) ? 'Submit' : 'Update' }} </button>
                        @if(empty($about)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Guidance Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="post" id="guidance_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($about) ? $about->id : '' }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" name="guidance_heading" id="guidance_heading" class="form-control" value="{{ !empty($about) ? $about->guidance_heading : '' }}">
                                @if($errors->has('guidance_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('guidance_heading') }}</b></span>
                                @endif
                            </div>

                            <div class="mb-2 guidance_description">
                                <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                <textarea name="guidance_description" id="guidance_description" class="summernote" id="description" cols="30" rows="10" style="display: none;">
                                    {!! !empty($about) ? $about->guidance_description : '' !!}</textarea>
                                @if($errors->has('guidance_description'))
                                <span class="text-danger"><b>* {{ $errors->first('guidance_description') }}</b></span>
                                @endif
                            </div>
        
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 guidance_img_path">
                                <label class="form-label">Image <span class="text-danger"> * Note: image ratio: 16 x 9, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="guidance_img_path" id="guidance_img_path" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($about->guidance_img_path) ? url('/').Storage::url($about->guidance_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('guidance_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('guidance_img_path') }}</b></span>
                                
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="guidance_section"> {{ empty($about) ? 'Submit' : 'Update' }} </button>
                        @if(empty($about)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Acknowledgment Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="post" id="acknowledgment_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($about) ? $about->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="acknow_heading" id="acknow_heading" class="form-control" value="{{ !empty($about) ? $about->acknow_heading : '' }}">
                        @if($errors->has('acknow_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('acknow_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-2 acknow_description">
                        <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                        <textarea name="acknow_description" class="summernote" id="description5" cols="30" rows="10" style="display: none;">
                            {!! !empty($about) ? $about->acknow_description : '' !!}</textarea>
                        @if($errors->has('acknow_description'))
                        <span class="text-danger"><b>* {{ $errors->first('acknow_description') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="acknowledgment_section"> {{ empty($about) ? 'Submit' : 'Update' }} </button>
                        @if(empty($about)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Strategic Goals Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="post" id="strategic_goals_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($about) ? $about->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading"  class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="strategic_heading" class="form-control" id="strategic_heading" value="{{ !empty($about) ? $about->strategic_heading : '' }}">
                        @if($errors->has('strategic_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('strategic_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="strategic_goals_section"> {{ empty($about) ? 'Submit' : 'Update' }} </button>
                        @if(empty($about)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


<script>
    $(document).ready(function () {
        // Function to capitalize the first letter of a string
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    
        // Event handler for input on heading field
        $('#about_heading,#vision_heading,#mission_heading,#journey_heading,#guidance_heading,#strategic_heading,#acknow_heading').on('input', function() {
            var currentValue = $(this).val();
            $(this).val(capitalizeFirstLetter(currentValue));
        });
    
        $.validator.addMethod("checkFileType", function(value, element) {
            if (!element.files || !element.files[0]) {
                return true;
            }
            var fileType = element.files[0]['type'];
            var validExtensions = ['image/jpeg', 'image/jpg', 'image/png',]; // Allowed file extensions
            return validExtensions.includes(fileType.toLowerCase());
        }, "Please select a valid image file (jpg, jpeg, png).");


        $.validator.addMethod("jqteRequired", function (value, element) {
        // Get the content from the jqte editor
        var editorContent = $(element).val();
        
        // Function to strip HTML tags (similar to PHP's strip_tags)
        function stripTags(input) {
            return input.replace(/<\/?[^>]+(>|$)/g, "");
        }
        // Strip tags from the editor content and remove spaces and newlines
        var strippedContent = stripTags(editorContent).replace(/\s+/g, '').trim();

        // Check if content is empty or only contains tags like <br> or <p><br></p>
        var isInvalid = strippedContent.length === 0 || strippedContent === '<br>' || strippedContent === '';

        return !isInvalid; // Return true if valid content exists
    }, "This field is required.");


    

    
        jQuery.validator.addMethod("checkFileSize", function(value, element) {
        const maxSize = 50 * 1024 * 1024; // 50 MB
        const file = element.files[0];
        if (!file) return true; // If no file is selected, do not validate for file size
        return file.size <= maxSize;
    }, "File size must be less than 50 MB.");


    jQuery.validator.addMethod("checkFileTypes", function(value, element) {
        const allowedExtensions = ['mp4', 'avi', 'mov'];
        const file = element.files[0];
        if (!file) return true; // If no file is selected, do not validate for file type
        const extension = file.name.split('.').pop().toLowerCase();
        return allowedExtensions.includes(extension);
    }, "Please upload a valid video file.");
     
     
    $("#about_us_section").validate({
        ignore: ".jqte_editor *", // Ignoring Summernote's editor elements
        debug: false,
        rules: {
            about_heading: {
                required: true,
            },
            about_description: {
                required: true,
                jqteRequired: true
            },
            about_img_1_path: {
                required: function(element) {
                    return $(element).data('dropify').settings.defaultFile === '';
                },
                checkFileType: true,
            },
            about_img_2_path: {
                required: function(element) {
                    return $(element).data('dropify').settings.defaultFile === '';
                },
                checkFileType: true,
            },
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "about_img_1_path") {
                error.addClass("text-danger");
                error.insertAfter($(".about_img_1_path"));
            } else if (element.attr("name") == "about_img_2_path") {
                error.addClass("text-danger");
                error.insertAfter($(".about_img_2_path"));
            } else if (element.attr("name") == "about_description") {
                error.addClass("text-danger");
                error.insertAfter($(".about_description"));
            } else {
                error.addClass("text-danger");
                error.insertAfter(element);
            }
        },
        onkeyup: function(element) {
            $(element).valid();
        },
        onfocusout: function(element) {
            if ($(element).attr("name") !== "about_img_1_path" || $(element).attr("name") !== "about_img_2_path") {
                    $(element).valid();
                }
        },
    });

        $("#vision_mission_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                vision_heading: {
                    required: true,
                },
                vision_description:{
                    required: true,
                },
               
                vision_icon_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                   // checkFileType: true,
                },
                mission_heading: {
                    required: true,
                },
                mission_description:{
                    required: true,
                },
               
                mission_icon_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                  //  checkFileType: true,
                },
            },

            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "vision_icon_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".vision_icon_path"));
                }  else if (element.attr("name") == "mission_icon_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".mission_icon_path"));
                } else if (element.attr("name") == "vision_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".vision_description"));
                } else if (element.attr("name") == "mission_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".mission_description"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "mission_icon_path" || $(element).attr("name") !== "vision_icon_path") {
                    $(element).valid();
                }
            },
        });

        $("#personal_journey_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                journey_heading: {
                    required: true,
                },
                journey_description:{
                    required: true,
                    jqteRequired: true
                },
               
                journey_img_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileType: true,
                },
                linkedin_url: {
                    required: true,
                    url:true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "journey_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".journey_description"));
                }  else if (element.attr("name") == "journey_img_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".journey_img_path"));
                }  else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "journey_img_path") {
                    $(element).valid();
                }
            },
        });

        $("#guidance_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                guidance_heading: {
                    required: true,
                },
                guidance_description:{
                    required: true,
                    jqteRequired: true
                },
               
                guidance_img_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileType: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "guidance_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".guidance_description"));
                }  else if (element.attr("name") == "guidance_img_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".guidance_img_path"));
                }  else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "guidance_img_path") {
                    $(element).valid();
                }
            },
        });

        $("#acknowledgment_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                acknow_heading: {
                    required: true,
                },
                acknow_description:{
                    required: true,
                    jqteRequired: true
                },
               
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "acknow_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".acknow_description"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "guidance_img_path") {
                    $(element).valid();
                }
            },
        });

            $("#strategic_goals_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                strategic_heading: {
                    required: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                error.insertAfter(element);
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                $(element).valid();
            },
        });

    });
    </script>

@endsection