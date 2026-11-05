

@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')
@include ("Front.includes.header")

    <!-- Page header Start -->
    {{-- <div class="page-header parallaxie" style="background-image: url('front/images/page-banners/podcasts.jpg')"> --}}
        <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}');">
        {{-- </div> --}}
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Privacy Policy' }}</h2>                        
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Privacy Policy</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="publishings-section">

        <div class="container">

            <div class="privacy-policy-content"> <span> {!! !empty($policy->description) ? $policy->description : '' !!} </span></div>

        </div>

        
    
    </div>



    @include ("Front.includes.footer")

</body>

</html>