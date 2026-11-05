@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/lessons') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">{{ !empty($lessons->id) ? 'Edit Lesson' :  'Add Lesson' }}</h4>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('lessons.store') }}" method="post" id="lesson_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $lessons->id ?? '') }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="heading" class="form-label">Lesson Heading <span class="text-danger"> *</span></label>
                                <input type="text" name="heading" id="heading" class="form-control" value="{{ !empty($lessons) ?$lessons->heading :  old('heading')}}">
                                @if($errors->has('heading'))
                                <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-2">
                                        <label for="link" class="form-label">Slug URL <span class="text-danger"> *</span></label>
                                        <input type="text" name="slug_url" id="slug_url" class="form-control" value="{{ !empty($lessons) ?$lessons->slug_url :  old('slug_url')}}">
                                        <span class="text-danger d-none" id="slug_url_existence_message"></span>
                                        @if($errors->has('slug_url'))
                                        <span class="text-danger"><b>* {{ $errors->first('slug_url') }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-2">
                                        <label class="form-label">Lesson Language <span class="text-danger"> *</span></label>
                                        <select name="language_id" class="form-select" aria-label="Default select example">
                                            <option value="">Select Language</option>
                                            @foreach($languages as $language)
                                                <option value="{{ $language->id }}" {{ (old('language_id') == $language->id || (isset($lessons) && $lessons->language_id == $language->id)) ? 'selected' : '' }}>
                                                    {{ $language->heading }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('language_id'))
                                            <span class="text-danger"><b>* {{ $errors->first('language_id') }}</b></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 lesson_description">
                                <label for="description" class="form-label">Lesson Description <span class="text-danger"><b>*</b></span></label>
                                <textarea name="lesson_description" class="summernote" id="description" cols="30" rows="10" style="display: none;">
                                    {!! !empty($lessons) ?$lessons->lesson_description :  old('lesson_description') !!}</textarea>
                                @if($errors->has('lesson_description'))
                                <span class="text-danger"><b>* {{ $errors->first('lesson_description') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 additional_description">
                                <label for="description1" class="form-label">Additional Resources <span class="text-danger"><b>*</b></span></label>
                                <textarea name="additional_description" class="summernote" id="description1" cols="30" rows="10" style="display: none;">
                                    {!! !empty($lessons) ?$lessons->additional_description :  old('additional_description') !!} </textarea>
                                @if($errors->has('additional_description'))
                                <span class="text-danger"><b>* {{ $errors->first('additional_description') }}</b></span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 lesson_img_path">
                                <label class="form-label">Lesson Cover Image <span class="text-danger"> * Note: image ratio: 1 x 1, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="lesson_img_path" id="lesson_img_path" class="form-control" data-show-remove="false" data-plugins="dropify" data-default-file="{{ !empty($lessons->lesson_img_path) ? url('/').Storage::url($lessons->lesson_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('lesson_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('lesson_img_path') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="link" class="form-label">Lesson Youtube Link <span class="text-danger"> *</span></label>
                                <input type="text" name="youtube_link" id="youtube_link" class="form-control" value="{{ !empty($lessons) ?$lessons->youtube_link :  old('youtube_link')}}" >
                                @if($errors->has('youtube_link'))
                                <span class="text-danger"><b>* {{ $errors->first('youtube_link') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="meta_title" class="form-label">Meta Title </label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ !empty($lessons) ?$lessons->meta_title :  old('meta_title')}}">
                        @if($errors->has('meta_title'))
                            <span class="text-danger"><b>* {{ $errors->first('meta_title') }}</b></span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="meta_keyword" class="form-label">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ !empty($lessons) ?$lessons->meta_keyword :  old('meta_keyword')}}">
                        @if($errors->has('meta_keyword'))
                            <span class="text-danger"><b>* {{ $errors->first('meta_keyword') }}</b></span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ !empty($lessons->meta_description) ? $lessons->meta_description : old('meta_description') }}</textarea>
                        @if($errors->has('meta_description'))
                            <span class="text-danger"><b>* {{ $errors->first('meta_description') }}</b></span>
                        @endif
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="lesson_section">{{ !empty($lessons) ? 'Update' : 'Submit' }}</button>
                        @if(empty($lessons))
                         <button type="reset" class="btn btn-danger reset-button">Cancel</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    $(".item-lessons").addClass("menuitem-active");
    $(".item-lessons a").addClass("active");
</script>

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
        

            // Custom method to validate YouTube link
    $.validator.addMethod("youtubeUrl", function(value, element) {
        // Regular expression to match valid YouTube URLs
        var youtubePattern = /^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/;
        return this.optional(element) || youtubePattern.test(value);
    }, "Please enter a valid YouTube URL.");


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

    $("#lesson_section").validate({
        ignore: ".jqte_editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
            slug_url: {
                required:true,
                checkSlugFormat: true, 
            },
            lesson_description: {
                required:true,
                jqteRequired: true
            },
            additional_description: {
                required: true,
                jqteRequired: true
            },
            youtube_link: {
                required:true,
                url: true, // For general URL format check
                youtubeUrl: true // Custom method to validate YouTube URL
            },
            lesson_img_path: {
                required: function(element) {
                            return $(element).data('dropify').settings.defaultFile === '';
                        },
                checkFileType: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "lesson_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".lesson_img_path"));
            }else if (element.attr("name") == "lesson_description") {
                error.addClass("text-danger");
                error.insertAfter($(".lesson_description"));
            }else if (element.attr("name") == "additional_description") {
                error.addClass("text-danger");
                error.insertAfter($(".additional_description"));
            }else{
                error.addClass("text-danger");
                error.insertAfter(element);
            }
        },
         onkeyup: function(element) {
            $(element).valid();
         },
         onfocusout: function(element) {
            if ($(element).attr("name") !== "lesson_img_path") {
                $(element).valid();
            }
         },
       
    });

});
  </script>


<script>
    $(".reset-button").click(function(){
    var drEvent = $('#lesson_img_path').dropify(); 
    drEvent = drEvent.data('dropify'); 
    drEvent.resetPreview(); // Reset the Dropify preview
    drEvent.clearElement(); // Clear the Dropify input

    // Refresh the jqte editors to reflect the cleared value
    $('#description').jqteVal(''); // Clear the lesson description jqte editor
    $('#description1').jqteVal(''); // Clear the additional description jqte editor

});
    </script>

    <script>
        $(document).ready(function() {
            function checkUrlExistence() {
            
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/lessons/check-url-exist') }}",
                    data: {
                        slug_url: $("#slug_url").val(),
                        id: $("#id").val()
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $("#submit-btn").attr("disabled", true);
                            $("#slug_url_existence_message").removeClass("d-none");
                            $("#slug_url_existence_message").html("<b>*</b> This slug URL has already been taken");
                        } else {
                            $("#slug_url_existence_message").addClass("d-none");
                            $("#slug_url_existence_message").html("");
                            $("#submit-btn").removeAttr("disabled");
                        }
                    }
                });
            }
    
            $("#slug_url").on("keyup", checkUrlExistence);
        });
    </script>

@endsection