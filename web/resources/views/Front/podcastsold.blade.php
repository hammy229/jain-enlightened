
@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')

@include ("Front.includes.header")

    <!-- Page header Start -->
        <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Podcasts' }}</h2>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Podcasts</li>
                            </ol>
                        </nav>                                
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="podcasts-section">
        <div class="container">
            <div class="row">

                @if(!empty($podcasts)&& $podcasts->count() > 0)
                @foreach ($podcasts as $podcast)
                <div class="col-lg-4 col-md-6">
                    <!-- Our Service Item Start -->
                    <div class="our-service-item wow fadeInUp" data-wow-delay="0.5s">
                        <!-- Our Service Image Start -->
                        <div class="our-service-image">
                            <figure class="image-anime">
                                <img src="{{ !empty($podcast->podcast_img_path) ? url('/') . Storage::url($podcast->podcast_img_path) : asset('front/images/page-banners/podcasts.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Our Service Image End -->
                        
                        <!-- Our Service Content Start -->
                        <div class="podcast-content-div">
                            <div class="our-service-content">
                                <div class="service-content-box">
                                    <div class="our-service-title">
                                        <a href="{{ !empty($podcast->youtube_url) ? $podcast->youtube_url : '' }}" data-bs-toggle="modal" data-bs-target="#PodcastVideo">{{ !empty($podcast->heading) ? $podcast->heading : '' }}</a>
                                    </div>
                                </div>
                                <div class="our-service-content-button ">
                                    <a href="{{ !empty($podcast->youtube_url) ? $podcast->youtube_url : '' }}" data-bs-toggle="modal" data-bs-target="#PodcastVideo"><i class="fa fa-play-circle"></i></a>
                                </div>                         
                            </div>                         
                        </div>
                        <!-- Our Service Content End -->
                    </div> 
                    <!-- Our Service Item End -->
                </div>
                @endforeach 
                @endif
            
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="PodcastVideo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: transparent;border: unset;">
        <div class="modal-body p-0 position-relative">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute;right: -15px;top: -15px;background-color: #ffffff;opacity: 1;"></button>
            <div class="podcast-video-popup-div">
                <iframe width="900" height="450" src="{{ !empty($podcast->youtube_url) ? $podcast->youtube_url : '' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
      </div>
    </div>
</div>
    @include ("Front.includes.footer")

    <script>
        $(".podcasts_active").addClass("active");
      </script>
</body>

</html>