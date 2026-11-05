@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-2">
            <h4 class="section-header">Lessons</h4>
            <a class="btn btn-add" href="{{ url('admin/add-lessons') }}"><i class="fa-solid fa-plus"></i> Add Lessons</a>
        </div>
        <div class="card">
            <div class="card-body table-responsive department-card">
                <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                    <thead class="table-light">
                        <tr role="row">
                            <th width="5%">Sr. No.</th>
                            <th width="30%">Name</th>
                            <th width="15%">Language</th>
                            <th width="30%">Image</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- <tr>
                            <td>1</td>
                            <td></td>
                            <td>gjyf</td>
                            <td>gjyfj</td>
                            <td></td>
                            <td>
                                <a href="{{url('admin/view-lesson')}}" class="btn btn-view"><i class="fa-regular fa-eye"></i></a>
                                <a href="#" class="btn btn-edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="#" class="btn btn-delete delete btn-xs"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{ URL::asset('admin_panel/controller_js/cn_lessons.js')}}"></script> 
@endsection