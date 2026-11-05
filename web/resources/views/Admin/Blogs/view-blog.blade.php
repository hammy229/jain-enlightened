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
            <a class="btn btn-back" href="{{ url('admin/blogs') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">Blog View</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <h4>Heading</h4>
                            <h5>{{ !empty($blog->heading) ? $blog->heading : '' }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <h4>Blog By</h4>
                                <h5>{{ !empty($blog->blog_by) ? $blog->blog_by : '' }}</h5>
                            </div>
                            <div class="col-6 mb-3">
                                <h4>Date</h4>
                                <h5>{{ !empty($blog->date) ? \Carbon\Carbon::parse($blog->date)->format('d-m-Y') : '' }}</h5>
                            
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4>Short Description</h4>
                            <h5>{!! !empty($blog->short_description) ? $blog->short_description : '' !!}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Description</h4>
                            <h5>{!! !empty($blog->description) ? $blog->description : '' !!}</h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="img">
                            <img src="{{ !empty($blog->blog_img_path) ? url('/').Storage::url($blog->blog_img_path) : '' }}" alt="img">
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
    $(".item-blogs").addClass("menuitem-active");
    $(".item-blogs a").addClass("active");
</script>
<script src="{{ URL::asset('admin_panel/controller_js/cn_lessons.js')}}"></script> 
@endsection