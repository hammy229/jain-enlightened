@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Banner</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('banner.store') }}" method="post" id="add-banner-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Pages <span class="text-danger">*</span></label>
                        <select class="form-select" name="page" id="page" aria-label="Default select example">
                            <option value="">Select Pages</option>
                            <option value="about_us">About Us</option>
                            <option value="blogs">Blogs</option>
                            <option value="contact_us">Contact Us</option>
                            <option value="donate">Donate</option>
                            <option value="gallery">Gallery</option>
                            <option value="impact">Impact</option>
                            <option value="lessons">Lessons</option>
                            <option value="podcasts">Podcasts</option>
                            <option value="privacy_policy">Privacy Policy</option>
                            <option value="research">Research</option>
                            <option value="terms_conditions">Terms & Conditions</option>     
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" id="heading">
                        @if($errors->has('heading'))
                        <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                        @endif
                    </div>
                    <div class="mb-2 upload-file">
                        <label class="form-label">Banner Image <span class="text-danger"> * Note: image ratio: 18 x 4, image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                        <input type="file" name="ban_image_path" class="form-control" id="ban_image_path" data-show-remove="false" class="dropify" data-plugins="dropify" accept="image/*" />
                        @if($errors->has('ban_image_path'))
                        <span class="text-danger"><b>* {{ $errors->first('ban_image_path') }}</b></span>
                        @endif
                    </div>


                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="banner_section" id="submitBtn">Submit</button>
                        <button class="btn btn-success" type="submit" name="banner_section" id="updateBtn" style="display: none;">Update</button>
                        <button type="reset" class="btn btn-danger reset-button " id="cancelBtn">Cancel</button>
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
    // Initialize Dropify
    var drEvent = $('#ban_image_path').dropify();

    // Function to reset and clear Dropify
    function clearDropify() {
        drEvent = $('#ban_image_path').dropify({
            defaultFile: null
        });
        drEvent = drEvent.data('dropify');
        drEvent.resetPreview();
        drEvent.clearElement();
        drEvent.settings.defaultFile = null;
    }

    // Function to handle showing and hiding buttons
    function handleButtons(showUpdate) {
        if (showUpdate) {
            $('#submitBtn').hide();
            $('#updateBtn').show();
            $('#cancelBtn').hide();
        } else {
            $('#submitBtn').show();
            $('#cancelBtn').show();
            $('#updateBtn').hide();
        }
    }

    // Reset form and Dropify
    function resetForm() {
        $('#id').val('');
        $('#heading').val('');
        clearDropify();
        handleButtons(false); // Show Submit button, hide Update button
    }

    $('#page').change(function() {
        var page = $(this).val();

        if (page) {
            $.ajax({
                url: '{{ url("admin/banner-data") }}/' + page,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);

                    if (data.Banner_Data && data.Banner_Data.id) {
                        $('#id').val(data.Banner_Data.id);
                        $('#heading').val(data.Banner_Data.heading);

                        var imageUrl = data.banner_path;

                        if (imageUrl) {
                            // Update Dropify image preview if an image is available
                            drEvent = $('#ban_image_path').dropify({
                                defaultFile: imageUrl
                            });

                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = imageUrl;
                            drEvent.destroy();
                            drEvent.init();
                        } else {
                            // Clear Dropify image preview if no image is available
                            clearDropify();
                        }

                        // Show Update button, hide Submit button
                        handleButtons(true);
                    } else {
                        // Reset form and Dropify if no data is found
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
            // If no page selected, reset the form and Dropify
            resetForm();
        }
    });

    // Reset form and Dropify on page load
    resetForm();
});
</script>

<script>
$(document).ready(function () {
    // Function to capitalize the first letter of a string
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Event handler for input on heading field
    $('#heading').on('input', function() {
        var currentValue = $(this).val();
        $(this).val(capitalizeFirstLetter(currentValue));
    });

    $.validator.addMethod("checkFileType", function(value, element) {
        if (!element.files || !element.files[0]) {
            return true;
        }
        var fileType = element.files[0]['type'];
        var validExtensions = ['image/jpeg', 'image/jpg', 'image/png']; // Allowed file extensions
        return validExtensions.includes(fileType.toLowerCase());
    }, "Please select a valid image file (jpg, jpeg, png).");

    $("#add-banner-form").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
            page:{
                required: true,
            },
            ban_image_path: {
                required: function(element) {
                    return $(element).data('dropify').settings.defaultFile === '';
                },
                checkFileType: true,
            },
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "ban_image_path") {
                error.addClass("text-danger");
                error.insertAfter($(".upload-file"));
            } else {
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

<script>
$(".reset-button").click(function() {
    // Reset the Dropify input
    var drEvent = $('#ban_image_path').dropify(); 
    drEvent = drEvent.data('dropify'); 
    drEvent.resetPreview(); // Reset the Dropify preview
    drEvent.clearElement(); // Clear the Dropify input
});

</script>

@endsection
