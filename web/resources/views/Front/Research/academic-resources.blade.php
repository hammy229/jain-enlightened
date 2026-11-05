
@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')
@include ("Front.includes.header")

<style>
    .research-section .educational-resources .product_card{
        background-color: #fff;
        margin-bottom: 30px;
    }
    .research-section .academics-resources .product_card, .books-and-publications .product_card{
        background-color: #f7f7f7;
        margin-bottom: 30px;
    }
    .books-and-publications .res-read-more i{
        opacity: 1 !important;
        padding-left: 5px !important;
    }
    .books-and-publications span.btn-default {
        font-size: 14px;
        line-height: 0;
        padding: 10px 20px;
        margin-top: 12px;
    }
    .books-and-publications span.btn-default i {
        margin-left: 5px;
    }
    .books-and-publications .product_card:hover span.btn-default::before{
        width: 106%;
        opacity: 1;
    }
    .header-nav {
        display: flex;
        justify-content: center;
        gap: 20px;

        a {
            padding: 10px 20px;
        }
        a.active {
            background-color: #003b49;
            border-radius: 10px;
        }
        a.active h4 {
            color: #f6bf60 !important;
        }
    }
</style>

    <!-- Page header Start -->
    <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Research' }}</h2>                              
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Research</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="research-section">

        <div class="resources-section academics-resources" style="background-color: #fff">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="mb-5">
                        <div class="header-nav">
                          <a class="" href="{{url('/research')}}"><h4 class="text-anime-style-3">Books / Publishing</h4></a>
                          <a class="" href="{{url('/research/educational')}}"><h4 class="text-anime-style-3">Educational Resources</h4></a>
                          <a class="active" href="{{url('/research/academic')}}"><h4 class="text-anime-style-3">Academic Resources</h4></a>
                        </div>
                      </div>
                    <!-- Section Title End -->
                    @if(!empty($researches)&& $researches->count() > 0)
                    @foreach ($researches as $researche)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="product_card">
                            <a href="{{ !empty($researche->research_url) ? $researche->research_url : '' }}" target="_blank">
                                <figure class="image-anime">
                                    <img src="{{ !empty($researche->research_img_path) ? url('/') . Storage::url($researche->research_img_path) : asset('front/images/default/studying-default.jpg') }}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        {{ !empty($researche->heading) ? $researche->heading : '' }}
                                    </h2>
                                    <span class="product_description">{!! !empty($researche->description) ? $researche->description : '' !!}</span>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>

                                </div>
                            </a>
                        </div>
                    </div>

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

                    {{-- <div class="col-md-4">
                        <div class="product_card">
                            <a href="javascript:void(0);">
                                <figure class="image-anime">
                                    <img src="{{URL::asset('front/images/default/studying-default.jpg')}}" alt="">
                                </figure>
                                <div class="product_info">
                                    <h2 class="product_name">
                                        Arham Doshi (Founder) Research Paper
                                    </h2>
                                    <p class="product_description">Loss on AI Translation</p>
                                    <span class="res-read-more">Read More
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div> --}}

                  
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Post Pagination Start -->
                        <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                            <ul class="pagination">
                                {{ $researches->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                        <!-- Post Pagination End -->
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include ("Front.includes.footer")

    <script>
        $(".research_active").addClass("active");
    </script>
</body>

</html>