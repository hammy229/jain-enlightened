
@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')
@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')
@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')

@include ("Front.includes.header")
     
<style>
    .home-model
        {
            max-width: 900px;
            height: 100%;
        }
</style>

    <!-- Hero Section Start -->
    <div class="hero hero-video">
        <!-- Video Start -->
		<div class="hero-bg-video">

        <video autoplay muted loop id="myVideo" playsinline ><source src="{{!empty($Home->banner_video_path) ? url('/').Storage::url($Home->banner_video_path) : ''}}" type="video/mp4"></video>
        <!-- Selfhosted Video End -->
		</div>
		<!-- Video End -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <!-- Hero Left Content Start -->
                    <div class="hero-content">
                        <div class="hero-content-title">
                            <h1 class="text-anime-style-3">{{ !empty($Home->heading) ? $Home->heading : '' }}  </h1>
                            <span>{{ !empty($Home->sub_heading) ? $Home->sub_heading : '' }} </span>
                        </div>
                        <div class="hero-content-footer wow fadeInUp" data-wow-delay="0.5s">
                            <a href="{{ !empty($Home->play_link) ? $Home->play_link : '' }}" class="">
                                <img src="{{URL::asset('front/images/Playstore.png')}}" alt="">
                            </a>
                            <a href="{{ !empty($Home->app_link) ? $Home->app_link : '' }}" class="">
                                <img src="{{URL::asset('front/images/AppStore.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Hero Left Content End -->
                </div>

                <div class="col-lg-6 col-md-5">
                    <!-- Hero Video Section Start -->
                    <div class="video-play-button ">
                        {{-- <a href="{{ !empty($Home->you_tube_link) ? $Home->you_tube_link : '' }}" class="popup-video" id="HomeVideo">
                            <img src="{{URL::asset('front/images/play.svg')}}" alt="">
                        </a>    --}}
                        
                        <a href="#" data-bs-toggle="modal" data-bs-target="#HomeVideo" data-url="{{ !empty($Home->you_tube_link) ? $Home->you_tube_link : '' }}"><img src="{{URL::asset('front/images/play.svg')}}" alt=""></a>
                    </div>

                    <!-- Hero Video Section End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- Cargo Shipment Section Start -->
    <div class="cargo-shipment">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <!-- Cargo Shipment Item Start -->
                    <div class="cargo-shipment-item wow fadeInUp"  data-wow-delay="0.25s">
                        <div class="cargo-shipment-image">
                            <img src="{{ !empty($Home->card_image_1_path) ? url('/') . Storage::url($Home->card_image_1_path) : URL::asset('front/images/lessons/img-1.png') }}" alt="">
                        </div>
                        <div class="cargo-shipment-content">
                            <div class="cargo-shipment-icon">
                                <img src="{{ !empty($Home->card_icon_1_path) ? url('/') . Storage::url($Home->card_icon_1_path) : asset('front/images/icons/hamsa.svg') }}" alt="">
                            </div>
                            <h3>{{ !empty($Home->card_heading_1) ? $Home->card_heading_1 : '' }}</h3>
                                <p>{{ !empty($Home->card_description_1) ? $Home->card_description_1 : '' }}</p>
                           
                        </div>
                    </div>
                    <!-- Cargo Shipment Item End -->
                </div>

                <div class="col-md-4">
                    <!-- Cargo Shipment Item Start -->
                    <div class="cargo-shipment-item active wow fadeInUp"  data-wow-delay="0.5s">
                        <div class="cargo-shipment-image">
                            <img src="{{ !empty($Home->card_image_2_path) ? url('/') . Storage::url($Home->card_image_2_path) : URL::asset('front/images/videos/jain-temples.png') }}" alt="">
                        </div>
                        <div class="cargo-shipment-content">
                            <div class="cargo-shipment-icon">
    
                                <img src="{{ !empty($Home->card_icon_2_path) ? url('/') . Storage::url($Home->card_icon_2_path) : asset('front/images/icons/hamsa.svg') }}" alt="">
                            </div>
                            <h3>{{ !empty($Home->card_heading_2) ? $Home->card_heading_2 : '' }}</h3>
                            <p>{{ !empty($Home->card_description_2) ? $Home->card_description_2 : '' }}</p>
                          
                        </div>
                    </div>
                    <!-- Cargo Shipment Item End -->
                </div>

                <div class="col-md-4">
                    <!-- Cargo Shipment Item Start -->
                    <div class="cargo-shipment-item wow fadeInUp"  data-wow-delay="0.75s">
                        <div class="cargo-shipment-image">
                         
                            <img src="{{ !empty($Home->card_image_3_path) ? url('/') . Storage::url($Home->card_image_3_path) : URL::asset('front/images/lessons/img-3.png') }}" alt="">
                        </div>
                        <div class="cargo-shipment-content">
                            <div class="cargo-shipment-icon">
                                <img src="{{ !empty($Home->card_icon_3_path) ? url('/') . Storage::url($Home->card_icon_3_path) : asset('front/images/icons/hamsa.svg') }}" alt="">
                            </div>
                           <h3> {{ !empty($Home->card_heading_3) ? $Home->card_heading_3 : '' }}</h3>
                            <p>{{ !empty($Home->card_description_3) ? $Home->card_description_3 : '' }}</p>
                           
                        </div>
                    </div>
                    <!-- Cargo Shipment Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Cargo Shipment Section End -->

    <!-- Transportation Section Start -->
    <div class="home-transportation">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 order-lg-1 order-md-2 order-2">
                    <!-- Home Transportation Content Start -->
                    <div class="home-transportation-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-3"> {{ !empty($Home->about_heading) ? $Home->about_heading : '' }}</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Home Transportation Body Start -->
                        <div class="home-transportation-body">
                            <p class="wow fadeInUp" data-wow-delay="0.5s">{!! !empty($Home->about_description) ? $Home->about_description : '' !!}</p>
                        </div>
                        <!-- Home Transportation Body End -->

                        <!-- Home Transportation footer Start -->
                        <div class="home-transportation-footer wow fadeInUp"  data-wow-delay="0.75s">
                            <div class="transportation-footer-btn">
                                <a href="{{url('about-us')}}" class="btn-default">About Us</a>
                            </div>     
                        </div>
                        <!-- Home Transportation footer End -->
                    </div>
                    <!-- Home Transportation content End -->
                </div>

                <div class="col-lg-6 col-md-12 order-lg-2 order-md-1 order-1">
                    <!-- Home Transportation Image Start -->
                    <div class="home-transportation-right">
                        <div class="transportation-img-1">
                            <figure class="reveal image-anime">
                                {{-- <video autoplay muted loop id="myVideo"><source src="{{URL::asset('front/images/videos/temple.mp4')}}" type="video/mp4"></video> --}}
                                    <video autoplay muted loop id="myVideo" playsinline><source src="{{!empty($Home->about_video_path) ? url('/').Storage::url($Home->about_video_path) : ''}}" type="video/mp4"></video>
                            </figure>
                        </div>

                        <div class="transportation-img-2">
                            <figure class="reveal image-anime">
                                {{-- <img src="{{URL::asset('front/images/videos/jain-temples.png')}}" alt=""> --}}
                                <img src="{{ !empty($Home->about_image_path) ? url('/') . Storage::url($Home->about_image_path) : asset('front/images/videos/jain-temples.png') }}" alt="">
                            </figure>
                        </div>

                    </div>
                    <!-- Home Transportation Image End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Transportation Section End -->

    <!-- Our Contract Section Start -->
    <div class="our-contract parallaxie">
        <video autoplay muted loop id="myVideo" playsinline><source src="{{URL::asset('front/images/videos/video-1.mp4')}}" type="video/mp4"></video>
        <div class="container">
            <div class="row align-items-center">  
                <div class="col-md-12">
                    <div class="our-cta-box">   
                        <div class="our-contract-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <img src="{{ !empty($Home->founders_image_path) ? url('/') . Storage::url($Home->founders_image_path) : URL::asset('front/images/videos/owner.jpg') }}" alt="" class="wow fadeInUp" data-wow-delay="0.25s" style="border-radius: 5px; aspect-ratio: 2 / 2; object-fit: cover;">
                                </div>
                                <div class="col-lg-8 col-md-12 text-start">
                                    <h2 class="text-anime-style-3">{{ !empty($Home->founders_heading) ? $Home->founders_heading : '' }}</h2>
                                    <div class="founder-content-div">
                                        @php
                                            // Split the description into an array of words
                                            $description = strip_tags($Home->founders_description);
                                            $words = explode(' ', $description);
                                        @endphp
                                        @if(count($words) > 200)
                                            <!-- Show the first 200 words in showing-text-div -->
                                            <div class="showing-text-div">
                                                <p class="" data-wow-delay="0.25s">  {!! implode(' ', array_slice($words, 0, 200)) !!}</p>
                                            </div>
                                    
                                            <!-- Show the rest of the description in moretext-div (hidden by default) -->
                                            <div class="moretext-div" style="display:none;">
                                                <p class="" data-wow-delay="0.25s">  {!! implode(' ', array_slice($words, 200)) !!} </p>
                                            </div>
                                            <!-- Read More / Read Less toggle button -->
                                            <a class="moreless-button text-white text-left" href="javascript:void(0);">Read More ></a>
                                        @else
                                            <!-- Show the full description if it's less than or equal to 200 words -->
                                            <div class="showing-text-div">
                                                <p class="" data-wow-delay="0.25s">{!! $description !!} </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Contract Section End -->

    <!-- recent project section Start -->
    @if(!empty($latest_lesson) && $latest_lesson->count() > 0)
    <div class="recent-project">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h2 class="text-anime-style-3">
                        @if(!empty($Home->lessons_heading))
                            <?php 
                                $headingWords = explode(' ', $Home->lessons_heading, 2); // Split the first word and the rest
                            ?>
                            {{ $headingWords[0] }}<span class="first-word">{{ isset($headingWords[1]) ? ' ' . $headingWords[1] : '' }}</span> <!-- Style for the first word -->
                             <!-- Remaining words -->
                        @endif
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.25s">{{ !empty($Home->lessons_sub_heading) ? $Home->lessons_sub_heading : '' }}</p>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="project-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                            @if(!empty($latest_lesson) && $latest_lesson->count() > 0)
                             @foreach ($latest_lesson as $lesson)
                                <!-- recent projects slide Start -->
                                <div class="swiper-slide">
                                    <div class="project-item">
                                        <div class="project-image">
                                            <figure class="image-anime">
                                                <img src="{{ !empty($lesson->lesson_img_path) ? url('/') . Storage::url($lesson->lesson_img_path) : asset('front/images/lessons/img-1.png') }}" alt="">
                                            </figure>
                                        </div>
                                        <div class="project-content">
                                            <div class="project-content-title">
                                                <h3><a href="{{!empty($lesson->slug_url)?url('lesson/' . Str::slug($lesson->slug_url)):''}}">{{ !empty($lesson->heading) ? $lesson->heading : '' }} - {{ !empty($lesson->language->heading) ? $lesson->language->heading : '' }}</a></h3>
                                                <span><a href="{{!empty($lesson->slug_url)?url('lesson/' . Str::slug($lesson->slug_url)):''}}"><i class="fa-solid fa-arrow-right-long"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- recent projects slide End -->
                                @endforeach
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        {{-- <div class="client-button-prev"><i class="fa-regular fa-circle-left"></i></div>
                        <div class="client-button-next"><i class="fa-regular fa-circle-right"></i></div> --}}
                    </div>
                </div>
            </div>
            
            <!-- Our Service Footer Start -->
            @if(!empty($latest_lesson) && $latest_lesson->count() >= 3)
                <div class="our-service-footer wow fadeInUp" data-wow-delay="1s">
                    <a href="{{URL::asset('lessons')}}" class="btn-default">View All Lessons</a>
                </div>
                @endif
                <!-- Our Service Footer End -->
            
        </div>
    </div>
    @endif 
    <!-- recent project section End -->

    <!-- Explore Our Service Section Start -->
    @if(!empty($latest_podcasts) && $latest_podcasts->count() > 0)
    <div class="our-service podcast-section">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="section-title">
                    {{-- <h2 class="text-anime-style-3">Explore our<span> Podcasts</span></h2> --}}
                    <h2 class="text-anime-style-3">
                        @if(!empty($Home->podcasts_heading))
                            <?php 
                                $headingWords = explode(' ', $Home->podcasts_heading, 2); // Split the first word and the rest
                            ?>
                            {{ $headingWords[0] }}<span class="first-word">{{ isset($headingWords[1]) ? ' ' . $headingWords[1] : '' }} </span> <!-- Style for the first word -->
                            <!-- Remaining words -->
                        @endif
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.25s">{{ !empty($Home->podcasts_sub_heading) ? $Home->podcasts_sub_heading : '' }}</p>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="project-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @if(!empty($latest_podcasts) && $latest_podcasts->count() > 0)
                                @foreach ($latest_podcasts as $podcast)
                                <!-- recent projects slide Start -->
                                <div class="swiper-slide">

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
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#PodcastVideo" data-url="{{ $podcast->youtube_url }}">{{ !empty($podcast->heading) ? $podcast->heading : '' }}</a>
                                                    </div>
                                                </div>
                                                <div class="our-service-content-button">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#PodcastVideo" data-url="{{ $podcast->youtube_url }}"><i class="fa fa-play-circle"></i></a>
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
                            <div class="swiper-pagination"></div>
                        </div>
                        {{-- <div class="client-button-prev"><i class="fa-regular fa-circle-left"></i></div>
                        <div class="client-button-next"><i class="fa-regular fa-circle-right"></i></div> --}}
                    </div>
                </div>
                

                <!-- Our Service Footer Start -->
                {{-- <div class="our-service-footer wow fadeInUp" data-wow-delay="1s">
                    <a href="{{URL::asset('podcasts')}}" class="btn-default">View all Podcasts</a>
                </div> --}}
                @if(!empty($latest_podcasts) && $latest_podcasts->count() >= 3)
                <div class="our-service-footer wow fadeInUp" data-wow-delay="1s">
                    <a href="{{URL::asset('podcasts')}}" class="btn-default">View all Podcasts</a>
                </div>
                @endif
                <!-- Our Service Footer End -->
            </div>
        </div>
    </div>
    @endif
    <!-- Explore Our Service Section End -->

    <!-- latest posts section Start -->
    @if(!empty($latest_blogs) && $latest_blogs->count() > 0)
    <div class="latest-posts">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="section-title">
                    {{-- <h2 class="text-anime-style-3">Our Latest <span> Blogs</span></h2> --}}
                    <h2 class="text-anime-style-3">
                        @if(!empty($Home->blog_heading))
                            <?php 
                                $headingWords = explode(' ', $Home->blog_heading, 2); // Split the first word and the rest
                            ?>
                            {{ $headingWords[0] }}<span class="first-word">{{ isset($headingWords[1]) ? ' ' . $headingWords[1] : '' }} </span> <!-- Style for the first word -->
                         
                        @endif
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay="0.25s">{{ !empty($Home->blog_sub_heading) ? $Home->blog_sub_heading : '' }}</p>
                </div>
                <!-- Section Title End -->
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="project-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @if(!empty($latest_blogs)&& $latest_blogs->count() > 0)
                                @foreach ($latest_blogs as $latest)
                                <div class="swiper-slide">
                                    <!-- Post Item Start -->
                                    <div class="post-item wow fadeInUp" data-wow-delay="0.25s">
                                        <!-- Post Featured Image Start -->
                                        <div class="post-featured-image">
                                            <figure class="image-anime">
                                                <img src="{{!empty($latest->blog_img_path)? url('/').Storage::url($latest->blog_img_path):asset('fronts/img/warehouse.png')}}" alt="">
                                            </figure>
                                        </div>
                                        <!-- Post Featured Image End -->

                                        <!-- Post Body Start -->
                                        <div class="post-body">
                                            <h3><a href="{{!empty($latest->slug_url)?url('blog/' . Str::slug($latest->slug_url)):''}}">{{!empty($latest->heading)?$latest->heading:''}}</a></h3>
                                            @if(!empty($latest->date))
                                            <div class="post-meta">
                                                <ul>
                                                    {{-- <li><i class="fa fa-user me-1"></i> {{!empty($latest->blog_by)?$latest->blog_by:''}} </li> --}}
                                                    <li><i class="fa fa-clock me-1"></i> {{ !empty($latest->date) ? \Carbon\Carbon::parse($latest->date)->format('d-m-Y') : '' }}</li>
                                                </ul>
                                            </div>
                                            @endif
                                            <p>{!! !empty($latest->short_description)?$latest->short_description:'' !!}</p>
                                            <a href="{{!empty($latest->slug_url)?url('blog/' . Str::slug($latest->slug_url)):''}}">
                                                <span class="res-read-more">Read More
                                                    <i class="fa fa-arrow-circle-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <!-- Post Body End -->
                                    </div>
                                    <!-- Post Item End -->
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        {{-- <div class="client-button-prev"><i class="fa-regular fa-circle-left"></i></div>
                        <div class="client-button-next"><i class="fa-regular fa-circle-right"></i></div> --}}
                    </div>
                </div>
            </div>
            <!-- latest Posts section End -->  
            @if(!empty($latest_blogs) && $latest_blogs->count() >= 3)
            <div class="row mt-4">
                <div class="d-flex justify-content-center">
                    <a href="{{URL::asset('blogs')}}" class="btn-default">View All Blogs</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif 
    <!-- recent project section Start -->
    @if(!empty($educational) && $educational->count() > 0)
    <div class="resources-section educational-resources">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="section-title">
                    {{-- <h2 class="text-anime-style-3">Jainism Additional <span> Educational Resources</span></h2> --}}
                    <h2 class="text-anime-style-3">
                        @if(!empty($Home->jain_edu_heading))
                            <?php 
                                // Split the heading into words
                                $headingWords = explode(' ', $Home->jain_edu_heading);
                                // Get the first three words
                                $firstThreeWords = array_slice($headingWords, 0, 2);
                                // Get the remaining part of the sentence
                                $remainingWords = array_slice($headingWords, 2);
                            ?>
                           {{ implode(' ', $firstThreeWords) }} <span class="first-three-words">{{ !empty($remainingWords) ? ' ' . implode(' ', $remainingWords) : '' }}</span> <!-- First three words styled -->
                             <!-- Remaining words -->
                        @endif
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="project-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @if(!empty($educational)&& $educational->count() > 0)
                                @foreach ($educational as $education)
                                <div class="swiper-slide">
                                    <div class="product_card">
                                        <a href="{{ !empty($education->research_url) ? $education->research_url : '' }}" target="_blank">
                                            <figure class="image-anime">
                                                <img src="{{ !empty($education->research_img_path) ? url('/') . Storage::url($education->research_img_path) : asset('front/images/default/studying-default.jpg') }}" alt="">
                                            </figure>
                                            <div class="product_info">
                                                <h2 class="product_name">
                                                    {{ !empty($education->heading) ? $education->heading : '' }}
                                                </h2>
                                                <div class="product_description">{!! !empty($education->description) ? $education->description : '' !!}</div>
                                                <span class="res-read-more">Read More
                                                    <i class="fa fa-arrow-circle-right"></i>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        {{-- <div class="client-button-prev"><i class="fa-regular fa-circle-left"></i></div>
                        <div class="client-button-next"><i class="fa-regular fa-circle-right"></i></div> --}}
                    </div>
                </div>
            </div>
            @if(!empty($educational) && $educational->count() >= 3)
            <div class="row mt-4">
                <div class="d-flex justify-content-center">
                    <a href="{{URL::asset('research/educational')}}" class="btn-default">View All Educational Resources</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif 
    <!-- recent project section End -->
    @if(!empty($academics) && $academics->count() > 0)
    <div class="resources-section academics-resources">
        <div class="container">
            <div class="row">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h2 class="text-anime-style-3">
                        @if(!empty($Home->jain_acd_heading))
                            <?php 
                                // Split the heading into words
                                $headingWords = explode(' ', $Home->jain_acd_heading);
                                // Get the first three words
                                $firstThreeWords = array_slice($headingWords, 0, 3);
                                // Get the remaining part of the sentence
                                $remainingWords = array_slice($headingWords, 3);
                            ?>
                           {{ implode(' ', $firstThreeWords) }} <span class="first-three-words">{{ !empty($remainingWords) ? ' ' . implode(' ', $remainingWords) : '' }}</span> <!-- First three words styled -->
                             <!-- Remaining words -->
                        @endif
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="project-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @if(!empty($academics)&& $academics->count() > 0)
                                @foreach ($academics as $academic)
                                <!-- Section Title End -->
                                <div class="swiper-slide">
                                    <div class="product_card mb-3">
                                        <a href="{{ !empty($academic->research_url) ? $academic->research_url : '' }}" target="_blank">
                                            <figure class="image-anime">
                                                <img src="{{ !empty($academic->research_img_path) ? url('/') . Storage::url($academic->research_img_path) : asset('front/images/default/studying-default.jpg') }}" alt="">
                                            </figure>
                                            <div class="product_info">
                                                <h2 class="product_name">
                                                    {{ !empty($academic->heading) ? $academic->heading : '' }}
                                                </h2>
                                                <p class="product_description">{!! !empty($academic->description) ? $academic->description : '' !!}</p>
                                                <span class="res-read-more">Read More
                                                    <i class="fa fa-arrow-circle-right"></i>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        {{-- <div class="client-button-prev"><i class="fa-regular fa-circle-left"></i></div>
                        <div class="client-button-next"><i class="fa-regular fa-circle-right"></i></div> --}}
                    </div>
                </div>
            </div>
            @if(!empty($academics) && $academics->count() >= 3)
            <div class="row mt-4">
                <div class="d-flex justify-content-center">
                    <a href="{{URL::asset('research/academic')}}" class="btn-default">View All Academic Resources</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif 

    @if(!empty($teastimonials) && $teastimonials->count() > 0)
    <div class="home-testimonials">
        <div class="container">
            <div class="row"> 
                <!-- Section Title Start -->
                <div class="section-title">
                    <h2 class="text-anime-style-3">
                        @if(!empty($Home->testimonials_heading))
                            <?php 
                                $headingWords = explode(' ', $Home->testimonials_heading, 2); // Split the first word and the rest
                            ?>
                           {{ $headingWords[0] }} <span class="first-word">{{ isset($headingWords[1]) ? ' ' . $headingWords[1] : '' }} </span> <!-- Style for the first word -->
                          
                        @endif
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>
            <!-- Swiper -->
            <div class="swiper TestimonialsSwiper">
                <div class="swiper-wrapper">
                    <!-- recent projects slide Start -->
                    @if(!empty($teastimonials) && $teastimonials->count() > 0)
                    @foreach ($teastimonials as $teastimonial)

                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p>{!! !empty($teastimonial->description) ? $teastimonial->description : '' !!}</p>
                            </div>
                            <div class="testimonial-footer">

                                {{-- @if(!empty($teastimonial->teastimonial_img_path)) --}}
                                {{-- <img src="{{ !empty($teastimonial->teastimonial_img_path) ? url('/') . Storage::url($teastimonial->teastimonial_img_path) : asset('front/images/default/studying-default.jpg') }}" alt=""> --}}
                                {{-- @endif --}}
                                <div class="testimonial-person">
                                    <p>{{ !empty($teastimonial->name) ? $teastimonial->name : '' }}</p>
                                    <span>{{ !empty($teastimonial->location) ? $teastimonial->location : '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="swiper-pagination"></div>
            </div> 
        </div> 
    </div>
    @endif 
    <!-- Gallery -->
    @if(!empty($gallery_img) && $gallery_img->count() > 0)
    <section class="my-photo-gallery">
        @if(!empty($gallery_img) && $gallery_img->count() >= 4)
        <div class="container">
            
            <div class="row">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h2 class="text-anime-style-3">
                        @if(!empty($Home->gallery_heading))
                            <?php 
                                $headingWords = explode(' ', $Home->gallery_heading, 2); // Split the first word and the rest
                            ?>
                            <span class="first-word">{{ $headingWords[0] }}</span> <!-- Style for the first word -->
                            {{ isset($headingWords[1]) ? ' ' . $headingWords[1] : '' }} <!-- Remaining words -->
                        @endif
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>
            @if(!empty($gallery_img) && $gallery_img->count() >= 4)
                <div class="gallery-grid mb-5">
                    <div class="row">
                        @foreach($gallery_img as $key => $img)
                            @if($key == 0) 
                                @php $image0 = !empty($img->gallery_img_path) ? url('/') . Storage::url($img->gallery_img_path) : asset('front/images/default/studying-default.jpg') @endphp
                            @elseif($key == 1)
                                @php $image1 = !empty($img->gallery_img_path) ? url('/') . Storage::url($img->gallery_img_path) : asset('front/images/default/studying-default.jpg') @endphp
                            @elseif($key == 2)
                                @php $image2 = !empty($img->gallery_img_path) ? url('/') . Storage::url($img->gallery_img_path) : asset('front/images/default/studying-default.jpg') @endphp
                            @elseif($key == 3)
                                @php $image3 = !empty($img->gallery_img_path) ? url('/') . Storage::url($img->gallery_img_path) : asset('front/images/default/studying-default.jpg') @endphp
                            @endif
                        @endforeach
                        <div class="col-12 col-md-6 gallery__body-one">
                            <a class="gallery-item" href="{{ !empty($image0) ? $image0 : '' }}" data-fancybox="gallery">
                                <img src="{{ !empty($image0) ? $image0 : '' }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="col-12 col-md-6 gallery__body-two">
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-4 mb-md-0 gallery__body-two_top">
                                    <a class="gallery-item" href="{{ !empty($image1) ? $image1 : '' }}" data-fancybox="gallery">
                                        <img src="{{ !empty($image1) ? $image1 : '' }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="col-12 col-sm-6 mb-4 mb-md-1 gallery__body-two_bottom">
                                    <a class="gallery-item" href="{{ !empty($image2) ? $image2 : ''  }}" data-fancybox="gallery">
                                        <img src="{{ !empty($image2) ? $image2 : ''  }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="col-12 col-sm-12 mt-md-3 mt-xxl-4 gallery__body-three_bottom">
                                    <a class="gallery-item" href="{{ !empty($image3) ? $image3 : ''  }}" data-fancybox="gallery">
                                        <img src="{{ !empty($image3) ? $image3 : ''  }}" class="img-fluid" >
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

          @if(!empty($gallery_img) && $gallery_img->count() >= 4)
            <div class="row ">
                <div class="d-flex justify-content-center">
                    <a href="{{URL::asset('gallery')}}" class="btn-default">View All</a>
                </div>
            </div>
         @endif
        </div>
        @endif
      </section>
      @endif     
    <!-- Gallery -->


 <!-- Modal -->
 <div class="modal fade" id="HomeVideo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered home-model">
        <div class="modal-content" style="background: transparent; border: unset; padding:15px;">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: -15px; top: -15px; background-color: #ffffff; opacity: 1;"></button>
                <div class="">
                    <div id="player1" class="click-disable"></div>        
                    {{-- <iframe id="videoFrame" width="900" height="450" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="PodcastVideo" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: transparent; border: unset;">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: -15px; top: -15px; background-color: #ffffff; opacity: 1;"></button>
                <div class="podcast-video-popup-div">
                    <div id="player" class="click-disable"></div>        
                    {{-- <iframe id="videoFrame" width="900" height="450" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                </div>
            </div>
        </div>
    </div>
</div>

    @include ("Front.includes.footer")

    <script>
        $(".home_active").addClass("active");
    </script>

    <script>
        $('.moreless-button').click(function() {
        $('.moretext-div').slideToggle();
        if ($('.moreless-button').text() == "Read More >") {
            $(this).text("Read Less <")
        } else {
            $(this).text("Read More >")
        }
        });
    </script>

<script>

    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    var player1;

    function onYouTubeIframeAPIReady(vlinkurl) {     
        player = new YT.Player('player', {
            height: '500',
            width: '100%',
            videoId: vlinkurl,
            playerVars: {
            'enablejsapi':1,
            'playsinline': 1,   
            'mute':1,         
            'autoplay':1,
            'controls':1
            
            },
            events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
            }
        });

        player1 = new YT.Player('player1', {
            height: '500',
            width: '100%',
            videoId: vlinkurl,
            playerVars: {
            'enablejsapi':1,
            'playsinline': 1,   
            'mute':1,         
            'autoplay':1,
            'controls':1
            
            },
            events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
            }
        });
        
        function onPlayerReady(event) {
        event.target.playVideo();
        }
        var done = false;
        function onPlayerStateChange(event) {       

        }
    }

     // When the modal is shown, update the iframe's src attribute
     $('#HomeVideo').on('show.bs.modal', function (event) {
       
       // Get the button that triggered the modal
       var button = $(event.relatedTarget); // Button that triggered the modal
       var videoUrl = button.data('url'); // Extract info from data-* attributes
       
       // Find the iframe and update its src attribute
       // var modal = $(this);
       // modal.find('#videoFrame').attr('src', videoUrl);
       
       const urlParams = new URLSearchParams(new URL(videoUrl).search);
      var vlinkurl = urlParams.get('v');
      if (player1) {
       player1.loadVideoById(vlinkurl);
       } else {
           createYouTubePlayer(vlinkurl);
       }
   });
    // When the modal is shown, update the iframe's src attribute
    $('#PodcastVideo').on('show.bs.modal', function (event) {
       debugger;
        // Get the button that triggered the modal
        var button = $(event.relatedTarget); // Button that triggered the modal
        var videoUrl = button.data('url'); // Extract info from data-* attributes
        
        // Find the iframe and update its src attribute
        // var modal = $(this);
        // modal.find('#videoFrame').attr('src', videoUrl);
        
        const urlParams = new URLSearchParams(new URL(videoUrl).search);
       var vlinkurl = urlParams.get('v');
       if (player) {
        player.loadVideoById(vlinkurl);
        } else {
            createYouTubePlayer(vlinkurl);
        }
    });

    // When the modal is hidden, clear the iframe's src attribute
    $('#PodcastVideo').on('hide.bs.modal', function () {
        var modal = $(this);
        modal.find('#videoFrame').attr('src', '');
    });

     // When the modal is hidden, clear the iframe's src attribute
     $('#HomeVideo').on('hide.bs.modal', function () {
        var modal = $(this);
        modal.find('#videoFrame').attr('src', '');
    });

</script>

</body>
</html>