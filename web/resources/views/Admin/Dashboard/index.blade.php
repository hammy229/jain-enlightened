@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
<style>
    .card {
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        background: #003b49;
        border: none;
    }

    .card::before {
        content: "";
        height: 100px;
        width: 100px;
        position: absolute;
        top: -40%;
        left: -20%;
        border-radius: 50%;
        border: 35px solid rgba(255, 255, 255, 0.102);
        transition: all .8s ease;
        filter: blur(.5rem);
    }

    .card:hover::before {
        width: 140px;
        height: 140px;
        top: -30%;
        left: 50%;
        filter: blur(0rem);
    }
    .card-body  {

        .header-title {
            font-size: 20px;
            color: #f6bf60;
            
        }
        .fw-normal {
            color: #f6bf60;
            font-size: 40px;
            font-family: fantasy;
        }
    }
    
</style>
@endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid dashboard-cards">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <a href="{{url('admin/lessons')}}" class="card-body">
                            <h4 class="header-title mt-0 mb-4">Lessons</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr" style="margin-top: 20px;">
                                    <i class="fa-solid fa-graduation-cap" style="font-size: 3rem; color:#ffffff2e;"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal mb-1"> {{ !empty($lesson_count) ? $lesson_count:'-' }} </h2>
                                    <p class="text-muted mb-1">Total Lessons</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <a href="{{url('admin/podcast')}}" class="card-body">
                            <h4 class="header-title mt-0 mb-4">Podcasts</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr" style="margin-top: 20px;">
                                    <i class="fa-solid fa-radio" style="font-size: 3rem; color:#ffffff2e;"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal mb-1"> {{ !empty($podcast_count) ? $podcast_count:'-' }} </h2>
                                    <p class="text-muted mb-1">Total Podcasts</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <a href="{{url('admin/blogs')}}" class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Blogs</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr" style="margin-top: 20px;">
                                    <i class="fa-solid fa-clipboard" style="font-size: 3rem; color:#ffffff2e;"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal mb-1"> {{ !empty($blog_count) ? $blog_count:'-' }} </h2>
                                    <p class="text-muted mb-1">Total Blogs</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <a href="#" class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Visitors</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr" style="margin-top: 20px;">
                                    <i class="fa-solid fa-users" style="font-size: 3rem; color:#ffffff2e;"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal mb-1">  {{ !empty($visit_count) ? $visit_count->visit_count:'-' }}</h2>
                                    <p class="text-muted mb-1">Total Visitors</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <a href="{{url('admin/internship-enquiry')}}" class="card-body">
                            <h4 class="header-title mt-0 mb-4">Internship</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr" style="margin-top: 20px;">
                                    <i class="fa-solid fa-user-graduate" style="font-size: 3rem; color:#ffffff2e;"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal mb-1"> {{ !empty($internship_count) ? $internship_count:'-' }}  </h2>
                                    <p class="text-muted mb-1">Total Enquiry</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <a href="{{url('admin/contact-us')}}" class="card-body">
                            <h4 class="header-title mt-0 mb-4">Contact Us</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr" style="margin-top: 20px;">
                                    <i class="fa-solid fa-address-book" style="font-size: 3rem; color:#ffffff2e;"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal mb-1"> {{ !empty($contact_count) ? $contact_count:'-' }}  </h2>
                                    <p class="text-muted mb-1">Total Enquiry</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection