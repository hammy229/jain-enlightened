@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Terms & Conditions</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('terms.store') }}" method="post" id="add_terms" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($term->id) ? $term->id : '' }}">
                    <div class="mb-2 description">
                        <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                        <textarea name="description" class="summernote" id="description" cols="30" rows="10" style="display: none;">
                        {{ !empty($term->description) ? $term->description : ''}}</textarea>
                        @if ($errors->has('description'))
                        <span class="text-danger error-message"><b>*</b>
                            {{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="term_section"> {{ empty($term) ? 'Submit' : 'Update' }} </button>
                        @if(empty($term)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $(document).ready(function() {

        $('#description').summernote({
            placeholder: 'Enter content here',
            height: 170,

            toolbar: [
        ['style', ['style']],
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['color', ['color']],
        ['fontname', ['fontname']], 
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['insert', ['link']],
        // ['view', ['fullscreen', 'codeview']]
        ['view', ['codeview']]
    ],
    fontNames: [
        'Arial',
        'Arial Black',
        'Comic Sans MS',
        'Courier New',
        'Georgia',
        'Impact',
        'Lucida Console',
        'Tahoma',
        'Times New Roman',
        'Verdana'
    ], 
    fontNamesIgnoreCheck: ['Arial', 'Impact'] 

        });
       

    });
</script>


<script>
    $(document).ready(function () {
   
     $.validator.addMethod("checkFileType", function(value, element) {
    if (!element.files || !element.files[0]) {
        return true;
    }
    var fileType = element.files[0]['type'];
    var validExtensions = ['image/jpeg', 'image/jpg', 'image/png']; // Allowed file extensions
    var fileExtension = fileType.toLowerCase();
    return validExtensions.includes(fileExtension);
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


    $("#add_terms").validate({
        ignore: ".jqte_editor *",
        debug: false,
        rules: {
            description: {
                required: true,
                jqteRequired: true
            },
          
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "description") {
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
                $(element).valid();
        
         },
       
    });
});
  </script>


@endsection