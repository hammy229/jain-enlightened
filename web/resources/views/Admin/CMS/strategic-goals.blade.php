@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-2">
            <h4 class="section-header">{{ !empty($strategic->id) ? 'Edit Strategic Goals' :  'Strategic Goals' }}</h4>

            {{-- <a class="btn btn-add" href="{{ url('admin/CMS/Testimonials/add-testimonial') }}"><i class="fa-solid fa-plus"></i> Add Testimonial</a> --}}
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('strategic.store') }}" method="post" id="strategic_section" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $strategic->id ?? '') }}">
                            <div class="mb-2">
                                <label for="heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($strategic->heading) ? $strategic->heading :  ''}}">
                                @if($errors->has('heading'))
                                <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 description">
                                <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                <textarea name="description" class="summernote" id="description" cols="30" rows="10" style="display: none;">
                                    {!! !empty($strategic->description) ? $strategic->description :  '' !!}</textarea>
                                    @if($errors->has('description'))
                                    <span class="text-danger"><b>* {{ $errors->first('description') }}</b></span>
                                    @endif
                                </div>
                            <div class="mb-2 strategic_img_path">
                                <label class="form-label">Image <span class="text-danger"> * Note: image ratio: 2 x 2, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="strategic_img_path" id="strategic_img_path" class="form-control" data-show-remove="false" data-plugins="dropify" data-default-file="{{ !empty($strategic->strategic_img_path) ? url('/').Storage::url($strategic->strategic_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('strategic_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('strategic_img_path') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-success" type="submit" name="team_section">{{ !empty($strategic) ? 'Update' : 'Submit' }}</button>
                                @if(empty($strategic))
                                 <button type="reset" class="btn btn-danger reset-button">Cancel</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body table-responsive department-card">
                        <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                            <thead class="table-light">
                                <tr role="row">
                                    <th width="10%">Sr. No.</th>
                                    <th width="30%">Heading</th>
                                    <th width="30%">Image</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
        
                            <tbody>
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".cms").addClass("menuitem-active");
    $("#cms").addClass("show");
    $(".goals-cms a").addClass("active");
</script>
<script src="{{ URL::asset('admin_panel/controller_js/cn_strategic.js')}}"></script>

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
    

    $("#strategic_section").validate({
        ignore: ".jqte_editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
          
            description: {
                required: true,
                jqteRequired: true
            },
          
            strategic_img_path: {
                required: function(element) {
                            return $(element).data('dropify').settings.defaultFile === '';
                        },
                checkFileType: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "strategic_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".strategic_img_path"));
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
    var drEvent = $('#strategic_img_path').dropify(); 
    drEvent = drEvent.data('dropify'); 
    drEvent.resetPreview(); // Reset the Dropify preview
    drEvent.clearElement(); // Clear the Dropify input

    // Refresh the jqte editors to reflect the cleared value
    $('#description').jqteVal(''); // Clear the lesson description jqte editor
    $('#description1').jqteVal(''); // Clear the additional description jqte editor

});
    </script>

@endsection