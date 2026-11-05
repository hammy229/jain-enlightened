@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Internship Opportunities</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('intern.store') }}" method="post" id="internship_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($intern) ? $intern->id : '' }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" name="heading" id="heading" class="form-control"  value="{{ !empty($intern) ? $intern->heading : '' }}">
                                @if($errors->has('heading'))
                                <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                @endif
                            </div>
        
                            <div class="mb-2">
                                <label for="ban_sub_heading" class="form-label">Sub Heading <span class="text-danger">*</span></label>
                                <textarea name="sub_heading" id="sub_heading" class="form-control" rows="2">{!! !empty($intern) ? $intern->sub_heading : '' !!}</textarea>
                                @if($errors->has('sub_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('sub_heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 description">
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="4">{!! !empty($intern) ? $intern->description : '' !!}</textarea>
                                @if($errors->has('description'))
                                <span class="text-danger"><b>* {{ $errors->first('description') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 intern_img_path">
                                <label class="form-label">Background Image <span class="text-danger"> * Note: image ratio: 16 x 9, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="intern_img_path" id="intern_img_path" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($intern->intern_img_path) ? url('/').Storage::url($intern->intern_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('intern_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('intern_img_path') }}</b></span>
                                @endif
                            
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="Internship_section"> {{ empty($intern) ? 'Submit' : 'Update' }} </button>
                        @if(empty($intern)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
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
    $('#heading,#sub_heading,#location,#meta_title,#meta_keyword').on('input', function() {
        var currentValue = $(this).val();
        $(this).val(capitalizeFirstLetter(currentValue));
    });

     $.validator.addMethod("checkFileType", function(value, element) {
    if (!element.files || !element.files[0]) {
        return true;
    }
    var fileType = element.files[0]['type'];
    var validExtensions = ['image/jpeg', 'image/jpg', 'image/png']; // Allowed file extensions
    var fileExtension = fileType.toLowerCase();
    return validExtensions.includes(fileExtension);
    }, "Please select a valid image file (jpg, jpeg, png).");

    // Custom validator method for slug URL check
    $.validator.addMethod("checkSlugFormat", function(value, element) {
            // This regex allows lowercase letters, numbers, and hyphens, but no spaces or other characters
            return /^[a-z0-9-]+$/.test(value);
        }, "Slug can only contain lowercase letters, numbers, and hyphens.");
        

    $("#internship_section").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
            sub_heading: {
                required: true,
            },
         
            description: {
                required: true,
            },
          
            intern_img_path: {
                required: function(element) {
                            return $(element).data('dropify').settings.defaultFile === '';
                        },
                checkFileType: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "intern_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".intern_img_path"));
            }else if (element.attr("name") == "description") {
                error.addClass("text-danger");
                error.insertAfter($(".description"));
            }else{
                error.addClass("text-danger");
                error.insertAfter(element);
            }
        },
         onkeyup: function(element) {
            $(element).valid();
         },
         onfocusout: function(element) {
            if ($(element).attr("name") !== "intern_img_path") {
                $(element).valid();
            }
         },  
    });

});
  </script>

@endsection