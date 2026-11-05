@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-2">
            <h4 class="section-header">Team</h4>
            <a class="btn btn-add" href="{{ url('admin/cms/team/add-team') }}"><i class="fa-solid fa-plus"></i> Add Team</a>
        </div>
        <div class="card">
            <div class="card-body table-responsive department-card">
                <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                    <thead class="table-light">
                        <tr role="row">
                            <th width="10%">Sr. No.</th>
                            <th width="30%">Name</th>
                            <th width="30%">Image</th>
                            <th width="15%">Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{ URL::asset('admin_panel/controller_js/cn_team.js')}}"></script> 

@endsection