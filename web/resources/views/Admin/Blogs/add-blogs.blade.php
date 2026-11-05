@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/blogs') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">{{ !empty($blog->id) ? 'Edit Blogs' :  'Add Blogs' }}</h4>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('blogs.store') }}" method="post" id="add-blogs-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $blog->id ?? '') }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($blog) ?$blog->heading :  old('heading')}}">
                                    @if($errors->has('heading'))
                                    <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                    @endif
                            </div>
                            <div class="mb-2">
                                <label for="link" class="form-label">Slug URL <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control slug_url" id="slug_url" name="slug_url" value="{{ !empty($blog) ?$blog->slug_url :  old('slug_url')}}">
                                <span class="text-danger d-none" id="slug_url_existence_message"></span>
                                @if($errors->has('slug_url'))
                                <span class="text-danger"><b>* {{ $errors->first('slug_url') }}</b></span>
                                @endif
                            </div> 
                            <div class="row">
                                <div class="col-lg-8">
                                    <label for="heading" class="form-label">Blog By <span class="text-danger">*</span></label>
                                    <input type="text" name="blog_by" id="blog_by" class="form-control" value="{{ !empty($blog->blog_by) ? $blog->blog_by : '' }}">
                                    @if($errors->has('blog_by'))
                                    <span class="text-danger"><b>* {{ $errors->first('blog_by') }}</b></span>
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="date" class="form-label">Date <span class="text-danger"><b></b></span></label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{ !empty($blog) ? $blog->date : old('date') }}" max="{{ date('Y-m-d') }}">
                                        @if($errors->has('date'))
                                        <span class="text-danger"><b>* {{ $errors->first('date') }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            <div class="mb-2 short_description">
                                <label for="subheading" class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea name="short_description" class="form-control" id="short_description" rows="3">{!! !empty($blog->short_description) ? $blog->short_description : old('short_description') !!}</textarea>
                                @if($errors->has('short_description'))
                                <span class="text-danger"><b>* {{ $errors->first('short_description') }}</b></span>
                                @endif
                            </div>
                            
                            <div class="mb-2 description">
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="summernote" id="description" cols="30" rows="10" style="display: none;">{!! !empty($blog->description) ? $blog->description : old('description') !!}</textarea>
                                @if($errors->has('description'))
                                <span class="text-danger"><b>* {{ $errors->first('description') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 blog_img_path">
                                <label class="form-label">Blog Image <span class="text-danger"><b>*</b> Note: image ratio: 6 x 4,
                                    image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="blog_img_path" id="blog_img_path" data-show-remove="false" class="dropify" data-plugins="dropify" data-default-file="{{ !empty($blog->blog_img_path) ? url('/').Storage::url($blog->blog_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('blog_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('blog_img_path') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="meta_title" class="form-label">Meta Title </label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ !empty($blog) ?$blog->meta_title :  old('meta_title')}}">
                        @if($errors->has('meta_title'))
                            <span class="text-danger"><b>* {{ $errors->first('meta_title') }}</b></span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="meta_keyword" class="form-label">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ !empty($blog) ?$blog->meta_keyword :  old('meta_keyword')}}">
                        @if($errors->has('meta_keyword'))
                            <span class="text-danger"><b>* {{ $errors->first('meta_keyword') }}</b></span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ !empty($blog->meta_description) ? $blog->meta_description : old('meta_description') }}</textarea>
                        @if($errors->has('meta_description'))
                            <span class="text-danger"><b>* {{ $errors->first('meta_description') }}</b></span>
                        @endif
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="blog_section">{{ !empty($blog) ? 'Update' : 'Submit' }}</button>
                        @if(empty($blog))
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
    $(".item-blogs").addClass("menuitem-active");
    $(".item-blogs a").addClass("active");
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
        

    $("#add-blogs-form").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
            sub_heading: {
                required:true,
            },
            slug_url: {
                required:true,
                checkSlugFormat: true, 
            },
            blog_by: {
                required: true,
            },
            // date: {
            //     required: true,
            // },
            short_description: {
                required:true,
                maxlength: 250 ,
            },
            description: {
                required: true,
            },
            // meta_title: {
            //     required: true,
            // },
            // meta_keyword: {
            //     required:true,
            // },
            // meta_description: {
            //     required: true,
            // },
            blog_img_path: {
                required: function(element) {
                            return $(element).data('dropify').settings.defaultFile === '';
                        },
                checkFileType: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "blog_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".blog_img_path"));
            }else if (element.attr("name") == "description") {
                error.addClass("text-danger");
                error.insertAfter($(".description"));
            }else if (element.attr("name") == "short_description") {
                error.addClass("text-danger");
                error.insertAfter($(".short_description"));
            }else{
                error.addClass("text-danger");
                error.insertAfter(element);
            }
        },
         onkeyup: function(element) {
            $(element).valid();
         },
         onfocusout: function(element) {
            if ($(element).attr("name") !== "blog_img_path") {
                $(element).valid();
            }
           
         },
       
    });

});
  </script>


<script>
    $(".reset-button").click(function(){
    var drEvent = $('#blog_img_path').dropify(); 
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
            //  var a = $("#slug_url").val(),
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/blogs/check-url-exist') }}",
                    data: {
                        slug_url: $("#slug_url").val(),
                        id: $("#id").val()
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $("#submit-btn").attr("disabled", true);
                            $("#slug_url_existence_message").removeClass("d-none");
                            $("#slug_url_existence_message").html("* This slug URL has already been taken");
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