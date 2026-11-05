@section('meta_title') Research | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-2">
            <h4 class="section-header">Research</h4>
            <a class="btn btn-add" href="{{ url('admin/add-research') }}"><i class="fa-solid fa-plus"></i> Add Research</a>
        </div>
        <div class="card">
            <div class="card-body table-responsive department-card">
                <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                    <thead class="table-light">
                        <tr role="row">
                            <th width="5%">Sr. No.</th>
                            <th class="text-center" width="5%">Latest Checked</th>
                            <th width="20%">Heading</th>
                            <th width="30%">Description</th>
                            <th width="30%">Image</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{ URL::asset('admin_panel/controller_js/cn_research.js')}}"></script>

    <script>
        function updateLatestChecked(checkbox) {
            let id = checkbox.getAttribute('data-id');
            let checked = checkbox.checked;

            $.ajax({
                url: '{{ route("research.updateLatestChecked") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    latest_checked: checked ? 1 : 0
                },
                success: function(response) {
                    if (response.success) {
                        success_toast("success", "Latest Checked status updated successfully.");
                    }
                },
                error: function(xhr) {
                    // Handle error responses
                    if (xhr.status === 400 && xhr.responseJSON.message) {
                        // Show error toast for backend validation
                        error_toast(xhr.responseJSON.message,'You can only check up to 3 records as latest'); // Show the message from the backend
                        checkbox.checked = false; 
                    } else {
                        error_toast('Error updating Latest Checked status.'); 
                    }
                }
            });
        }
    </script>

@endsection