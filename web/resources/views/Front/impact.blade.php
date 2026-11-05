@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')
@include ("Front.includes.header")

<style>
    .col-md-6.col-6 {
        margin-bottom: 25px;
    }

</style>

    <!-- Page header Start -->
    <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Impact' }}</h2>                              
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Impact</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="impact-section">
        <div class="container">
            <!-- Project Details Box Start -->
            <div class="project-details-box">
                @if(!empty($impacts)&& $impacts->count() > 0)
                    <div class="row">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-3">What have we done?</h2>
                        </div>
                        <!-- Section Title End -->
                    </div>
                @endif

                <div class="row">

                    @if(!empty($impacts)&& $impacts->count() > 0)
                    @foreach ($impacts as $impact)

                    <div class="col-md-12 col-12 col-lg-6 mb-4">
                        <div class="project-details-content d-flex" style="gap: 20px">
                            <img src="{{ !empty($impact->imptact_img_path) ? url('/') . Storage::url($impact->imptact_img_path) : asset('front/images/page-banners/blogs.jpg') }}" alt="" width="140px"  class="wow fadeInUp" data-wow-delay="0.5s">
                            <div class="wow fadeInUp" data-wow-delay="0.5s">
                                <div class="notiglow"></div>
                                <div class="notiborderglow"></div>
                                <div class="impact-header">{{ !empty($impact->heading) ? $impact->heading : '' }}</div>
                                <div class="impact-body">{!! !empty($impact->description) ? $impact->description : '' !!}</div>
                            </div>
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

                </div>
                  <!-- Pagination Links Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                    <ul class="pagination">
                        {{ $impacts->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            </div>
        </div>
        <!-- Pagination Links End -->
            </div>
            <!-- Project Details Box End -->
        </div>

        
    
    </div>



    @include ("Front.includes.footer")

    <script>
        $(".impact_active").addClass("active");
      </script>
</body>

</html>