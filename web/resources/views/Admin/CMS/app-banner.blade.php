@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">{{ !empty($app_banner->id) ? 'Edit App Banner' :  'App Banner' }}</h4>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('appbanner.store') }}" method="post" id="app-banner-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $app_banner->id ?? '') }}">
                            <div class="mb-2">
                                <label for="heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="heading" id="heading" value="{{ !empty($app_banner->heading) ? $app_banner->heading :  ''}}">
                                @if($errors->has('heading'))
                                <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 app_banner_img_path">
                                <label class="form-label">Banner Image <span class="text-danger"> * Note: image ratio: 2 x 1, <br>
                                    image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="app_banner_img_path" class="form-control" id="app_banner_img_path" data-show-remove="false" class="dropify" data-default-file="{{ !empty($app_banner->app_banner_img_path) ? url('/').Storage::url($app_banner->app_banner_img_path) : '' }}" data-plugins="dropify" accept="image/*" />
                                @if($errors->has('app_banner_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('app_banner_img_path') }}</b></span>
                                @endif
                            </div>
        
        
                            <div class="mb-0">
                                <button class="btn btn-success" type="submit" name="lesson_section">{{ !empty($app_banner) ? 'Update' : 'Submit' }}</button>
                                @if(empty($app_banner))
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

<script src="{{ URL::asset('admin_panel/controller_js/cn_app_banner.js')}}"></script>

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

    $("#app-banner-form").validate({
        ignore: ".jqte_editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
            app_banner_img_path: {
                required: function(element) {
                    return $(element).data('dropify').settings.defaultFile === '';
                },
                checkFileType: true,
            },
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "app_banner_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".app_banner_img_path"));
            } else {
                error.addClass("text-danger");
                error.insertAfter(element);
            }
        },
        onkeyup: function(element) {
            $(element).valid();
        },
        onfocusout: function(element) {
            if ($(element).attr("name") !== "app_banner_img_path") {
                $(element).valid();
            }
        },
    });
});
</script>

<script>
$(".reset-button").click(function(){
     // Reset the Dropify input
     var drEvent = $('#app_banner_img_path').dropify(); 
    drEvent = drEvent.data('dropify'); 
    drEvent.resetPreview(); // Reset the Dropify preview
    drEvent.clearElement(); // Clear the Dropify input
});
</script>

@endsection
