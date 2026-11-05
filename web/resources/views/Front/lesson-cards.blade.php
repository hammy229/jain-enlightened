@if(!empty($lessons) && $lessons->count() > 0)
    @foreach ($lessons as $lesson)
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="project-item">
                <div class="project-image">
                    <figure class="image-anime">
                        <img src="{{ !empty($lesson->lesson_img_path) ? url('/') . Storage::url($lesson->lesson_img_path) : asset('front/images/lessons/img-1.png') }}" alt="">
                    </figure>
                </div>
                <div class="project-content">
                    <div class="project-content-title">
                        <h3>
                            <a href="{{!empty($lesson->slug_url)?url('lesson/' . Str::slug($lesson->slug_url)):''}}">
                                {{ !empty($lesson->heading) ? $lesson->heading : '' }} - {{ !empty($lesson->language->heading) ? $lesson->language->heading : '' }}
                            </a>
                        </h3>
                        <span><a href="{{!empty($lesson->slug_url)?url('lesson/' . Str::slug($lesson->slug_url)):''}}">
                            <i class="fa-solid fa-arrow-right-long"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            <!-- Post Pagination Start -->
            <div class="post-pagination wow fadeInUp" data-wow-delay="1s">
                {{ $lessons->links('pagination::bootstrap-4') }}
            </div>
            <!-- Post Pagination End -->
        </div>
    </div>
    
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