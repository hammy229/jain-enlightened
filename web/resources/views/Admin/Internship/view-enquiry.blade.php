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
</style>

@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <a class="btn btn-back" href="{{ url('admin/internship-enquiry') }}"><i class="fa-solid fa-angle-left"></i></a>
            <h4 class="section-header">Internship Enquiry View</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4>Full Name</h4>
                    <h5>{{ !empty($intern->name) ? $intern->name : '' }}</h5>
                </div>
                <div class="mb-3">
                    <h4>Email Id</h4>
                    <h5>{{ !empty($intern->email) ? $intern->email : '' }}</h5>
                </div>
                <div class="mb-3">
                    <h4>Mobile No.</h4>
                    <h5>{{ !empty($intern->mobile_no) ? $intern->mobile_no : '' }}</h5>
                </div>
                <div class="mb-3">
                    <h4>Positions</h4>
                    <h5>{{ !empty($intern->position) ? ucwords(str_replace('_', ' ', $intern->position)) : '' }}</h5>
                </div>
                <div class="mb-3">
                    <h4>Info</h4>
                    <h5>{{ !empty($intern->about) ? $intern->about : '' }}</h5>
                </div>
                <div class="mb-3">
                    <h4>Goals</h4>
                    <h5>{{ !empty($intern->goals) ? $intern->goals : '' }}</h5>
                </div>
                <div class="mb-3">
                    <h4>Message</h4>
                    <h5>{{ !empty($intern->message) ? $intern->message : '' }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('admin_panel/controller_js/cn_contact_enquiry.js')}}"></script>

<script>
    $(".item-Internship").addClass("menuitem-active");
    $(".item-Internship a").addClass("active");
</script>

@endsection