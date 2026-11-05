

@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')
@include ("Front.includes.header")

    <!-- Page header Start -->
        <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Help Us Out' }}</h2>                              
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Donate</li>
                            </ol>
                        </nav> 
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="donation-section">
        <div class="container">
             <div class="row">
                <div class="col-md-12 col-lg-8">
                    <h2 class="text-anime-style-3">Scan in your banking app to pay</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="donation-card">
                                <h5 class="text-anime-style-3">{{ !empty($donate->scanner_heading_1) ? $donate->scanner_heading_1 : '' }}</h5>
                                <figure class="reveal image-anime w-100">
                                    <img src="{{ !empty($donate->scanner_img_path_1) ? url('/') . Storage::url($donate->scanner_img_path_1) : asset('front/images/donation/paypal.png') }}" alt="" class="parallaxie">
                                </figure>
                                <h5 class="text-anime-style-3 mb-0">Scan. Pay. Go.</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="donation-card">
                                <h5 class="text-center">{{ !empty($donate->scanner_heading_2) ? $donate->scanner_heading_2 : '' }} <sup>®</sup></h5>
                                <figure class="reveal image-anime w-100">
                                    <img src="{{ !empty($donate->scanner_img_path_2) ? url('/') . Storage::url($donate->scanner_img_path_2) : asset('front/images/donation/zelle.png') }}" alt="" class="parallaxie">
                                </figure>
                                <h5 class="text-anime-style-3 mb-0">Scan. Pay. Go.</h5>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-6 col-lg-4 ">
                    <h2 class="text-anime-style-3">Bank Details</h2>
                    <div class="donation-card bank-details-card">
                        <div class="bank-card-content">
                            <h5 class="text-anime-style-3">Bank Name</h5>
                            <p>{{ !empty($donate->bank_name) ? $donate->bank_name : '' }}</p>
                        </div>
                        <div class="bank-card-content">
                            <h5 class="text-anime-style-3">Account Holder Name</h5>
                            <p>{{ !empty($donate->account_holder_name) ? $donate->account_holder_name : '' }}</p>
                        </div>
                        <div class="bank-card-content">
                            <h5 class="text-anime-style-3">Account Number</h5>
                            <p>{{ !empty($donate->account_number) ? $donate->account_number : '' }}</p>
                        </div>
                        <div class="bank-card-content">
                            <h5 class="text-anime-style-3">IFSC Code</h5>
                            <p>{{ !empty($donate->ifsc_code) ? $donate->ifsc_code : '' }}</p>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        
    
    </div>



    @include ("Front.includes.footer")


</body>

</html>