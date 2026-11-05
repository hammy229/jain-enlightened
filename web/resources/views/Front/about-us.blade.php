
@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')

@include ("Front.includes.header")
<style>
        .team-modal .modal-dialog {
             max-width: 650px;
        }
</style>
    <div class="about-us-page">
        <!-- Page header Start -->
        <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/about.jpg') }}');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <!-- Page Header box Start -->
                        <div class="page-header-box">
                            <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'About Us' }}</h2>
                            <nav class="wow fadeInUp" data-wow-delay="0.25s">
                                <ol class="breadcrumb">
                                    <li><a href="{{URL::asset('/')}}">Home</a></li>
                                    <li> about Us</li>
                                </ol>
                            </nav>                                
                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        <!-- Transportation Section Start -->
        <div class="home-transportation about-transportation ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 order-lg-1 order-md-2 order-2">
                        <!-- Home Transportation Content Start -->
                        <div class="home-transportation-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                {{-- <h2 class="text-anime-style-3"><span>Why we</span> started</h2> --}}
                                <h2 class="text-anime-style-3">{{ !empty($about->about_heading) ? $about->about_heading : '' }}</h2>
                            </div>
                            <!-- Section Title End -->
    
                            <!-- Home Transportation Body Start -->
                            <div class="home-transportation-body">
                                <p class="wow fadeInUp" data-wow-delay="0.25s">{!! !empty($about->about_description) ? $about->about_description : '' !!}</p>
                            </div>
                            <!-- Home Transportation Body End -->
                        </div>
                        <!-- Home Transportation content End -->
                    </div>
    
                    <div class="col-lg-6 col-md-12 order-lg-2 order-md-1 order-1">
                        <!-- Home Transportation Image Start -->
                        <div class="home-transportation-right">
                            <div class="transportation-img-1">
                                <figure class="reveal image-anime">
                                    {{-- <img src="https://images.squarespace-cdn.com/content/v1/6650a27fede8cf4e2c2b6827/990cb391-318a-4cb2-9c75-01c39e8468fd/harsh-jain-7ToS-cBe5IA-unsplash.jpg?format=1500w" alt=""> --}}
                                    <img src="{{ !empty($about->about_img_1_path) ? url('/') . Storage::url($about->about_img_1_path) : URL::asset('front/images/videos/jain-temples.png') }}" alt="">
                                </figure>
                            </div>
    
                            <div class="transportation-img-2">
                                <figure class="reveal image-anime">
                                    <img src="{{ !empty($about->about_img_2_path) ? url('/') . Storage::url($about->about_img_2_path) : URL::asset('front/images/videos/jain-temples.png') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Home Transportation Image End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Transportation Section End -->

        <!-- About Transport Section Start -->
        <div class="about-transport">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <!-- Transport Item Start -->
                        <div class="transport-item wow fadeInUp" data-wow-delay="0.25s">
                            <!-- Transport Icon Start -->
                            <div class="icon-box">
                                <img src="{{ !empty($about->vision_icon_path) ? url('/') . Storage::url($about->vision_icon_path) : URL::asset('front/images/icon-transport-1.svg') }}" alt="">
                            </div>
                            <!-- Transport Icon End -->

                            <!-- Transport Content Start -->
                            <div class="transport-content">
                                <h3>{{ !empty($about->vision_heading) ? $about->vision_heading : '' }}</h3>
                                <p>{!! !empty($about->vision_description) ? $about->vision_description : '' !!}</p>
                            </div>
                            <!-- Transport Content End -->
                        </div>
                        <!-- Transport Item End -->
                    </div>
                
                    <div class="col-md-6">
                        <!-- Transport Item Start -->
                        <div class="transport-item wow fadeInUp" data-wow-delay="0.5s">
                            <!-- Transport Icon Start -->
                            <div class="icon-box">
                                <img src="{{ !empty($about->mission_icon_path) ? url('/') . Storage::url($about->mission_icon_path) : URL::asset('front/images/icon-transport-2.svg') }}" alt="">
                            </div>
                            <!-- Transport Icon End -->

                            <!-- Transport Content Start -->
                            <div class="transport-content">
                                <h3>{{ !empty($about->mission_heading) ? $about->mission_heading : '' }}</h3>
                                <p>{!! !empty($about->mission_description) ? $about->mission_description : '' !!}</p>
                            </div>
                            <!-- Transport Content End -->
                        </div>
                        <!-- Transport Item End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- About Transport Section End -->

        <!-- Our Contract Section Start -->
        <div class="our-contract parallaxie">
            <video autoplay muted loop id="myVideo"><source src="{{URL::asset('front/images/videos/video-1.mp4')}}" type="video/mp4"></video>

                <div class="container">
                    <div class="row align-items-center">  
                        <div class="col-md-12">
                            <div class="our-cta-box">   
                                <div class="our-contract-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12">
                                            <img src="{{ !empty($about->journey_img_path) ? url('/') . Storage::url($about->journey_img_path) : URL::asset('front/images/videos/owner.jpg') }}" alt="" class="wow fadeInUp" data-wow-delay="0.25s" style="border-radius: 5px;">
                                        </div>
                                        <div class="col-lg-8 col-md-12 text-start">
                                            <h2 class="text-anime-style-3">{{ !empty($about->journey_heading) ? $about->journey_heading : '' }}</h2>
                                            <div class="founder-content-div">
                                                @php
                                                    // Split the description into an array of words
                                                    $description = strip_tags($about->journey_description);
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
                                            <div class="journey-social-link mt-2">
                                                {{-- <span>Founder - Arham Doshi</span> --}}
                                                <a href="{{ !empty($about->linkedin_url) ? $about->linkedin_url : '' }}" class="linkedin-button" target="_blank"><i class="fa-brands fa-linkedin"></i>LinkedIn</a>
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

        <!-- Our Industry Section Start -->
        <div class="our-indurstry">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 for-order-2">
                        <!-- Indurstry Image Start -->
                        <div class="indurstry-image">
                            <figure class="reveal image-anime">
                                {{-- <img src="https://images.squarespace-cdn.com/content/v1/6650a27fede8cf4e2c2b6827/990cb391-318a-4cb2-9c75-01c39e8468fd/harsh-jain-7ToS-cBe5IA-unsplash.jpg?format=1500w" alt=""> --}}
                                <img src="{{ !empty($about->guidance_img_path) ? url('/') . Storage::url($about->guidance_img_path) : URL::asset('front/images/icon-transport-2.svg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Indurstry Image End -->
                    </div>
                    <div class="col-lg-6">
                        <div class="our-indurstry-content">
                            <!-- Section Title Start -->
                        <div class="section-title">
                            {{-- <h2 class="text-anime-style-3">Role of <span> Pathshala and Spiritual Guidance</span></h2> --}}
                            <h2 class="text-anime-style-3">{{ !empty($about->guidance_heading) ? $about->guidance_heading : '' }}</span></h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Indurstry Content Start -->
                        <div class="indurstry-content">  
                            <p class="wow fadeInUp" data-wow-delay="0.25s">{!! !empty($about->guidance_description) ? $about->guidance_description : '' !!}</p> 
                            
                        </div>
                        <!-- Indurstry Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Industry Section End -->

        <!-- Transportation Section Start -->
        <div class="acknowledgment-of-teacher ">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="text-anime-style-3">{{ !empty($about->acknow_heading) ? $about->acknow_heading : '' }}</h2>
                </div>
                <div class="acknowledgment-of-teacher-box wow fadeInUp"  data-wow-delay="0.5s">
                    {!! !empty($about->acknow_description) ? $about->acknow_description : '' !!}
                    {{-- <p class="wow fadeInUp" data-wow-delay="0.25s">In addition to Yashovijayji MS, I also owe a great deal of gratitude to my Pathshala teachers, who played a pivotal role in shaping my understanding and dedication to Jainism. Charu Aunty was one of the first to introduce me to the profound teachings of Jainism. Her compassionate and patient approach made learning an enjoyable and enlightening experience. Her guidance and encouragement were instrumental in nurturing my interest in Jain philosophy. </p>
                    <p class="wow fadeInUp" data-wow-delay="0.5s">Yashovijayji Maharaj Saheb has been the cornerstone of my spiritual and intellectual growth. His teachings have not only deepened my understanding of Jainism but have also inspired me to take action by creating Jain Enlightened. His influence is woven into the very fabric of this initiative, and I consider him my main guru, whose wisdom continues to guide every step of this journey.</p>
                    <p class="wow fadeInUp" data-wow-delay="0.5s">In addition to Yashovijayji MS, I also owe a great deal of gratitude to my Pathshala teachers, who played a pivotal role in shaping my understanding and dedication to Jainism. Charu Aunty was one of the first to introduce me to the profound teachings of Jainism. Her compassionate and patient approach made learning an enjoyable and enlightening experience. Her guidance and encouragement were instrumental in nurturing my interest in Jain philosophy. Yashovijayji Maharaj Saheb has been the cornerstone of my spiritual and intellectual growth. His teachings have not only deepened my understanding of Jainism but have also inspired me to take action by creating Jain Enlightened. His influence is woven into the very fabric of this initiative, and I consider him my main guru, whose wisdom continues to guide every step of this journey.</p> --}}
                </div>
            </div>
        </div>
        <!-- Transportation Section End -->
        
        <!-- Export Team Section Start -->
     @if(!empty($team_bords) && $team_bords->count() > 0)
        <div class="export-team advisory-team">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3">Advisory<span> Board!</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="row">
                    @if(!empty($team_bords)&& $team_bords->count() > 0)
                    @foreach ($team_bords as $bord)
                    
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="team-item wow fadeInUp"  data-wow-delay="0.25s">
                            <a href="#" class="open-modal" 
                               data-name="{{ $bord->name }}"
                               data-designation="{{ $bord->designation }}"
                               data-description="{{ $bord->description }}"
                               data-image="{{ !empty($bord->team_img_path) ? url('/') . Storage::url($bord->team_img_path) : asset('front/images/icon-transport-2.svg') }}"
                               data-bs-toggle="modal" data-bs-target="#PersonDescriptionModalbord">
                                <div class="team-image">
                                    <figure class="image-anime">
                                        <img src="{{ !empty($bord->team_img_path) ? url('/') . Storage::url($bord->team_img_path) : asset('front/images/icon-transport-2.svg') }}" alt="">
                                    </figure>
                                </div>
                                <div class="team-content">
                                    <p>{{ !empty($bord->designation) ? $bord->designation : '' }}</p>
                                    <h3>{{ !empty($bord->name) ? $bord->name : '' }}</h3>
                                </div>
                            </a>
                            <a href="{{ !empty($bord->linkedin_url) ? $bord->linkedin_url : '' }}" class="linkedin-button" target="_blank"><i class="fa-brands fa-linkedin"></i>LinkedIn</a>
                        </div>
                    </div>

                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif 
      <!-- Export Team Section End -->

        <!-- Export Team Section Start -->
    @if(!empty($teams) && $teams->count() > 0)
        <div class="export-team meet-our-team">
            <div class="container">
                <div class="row">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3">Meet<span> the Team!</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="row">

                    @if(!empty($teams)&& $teams->count() > 0)
                    @foreach ($teams as $team)

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <!-- Team Item Start -->
                        <div class="team-item wow fadeInUp" data-wow-delay="0.25s">
                            <a href="#" 
                               data-bs-toggle="modal" 
                               data-bs-target="#PersonDescriptionModalteam"
                               data-name="{{ !empty($team->name) ? $team->name : '' }}" 
                               data-designation="{{ !empty($team->designation) ? $team->designation : '' }}"
                               data-description="{{ !empty($team->description) ? $team->description : '' }}" 
                               data-image="{{ !empty($team->team_img_path) ? url('/') . Storage::url($team->team_img_path) : URL::asset('front/images/icon-transport-2.svg') }}"
                            >
                                <div class="team-image">
                                    <figure class="image-anime">
                                        <img src="{{ !empty($team->team_img_path) ? url('/') . Storage::url($team->team_img_path) : URL::asset('front/images/icon-transport-2.svg') }}" alt="">
                                    </figure>
                                </div>
                                <div class="team-content">
                                    <p>{{ !empty($team->designation) ? $team->designation : '' }}</p>
                                    
                                    <h3>{{ !empty($team->name) ? $team->name : 'dfr' }}</h3>

                                </div>
                            </a>
                            <a href="{{ !empty($team->linkedin_url) ? $team->linkedin_url : '' }}" class="linkedin-button" target="_blank"><i class="fa-brands fa-linkedin"></i>LinkedIn</a>
                        </div>
                        <!-- Team Item End -->
                    </div>

                    @endforeach
                    @endif


                </div>
            </div>
        </div>
   @endif
        <!-- Export Team Section End -->

        <!-- Our Industry Section Start -->
     @if(!empty($strategics) && $strategics->count() > 0)
        <div class="our-strategic-goals">
            <div class="container">
                    <!-- Section Title Start -->
                <div class="section-title">
                    {{-- <h2 class="text-anime-style-3">Strategic <span> Goals</span> </h2> --}}
                    <h2 class="text-anime-style-3">   {{ !empty($about->strategic_heading) ? $about->strategic_heading : '' }}</span> </h2>
                </div>
                <!-- Section Title End -->

                <!-- Indurstry Content Start -->
                <div class="indurstry-content">  
                    @if(!empty($strategics) && $strategics->count() > 0)
                        @foreach ($strategics as $strategic)
                        @if ($loop->iteration % 2 == 1) <!-- Odd iteration: 1st, 3rd, 5th, etc. -->
                                <div class="indurstry-content-box">  
                                    <div class="row">
                                        <div class="col-md-4 for-order-2">
                                            <figure class="image-anime">
                                                <img src="{{ !empty($strategic->strategic_img_path) ? url('/') . Storage::url($strategic->strategic_img_path) : URL::asset('front/images/icon-transport-2.svg') }}" alt="" class="ind-img-left">
                                            </figure>
                                        </div>
                                        <div class="col-md-8 ps-0">
                                            <div class="industry-content-card">
                                                <h4 class="text-anime-style-2 mb-3">{{ !empty($strategic->heading) ? $strategic->heading : '' }}</h4>
                                                <div>{!! !empty($strategic->description) ? $strategic->description : '' !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else <!-- Even iteration: 2nd, 4th, 6th, etc. -->
                                <div class="indurstry-content-box">  
                                    <div class="row">
                                        <div class="col-md-8 ps-0">
                                            <div class="industry-content-card">
                                                <h4 class="text-anime-style-2 mb-3">{{ !empty($strategic->heading) ? $strategic->heading : '' }}</h4>
                                                <div>{!! !empty($strategic->description) ? $strategic->description : '' !!}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <figure class="image-anime">
                                                <img src="{{ !empty($strategic->strategic_img_path) ? url('/') . Storage::url($strategic->strategic_img_path) : URL::asset('front/images/icon-transport-2.svg') }}" alt="" class="ind-img-right">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
     @endif
        <!-- Our Industry Section End -->

    </div>


    <div class="modal fade team-modal" id="PersonDescriptionModalbord" tabindex="-1" aria-labelledby="PersonDescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40"><g><path fill="#000" d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414z"></path></g></svg>
                    </button>
                    <div class="person-description-div">
                        <div class="row">
                            <div class="col-md-4">
                                <figure class="image-anime">
                                    <img id="personImage" src="" alt="">
                                </figure>
                            </div>
                            <div class="col-md-8">
                                <div class="person-content-div">
                                    <h4 id="personName"></h4>
                                    <span id="personDesignation"></span>
                                    <div class="person-detail-content">
                                        <p id="personDescription"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

    <!-- Modal -->
<div class="modal fade team-modal" id="PersonDescriptionModalteam" tabindex="-1" aria-labelledby="PersonDescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0" viewBox="0 0 40 40" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#000" fill-rule="evenodd" d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414z" clip-rule="evenodd" opacity="1" data-original="#000000"></path></g></svg>
                </button>
                <div class="person-description-div">
                    <div class="row">
                        <div class="col-md-4">
                            <figure class="image-anime">
                                <img id="modalImage" src="" alt="">
                            </figure>
                        </div>
                        <div class="col-md-8">
                            <div class="person-content-div">
                                <h4 id="modalName">Name Here</h4>
                                <span id="modalDesignation">Designation Here</span>
                                <div class="person-detail-content">
                                    <p id="modalDescription">Description Here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @include ("Front.includes.footer")
    <script>
        $(".about_active").addClass("active");
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
            document.addEventListener('DOMContentLoaded', function () {
        // Attach click event listener to each team item link
        document.querySelectorAll('.open-modal').forEach(function (element) {
            element.addEventListener('click', function () {
                // Get the data attributes from the clicked element
                const name = this.getAttribute('data-name');
                const designation = this.getAttribute('data-designation');
                const description = this.getAttribute('data-description');
                const image = this.getAttribute('data-image');
                
                // Set the modal content with the person's information
                document.getElementById('personName').textContent = name;
                document.getElementById('personDesignation').textContent = designation;
                // document.getElementById('personDescription').textContent = description;
                document.getElementById('personDescription').innerHTML = description;
                document.getElementById('personImage').setAttribute('src', image);
            });
        });
    });


</script>


<script>
    $(document).ready(function(){
    $('#PersonDescriptionModalteam').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('name'); // Extract info from data-* attributes
        var designation = button.data('designation');
        var description = button.data('description');
        var image = button.data('image');

        // Update the modal's content
        var modal = $(this);
        modal.find('#modalName').text(name);
        modal.find('#modalDesignation').text(designation);
        modal.find('#modalDescription').text(description);
        document.getElementById('personDescription').innerHTML = description;
        modal.find('#modalImage').attr('src', image);
    });
});
</script>






</body>

</html>