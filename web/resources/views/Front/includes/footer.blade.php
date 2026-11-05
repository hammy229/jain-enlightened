
@php $General_setting = App\Helpers\Helpers\Helper::General_setting() @endphp
@php $internship = App\Helpers\Helpers\Helper::Internship() @endphp

@php $Home = App\Helpers\Helpers\Helper::Home() @endphp
<!-- Main Footer Start  -->
<footer class="main-footer">
    <!-- Mega Footer Start -->
    <div class="mega-footer">
            <div class="join">
                <div class="container p-sm-0">
                    <div class="row">
                        <div class="col-md-10 card join__card">
                            {{-- <img src="{{URL::asset('front/images/videos/jain-temples.png')}}" class="img-fluid join__card-img" alt="image"> --}}
                            <img src="{{!empty($internship->intern_img_path) && Storage::exists($internship->intern_img_path) ? url('/').Storage::url($internship->intern_img_path) : URL::asset('front/images/icons/SainyaYog-Logo.png') }}" class="img-fluid join__card-img" alt="image">
                            <div class="img-overlay-div"></div>
                            <div class="card-img-overlay join__card-layer">
                                <div class="col-11 col-md-7">
                                    <h3 class="join__text global__text">{{ !empty($internship->heading) ? $internship->heading : '' }}</h3>
                                    <h2 class="join__heading global__heading">{!! !empty($internship->sub_heading) ? $internship->sub_heading : '' !!} 
                                    </h2>
                                    <p class="mb-3">{!! !empty($internship->description) ? $internship->description : '' !!}</p>
                                    <a href="#" class="btn-default-reverse "  data-bs-toggle="modal" data-bs-target="#InternshipModal">Discover More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Footer About Start -->
                        <div class="footer-about">
                            <!-- Footer Heading Start -->
                            <div class="footer-heading">
                                <figure>
                                    {{-- <img src="{{URL::asset('front/images/logo/logo.png')}}" alt="" style="width: 150px;"> --}}
                                    <a href={{url('/')}}><img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->ent_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->ent_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->ent_image_path) : URL::asset('front/images/icons/SainyaYog-Logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->ent_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->ent_image_name : '' }}" alt="" style="width: 150px;"></a>
                                    {{-- <a href={{url('/')}}><img class="img-fluid join__card-img" alt="image" src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('front/images/icons/SainyaYog-Logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}"></a> --}}
                                </figure>
                            </div>
                            <!-- Footer Heading End -->

                            <!-- Footer Content Start -->
                            <div class="footer-content">
                                {{-- <p>Experience the profound teachings of Jainism in multiple languages - Gujarati, Hindi, and English. Learn, reflect, and spread the wisdom.</p> --}}
                                @if(!empty($General_setting->description))
                                <p class="wow fadeInUp mb-4" data-wow-delay="0.25s">{{ !empty($General_setting->description) ? $General_setting->description : '' }}</p>
                                @endif
                            </div>
                            <!-- Footer Content End -->

                            <!-- Footer Social Link Start -->
                            <div class="footer-social-link">
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
                            <!-- Footer Social Link End -->
                        </div>  
                        <!-- Footer About End -->                         
                    </div>

                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Footer links Start -->
                        <div class="footer-links">
                            <div class="footer-info-heading">
                                <h2>Quick Links</h2>
                            </div>
                            <ul>
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li><a href="{{URL::asset('about-us')}}">About Us</a></li>
                                <li><a href="{{URL::asset('lessons')}}">Lessons</a></li>
                                <li><a href="{{URL::asset('podcasts')}}">Podcasts</a></li>
                                <li><a href="{{URL::asset('research')}}">Research</a></li>
                                <li><a href="{{URL::asset('blogs')}}">Blogs</a></li>
                                <li><a href="{{URL::asset('impact')}}">Impact</a></li>
                                <li><a href="{{URL::asset('gallery')}}">Gallery</a></li>
                                <li><a href="{{URL::asset('contact-us')}}">Contact</a></li>
                            </ul>
                        </div>
                        <!-- Footer links End -->
                    </div>                        

                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Footer Contact Info Start -->
                        <div class="footer-contact-info">
                            <!-- footer info heading Start -->
                            <div class="footer-info-heading">
                                <h2>Contact Us</h2>
                            </div>
                            <!-- footer info heading End -->

                            <!-- Footer Contact Info Box Start -->

                            <div class="footer-contact-box">
                                @if(!empty($General_setting->email))
                                    <div class="footer-info-box">
                                        <a href="mailto:{{ !empty($General_setting->email) ? $General_setting->email : '' }}">
                                        <div class="icon-box">
                                            <i class="fa-regular fa-envelope"></i>
                                        </div>

                                        {{ !empty($General_setting->email) ? $General_setting->email : '' }}</a>
                                    </div>
                                @endif
                                @if(!empty($General_setting->mobile))
                                <div class="footer-info-box">
                                    <a href="tel:{{ !empty($General_setting->mobile) ? $General_setting->mobile : '' }}">
                                    <div class="icon-box">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>

                                    {{ !empty($General_setting->mobile) ? $General_setting->mobile : '' }}</a>
                                </div>
                                @endif
                                @if(!empty($General_setting->address))
                                <div class="footer-info-box footer-info-map">
                                    <div class="icon-box">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <p>{{ !empty($General_setting->address) ? $General_setting->address : '' }}</p>							
                                </div>
                                @endif
                                <div class="footer-application">
                                    @if(!empty($Home->play_link))
                                        <a href="{{ $Home->play_link }}" target="_blank">
                                            <img src="{{ URL::asset('front/images/Playstore.png') }}" alt="">
                                        </a>
                                    @endif
                                    @if(!empty($Home->app_link))
                                        <a href="{{ $Home->app_link }}" target="_blank">
                                            <img src="{{ URL::asset('front/images/AppStore.png') }}" alt="">
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <!-- Footer Contact Info Box End -->
                        </div>
                    </div>
                    <!-- Footer Contact Info End -->

                    <!-- Subscribe Newsletters Start  -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- footer info heading Start -->
                        @if(!empty($General_setting->ent_heading))
                        <div class="footer-info-heading">
                            <h2>{{ $General_setting->ent_heading }}</h2>
                        </div>
                        @endif
                        <!-- footer info heading End -->

                        <!-- Newsletters Content Start -->
                        @if(!empty($General_setting->ent_description))
                        <div class="newsletters-content">
                            <p>{{ $General_setting->ent_description }}</p>
                        </div>
                        @endif
                        <!-- Newsletters Content End -->
                        
                        <!-- Newsletters Form Start -->
                        <div class="newsletters-form">
                            @if(!empty($General_setting->ent_image_path))
                            <a href="javascript:void(0)">
                                {{-- <img src="https://images.squarespace-cdn.com/content/v1/6650a27fede8cf4e2c2b6827/4b17898c-03e3-470a-aa97-b84a05c3ef3b/foundation-logo.png?format=750w" alt=""> --}}
                                <img src="{{ !empty($General_setting->ent_image_path) && Storage::exists($General_setting->ent_image_path) ? url('/').Storage::url($General_setting->ent_image_path) : URL::asset('front/images/icons/SainyaYog-Logo.png') }}" alt="{{ !empty($General_setting->logo_image_name) ? $General_setting->logo_image_name : '' }}" alt="">
                            </a>
                            @endif
                        <!-- Newsletters Form End -->
                    </div>
                    <!-- Subscribe Newsletters End  -->
                </div>
            </div>
        </div>
        <!-- Mega Footer End -->
    </footer>
    <!-- Main footer End -->

    <!-- Footer Copyright Section Start -->
    <div class="footer-copyright-links">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7 col-12">
                    <!-- Footer Copyright Content Start -->
                    <div class="footer-copyright">
                        <p>Copyright © <script>document.write(new Date().getFullYear());</script> <span style="color:#f6bf60;">Jain Enlightened</span>. All rights reserved.</p>
                       
                    </div>
                    <!-- Footer Copyright Content End -->
                </div>
                <div class="col-lg-6 col-md-5 col-12">
                    <!-- Footer Policy Links Start -->
                    <div class="footer-policy-links">
                        <ul>
                            <li><a href="{{URL::asset('privacy-policy')}}">Privacy Policy</a></li>
                            <li><a href="{{URL::asset('terms-and-condition')}}">Terms and Condition</a></li>
                        </ul>
                    </div>
                    <!-- Footer Policy Links End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copyright Section End -->

    <!-- Modal -->
    <div class="modal fade" id="InternshipModal" tabindex="-1" aria-labelledby="InternshipModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h2 class="modal-title" id="InternshipModalLabel">Let’s work together.</h2>
                <p class="text-center">Interested in an Internship? <br> Fill out some info and we will be in touch shortly! <br> We can't wait to hear from you!</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0" viewBox="0 0 40 40" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#ffffff" fill-rule="evenodd" d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414z" clip-rule="evenodd" opacity="1" data-original="#000000"></path></g></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="internship-form">
                    {{-- <form  action="#" method="post" data-toggle="validator"> --}}
                    <form action="{{ route('internship.store') }}" method="post" id="InternshipForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-3">
                                <label for="name">Full name <span style="color: #ff0000">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name">
                                @if($errors->has('name'))
                                        <span class="text-danger error-message"><b>*</b> {{$errors->first('name')}}</span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group  col-md-6 mb-3">
                                <label for="email">Email ID<span style="color: #ff0000">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email id" >
                                @if($errors->has('email'))
                                <span class="text-danger error-message"><b>*</b> {{$errors->first('email')}}</span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group  col-md-6 mb-3">
                                <label for="number">Mobile no.</label>
                                <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter your mobile no." >
                                @if($errors->has('mobile_no'))
                                <span class="text-danger error-message"><b>*</b> {{$errors->first('mobile_no')}}</span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-md-12 mb-3 select-position-div">
                                <label for="position">What positions are you interested in? <span style="color: #ff0000">*</span></label>
                                <i class="fa fa-down"></i>
                                <select name="position" name="position" id="position" class="form-select">
                                    <option value="">Select Position</option>
                                    <option value="lesson_writer">Lesson Writer</option>
                                    <option value="blog_writer">Blog Writer</option>
                                </select>
                                @if($errors->has('position'))
                                <span class="text-danger error-message"><b>*</b> {{$errors->first('position')}}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <label for="msg">Tell us about yourself<span style="color: #ff0000">*</span></label>
                                <textarea class="form-control" name="about" id="about" rows="2" placeholder="Tell us about yourself" ></textarea>
                                @if($errors->has('about'))
                                <span class="text-danger error-message"><b>*</b> {{$errors->first('about')}}</span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="msg2">What are your goals if given the position<span style="color: #ff0000">*</span></label>
                                <textarea class="form-control" name="goals" id="goals" rows="2" placeholder="What are your goals if given the position" ></textarea>
                                @if($errors->has('goals'))
                                <span class="text-danger error-message"><b>*</b> {{$errors->first('goals')}}</span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="msg3">Any message to us<span style="color: #ff0000">*</span></label>
                                <textarea class="form-control" name="message" id="message" rows="2" placeholder="Any message to us" ></textarea>
                                @if($errors->has('message'))
                                <span class="text-danger error-message"><b>*</b> {{$errors->first('message')}}</span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Jquery Library File -->
    <script src="{{URL::asset('front/js/jquery-3.7.1.min.js')}}"></script>
    <!-- Bootstrap js File -->
    <script src="{{URL::asset('front/js/bootstrap.min.js')}}"></script>
    <!-- Validator js File -->
    <script src="{{URL::asset('front/js/validator.min.js')}}"></script>
    <!-- SlickNav js File -->
    <script src="{{URL::asset('front/js/jquery.slicknav.js')}}"></script>
    <!-- Swiper js File -->
    <script src="{{URL::asset('front/js/swiper-bundle.min.js')}}"></script>
    <!-- Counter js File -->
    <script src="{{URL::asset('front/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{URL::asset('front/js/jquery.counterup.min.js')}}"></script>
    <!-- Magnific js File -->
    <script src="{{URL::asset('front/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- SmoothScroll -->
    <script src="{{URL::asset('front/js/SmoothScroll.js')}}"></script>
    <!-- Parallax js -->
	<script src="{{URL::asset('front/js/parallaxie.js')}}"></script>
    <!-- MagicCursor js File -->
    <script src="{{URL::asset('front/js/gsap.min.js')}}"></script>
    <script src="{{URL::asset('front/js/magiccursor.js')}}"></script>
    <!-- Text Effect js File -->
	<script src="{{URL::asset('front/js/SplitText.js')}}"></script>
    <script src="{{URL::asset('front/js/ScrollTrigger.min.js')}}"></script>
    <!-- YTPlayer js File -->
    <script src="{{URL::asset('front/js/jquery.mb.YTPlayer.min.js')}}"></script>
    <!-- Wow js File -->
    <script src="{{URL::asset('front/js/wow.js')}}"></script>
    <!-- Main Custom js File -->
    <script src="{{URL::asset('front/js/function.js')}}"></script>

    <!-- Toaster Js -->
    <script src="{{ URL::asset('package_assets/libs/toastr/build/toastr.min.js') }}"></script>

    <!-- fancy box -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<!-- Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

    <!-- Validation Js -->
    <script src="{{ URL::asset('package_assets/libs/validation/validate.min.js') }}"></script>

    <script>
        Fancybox.bind("[data-fancybox]", {
        // Your custom options
        });
    </script>

    <script>
        $(document).ready(function() {
            var $topUp = $('.top-up');

            $(window).scroll(function() {
                // Check if the user has scrolled down 50% of the document height
                if ($(window).scrollTop() > $(document).height() * 0.5) {
                    $topUp.fadeIn(); // Show the div
                } else {
                    $topUp.fadeOut(); // Hide the div
                }
            });

            // Optional: Smooth scroll to top when clicking the div
            $topUp.click(function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            });
        });
    </script>

    <!-- Toaster Code -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }

        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
        @endif

        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @endif
    </script>

    <script>
        function success_toast(title = '', message = '') {
            toastr.success(message);
        }

        function error_toast(title = '', message = '') {
            toastr.error(message);
        }
    </script>


{{-- internship front validation start --}}

<script>
    $(document).ready(function() {
        // Allow only numeric values for the mobile number field
        $('#mobile_no').on('input', function() {
            var newValue = this.value.replace(/\D/g, ''); // Remove non-numeric characters
            this.value = newValue;
        });
    
        // Apply capitalization on name and message input fields
        $('#name, #message').on('input', function() {
            var currentValue = $(this).val();
            $(this).val(capitalizeFirstLetter(currentValue));
        });

        // Capitalize the first letter of the input for name and message
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        formValidation();
 
    });

    function formValidation(){
        // Custom validator for mobile number (10 digits)
        $.validator.addMethod("mobileValid", function(value, element) {
            return this.optional(element) || (value.length === 10 && /^\d+$/.test(value));
        }, "Please enter a valid 10-digit mobile number");
    
        // Custom validator for email domain
        $.validator.addMethod("domainValidation", function(value, element) {
            return this.optional(element) || /^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+(?:com|in)$/.test(value);
        }, "Please enter a valid email address.");


         // Validator to check for leading/trailing spaces and prevent empty space entries
    $.validator.addMethod("noSpace", function(value, element) {
        return $.trim(value).length > 0; // Check if the trimmed value is not empty
    }, "This field should not contain spaces.");
    
        $("#InternshipForm").validate({
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
                position: {
                    required: true,
                    noSpace: true, 
                },
                mobile_no: {
                    required: true,
                    mobileValid: true,
                    noSpace: true, 
                },
                about: {
                    required: true,
                    noSpace: true, 
                },
                goals: {
                    required: true,
                    noSpace: true, 
                },
                message: {
                    required: true,
                    noSpace: true, 
                },
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
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                error.insertAfter(element); // Place error message after the input field
            },
            onkeyup: function(element) {
                var mobileNo = $("#mobile_no").val();
                if (mobileNo.length === 10) {
                    $(element).valid(); // Validate when the mobile number has 10 digits
                }
            },
            onfocusout: function(element) {
                $(element).valid(); // Validate on focus out
            },
        });
    }
 </script>

{{-- internship front validation end --}}


{{-- AI --}}
@if(config('services.fastbots.bot_id'))
<script defer src="https://app.fastbots.ai/embed.js" data-bot-id="{{ config('services.fastbots.bot_id') }}"></script>
@endif