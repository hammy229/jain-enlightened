
@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')

@include ("Front.includes.header")

<style>
    .content_div {
    display: flex;
    margin: 0 auto;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    max-width: 1000px;
    }
    .gallery-img {
    color: inherit;
    cursor: pointer;
    /* width: calc(33% - 2rem);
    min-width: calc(33% - 2rem); */
    height: 250px;
    min-height: 250px;
    perspective: 1000px;
    margin-bottom: 2rem;
    position: relative;
    }
    @media screen and (max-width: 800px) {
    .gallery-img {
        width: calc(50% - 2rem);
    }
    }
    @media screen and (max-width: 500px) {
    .gallery-img {
        width: 100%;
    }
    }

    .gallery_front,
    .gallery_back {
    display: flex;
    border-radius: 6px;
    background-position: center;
    background-size: cover;
    text-align: center;
    justify-content: center;
    align-items: center;
    position: absolute;
    height: 100%;
    width: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transform-style: preserve-3d;
    transition: ease-in-out 600ms;
    }

    .gallery_back:before {
    position: absolute;
    display: block;
    content: "";
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #1a9be6, #1a57e6);
    opacity: 0.25;
    z-index: -1;
    border-radius: 15px
    }
    .gallery-img:hover .gallery_front {
    transform: rotateY(180deg);
    }
    .gallery-img:nth-child(even):hover .gallery_front {
    transform: rotateY(-180deg);
    }

    .gallery_back {
        background: #fff;
        transform: rotateY(-180deg);
        padding: 0 2em;
    }

    .gallery-img:hover .gallery_back {
        transform: rotateY(0deg);
    }
    .gallery-img:hover .gallery_back .photo__view {
        background-color: #ffffff7d !important;
    }

</style>

    <!-- Page header Start -->
    <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Gallery' }}</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{URL::asset('/')}}">Home</a></li>
                            <li> Gallery</li>
                        </ol>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="gallery-section">
        <div class="container">
            <div class="gallery-div">
                <div class="gallery-tabs">
                  <div class="taeb-switch left text-center">
                    <div class="taeb active showSingle" taeb-direction="left" target="1">Photos</div>
                    <div class="taeb showSingle" taeb-direction="right" target="2">Videos</div>
                  </div>
                </div>
            </div>
    
            <div class="gallery-content">
                <div class="gallery-images targetDiv gallery_div" id="div1">
                    <div class="row">
                        @if(!empty($gallery_img) && $gallery_img->count() > 0)
                        @foreach ($gallery_img as $img)
                        @php
                        // Get the raw description and remove HTML tags
                        $description = !empty($img->description) ? $img->description : '';
                        $plainTextDescription = strip_tags($description); // Remove HTML tags
            
                        // Limit the plain text description to 10 words
                        $descriptionWords = explode(' ', $plainTextDescription);
                        $limitedDescription = implode(' ', array_slice($descriptionWords, 0, 20)) . (count($descriptionWords) > 10 ? '...' : '');
                       @endphp

                                  {{-- <p>{{ $description }}</p>  --}}

                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <a href="{{ !empty($img->gallery_img_path) ? url('/') . Storage::url($img->gallery_img_path) : asset('front/images/default/studying-default.jpg') }}" data-fancybox="gallery" data-caption="{{ $description }}">
                                    <div class="gallery-img">
                                        <div class="gallery-item">
                                            <div class="gallery_front">
                                                <img src="{{ !empty($img->gallery_img_path) ? url('/') . Storage::url($img->gallery_img_path) : asset('front/images/default/studying-default.jpg') }}" class="img-fluid" alt="">
                                            </div>
                                            <div class="gallery_back">
                                                <div class="photo__view">
                                                    <i class="fa fa-eye"></i>
                                                </div>
                                                <div>
                                                    <p>{{ $limitedDescription }}</p>
                                                    {{-- <p>{!! !empty($img->description) ? $img->description : '' !!}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div><!-- /.col-lg-4 -->          
                            @endforeach
                            @else
                            <div class="no-data-found">
                                <img src="{{URL::asset('front/images/default/No-Data-Found.jpg')}}" alt="No Data Found Image">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <h2 class="text-anime-style-3">
                                        No Data<span class="first-word"> Found</span> <!-- Style for the first word -->
                                            <!-- Remaining words -->
                                    </h2>
                                    <p class="wow fadeInUp" data-wow-delay="0.25s">What you searched was unfortunately not found or doesn't exist.</p>
                                </div>
                                <!-- Section Title End -->
                            </div>
                            @endif
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Post Pagination Start -->
                            <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                                <ul class="pagination photo-pagination">
                                    {{ $gallery_img->links('pagination::bootstrap-4') }}
                                </ul>
                            </div>
                            
                            <!-- Post Pagination End -->
                        </div>
                    </div>
                    </div><!-- /.row -->
                </div>
                <div class="gallery-videos targetDiv" id="div2">
                    <div class="row">
                        @if(!empty($gallery_video) && $gallery_video->count() > 0)
                            @foreach ($gallery_video as $video)
                            @php
                                // Initialize variables
                                $youtubeLink = '';
                                $youtubeThumbnail = '';
                
                                if (!empty($video->gallery_video_link)) {
                                    // Check if the video link is a YouTube link
                                    if (strpos($video->gallery_video_link, 'youtube.com/watch') !== false) {
                                        // Keep the original 'watch?v=' link for the popup player
                                        $youtubeLink = $video->gallery_video_link;
                
                                        // Extract YouTube video ID from the URL
                                        parse_str(parse_url($video->gallery_video_link, PHP_URL_QUERY), $queryParams);
                                        $youtubeVideoId = $queryParams['v'] ?? ''; // Get the 'v' parameter value (video ID)
                
                                        // Construct YouTube thumbnail URL
                                        if (!empty($youtubeVideoId)) {
                                            $youtubeThumbnail = "https://img.youtube.com/vi/$youtubeVideoId/hqdefault.jpg";
                                        }
                                    } else {
                                        // Use the original link if it's not a YouTube link
                                        $youtubeLink = $video->gallery_video_link;
                                    }
                                }
                            @endphp
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="gallery-img">
                                    <a class="video__btn video__btn-white popup-video" href="{{ !empty($youtubeLink) ? $youtubeLink : '' }}">
                                        <div class="video__player">
                                            <i class="fa fa-play"></i>
                                        </div>
                                        <img src="{{ !empty($youtubeThumbnail) ? $youtubeThumbnail : asset('front/images/logo/logo.png') }}" alt="gallery img">
                                    </a>
                                </div><!-- /.gallery-img -->
                            </div><!-- /.col-lg-4 -->
                            @endforeach
                            @else
                            <div class="no-data-found">
                                <img src="{{URL::asset('front/images/default/No-Data-Found.jpg')}}" alt="No Data Found Image">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <h2 class="text-anime-style-3">
                                        No Data<span class="first-word"> Found</span> <!-- Style for the first word -->
                                            <!-- Remaining words -->
                                    </h2>
                                    <p class="wow fadeInUp" data-wow-delay="0.25s">What you searched was unfortunately not found or doesn't exist.</p>
                                </div>
                                <!-- Section Title End -->
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Post Pagination Start -->
                                <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                                    <ul class="pagination video-pagination">
                                        {{ $gallery_video->links('pagination::bootstrap-4') }}
                                    </ul>
                                </div>
                                
                                <!-- Post Pagination End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include ("Front.includes.footer")

    <script>
        $(".gallery_active").addClass("active");
    </script>

<script>
    // $(function() {
    //   var taeb = $(".taeb-switch");
    //   taeb.find(".taeb").on("click", function() {
    //     var $this = $(this);

    //     if ($this.hasClass("active")) return;

    //     var direction = $this.attr("taeb-direction");

    //     taeb.removeClass("left right").addClass(direction);
    //     taeb.find(".taeb.active").removeClass("active");
    //     $this.addClass("active");
    //   });
    //   jQuery('.showSingle').click(function(){
    //       jQuery('.targetDiv').hide('.gallery-content');
    //       jQuery('#div'+$(this).attr('target')).slideToggle();

    //     }); 

    // });

</script>


<script>
        $(document).ready(function() {
        // Handle tab switching
        $('.taeb-switch .taeb').on('click', function() {
            var $this = $(this);
            if ($this.hasClass('active')) return;

            var direction = $this.attr('taeb-direction');
            var target = $this.attr('target');

            $('.gallery-content .targetDiv').hide(); // Hide all content
            $('#div' + target).show(); // Show the selected content
            
            $('.taeb-switch').removeClass('left right').addClass(direction);
            $('.taeb-switch .taeb.active').removeClass('active');
            $this.addClass('active');
        });

        // Handle pagination click event
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault(); // Prevent the default link behavior

            var href = $(this).attr('href'); // Get the href attribute

            // Check if the link belongs to Photos or Videos
            var isPhotoPagination = $(this).closest('.gallery-images').length > 0;
            var target = isPhotoPagination ? '1' : '2';

            // Update active tab
            $('.taeb-switch .taeb[target="' + target + '"]').trigger('click');

            // Load the new page content via AJAX
            $.ajax({
                url: href,
                success: function(data) {
                    var targetDiv = isPhotoPagination ? '#div1' : '#div2';
                    $(targetDiv).html($(data).find(targetDiv).html());
                }
            });
        });
    });

</script>

<script>
    $(document).ready(function() {
        $('.photo__view').on('click', function() {
            // Find the closest anchor tag and trigger its click event
            $(this).['data-fancybox'].trigger('click');
        });
    });
    </script>
</body>

</html>