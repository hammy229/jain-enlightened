@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center my-2">
                <h4 class="section-header">{{ !empty($podcast->id) ? 'Edit Podcast' :  'Podcast' }}</h4>
                
            </div>
            <div class="col-4">
                <div class="card department-card">
                    <div class="card-body">
                        <form action="{{ route('podcast.store') }}" method="post" id="podcast_section" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $podcast->id ?? '') }}">
                            <div class="mb-2">
                                <label for="heading" class="form-label">Podcast Heading <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="heading" name="heading" value="{{ !empty($podcast->heading) ? $podcast->heading :  ''}}">
                                @if($errors->has('heading'))
                                <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Podcast Cover Image <span class="text-danger"> * Note: image ratio: 6 x 4, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" name="podcast_img_path" id="podcast_img_path" class="form-control" data-plugins="dropify" data-default-file="{{ !empty($podcast->podcast_img_path) ? url('/').Storage::url($podcast->podcast_img_path) : '' }}" accept="image/*" />
                                @if($errors->has('podcast_img_path'))
                                <span class="text-danger"><b>* {{ $errors->first('podcast_img_path') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Podcast Youtube Link <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="youtube_url" name="youtube_url" value="{{ !empty($podcast->youtube_url) ? $podcast->youtube_url :  ''}}">
                                @if($errors->has('youtube_url'))
                                <span class="text-danger"><b>* {{ $errors->first('youtube_url') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-success" type="submit" name="podcast_section">{{ !empty($podcast) ? 'Update' : 'Submit' }}</button>
                                @if(empty($podcast))
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
                                    <th width="30%">Heading</th>
                                    {{-- <th width="15%">Language</th> --}}
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
    $(".item-podcast").addClass("menuitem-active");
    $(".item-podcast a").addClass("active");
</script>
<script src="{{ URL::asset('admin_panel/controller_js/cn_podcast.js')}}"></script>
    
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
        

            // Custom method to validate YouTube link
    $.validator.addMethod("youtubeUrl", function(value, element) {
        // Regular expression to match valid YouTube URLs
        var youtubePattern = /^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/;
        return this.optional(element) || youtubePattern.test(value);
    }, "Please enter a valid YouTube URL.");


    $("#podcast_section").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            heading: {
                required: true,
            },
          
            youtube_url: {
                required:true,
                url: true, // For general URL format check
                youtubeUrl: true // Custom method to validate YouTube URL
            },
          
            podcast_img_path: {
                required: function(element) {
                            return $(element).data('dropify').settings.defaultFile === '';
                        },
                checkFileType: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "podcast_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".podcast_img_path"));
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
            if ($(element).attr("name") !== "podcast_img_path") {
                $(element).valid();
            }
         },  
    });

});
  </script>

<script>
    $(".reset-button").click(function(){
        // Reset the Dropify input
        var drEvent = $('#podcast_img_path').dropify(); 
    drEvent = drEvent.data('dropify'); 
    drEvent.resetPreview(); // Reset the Dropify preview
    drEvent.clearElement(); // Clear the Dropify input
        
    });
    
 </script>

@endsection