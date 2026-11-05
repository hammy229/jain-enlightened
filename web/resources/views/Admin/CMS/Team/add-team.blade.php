@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/cms/team/index') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">{{ !empty($team->id) ? 'Edit Team' :  'Team' }}</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('team.store') }}" method="post" id="team_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $team->id ?? '') }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="heading" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ !empty($team->name) ? $team->name :  ''}}">
                                @if($errors->has('name'))
                                <span class="text-danger"><b>* {{ $errors->first('name') }}</b></span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                                        <input type="text" id="designation" name="designation" class="form-control" value="{{ !empty($team->designation) ? $team->designation :  ''}}">
                                        @if($errors->has('designation'))
                                        <span class="text-danger"><b>* {{ $errors->first('designation') }}</b></span>
                                       @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                 
                                    <div class="mb-2">
                                        <label class="form-label">Team <span class="text-danger"> *</span></label>
                                        <select class="form-select" name="team" id="team" aria-label="Default select example">
                                            <option value="">Select Team</option>
                                         @foreach(config('constant.team_type') as $key => $value)
                                            <option value="{{ $key }}" {{ old('team', $team->team ?? '') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                         @endforeach
                                           
                                        </select>
                                        @if($errors->has('team'))
                                        <span class="text-danger"><b>* {{ $errors->first('team') }}</b></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="linkedin_url" class="form-label">Linkedin Link <span class="text-danger">*</span></label>
                                <input type="text" id="linkedin_url" name="linkedin_url" class="form-control"  value="{{ !empty($team->linkedin_url) ? $team->linkedin_url :  ''}}">
                                @if($errors->has('linkedin_url'))
                                        <span class="text-danger"><b>* {{ $errors->first('linkedin_url') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 description">
                                <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                <textarea name="description" class="summernote" id="description" cols="30" rows="10" style="display: none;">
                                    {!! !empty($team->description) ? $team->description : '' !!}</textarea>
                                @if($errors->has('description'))
                                <span class="text-danger"><b>* {{ $errors->first('description') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 team_img_path">
                                <label class="form-label">Image <span class="text-danger"> * Note: image ratio: 2 x 2, image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="team_img_path" id="team_img_path" class="form-control" data-show-remove="false" data-plugins="dropify" data-default-file="{{ !empty($team->team_img_path) ? url('/').Storage::url($team->team_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('team_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('team_img_path') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="team_section">{{ !empty($team) ? 'Update' : 'Submit' }}</button>
                        @if(empty($team))
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
    $(".cms").addClass("menuitem-active");
    $("#cms").addClass("show");
    $(".team-cms a").addClass("active");
</script>

<script>
    $(document).ready(function () {
   
        // Function to capitalize the first letter of a string
    function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

    // Event handler for input on heading field
    $('#name,#designation,#location,#meta_title,#meta_keyword').on('input', function() {
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


    $("#team_section").validate({
        ignore: ".jqte_editor *",
        debug: false,
        rules: {
            name: {
                required: true,
            },
            team: {
                required: true,
            },
            designation: {
                required:true,
            },
            linkedin_url: {
                required:true,
                url:true,
            },
            description: {
                required: true,
                jqteRequired: true
            },
          
            team_img_path: {
                required: function(element) {
                            return $(element).data('dropify').settings.defaultFile === '';
                        },
                checkFileType: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "team_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".team_img_path"));
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
            if ($(element).attr("name") !== "team_img_path") {
                $(element).valid();
            }
         },  
    });

});
  </script>

<script>
    $(".reset-button").click(function(){
    var drEvent = $('#team_img_path').dropify(); 
    drEvent = drEvent.data('dropify'); 
    drEvent.resetPreview(); // Reset the Dropify preview
    drEvent.clearElement(); // Clear the Dropify input

    // Refresh the jqte editors to reflect the cleared value
    $('#description').jqteVal(''); // Clear the lesson description jqte editor
    $('#description1').jqteVal(''); // Clear the additional description jqte editor

});
    </script>

@endsection