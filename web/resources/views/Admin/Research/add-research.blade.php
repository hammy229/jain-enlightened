@section('meta_title') Research | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/research') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">{{ !empty($research->id) ? 'Edit Research' :  'Add Research' }}</h4>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('podcasts.store') }}" method="post" id="research_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $research->id ?? '') }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($research->heading) ? $research->heading :  ''}}">
                                        @if($errors->has('heading'))
                                        <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                        @endif
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Select Resources <span class="text-danger">*</span></label>
                                        <select class="form-select" id="resources" name="resources" aria-label="Default select example">
                                            <option value="">Select Resources</option>
                                            @foreach(config('constant.resources_type') as $key => $value)
                                                <option value="{{ $key }}" {{ old('resources', $research->resources ?? '') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        
                                          </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-2 description">
                                    <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                    <textarea name="description" class="summernote" id="description" cols="30" rows="10" style="display: none;">
                                        {!! !empty($research->description) ? $research->description :  ''!!}</textarea>
                                    @if($errors->has('description'))
                                    <span class="text-danger"><b>* {{ $errors->first('description') }}</b></span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 research_img_path">
                                <label class="form-label">Upload Image <span class="text-danger">* Note: image ratio: 16 x 9, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="research_img_path" id="research_img_path" class="form-control" data-show-remove="false" data-plugins="dropify" data-default-file="{{ !empty($research->research_img_path) ? url('/').Storage::url($research->research_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('research_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('research_img_path') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="link" class="form-label">Document Link <span class="text-danger">*</span></label>
                                <input type="text" id="research_url" name="research_url" class="form-control" value="{{ !empty($research->research_url) ? $research->research_url :  ''}}">
                                @if($errors->has('research_url'))
                                <span class="text-danger"><b>* {{ $errors->first('research_url') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="team_section">{{ !empty($research) ? 'Update' : 'Submit' }}</button>
                        @if(empty($research))
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
    $(".item-research").addClass("menuitem-active");
    $(".item-research a").addClass("active");
</script>
 
<script>
    $(document).ready(function () {
   
        // Function to capitalize the first letter of a string
 function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Event handler for input on heading field
    $('#heading,#designation,#location,#meta_title,#meta_keyword').on('input', function() {
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


    $("#research_section").validate({
        ignore: ".jqte_editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
                maxlength: 65,
            },
            description: {
                required: true,
                jqteRequired: true
            },
            resources:{
                required: true,
            },
            research_url: {
                required: true,
                url:true,
            },
          
            research_img_path: {
                required: function(element) {
                            return $(element).data('dropify').settings.defaultFile === '';
                        },
                checkFileType: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "research_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".research_img_path"));
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
            if ($(element).attr("name") !== "strategic_img_path") {
                $(element).valid();
            }
         },  
    });

});
  </script>

<script>
    $(".reset-button").click(function(){
    var drEvent = $('#research_img_path').dropify(); 
    drEvent = drEvent.data('dropify'); 
    drEvent.resetPreview(); // Reset the Dropify preview
    drEvent.clearElement(); // Clear the Dropify input

    // Refresh the jqte editors to reflect the cleared value
    $('#description').jqteVal(''); // Clear the lesson description jqte editor
    $('#description1').jqteVal(''); // Clear the additional description jqte editor

});
    </script>

@endsection