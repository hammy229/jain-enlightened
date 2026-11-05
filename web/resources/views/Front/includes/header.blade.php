
@php $General_setting = App\Helpers\Helpers\Helper::General_setting() @endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="description" content="">
    <meta name="keywords" content=""> --}}
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    @yield('meta-header')
    <meta name="jain enlightened" content="">
    <!-- Favicon Icon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('front/images/logo/logo.png')}}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->favicon_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->favicon_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->favicon_image_path) : URL::asset('front/images/logo/logo.png') }}">
    <!-- Google Fonts Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{URL::asset('front/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
    <!-- SlickNav Css -->
    <link href="{{URL::asset('front/css/slicknav.min.css')}}" rel="stylesheet">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{URL::asset('front/css/swiper-bundle.min.css')}}">
    <!-- Font Awesome Icon Css-->
    <link href="{{URL::asset('front/css/all.min.css')}}" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="{{URL::asset('front/css/animate.css')}}" rel="stylesheet">
    <!-- Magnific Css -->
    <link href="{{URL::asset('front/css/magnific-popup.css')}}" rel="stylesheet">
    <!-- Main Custom Css -->
    <link href="{{URL::asset('front/css/custom.css')}}" rel="stylesheet" media="screen">
     <!-- fancy box -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

          <!-- Toastr Css -->
    <link rel="stylesheet" href="{{URL::asset('package_assets/libs/toastr/build/toastr.min.css')}}" />
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
    </head>

<body class="tt-magic-cursor">

    <!-- Preloader Start -->
    {{-- <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="{{URL::asset('front/images/logo/logo.png')}}" alt=""></div>
        </div>
    </div> --}}
    <!-- Preloader End -->

    <div class="top-up" style="position: fixed;">
        <a href="#"><i class="fa-solid fa-arrow-up"></i></a>
    </div>

    <!-- Magic Cursor Start -->
    <div id="magic-cursor">
        <div id="ball"></div>
    </div>
    <!-- Magic Cursor End -->

    <!-- Topbar Section Start -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-7">
                    <!-- Topbar Contact Information Start -->
                    <div class="topbar-contact-info">
                        <ul>
                            {{-- <li><a href="#"><i class="fa-solid fa-location-dot"></i>  Lorem ipsum dolor, sit amet consectetur.</a></li>
                            <li><a href="#"><i class="fa-solid fa-at"></i>  you@your-domain.com</a></li> --}}
                       
                            <li class="topbar-contact-map">     
                            @if(!empty($General_setting->address))
                                <p><i class="fa-solid fa-location-dot"></i>{{ !empty($General_setting->address) ? $General_setting->address : '' }}</p>
                                @endif
                            </li>
                            <li>
                                @if(!empty($General_setting->email)) 
                                <a href="mailto:{{ !empty($General_setting->email) ? $General_setting->email : '' }}"><i class="fa-regular fa-envelope"></i>  {{ !empty($General_setting->email) ? $General_setting->email : '' }}</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <!-- Topbar Contact Information End -->
                </div>

                <div class="col-lg-4 col-md-5">
                    <!-- Topbar Social Links Start -->
                    <div class="topbar-social-links">
                        <ul>
                            {{-- <li><a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="https://www.youtube.com/@JainEnlightened/videos" target="_blank"><i class="fa-brands fa-youtube"></i></a></li> 
                            <li><a href="https://www.linkedin.com/company/jain-enlightened/" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>  --}}

                            @if(!empty($General_setting->facebook_url))
                            <li><a href="{{ !empty($General_setting->facebook_url) ? $General_setting->facebook_url : '' }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            @endif
                            @if(!empty($General_setting->youtube_url))
                            <li><a href="{{ !empty($General_setting->youtube_url) ? $General_setting->youtube_url : '' }}" target="_blank"><i class="fa-brands fa-youtube"></i></a></li> 
                            @endif
                            @if(!empty($General_setting->linkedin_url))
                            <li><a href="{{ !empty($General_setting->linkedin_url) ? $General_setting->linkedin_url : '' }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                            @endif
                            @if(!empty($General_setting->instagram_url))
                            <li><a href="{{ !empty($General_setting->instagram_url) ? $General_setting->instagram_url : '' }}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li> 
                            @endif
                            @if(!empty($General_setting->twitter_url))
                            <li><a href="{{ !empty($General_setting->twitter_url) ? $General_setting->twitter_url : '' }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                                </svg></a></li> 
                            @endif
                        </ul>
                    </div>
                    <!-- Topbar Social Links End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar Section End -->

    <!-- Header Start -->
    <header class="main-header">
        <div class="header-sticky">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <!-- Logo Start -->
                    <a class="navbar-brand" href="{{URL::asset('/')}}"><img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('front/images/logo/logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" alt="" style=""></a>
                    {{-- <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('front/images/logo/logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" alt="" width="" height="50"> --}}
                    <!-- Logo End -->
                    <!--Donate Start-->
                    <div class="mobile-donate-btn-div">
                        <a href="{{URL::asset('donation')}}" class="mobile-donate-btn"><img src="{{URL::asset('front/images/icons/pay.png')}}" alt="" style="width: 21px;"></a>
                    </div>                           
                    <!--Donate End-->

                    <!-- Main Menu Start -->
                    <div class="collapse navbar-collapse main-menu">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item"><a class="nav-link home_active" href="{{URL::asset('/')}}">Home</a></li>
                            <li class="nav-item"><a class="nav-link about_active" href="{{URL::asset('about-us')}}">About Us</a></li>
                            <li class="nav-item"><a class="nav-link lessons_active" href="{{URL::asset('lessons')}}">Lessons</a></li>
                            <li class="nav-item"><a class="nav-link podcasts_active" href="{{URL::asset('podcasts')}}">Podcasts</a></li>
                            <li class="nav-item"><a class="nav-link impact_active" href="{{URL::asset('impact')}}">Impact</a></li>
                            <li class="nav-item"><a class="nav-link research_active" href="{{URL::asset('research')}}">Research</a></li>
                            <li class="nav-item"><a class="nav-link blogs_active" href="{{URL::asset('blogs')}}">Blogs</a></li> 
                            <li class="nav-item"><a class="nav-link contact_active" href="{{URL::asset('contact-us')}}">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Main Menu End -->

                    <!--Donate Start-->
                    <div class="header-contact-us">
                        <a href="{{URL::asset('donation')}}" class="desktop-donate-btn"><img src="{{URL::asset('front/images/icons/pay.png')}}" alt="" style="width: 25px;">Donate</a>
                    </div>                           
                    <!--Donate End-->

                    <div class="navbar-toggle"></div>                         
                </div>
            </nav>

            <div class="responsive-menu"></div>
        </div>
    </header>
    <!-- Header End -->