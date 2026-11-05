
@section('meta-header')
@section('title',!empty($blog_details->meta_title)?$blog_details->meta_title:'')

@section('meta_description',!empty($blog_details->meta_description)?$blog_details->meta_description:'')

@section('meta_keywords', !empty($blog_details->meta_keyword)?$blog_details->meta_keyword:'')
@include ("Front.includes.header")

<style>
    .page-header-box h2 {
        font-size: 35px;
    }
</style>


{{-- {{dd($blog_details->meta_title)}} --}}

{{-- @endsection --}}

    <!-- Page header Start -->
    {{-- <div class="page-header parallaxie" style="background-image: url('front/images/page-banners/blogs.jpg')"> --}}
        <div class="page-header parallaxie blogs-details-banner" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/blogs.jpg') }}');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <!-- Page Header box Start -->
                        <div class="page-header-box">
                            <h2 class="text-anime-style-3">{{!empty($blog_details->heading)?$blog_details->heading:''}}</h2>
                            <div class="post-single-meta wow fadeInUp" data-wow-delay="0.25s">
                                <ul >
                                    <li><i class="fa fa-user me-1"></i> {{!empty($blog_details->blog_by)?$blog_details->blog_by:''}}</li>
                                @if(!empty($blog_details->date))
                                    <li><i class="fa fa-calendar-week me-1"></i> {{ !empty($blog_details->date) ? \Carbon\Carbon::parse($blog_details->date)->format('d-m-Y') : '' }}</li>
                                @endif   
                                </ul>
                            </div>                            
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
    <!-- Page Header End -->

    <!-- Single Post Page Start -->
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <!-- Blog Detail Content Start -->
                    <div class="blog-detail-content">
                        <!-- Blog Detail Featured Image Start -->
                        <div class="blog-detail-featured-image">
                            <figure class="reveal image-anime w-100">
                                {{-- <img src="https://images.squarespace-cdn.com/content/v1/6650a27fede8cf4e2c2b6827/1723607312835-O3Y71RVK3FY3G61HQLWK/Jain+Diaspora.jpeg?format=1500w" alt="" class="parallaxie"> --}}
                                <img src="{{!empty($blog_details->blog_img_path)? url('/').Storage::url($blog_details->blog_img_path):asset('fronts/img/warehouse.png')}}" height="" class="blog-details-image" alt="" class="parallaxie">
                            </figure>
                        </div>
                        <!-- Blog Detail Featured Image End -->

                        <!-- Blog Detail Post Content Start -->
                        <div class="blog-detail-post-content wow fadeInUp" data-wow-delay="0.75s">
                           <p>{!! !empty($blog_details->description)?$blog_details->description:'' !!}</p>
                        </div>
                        <!-- Blog Detail Post Content End -->


                        @php

                                $facebook_share_url = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($blog_url);
                                $twitter_share_url = "https://twitter.com/intent/tweet?url=" . urlencode($blog_url) . "&text=" . urlencode($blog_details->heading);
                                $linkedin_share_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . urlencode($blog_url) . "&title=" . urlencode($blog_details->heading);
                                 
                                // $facebook_share_url = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($blog_url);
                                // $twitter_share_url = "https://twitter.com/intent/tweet?url=" . urlencode($blog_url) . "&text=" . urlencode($blog_details->heading);
                                // $linkedin_share_url = "https://www.linkedin.com/shareArticle?url=" . urlencode($blog_url) . "&title=" . urlencode($blog_details->heading);
                        @endphp

                        <!-- Post Extra Info Start -->
                    <div class="row align-items-center">

                        <div class="col-lg-4">
                            <!-- Post Sharing Links Start -->
                            <div class="post-social-links wow fadeInUp" data-wow-delay="0.25s">
                                <p>Share to </p>
                                <ul>
                                    <li><a href="{{ $facebook_share_url }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="{{ $linkedin_share_url }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="{{ $twitter_share_url }}" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                                        </svg></a></li>
                                </ul>
                            </div>
                            <!-- Post Sharing Links End -->
                        </div>
                    </div>
                    <!-- Post Extra Info End -->
                    </div>
                    <!-- Blog Detail Content End -->
                </div>
                <div class="col-lg-4  col-md-12 position-relative">
                    <!-- Service Details sidebar Start -->
                    <div class="service-details-sidebar">


                        <div class="blog-details-post-widget wow fadeInUp" data-wow-delay="0.5s">
                            <div class="footer-info-heading">
                                <h2>Latest Blogs</h2>
                            </div>
                            <div class="post-widget-body">
                                <!-- Recent Post Item Start -->

                                @if(!empty($latest_blogs)&& $latest_blogs->count() > 0)
                                
                                @foreach ($latest_blogs as $latest)


                                <div class="recent-post-item">
                                    <div class="recent-post-feature-img">
                                        <figure>
                                            {{-- <a href="#"><img src="https://images.squarespace-cdn.com/content/v1/6650a27fede8cf4e2c2b6827/1723607312835-O3Y71RVK3FY3G61HQLWK/Jain+Diaspora.jpeg?format=1500w" alt="img"></a> --}}
                                            <a href="{{!empty($latest->slug_url)?url('blog-details/' . Str::slug($latest->slug_url)):''}}"><img src="{{!empty($latest->blog_img_path)? url('/').Storage::url($latest->blog_img_path):asset('fronts/img/warehouse.png')}}" alt="img"></a>
                                        </figure>
                                    </div>

                                    <div class="recent-post-content">
                                        <h3><a href="{{!empty($latest->slug_url)?url('blog/' . Str::slug($latest->slug_url)):''}}">{{ !empty($latest->heading) ? $latest->heading : '' }}</a></h3>
                                        <div class="post-readmore">
                                            <a href="{{!empty($latest->slug_url)?url('blog/' . Str::slug($latest->slug_url)):''}}">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Recent Post Item End -->
                                @endforeach
                                @else
                                    <div class="no-latest-blogs">
                                        <p>No latest blogs available.</p>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                    <!-- Service Details sidebar End -->
                </div>
            </div>
        </div>
    </div> 
    <!-- Single Post Page End -->

    @include ("Front.includes.footer")

    <script>
        $(".blogs_active").addClass("active");
    </script>

</body>

</html>