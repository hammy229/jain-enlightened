@section('meta_title') Gallery | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
 <!-- fancy box -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .preview-multiple-div {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
        margin-top: 20px;
    }
    .preview-img-card {
        position: relative;
        display: flex;
        justify-content: center;
        width: 240px;
        height: 150px;
        padding: 20px;
        border-radius: 10px;
        background: #f1f1f1;
    }
    .preview-img-card img{
        height: 100%;
        object-fit: contain;
    }
    .preview-img-card .img-close {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #dee2ef;
        padding: 5px 10px;
        border-radius: 100%;
        font-weight: 700;
        cursor: pointer;
    }
    .img-close:hover svg {
        color: #f00;
    }
    .youtube-video-view {
        border-top: 1px solid #f4bd5f;
        padding-top: 20px;
        margin-top: 20px;
    }
    .video-play-button{
        position: absolute;
        display: flex;
        top: 50%;
        left: 50%;
        width: 50px;
        height: 50px;
        background-color: #003b49;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        transform: translate(-50%, -50%);
        z-index: 3;
    }
    .video-play-button svg{
        color: #f5be5f;
    }

    .video-play-button::before{
        content: '';
        position: absolute;
        top: 0px;
        left: 0px;
        width: 50px;
        height: 50px;
        background-color: #003b49;
        border-radius: 50%;
        animation: border-zooming 1s infinite linear;
        z-index: -1;
    }
    @-webkit-keyframes border-zooming{
        0%{
            transform: scale(0);
            opacity: 1;
        }
        100%{
            transform: scale(1.4);
            opacity: 0;
        }
    }

    .play-btn {
        color: #f00;
        font-size: 20px;
    }
    .play-btn {
        color: #ffffff;
        font-size: 20px;
        border: 2px solid #ffffff;
        line-height: 0;
        padding: 6px 7px 5px 9px;
        border-radius: 100%;
    }
    .play-btn i{
        border: 2px solid red;
        border-radius: 100%;
        padding: 7px 6px 6px 9px;
    }
</style>
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">{{ !empty($video->id) ? 'Edit Video' :  'Video' }}</h4>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-body department-card">
                            <form action="{{ route('gallery_video.store') }}" method="post" id="gallery_link_section" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $video->id ?? '') }}">
                            <div class="col-12 mb-2">
                                <label class="form-label">Upload Youtube Link <span class="text-danger">*</span></label>
                                <input type="text" name="gallery_video_link" id="gallery_video_link" value="{{!empty($video->gallery_video_link) ? $video->gallery_video_link : '' }}" class="form-control"  />
                                @if($errors->has('gallery_video_link'))
                                <span class="text-danger"><b>* {{ $errors->first('gallery_video_link') }}</b></span>
                            @endif
                            </div>
                            <div class="mb-0">
                                {{-- <button type="submit" name="link_section" class="btn btn-success">Add</button> --}}
                                <button class="btn btn-success" type="submit" name="link_section">{{ !empty($video) ? 'Update' : 'Submit' }}</button>
                                @if(empty($video))
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
                                    <th width="30%">Link</th>
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
    $(".gallery ").addClass("menuitem-active");
    $("#gallery").addClass("show");
    $(".video-gallery a").addClass("active");
</script>
<script src="{{ URL::asset('admin_panel/controller_js/cn_gallery_video.js')}}"></script> 


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

         // Custom method to validate YouTube link
         $.validator.addMethod("youtubeUrl", function(value, element) {
        // Regular expression to match valid YouTube URLs
        var youtubePattern = /^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/;
        return this.optional(element) || youtubePattern.test(value);
    }, "Please enter a valid YouTube URL.");

    $("#gallery_image_section").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            
            gallery_img_path: {
               required:true,
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
            if ($(element).attr("name") !== "gallery_img_path") {
                $(element).valid();
            }
           
         },
       
    });

    $("#gallery_link_section").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            
            gallery_video_link: {
                    required: true,
                    url: true, // For general URL format check
                    youtubeUrl: true // Custom method to validate YouTube URL
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "blog_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".blog_img_path"));
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



<script>
    $(document).ready(function(){
        // Delete image
        $('.preview-img-card .img-close').click(function() {
            var imageCard = $(this).closest('.preview-img-card');
            var imageId = imageCard.data('id');

            if(confirm('Are you sure you want to delete this image?')) {
                $.ajax({
                    url: '{{ route("admin.gallery.delete-image", ":id") }}'.replace(':id', imageId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        imageCard.remove(); // Remove image card from the DOM
                    }
                });
            }
        });

        // Delete video
        $('.youtube-video-view .img-close').click(function() {
            var videoCard = $(this).closest('.preview-img-card');
            var videoId = videoCard.data('id');

            if(confirm('Are you sure you want to delete this video?')) {
                $.ajax({
                    url: '{{ route("admin.gallery.delete-video", ":id") }}'.replace(':id', videoId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        videoCard.remove(); // Remove video card from the DOM
                    }
                });
            }
        });
    });
</script>

@endsection