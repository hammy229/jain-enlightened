@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center my-2">
                <h4 class="section-header">{{ !empty($languages->id) ? 'Edit Language' :  'Language' }}</h4>
            </div>
            <div class="col-4">
                <div class="card department-card">
                    <div class="card-body">
                        <form action="{{ route('language.store') }}" method="post" id="languages_section" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $languages->id ?? '') }}">
                            <div class="mb-2">
                                <label for="heading" class="form-label">Language <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($languages->heading) ? $languages->heading :  ''}}">
                                <span class="text-danger d-none" id="heading_existence_message"></span>
                                @if($errors->has('heading'))
                                <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-success" type="submit" name="languages_section">{{ !empty($languages) ? 'Update' : 'Submit' }}</button>
                                @if(empty($languages))
                                 <button type="reset" class="btn btn-danger reset-button">Cancel</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body table-responsive department-card">
                        <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                            <thead class="table-light">
                                <tr role="row">
                                    <th width="10%">Sr. No.</th>
                                    <th width="">Language</th>
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

<script src="{{ URL::asset('admin_panel/controller_js/cn_language.js')}}"></script>

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

    $("#languages_section").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "podcast_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".podcast_img_path"));
            }else{
                error.addClass("text-danger");
                error.insertAfter(element);
            }
        },
         onkeyup: function(element) {
            $(element).valid();
         },
         onfocusout: function(element) {
            if ($(element).attr("name") !== "podcast_img_path") {
                $(element).valid();
            }
         },  
    });

});
 </script>


<script>
    $(".reset-button").click(function(){
        $('.summernote').summernote('code', '');
         
        $(".dropify-clear").trigger("click");
        
    });
    
 </script>



<script>
    $(document).ready(function() {
        function checkUrlExistence() {

            $.ajax({
                type: "get",
                url: "{{ url('admin/master/language/check-url-exist') }}",
                data: {
                    heading: $("#heading").val(),
                    id: $("#id").val()
                },
                success: function(response) {
                    if (response.trim() == "true") {
                        $("#submit-btn").attr("disabled", true);
                        $("#heading_existence_message").removeClass("d-none");
                        $("#heading_existence_message").html("<b>*</b> This language has already been taken");
                    } else {
                        $("#heading_existence_message").addClass("d-none");
                        $("#heading_existence_message").html("");
                        $("#submit-btn").removeAttr("disabled");
                    }
                }
            });
        }
        $("#heading").on("keyup", checkUrlExistence);
    });
</script>

@endsection