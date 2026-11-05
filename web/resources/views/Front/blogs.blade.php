@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')
@include ("Front.includes.header")

    <!-- subpage header Start -->
    {{-- <div class="page-header parallaxie" style="background-image: url('front/images/page-banners/blogs.jpg')"> --}}
        <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/blogs.jpg') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Blogs' }}</h2>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Blogs</li>
                            </ol>
                        </nav>                                
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Page section Start -->
    <div class="latest-posts blog-page">
        <div class="container">
            <div class="row">
                @if(!empty($Blogs)&& $Blogs->count() > 0)
                @foreach ($Blogs as $Blog)
                <div class="col-lg-4 col-md-6">
                    <!-- Post Item Start -->
                    <div class="post-item wow fadeInUp" data-wow-delay="0.25s">
                        <!-- Post Featured Image Start -->
                        <div class="post-featured-image">
                            <figure class="image-anime">
                                <img src="{{ !empty($Blog->blog_img_path) ? url('/') . Storage::url($Blog->blog_img_path) : asset('front/images/page-banners/blogs.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Body Start -->
                        <div class="post-body">
                            <h3><a href="{{!empty($Blog->slug_url)?url('blog/' . Str::slug($Blog->slug_url)):''}}">{{ !empty($Blog->heading) ? $Blog->heading : '' }}</a></h3>
                            @if(!empty($Blog->date))
                            <div class="post-meta">
                                <ul>
                                    {{-- <li><i class="fa fa-user me-1"></i> {{ !empty($Blog->blog_by) ? $Blog->blog_by : '' }}</li> --}}
                                    <li><i class="fa fa-calendar-week me-1"></i> {{ !empty($Blog->date) ? \Carbon\Carbon::parse($Blog->date)->format('d-m-Y') : '' }}</li>
                                </ul>
                            </div>
                           @endif
                            <p>{!! !empty($Blog->short_description) ? $Blog->short_description : '' !!}</p>
                            <a href="{{!empty($Blog->slug_url)?url('blog/' . Str::slug($Blog->slug_url)):''}}">
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
            
            {{-- <div class="row">
				<div class="col-md-12">
					<!-- Post Pagination Start -->
					<div class="post-pagination wow fadeInUp" data-wow-delay="1s">
						<ul class="pagination">
							<li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
						</ul>
					</div>
					<!-- Post Pagination End -->
				</div>
			</div> --}}

            <div class="row">
                <div class="col-md-12">
                    <!-- Post Pagination Start -->
                    <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                        {{ $Blogs->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- Post Pagination End -->
                </div>
            </div>

          
        </div>
    </div>
    <!-- Blog Page section End -->
    
    @include ("Front.includes.footer")

    <script>
        $(".blogs_active").addClass("active");
      </script>

</body>

</html>