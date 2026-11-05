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
        /* height: 300px; */
    }
</style>
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/research') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">Research View</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <h4>Heading</h4>
                            <h5>{{ !empty($research->heading) ? $research->heading : '' }}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Selected Resource</h4>
                            <h5>{{ !empty($research->resources) ? ucwords(str_replace('_', ' ', $research->resources)) : '' }}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Description</h4>
                            <h5>{!! !empty($research->description) ? $research->description : '' !!}</h5>
                        </div>
                        <div class="mb-3">
                            <h4>Link</h4>
                            <h5><a href="{{ !empty($research->research_url) ? $research->research_url : '' }}" target="_blank">https://research-archive.org/index.php/rars/preprint/view/1453/version/1593</a></h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="img">
                            <img src="{{ !empty($research->research_img_path) ? url('/').Storage::url($research->research_img_path) : '' }}" alt="img">
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
    $(".item-research").addClass("menuitem-active");
    $(".item-research a").addClass("active");
</script>
<script src="{{ URL::asset('admin_panel/controller_js/cn_lessons.js')}}"></script> 
@endsection