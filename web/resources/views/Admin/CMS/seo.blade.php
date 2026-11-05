@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">SEO Content</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('seo.store') }}" method="post" id="add-seo-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Pages -->
                        <div class="mb-3">
                            <label for="page" class="form-label">Pages <span class="text-danger"><b> </b></span></label>
                            <select class="form-select" id="page" name="page">
                                <option value="">Select Pages</option>
                                <option value="home">Home</option>
                                <option value="about">About Us</option>
                                <option value="lessons">Lessons</option>
                                <option value="podcasts">Podcast</option>
                                <option value="impact">Impact</option>
                                <option value="research">Research</option>
                                <option value="blogs">Blogs</option>
                                <option value="contact_us">Contact Us</option>
                                <option value="donate">Donate</option>
                                <option value="gallery">Gallery</option>
                                <option value="terms_conditions">Terms and Conditions</option>
                                <option value="privacy_policy">Privacy Policy</option>
                            </select>
                        </div>

                        <!-- Meta Title -->
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title <span class="text-danger"><b> </b></span></label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                            @if($errors->has('meta_title'))
                                <span class="text-danger"><b> {{ $errors->first('meta_title') }}</b></span>
                            @endif
                        </div>
                
                        <!-- Meta Keyword -->
                        <div class="mb-3">
                            <label for="meta_keyword" class="form-label">Meta Keyword <span class="text-danger"><b> </b></span></label>
                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword') }}">
                            @if($errors->has('meta_keyword'))
                                <span class="text-danger"><b> {{ $errors->first('meta_keyword') }}</b></span>
                            @endif
                        </div>
                
                        <!-- Meta Description -->
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description <span class="text-danger"><b> </b></span></label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                            @if($errors->has('meta_description'))
                                <span class="text-danger"><b> {{ $errors->first('meta_description') }}</b></span>
                            @endif
                        </div>
                
                        <!-- Submit Button -->
                        <div class="mb-3">

                        <button class="btn btn-success" name="seo_section" type="submit" id="submitBtn">Submit</button>
                        <button class="btn btn-success" name="seo_section" type="submit" id="updateBtn" style="display: none;">Update</button>
                        <button type="reset" class="btn btn-danger" id="cancelBtn">Cancel</button>
                         
                        </div>
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
        // Initialize the form with default values
        function resetForm() {
            $('#id').val('');
            $('#meta_title').val('');
            $('#meta_keyword').val('');
            $('#meta_description').val('');
            // $('#submitBtn').text('Submit');
            $('#submitBtn').show();
            $('#updateBtn').hide();
            $('#cancelBtn').show();
        }
    
        // Reset form on page load
        resetForm();
    
        $('#page').change(function() {
            var page = $(this).val();
    
            if (page && page !== '') {
                $.ajax({
                    url: '{{ url("admin/seo-data") }}/' + page,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#id').val(data.id);
                        $('#meta_title').val(data.meta_title);
                        $('#meta_keyword').val(data.meta_keyword);
                        $('#meta_description').val(data.meta_description);
                        // $('#submitBtn').text(data.id ? 'Update' : 'Submit');


                        // if (data.id) {
                        //     $('#submitBtn').hide();
                        //     $('#updateBtn').show();
                        // } else {
                        //     $('#submitBtn').show();
                        //     $('#updateBtn').hide();
                        // }

                        if (data.id) {
                            $('#submitBtn').hide();
                            $('#updateBtn').show();
                            $('#cancelBtn').hide();
                        } else {
                            resetForm();
                        }


                    },
                    error: function(xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', error);
                    }
                });
            } else {
                resetForm();
            }
        });
    });
    </script>
    
<script>
$(document).ready(function () {

    // Function to capitalize the first letter of a string
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Event handler for input on heading field
$('#meta_title,#meta_keyword,#meta_description').on('input', function() {
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



$("#add-seo-form").validate({
    ignore: ".note-editor *",
    debug: false,
    rules: {
        page:{
            required:true,
        },
        meta_title: {
            required: true,
        },
        meta_keyword: {
            required:true,
        },
        meta_description: {
            required: true,
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

});
</script>

@endsection