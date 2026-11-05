@php $General_setting = App\Helpers\Helpers\Helper::General_setting() @endphp

@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')

@include ("Front.includes.header")

    <!-- Page header Start -->
    {{-- <div class="page-header parallaxie" style="background-image: url('front/images/page-banners/contact.jpg')"> --}}
        <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/contact.jpg') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Contact' }}</h2>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Contact</li>                              
                            </ol>
                        </nav>                                
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Get In Touch Section Start -->
    <div class="get-in-touch">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 mb-3">
                    <!-- Get Quote Start -->
                    <div class="get-quote">
                        <h2 class="text-anime-style-3">Drop us a line</h2>
                        <div class="get-quote-content">
                            <p class="wow fadeInUp" data-wow-delay="0.5s">Please fill out the form below to get in touch with us. We'll get back to you as soon as possible.</p>
                        </div>
                        <div class="get-quote-form wow fadeInUp" data-wow-delay="0.75s">
                            <form action="{{ route('contacts.store') }}" method="post" id="add-contact-form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Full Name *">
                                        @if($errors->has('name'))
                                        <span class="text-danger error-message"><b>*</b> {{$errors->first('name')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group  col-md-12 mb-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email *">
                                        @if($errors->has('email'))
                                        <span class="text-danger error-message"><b>*</b> {{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group  col-md-12 mb-3">
                                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter Your Mobile No. *">
                                        @if($errors->has('mobile_no'))
                                        <span class="text-danger error-message"><b>*</b> {{$errors->first('mobile_no')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <textarea  class="form-control" name="message" id="message" rows="3" placeholder="Write Your Message *"></textarea>
                                        @if($errors->has('message'))
                                        <span class="text-danger error-message"><b>*</b> {{$errors->first('message')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-roup col-md-12 mb-3">
                                        <div id="CaptchaDiv">
                                            <div class="Captcha-Div">
                                                <span id="captcha"></span>
                                                <span id="refresh"><i class="fa-solid fa-rotate"></i></span>  
                                                <input id="textBox" type="text" name="text" class="form-control " placeholder="Enter Captcha ">
                                            </div> 
                                            <span id="output"></span>
                                          </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default" id="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Get Quote End -->
                </div>

                <div class="col-lg-5 col-md-12 mb-3">
                    <div class="contact-us">
                        @if(!empty($General_setting->heading))
                        <h2 class="text-anime-style-3">{{ !empty($General_setting->heading) ? $General_setting->heading : '' }}</h2>
                        @endif
                        @if(!empty($General_setting->description))
                        <p class="wow fadeInUp mb-4" data-wow-delay="0.25s">{{ !empty($General_setting->description) ? $General_setting->description : '' }}</p>
                        @endif
                        <!-- Contact Us Info Start -->
                        <div class="contact-us-info">
                            <div class="footer-info-box wow fadeInUp" data-wow-delay="0.25s">
                                <div class="icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M405.333 213.874V106.667c0-23.531-19.135-42.667-42.667-42.667h-320C19.135 64 0 83.135 0 106.667V320c0 23.531 19.135 42.667 42.667 42.667h239.215C295.858 411.84 341.073 448 394.667 448c20.625 0 40.906-5.427 58.677-15.708 5.094-2.948 6.844-9.469 3.885-14.573-2.948-5.104-9.479-6.865-14.573-3.885-14.521 8.396-31.115 12.833-47.99 12.833-52.938 0-96-43.063-96-96s43.063-96 96-96 96 43.063 96 96v10.667c0 11.76-9.573 21.333-21.333 21.333-11.76 0-21.333-9.573-21.333-21.333v-42.667A10.66 10.66 0 0 0 437.333 288c-2.869 0-5.447 1.161-7.362 3-9.428-8.401-21.714-13.667-35.305-13.667-29.406 0-53.333 23.927-53.333 53.333S365.26 384 394.667 384c15.896 0 30.03-7.131 39.81-18.202 7.727 10.977 20.44 18.202 34.857 18.202C492.865 384 512 364.865 512 341.333v-10.667c0-61.097-46.956-111.378-106.667-116.792zM42.667 85.333h320c.444 0 .816.227 1.254.254L211.438 210.75c-5.427 3.417-13.292 2.708-16.823.542L41.426 85.585c.433-.026.801-.252 1.241-.252zM384 213.874c-59.711 5.414-106.667 55.695-106.667 116.793 0 3.6.221 7.148.54 10.667H42.667c-11.76 0-21.333-9.573-21.333-21.333V106.667c0-3.021.667-5.874 1.805-8.48L182.022 228.48c6.208 4.052 13.344 6.188 20.646 6.188 7.021 0 13.885-1.979 19.927-5.729a10.367 10.367 0 0 0 1.719-1.156l157.88-129.598c1.139 2.608 1.807 5.461 1.807 8.483v107.206zm10.667 148.793c-17.646 0-32-14.354-32-32s14.354-32 32-32 32 14.354 32 32-14.354 32-32 32z" fill="#f6bf60" opacity="1" data-original="#000000" class=""></path></g></svg>
                                </div>
                                @if(!empty($General_setting->email))
                                <a href="mailto:{{ !empty($General_setting->email) ? $General_setting->email : '' }}">{{ !empty($General_setting->email) ? $General_setting->email : '' }}</a>
                                @endif
                            </div>
                            
                            <div class="footer-info-box wow fadeInUp" data-wow-delay="0.75s">
                                <div class="icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="22" x="0" y="0" viewBox="0 0 473.806 473.806" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M374.456 293.506c-9.7-10.1-21.4-15.5-33.8-15.5-12.3 0-24.1 5.3-34.2 15.4l-31.6 31.5c-2.6-1.4-5.2-2.7-7.7-4-3.6-1.8-7-3.5-9.9-5.3-29.6-18.8-56.5-43.3-82.3-75-12.5-15.8-20.9-29.1-27-42.6 8.2-7.5 15.8-15.3 23.2-22.8 2.8-2.8 5.6-5.7 8.4-8.5 21-21 21-48.2 0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5-6-6.2-12.3-12.6-18.8-18.6-9.7-9.6-21.3-14.7-33.5-14.7s-24 5.1-34 14.7l-.2.2-34 34.3c-12.8 12.8-20.1 28.4-21.7 46.5-2.4 29.2 6.2 56.4 12.8 74.2 16.2 43.7 40.4 84.2 76.5 127.6 43.8 52.3 96.5 93.6 156.7 122.7 23 10.9 53.7 23.8 88 26 2.1.1 4.3.2 6.3.2 23.1 0 42.5-8.3 57.7-24.8.1-.2.3-.3.4-.5 5.2-6.3 11.2-12 17.5-18.1 4.3-4.1 8.7-8.4 13-12.9 9.9-10.3 15.1-22.3 15.1-34.6 0-12.4-5.3-24.3-15.4-34.3l-54.9-55.1zm35.8 105.3c-.1 0-.1.1 0 0-3.9 4.2-7.9 8-12.2 12.2-6.5 6.2-13.1 12.7-19.3 20-10.1 10.8-22 15.9-37.6 15.9-1.5 0-3.1 0-4.6-.1-29.7-1.9-57.3-13.5-78-23.4-56.6-27.4-106.3-66.3-147.6-115.6-34.1-41.1-56.9-79.1-72-119.9-9.3-24.9-12.7-44.3-11.2-62.6 1-11.7 5.5-21.4 13.8-29.7l34.1-34.1c4.9-4.6 10.1-7.1 15.2-7.1 6.3 0 11.4 3.8 14.6 7l.3.3c6.1 5.7 11.9 11.6 18 17.9 3.1 3.2 6.3 6.4 9.5 9.7l27.3 27.3c10.6 10.6 10.6 20.4 0 31-2.9 2.9-5.7 5.8-8.6 8.6-8.4 8.6-16.4 16.6-25.1 24.4-.2.2-.4.3-.5.5-8.6 8.6-7 17-5.2 22.7l.3.9c7.1 17.2 17.1 33.4 32.3 52.7l.1.1c27.6 34 56.7 60.5 88.8 80.8 4.1 2.6 8.3 4.7 12.3 6.7 3.6 1.8 7 3.5 9.9 5.3.4.2.8.5 1.2.7 3.4 1.7 6.6 2.5 9.9 2.5 8.3 0 13.5-5.2 15.2-6.9l34.2-34.2c3.4-3.4 8.8-7.5 15.1-7.5 6.2 0 11.3 3.9 14.4 7.3l.2.2 55.1 55.1c10.3 10.2 10.3 20.7.1 31.3zM256.056 112.706c26.2 4.4 50 16.8 69 35.8s31.3 42.8 35.8 69c1.1 6.6 6.8 11.2 13.3 11.2.8 0 1.5-.1 2.3-.2 7.4-1.2 12.3-8.2 11.1-15.6-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3 3.7-15.6 11s3.5 14.4 10.9 15.6zM473.256 209.006c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2 3.7-15.5 11-1.2 7.4 3.7 14.3 11.1 15.6 46.6 7.9 89.1 30 122.9 63.7 33.8 33.8 55.8 76.3 63.7 122.9 1.1 6.6 6.8 11.2 13.3 11.2.8 0 1.5-.1 2.3-.2 7.3-1.1 12.3-8.1 11-15.4z" fill="#f6bf60" opacity="1" data-original="#000000" class=""></path></g></svg>
                                </div>
                                @if(!empty($General_setting->mobile))
                                <a href="tel:{{ !empty($General_setting->mobile) ? $General_setting->mobile : '' }}">{{ !empty($General_setting->mobile) ? $General_setting->mobile : '' }}</a>
                                @endif
                            </div>

                            <div class="footer-info-box wow fadeInUp footer-info-map" data-wow-delay="0.5s">
                                <div class="icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><defs><clipPath id="a" clipPathUnits="userSpaceOnUse"><path d="M0 512h512V0H0Z" fill="#f6bf60" opacity="1" data-original="#000000"></path></clipPath></defs><g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="M0 0c0-38.07-30.861-68.932-68.932-68.932-38.07 0-68.931 30.862-68.931 68.932 0 38.07 30.861 68.932 68.931 68.932C-30.861 68.932 0 38.07 0 0Z" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(324.932 350.68)" fill="none" stroke="#f6bf60" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="M0 0c-27.55 35.6-70.81 56.87-115.83 56.87-45.02 0-88.28-21.27-115.83-56.87-31.07-40.16-36.63-88.55-20.3-135.84 15.7-45.46 49.04-83.37 76.3-122.44 19.5-27.95 39-55.9 58.5-83.86l1.33-1.9 1.33 1.9c19.5 27.96 39 55.91 58.5 83.86 27.26 39.07 60.6 76.98 76.3 122.44C36.63-88.55 31.07-40.16 0 0Z" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(371.83 440.165)" fill="none" stroke="#f6bf60" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path><path d="m0 0-42.65-26.94 134.4-84.9 134.4 84.9L183.5 0" style="stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1" transform="translate(164.25 126.805)" fill="none" stroke="#f6bf60" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity="" data-original="#000000" opacity="1" class=""></path></g></g></svg>
                                </div>
                                @if(!empty($General_setting->address))
                                <p>{{ !empty($General_setting->address) ? $General_setting->address : '' }}</p>
                                @endif
                            </div>

                        </div>
                        <!-- Contact Us Info End -->

                        <!-- Contact Us Footer Start -->
                        <div class="contact-us-footer wow fadeInUp" data-wow-delay="1s">
                            <div class="topbar-social-links contact-details">
                                <ul>
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
                        </div>
                        <!-- Contact Us Footer End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Get In Touch Section End -->

    <!-- Google Map Iframe Start -->
    <div class="google-map">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(!empty($General_setting->map_link))
                    <div class="google-map-iframe">
                        <iframe src="{{ !empty($General_setting->map_link) ? $General_setting->map_link : '' }}" style="border:0;height:350px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Google Map Iframe End -->

    @include ("Front.includes.footer")
      

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(".contact_active").addClass("active");
    </script>

<script>
    
   $(document).ready(function() {
    // Allow only numeric values for the mobile number field
    $('#mobile_no').on('input', function() {
        var newValue = this.value.replace(/\D/g, ''); // Remove non-numeric characters
        this.value = newValue;
    });

    // Custom validator for mobile number (10 digits)
    $.validator.addMethod("mobileValid", function(value, element) {
        return this.optional(element) || (value.length === 10 && /^\d+$/.test(value));
    }, "Please enter a valid 10-digit mobile number");

    // Custom validator for email domain
    $.validator.addMethod("domainValidation", function(value, element) {
        return this.optional(element) || /^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+(?:com|in)$/.test(value);
    }, "Please enter a valid email address.");

    // Custom validator for captcha
    $.validator.addMethod("captchaValid", function(value, element) {
        return value === $('#captcha').text();
    }, "Captcha is incorrect. Please try again.");

    // Capitalize the first letter of the input for name and message
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Apply capitalization on name and message input fields
    $('#name, #message').on('input', function() {
        var currentValue = $(this).val();
        $(this).val(capitalizeFirstLetter(currentValue));
    });


    // Validator to check for leading/trailing spaces and prevent empty space entries
    $.validator.addMethod("noSpace", function(value, element) {
        return $.trim(value).length > 0; // Check if the trimmed value is not empty
    }, "This field should not contain spaces.");
    // Name Field should not contain spaces.
    // Initialize form validation
    $("#add-contact-form").validate({
        ignore: ".note-editor *", // Ignore elements within the Summernote editor
        debug: false,
        rules: {
            name: {
                required: true,
                noSpace: true, 
            },
            email: {
                required: true,
                email: true,
                domainValidation: true,
                noSpace: true, 
            },
            mobile_no: {
                required: true,
                mobileValid: true,
                noSpace: true, 
            },
            message: {
                required: true,
                noSpace: true, 
            },
            text: {
                required: true,
                captchaValid: true,
                noSpace: true, 
            }
        },
        messages: {
            name: {
                required: "Please enter your full name",
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            mobile_no: {
                required: "Please enter your mobile number",
                mobileValid: "Please enter a valid 10-digit mobile number"
            },
            message: {
                required: "Please enter your message",
            },
            text: {
                required: "Please enter the captcha",
                captchaValid: "Captcha is incorrect. Please try again."
            }
        },
        errorElement: "span",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "text") {
                error.addClass("text-danger");
                error.insertAfter($(".Captcha-Div"));
            } else {
                error.addClass("text-danger");
                error.insertAfter(element);
            }
            // error.addClass("text-danger");
            // error.insertAfter(element); // Place error message after the input field
        },
        onkeyup: function(element) {
            var mobileNo = $("#mobile_no").val();
            if (mobileNo.length === 10) {
                $(element).valid(); // Validate when the mobile number has 10 digits
            }
        },
        onfocusout: function(element) {
            $(element).valid(); // Validate on focus out
        }
    });
});
</script>
{{-- Captch --}}
<script>
    let captchaText = document.querySelector('#captcha');
    let userText = document.querySelector('#textBox');
    let submitButton = document.querySelector('#submit');
    let output = document.querySelector('#output');
    let refreshButton = document.querySelector('#refresh');

    let alphaNums = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    let emptyArr = [];
    for(let i = 1; i <= 7; i++) {
        emptyArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
    }
    captchaText.innerHTML = emptyArr.join('');

    userText.addEventListener('keyup', function(e) {
        if(e.keyCode === 13) {
            if(userText.value === captchaText.innerHTML) {
                output.classList.add("greenText");
             //   output.innerHTML = "Correct!";
            } else {
                output.classList.add("text-danger");
             //   output.innerHTML = "Incorrect, please try again";
            }
        }
    });

    submitButton.addEventListener('click',  function() {
        if(userText.value === captchaText.innerHTML) {
            output.classList.add("greenText");
          //  output.innerHTML = "Correct!";
        } else {
            output.classList.add("text-danger");
          //  output.innerHTML = "Incorrect, please try again";
        }
    });

    refreshButton.addEventListener('click', function () {
        userText.value = "";
        let refreshArr = [];
        for(let j = 1; j <= 7; j++) {
            refreshArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
        }
        captchaText.innerHTML = refreshArr.join('');
        output.innerHTML = "";
    });

    submitButton.addEventListener('keyup', function(e) {
        if(e.keyCode === 13) {
        if(userText.value === captchaText.innerHTML) {
            console.log("correct!");
            output.classList.add("greenText");
        //    output.innerHTML = "Correct!";
        } else {
            output.classList.add("text-danger");
            output.innerHTML = "Incorrect, please try again";
        }
        }
    });

</script>
{{-- Captch --}}


</body>

</html>