@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Team</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="mb-2">
                        <label class="form-label">Pages</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Pages</option>
                            <option value="1">Home</option>
                            <option value="2">About Us</option>
                            <option value="2">Lessons</option>
                            <option value="2">Podcasts</option>
                            <option value="2">Blogs</option>
                            <option value="2">Contact Us</option>
                            <option value="3">Terms & Conditions</option>
                            <option value="3">Privacy Policy</option>
                          </select>
                    </div>
                    <div class="mb-2">
                        <label for="meta-title" class="form-label">Meta Title </label>
                        <input type="text" class="form-control" id="meta-title">
                    </div>
                    <div class="mb-2">
                        <label for="meta-keyword" class="form-label">Meta Keyword </label>
                        <input type="text" class="form-control" id="meta-keyword">
                    </div>
                    <div class="mb-2">
                        <label for="meta-description" class="form-label">Meta Description </label>
                        <textarea name="meta-description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-0">
                        <button class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection