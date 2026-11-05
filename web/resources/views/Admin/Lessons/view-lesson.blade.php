@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
<style>
    h4 {
        margin-bottom: 5px;
    } 
    h5 {
        font-weight: 400;
        margin-top: 0px;
    }
    .img {
        overflow: hidden;
    }
    .img img {
        width: 100%;
        object-fit: contain;
        height: auto;
    }
</style>
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/lessons') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">Lesson View</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <h4>Heading</h4>
                            <h5>{{ !empty($lesson->heading) ? $lesson->heading : '' }}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Language</h4>
                            <h5>{{ !empty($lesson->language_id) ? $lesson->language->heading : '' }}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Description</h4>
                            <h5>{!! !empty($lesson->lesson_description) ? $lesson->lesson_description : '' !!}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Additional Resources</h4>
                            <h5>{!! !empty($lesson->additional_description) ? $lesson->additional_description : '' !!}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Youtube Link</h4>
                            <h5><a href="{{ !empty($lesson->youtube_link) ? $lesson->youtube_link : '' }}" target="_blank">https://youtu.be/W_SkqgnH8B4?si=S8SWkQX-oQhgs9Vu</a><h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="img">
                            <img src="{{ !empty($lesson->lesson_img_path) ? url('/').Storage::url($lesson->lesson_img_path) : '' }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".item-lessons").addClass("menuitem-active");
    $(".item-lessons a").addClass("active");
</script>

<script src="{{ URL::asset('admin_panel/controller_js/cn_lessons.js')}}"></script> 
@endsection