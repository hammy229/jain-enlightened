
@section('meta-header')
@section('title',!empty($lesson_details->meta_title)?$lesson_details->meta_title:'')

@section('meta_description',!empty($lesson_details->meta_description)?$lesson_details->meta_description:'')

@section('meta_keywords', !empty($lesson_details->meta_keyword)?$lesson_details->meta_keyword:'')
@include ("Front.includes.header")

<style>
    ul > li, ol > li {
        margin-bottom: 10px;
    }
</style>

    <!-- Page header Start -->
    <div class="page-header parallaxie" style="background-image: url('{{ !empty($lesson_details->lesson_img_path) ? url('/') . Storage::url($lesson_details->lesson_img_path) : asset('front/images/lessons/img-1.png') }}')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($lesson_details->heading) ? $lesson_details->heading : '' }} - {{ !empty($lesson_details->language) ? $lesson_details->language->heading : '' }}</h2>
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
                            {{-- <iframe width="100%" height="450" src="https://www.youtube.com/embed/W_SkqgnH8B4?si=QEoUoLlvQFZKttku" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                            {{-- <iframe width="100%" height="450" src="{{ !empty($lesson_details->youtube_link) ? $lesson_details->youtube_link : '' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                            <div id="player" class="click-disable"></div>                   
                           
                        </div>
                        <!-- Blog Detail Featured Image End -->

                        <!-- Blog Detail Post Content Start -->
                        <div class="blog-detail-post-content wow fadeInUp" data-wow-delay="0.75s">
                            {!! !empty($lesson_details->lesson_description) ? $lesson_details->lesson_description : '' !!}
                        </div>
                 @php

                             $facebook_share_url = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($lesson_url);
                             $twitter_share_url = "https://twitter.com/intent/tweet?url=" . urlencode($lesson_url) . "&text=" . urlencode($lesson_details->heading);
                             $linkedin_share_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . urlencode($lesson_url) . "&title=" . urlencode($lesson_details->heading);
                                  
                @endphp
                    <div class="row align-items-center">

                        <div class="col-lg-4">
                            <!-- Post Sharing Links Start -->
                            <div class="post-social-links wow fadeInUp" data-wow-delay="0.25s">
                                <p>Share to </p>
                                <ul>
                                    <li><a href="{{ $facebook_share_url }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    {{-- <li><a href="https://www.youtube.com/@JainEnlightened/videos" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>  --}}
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
                <div class="col-lg-4  col-md-12">
                    <!-- Service Details sidebar Start -->
                    <div class="service-details-sidebar">


                        <div class="blog-details-post-widget wow fadeInUp" data-wow-delay="0.5s">
                            <div class="footer-info-heading">
                                <h2 class="mb-3" style="color:#000;">Additional Resources</h2>
                            </div>
                            {!! !empty($lesson_details->additional_description) ? $lesson_details->additional_description : '' !!}
                          
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
        $(".lessons_active").addClass("active");
    </script>
    <script>
     
   var tag = document.createElement('script');
   
   tag.src = "https://www.youtube.com/iframe_api";
   var firstScriptTag = document.getElementsByTagName('script')[0];
   firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
   
   var player;
   
   function onYouTubeIframeAPIReady() {          
    //    var vlink = 'Rgn8Yot_l24';

        var videoUrl = '{{ !empty($lesson_details->youtube_link) ? $lesson_details->youtube_link : '' }}'

    const urlParams = new URLSearchParams(new URL(videoUrl).search);
    var vlinkurl = urlParams.get('v');
   // var vlink = 'Rgn8Yot_l24';
       player = new YT.Player('player', {
           height: '625',
           width: '100%',
           videoId: vlinkurl,
           playerVars: {
           'enablejsapi':1,
           'playsinline': 1,   
           'mute':1,         
           'autoplay':1,
           'controls':1
           
           },
           events: {
           'onReady': onPlayerReady,
           'onStateChange': onPlayerStateChange
           }
       });
   }
   
   function onPlayerReady(event) {
       event.target.playVideo();
   }
   var done = false;
   function onPlayerStateChange(event) {
   
   }
   function stopVideo() {
       player.stopVideo();
   }
   
   $(".mute-unmute").click(function(){   
       if(player.isMuted()==true)
       {
           player.unMute();
       }else
       {
           player.mute();
       }        
   });
   $(".play-pause").click(function(){
       if(player.getPlayerState()==1)
       {
           player.pauseVideo();
       }else if(player.getPlayerState()==2)
       {
           player.playVideo()
       }        
   });
   $(".seek-minus").click(function(){
   var minus_time = player.getCurrentTime()-10;
   player.seekTo(minus_time,true);
   });
   
   $(".seek-plus").click(function(){
   var plus_time = player.getCurrentTime()+10;
   player.seekTo(plus_time,true);        
   });
   </script>

</body>

</html>