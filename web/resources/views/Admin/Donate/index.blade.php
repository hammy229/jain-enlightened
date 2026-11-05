@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center my-2">
                <h4 class="section-header">Donate</h4>
            </div>
            <div class="col-12">
                <div class="card department-card">
                    <div class="card-body">
                        <form action="{{ route('donate.store') }}" method="post" id="donate_section" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($donate) ? $donate->id : '' }}">
                            <h4>Bank Details</h4>
                            <div class="mb-2">
                                <label for="heading" class="form-label">Bank Name <span class="text-danger"> *</span></label>
                                <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ !empty($donate) ? $donate->bank_name : '' }}">
                                @if($errors->has('bank_name'))
                                <span class="text-danger"><b>* {{ $errors->first('bank_name') }}</b></span>
                                @endif   
                            </div>
                            <div class="mb-2">
                                <label for="heading" class="form-label">Account Holder Name <span class="text-danger"> *</span></label>
                                <input type="text" name="account_holder_name" id="account_holder_name" class="form-control" value="{{ !empty($donate) ? $donate->account_holder_name : '' }}">
                                @if($errors->has('account_holder_name'))
                                <span class="text-danger"><b>* {{ $errors->first('account_holder_name') }}</b></span>
                                @endif   
                            </div>
                            <div class="mb-2">
                                <label for="heading" class="form-label">Account Number <span class="text-danger"> *</span></label>
                                <input type="text" name="account_number" id="account_number" class="form-control" value="{{ !empty($donate) ? $donate->account_number : '' }}">
                                @if($errors->has('account_number'))
                                <span class="text-danger"><b>* {{ $errors->first('account_number') }}</b></span>
                                @endif   
                            </div>
                            <div class="mb-2">
                                <label for="heading" class="form-label">IFSC Code <span class="text-danger"> *</span></label>
                                <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" value="{{ !empty($donate) ? $donate->ifsc_code : '' }}">
                                @if($errors->has('ifsc_code'))
                                <span class="text-danger"><b>* {{ $errors->first('ifsc_code') }}</b></span>
                                @endif   
                            </div>
                            <h4>Scanner Details</h4>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label for="heading" class="form-label">Scanner Heading <span class="text-danger"> *</span></label>
                                        <input type="text" name="scanner_heading_1" id="scanner_heading_1" class="form-control" value="{{ !empty($donate) ? $donate->scanner_heading_1 : '' }}">
                                        @if($errors->has('scanner_heading_1'))
                                        <span class="text-danger"><b>* {{ $errors->first('scanner_heading_1') }}</b></span>
                                        @endif   
                                    </div>
                                    <div class="mb-2 scanner_img_path_1">
                                        <label class="form-label">Scanner Image <span class="text-danger"> * Note: image ratio: 2 x 2, image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                        <input type="file" name="scanner_img_path_1" id="scanner_img_path_1" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($donate->scanner_img_path_1) ? url('/').Storage::url($donate->scanner_img_path_1) : '' }}" accept="image/*" />
                                        @if($errors->has('scanner_img_path_1'))
                                        <span class="text-danger"><b>* {{ $errors->first('scanner_img_path_1') }}</b></span>
                                        @endif   
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label for="heading" class="form-label">Scanner Heading <span class="text-danger"> *</span></label>
                                        <input type="text" name="scanner_heading_2" id="scanner_heading_2" class="form-control" value="{{ !empty($donate) ? $donate->scanner_heading_2 : '' }}">
                                        @if($errors->has('scanner_heading_2'))
                                        <span class="text-danger"><b>* {{ $errors->first('scanner_heading_2') }}</b></span>
                                        @endif   
                                    </div>
                                    <div class="mb-2 scanner_img_path_2">
                                        <label class="form-label">Scanner Image <span class="text-danger"> * Note: image ratio: 2 x 2, image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                        <input type="file" name="scanner_img_path_2" id="scanner_img_path_2" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($donate->scanner_img_path_2) ? url('/').Storage::url($donate->scanner_img_path_2) : '' }}" accept="image/*" />
                                        @if($errors->has('scanner_img_path_2'))
                                        <span class="text-danger"><b>* {{ $errors->first('scanner_img_path_2') }}</b></span>
                                        @endif   
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-success" type="submit" name="donate_section"> {{ empty($donate) ? 'Submit' : 'Update' }} </button>
                                @if(empty($donate)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </div>
                        </form>
                    </div>
                </div>
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


        $.validator.addMethod("summernoteRequired", function(value, element) {
            // Check if Summernote has some content other than empty paragraphs with line breaks
            var summernoteContent = $(element).summernote('code').trim();
            return summernoteContent.length > 0 && !(/^\s*<p>\s*<br>\s*<\/p>\s*$/).test(summernoteContent) && !(/^\s*<br>\s*$/).test(summernoteContent);
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
     

    $("#donate_section").validate({
        ignore: ".note-editor *", // Ignoring Summernote's editor elements
        debug: false,
        rules: {
            bank_name: {
                required: true,
            },
            account_holder_name: {
                required: true,
            },
            ifsc_code: {
                required: true,
            },
            account_number: {
                required: true,
            },
            scanner_heading_1: {
                required: true,
            },
            scanner_heading_2: {
                required: true,
            },
            scanner_img_path_1: {
                required: function(element) {
                    return $(element).data('dropify').settings.defaultFile === '';
                },
                checkFileType: true,
            },
            scanner_img_path_2: {
                required: function(element) {
                    return $(element).data('dropify').settings.defaultFile === '';
                },
                checkFileType: true,
            },
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "scanner_img_path_1") {
                error.addClass("text-danger");
                error.insertAfter($(".scanner_img_path_1"));
            } else if (element.attr("name") == "scanner_img_path_2") {
                error.addClass("text-danger");
                error.insertAfter($(".scanner_img_path_2"));
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
});
    </script>


@endsection