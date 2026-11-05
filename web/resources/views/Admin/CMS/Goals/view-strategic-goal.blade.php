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
        object-fit: contain;
        height: 300px;
    }
</style>
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/cms/strategic-goals') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">Strategic Goal View</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <h4>Heading</h4>
                            <h5>{{ !empty($strategic->heading) ? $strategic->heading : '' }}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Description</h4>
                            <h5>{!! !empty($strategic->description) ? $strategic->description : '' !!}</h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="img">
                            <img src="{{ !empty($strategic->strategic_img_path) ? url('/').Storage::url($strategic->strategic_img_path) : '' }}" alt="img">
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
    $(".cms").addClass("menuitem-active");
    $("#cms").addClass("show");
    $(".goals-cms a").addClass("active");
</script>
<script src="{{ URL::asset('admin_panel/controller_js/cn_lessons.js')}}"></script> 
@endsection