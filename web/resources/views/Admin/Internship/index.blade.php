@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-2">
            <h4 class="section-header">Internship Enquiry</h4>
            <div>      
                <button class="btn btn-danger"  id="deleteSelected">Delete</button>
                <a href="{{ route('export.interns') }}" class="btn btn-success waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-file-excel"></i></span>Download to Excel</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive department-card">
                <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                    <thead class="table-light">
                        <tr role="row">
                            <th width="5%">Sr. No.</th>
                            <th><input type="checkbox" name="user_checkbox" id="selectAll" class="pe-1"></th>
                            <th width="10%">Date & Time</th>
                            <th width="15%">Name</th>
                            <th width="20%">Email</th>
                            <th width="10%">Mobile No</th>
                            <th width="30%">Position</th>
                            <th width="10%">Action</th>
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
{{-- <script src="{{ URL::asset('admin_panel/controller_js/cn_intern_enquirys.js')}}"></script> --}}

<script src="{{ URL::asset('admin_panel/controller_js/cn_intern.js')}}"></script>

<script>
    $(document).ready(function(){
        $("#selectAll").click(function(){
            $(".user_checkbox").prop('checked', $(this).prop('checked'));
        });
        $("#deleteSelected").click(function(){
            var selectedRecords = [];

            $("input:checkbox[name=user_checkbox]:checked").each(function(){
                selectedRecords.push($(this).val());
            });

            console.log(selectedRecords);

            if (confirm("Do you really want to delete?")) {
            $.ajax({
                url: "{{ route('intern.deleteSelected') }}",
                type: 'delete',    
                data: {
                    ids: selectedRecords,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response); 
                        if (response.success) {
                            success_toast("Success", "Data Deleted Successfully");
                            setTimeout(function() {
                                location.reload();
                            }, 1000); // 1000 milliseconds = 1 second
                           //  location.reload();
                        }
                
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        });
    });
</script>



@endsection