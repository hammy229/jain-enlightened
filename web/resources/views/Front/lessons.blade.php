
@section('meta-header')
@section('title',!empty($metadata->meta_title)?$metadata->meta_title:'')

@section('meta_description',!empty($metadata->meta_description)?$metadata->meta_description:'')

@section('meta_keywords', !empty($metadata->meta_keyword)?$metadata->meta_keyword:'')
@include ("Front.includes.header")

<style>
    .taeb-switch:after {
        width: 100px;
    }
    .taeb-switch.left:after {
        left: 0% !important;
    }
    .taeb-switch.mid:after {
        left: 34%;
    }
    .taeb-switch.right:after {
        left: 67%;
    }
</style>

    <!-- subpage header Start -->
    <div class="page-header parallaxie" style="background-image: url('{{ !empty($banner->ban_image_path) ? url('/') . Storage::url($banner->ban_image_path) : asset('front/images/page-banners/podcasts.jpg') }}')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header box Start -->
                    <div class="page-header-box">
                        <h2 class="text-anime-style-3">{{ !empty($banner->heading) ? $banner->heading : 'Lessons' }}</h2>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li><a href="{{URL::asset('/')}}">Home</a></li>
                                <li> Lessons</li>
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
    <div class="lessons-page">
        <div class="container">
            <div class="lessons-slect-div">
                <label for="LanguageSelector">Select Language Option </label>
                <select id="LanguageSelector">
                    <option value="all_language" selected>All</option>
                    @foreach($languages as $lang)
                        <option value="{{ $lang->heading }}">{{ $lang->heading }}</option>
                    @endforeach
                    {{-- <option value="Hindi">Hindi</option>
                    <option value="Gujrati">Gujarati</option>
                    <option value="English">English</option>
                    <option value="Spanish">Spanish</option> --}}
                </select>
            </div>
            
            <div class="lessons-content">
                <div class="row" id="lessonsContainer">
                    @include('Front.lesson-cards', ['lessons' => $lessons])
                </div>
            </div>

        </div>
    </div>
    <!-- Blog Page section End -->
    
    @include ("Front.includes.footer")

    <script>
        $(".lessons_active").addClass("active");
    </script>

    {{-- <script>
        $(function() {
            $('#LanguageSelector').change(function(){
                $('.LessonCard').hide();
                $('#' + $(this).val()).show();
                if($(this).val() == 'all_language') {
                    $('.LessonCard').show();
                }
            });
        });
    </script>


        <script>
    $(document).ready(function() {
        $('#LanguageSelector').change(function() {
            var selectedLanguage = $(this).val();
            
            $.ajax({
                url: '{{ url('lessons') }}',
                method: 'GET',
                data: { language: selectedLanguage },
                success: function(response) {
                    $('#lessonsContainer').html(response.lessons);
                }
            });
        });
    });
</script> --}}



<script>

    $(document).ready(function() {
        $('#LanguageSelector').change(function() {
            var selectedLanguage = $(this).val();
            
            $.ajax({
                url: '{{ url('lessons') }}',
                method: 'GET',
                data: { language: selectedLanguage },
                success: function(response) {
                    $('#lessonsContainer').html(response.lessons);
                    $('.pagination-wrapper').html(response.pagination); // Update pagination
                }
            });
        });

        // Handle pagination links dynamically
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            var selectedLanguage = $('#LanguageSelector').val();

            $.ajax({
                url: '{{ url('lessons') }}?page=' + page,
                method: 'GET',
                data: { language: selectedLanguage },
                success: function(response) {
                    $('#lessonsContainer').html(response.lessons);
                    $('.pagination-wrapper').html(response.pagination);
                }
            });
        });
    });


</script>
  
</body>

</html>