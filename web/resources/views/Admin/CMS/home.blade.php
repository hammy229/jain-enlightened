@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
<style>
    .file_name_wrapper {
        display: flex;
        justify-content: space-between;
        width: 100%;
        background: #fff;
        border: 1px solid #ced4da;
        border-radius: .2rem !important;
        padding: 0.5rem 1rem 0.5rem 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Home Banner Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="home_banner_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="heading" id="heading" value="{{ !empty($home) ? $home->heading : '' }}">
                                @if($errors->has('heading'))
                                <span class="text-danger"><b>* {{ $errors->first('heading') }}</b></span>
                                @endif
                            </div>
        
                            <div class="mb-2">
                                <label for="ban_sub_heading" class="form-label">Sub Heading <span class="text-danger">*</span></label>
                                <textarea name="sub_heading" id="sub_heading" class="form-control" rows="4">{{ !empty($home) ? $home->sub_heading : '' }}</textarea>
                                @if($errors->has('sub_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('sub_heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="button_url" class="form-label">Play Store Link <span class="text-danger">*</span></label>
                                <input type="text" name="play_link" id="play_link" class="form-control" value="{{ !empty($home) ? $home->play_link : '' }}">
                                @if($errors->has('play_link'))
                                <span class="text-danger"><b>* {{ $errors->first('play_link') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="button_url" class="form-label">App Store Link <span class="text-danger">*</span></label>
                                <input type="text" name="app_link" id="app_link" class="form-control" value="{{ !empty($home) ? $home->app_link : '' }}">
                                @if($errors->has('app_link'))
                                <span class="text-danger"><b>* {{ $errors->first('app_link') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 banner_video_path">
                                <label class="form-label">Banner Video <span class="text-danger"> * Note: image size: less than 8MB, <br> image type: mp4.</span></label>
                                <input type="file" name="banner_video_path" id="banner_video_path" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($home->banner_video_path) ? url('/').Storage::url($home->banner_video_path) : '' }}" accept="video/*" />
                                @if($errors->has('banner_video_path'))
                                <span class="text-danger"><b>* {{ $errors->first('banner_video_path') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="button_url" class="form-label">Youtube Video Link <span class="text-danger">*</span></label>
                                <input type="text" name="you_tube_link" id="you_tube_link" class="form-control" value="{{ !empty($home) ? $home->you_tube_link : '' }}" >
                                @if($errors->has('you_tube_link'))
                                <span class="text-danger"><b>* {{ $errors->first('you_tube_link') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="home_banner_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Banner Cards Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
               

                <form action="{{ route('home.store') }}" method="post" id="banner_cards_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" name="card_heading_1" id="card_heading_1" class="form-control" value="{{ !empty($home) ? $home->card_heading_1 : '' }}">
                                @if($errors->has('card_heading_1'))
                                <span class="text-danger"><b>* {{ $errors->first('card_heading_1') }}</b></span>
                                @endif
                            </div>
                            
                            <div class="mb-2">
                                <label for="ban_sub_heading" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="card_description_1" name="card_description_1"  class="form-control" rows="4">{{ !empty($home) ? $home->card_description_1 : '' }}</textarea>
                                @if($errors->has('card_description_1'))
                                <span class="text-danger"><b>* {{ $errors->first('card_description_1') }}</b></span>
                                @endif
                            </div>
                            {{-- <div class="mb-2">
                                <label class="form-label">Icon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" name="card_icon_1_path" class="form-control" id="upload_image" value="{{ !empty($home->card_icon_1_path) ? url('/').Storage::url($home->card_icon_1_path) : '' }}" accept=".jpg, .jpeg, .png" onchange="fileSelected(this)" style="display: none">
                                    @if($errors->has('card_icon_1_path'))
                                    <span class="text-danger"><b>* {{ $errors->first('card_icon_1_path') }}</b></span>
                                    @endif
                                    <label class="input-group-text file_name_wrapper" for="upload_image" style="cursor: pointer">
                                        <p class="uploaded_file_name mb-0" style="font-size:0.8125rem;">Browse Your Image</p>
                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    </label>
                                </div>
                            </div> --}}
                            <div class="mb-2">
                                <label class="form-label">Icon 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" name="card_icon_1_path" class="form-control" id="upload_image_1" accept=".jpg, .jpeg, .png" onchange="fileSelected(this, 'file_name_1')" style="display: none">
                                    @if($errors->has('card_icon_1_path'))
                                    <span class="text-danger"><b>* {{ $errors->first('card_icon_1_path') }}</b></span>
                                    @endif
                                    <label class="input-group-text file_name_wrapper" for="upload_image_1" style="cursor: pointer">
                                        <p class="uploaded_file_name" id="file_name_1" class="mb-0" style="font-size:0.8125rem; margin-bottom: 0px;">
                                            {{ !empty($home->card_icon_1_name) ? basename($home->card_icon_1_name) : 'Browse Your Image' }}
                                        </p>
                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2 card_image_1_path">
                                <label class="form-label">Background Image <span class="text-danger"> * Note: image ratio: 16 x 9, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" class="form-control" name="card_image_1_path" id="card_image_1_path" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($home->banner_video_path) ? url('/').Storage::url($home->card_image_1_path) : '' }}" accept="image/*" />
                                @if($errors->has('card_image_1_path'))
                                <span class="text-danger"><b>* {{ $errors->first('card_image_1_path') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4"> 
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="card_heading_2" id="card_heading_2" value="{{ !empty($home) ? $home->card_heading_2 : '' }}" >
                                @if($errors->has('card_heading_2'))
                                <span class="text-danger"><b>* {{ $errors->first('card_heading_2') }}</b></span>
                                @endif
                            </div>
        
                            <div class="mb-2">
                                <label for="ban_sub_heading" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="card_description_2" id="card_description_2" class="form-control" rows="4">{{ !empty($home) ? $home->card_description_2 : '' }}</textarea>
                                @if($errors->has('card_description_2'))
                                <span class="text-danger"><b>* {{ $errors->first('card_description_2') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Icon 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" name="card_icon_2_path" class="form-control" id="upload_image_2" accept=".jpg, .jpeg, .png" onchange="fileSelected(this, 'file_name_2')" style="display: none">
                                    @if($errors->has('card_icon_2_path'))
                                    <span class="text-danger"><b>* {{ $errors->first('card_icon_2_path') }}</b></span>
                                    @endif
                                    <label class="input-group-text file_name_wrapper" for="upload_image_2" style="cursor: pointer">
                                        <p class="uploaded_file_name" id="file_name_2" class="mb-0" style="font-size:0.8125rem; margin-bottom: 0px;">
                                            {{ !empty($home->card_icon_2_name) ? basename($home->card_icon_2_name) : 'Browse Your Image' }}
                                        </p>
                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2 card_image_2_path">
                                <label class="form-label">Background Images <span class="text-danger"> * Note: image ratio: 16 x 9, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" class="form-control" name="card_image_2_path" id="card_image_2_path" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($home->card_image_2_path) ? url('/').Storage::url($home->card_image_2_path) : '' }}" accept="image/*" />
                                @if($errors->has('card_image_2_path'))
                                <span class="text-danger"><b>* {{ $errors->first('card_image_2_path') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="card_heading_3" id="card_heading_3" value="{{ !empty($home) ? $home->card_heading_3 : '' }}">
                                @if($errors->has('card_heading_3'))
                                <span class="text-danger"><b>* {{ $errors->first('card_heading_3') }}</b></span>
                                @endif
                            </div>
        
                            <div class="mb-2">
                                <label for="ban_sub_heading" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="card_description_3" id="card_description_3" class="form-control" rows="4">{{ !empty($home) ? $home->card_description_3 : '' }}</textarea>
                                @if($errors->has('card_description_3'))
                                <span class="text-danger"><b>* {{ $errors->first('card_description_3') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Icon 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" name="card_icon_3_path" class="form-control" id="upload_image_3" accept=".jpg, .jpeg, .png" onchange="fileSelected(this, 'file_name_3')" style="display: none">
                                    @if($errors->has('card_icon_3_path'))
                                    <span class="text-danger"><b>* {{ $errors->first('card_icon_3_path') }}</b></span>
                                    @endif
                                    <label class="input-group-text file_name_wrapper" for="upload_image_3" style="cursor: pointer">
                                        <p class="uploaded_file_name" id="file_name_3" class="mb-0" style="font-size:0.8125rem; margin-bottom: 0px;">
                                            {{ !empty($home->card_icon_3_name) ? basename($home->card_icon_3_name) : 'Browse Your Image' }}
                                        </p>
                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2 card_image_3_path">
                                <label class="form-label">Background Images <span class="text-danger"> * Note: image ratio: 16 x 9, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" class="form-control" name="card_image_3_path" id="card_image_3_path" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($home->card_image_3_path) ? url('/').Storage::url($home->card_image_3_path) : '' }}" accept="image/*" />
                                @if($errors->has('card_image_3_path'))
                                <span class="text-danger"><b>* {{ $errors->first('card_image_3_path') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="banner_cards_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>

            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">About Us Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="about_us_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="about_heading" id="about_heading" value="{{ !empty($home) ? $home->about_heading : '' }}">
                                @if($errors->has('about_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('about_heading') }}</b></span>
                                @endif
                            </div>

                            <div class="mb-2 about_description">
                                <label for="description" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                <textarea class="summernote" name="about_description" id="description" cols="30" rows="10" style="display: none;">{{ !empty($home) ? $home->about_description : '' }}
                                </textarea>
                                 @if($errors->has('about_description'))
                                <span class="text-danger"><b>* {{ $errors->first('about_description') }}</b></span>
                                @endif
                            </div>
        
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 about_image_path">
                                <label class="form-label">Image <span class="text-danger"> * Note: image ratio: 2 x 2, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" class="form-control" name="about_image_path" id="about_image_path" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($home->about_image_path) ? url('/').Storage::url($home->about_image_path) : '' }}" accept="image/*" />
                                @if($errors->has('about_image_path'))
                                <span class="text-danger"><b>* {{ $errors->first('about_image_path') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 about_video_path">
                                <label class="form-label">Video <span class="text-danger"> * Note: image size: less than 12MB, <br> image type: mp4.</span></label>
                                <input type="file" class="form-control" name="about_video_path" id="about_video_path" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($home->about_video_path) ? url('/').Storage::url($home->about_video_path) : '' }}" accept="video/*"  />
                                @if($errors->has('about_video_path'))
                                <span class="text-danger"><b>* {{ $errors->first('about_video_path') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="about_us_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Lessons Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="lessons_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="lessons_heading" id="lessons_heading" class="form-control" value="{{ !empty($home) ? $home->lessons_heading : '' }}">
                        @if($errors->has('lessons_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('lessons_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label for="ban_sub_heading" class="form-label">Sub Heading <span class="text-danger">*</span></label>
                        <textarea name="lessons_sub_heading" id="lessons_sub_heading" class="form-control" rows="3"> {{ !empty($home) ? $home->lessons_sub_heading : '' }}
                        </textarea>
                        @if($errors->has('lessons_sub_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('lessons_sub_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="lessons_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Founders Message Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="founders_message_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-2">
                                <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="founders_heading" id="founders_heading" value="{{ !empty($home) ? $home->founders_heading : '' }}">
                                @if($errors->has('gallery_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('gallery_heading') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2 founders_description">
                                <label for="description2" class="form-label">Description <span class="text-danger"><b>*</b></span></label>
                                <textarea name="founders_description" class="summernote" id="description2" cols="30" rows="10" style="display: none;"> {{ !empty($home) ? $home->founders_description : '' }}
                                </textarea>
                                @if($errors->has('gallery_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('gallery_heading') }}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2 founders_image_path">
                                <label class="form-label">Image <span class="text-danger"> * Note: image ratio: 2 x 2, <br> image size: less than 5MB, image type: jpg, jpeg, png.</span></label>
                                <input type="file" id="founders_image_path" name="founders_image_path" class="form-control" data-plugins="dropify" data-show-remove="false" data-default-file="{{ !empty($home->founders_image_path) ? url('/').Storage::url($home->founders_image_path) : '' }}" accept="image/*" />
                                @if($errors->has('gallery_heading'))
                                <span class="text-danger"><b>* {{ $errors->first('gallery_heading') }}</b></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="founders_message_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Podcasts Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="podcasts_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="podcasts_heading" id="podcasts_heading" value="{{ !empty($home) ? $home->podcasts_heading : '' }}">
                        @if($errors->has('podcasts_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('podcasts_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-2 ">
                        <label for="ban_sub_heading" class="form-label">Sub Heading <span class="text-danger">*</span></label>
                        <textarea name="podcasts_sub_heading" id="podcasts_sub_heading" class="form-control" rows="3">{{ !empty($home) ? $home->podcasts_sub_heading : '' }}</textarea>
                        @if($errors->has('podcasts_sub_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('podcasts_sub_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="podcasts_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
       
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Jainism Additional Educational Resources Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="jainism_additional_educational_resources_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="jain_edu_heading" id="jain_edu_heading"class="form-control" value="{{ !empty($home) ? $home->jain_edu_heading : '' }}">
                        @if($errors->has('jain_edu_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('jain_edu_heading') }}</b></span>
                        @endif
                    </div>
                

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="jainism_additional_educational_resources_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header"> Jainism Research and Academic Resources Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="jainism_research_and_academic_resources_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="jain_acd_heading" id="jain_acd_heading" class="form-control" value="{{ !empty($home) ? $home->jain_acd_heading : '' }}" >
                        @if($errors->has('jain_acd_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('jain_acd_heading') }}</b></span>
                        @endif
                    </div>
                  
                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="jainism_research_and_academic_resources_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
      
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Testimonials Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="testimonials_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="testimonials_heading" id="testimonials_heading" class="form-control" value="{{ !empty($home) ? $home->testimonials_heading : '' }}" >
                        @if($errors->has('testimonials_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('testimonials_heading') }}</b></span>
                        @endif
                    </div>
                

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="testimonials_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Blogs Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="blogs_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="blog_heading" id="blog_heading" class="form-control" value="{{ !empty($home) ? $home->blog_heading : '' }}"  >
                        @if($errors->has('blog_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('blog_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label for="ban_sub_heading" class="form-label">Sub Heading <span class="text-danger">*</span></label>
                        <textarea name="blog_sub_heading" id="blog_sub_heading" class="form-control" rows="3">{{ !empty($home) ? $home->blog_sub_heading : '' }}</textarea>
                        @if($errors->has('blog_sub_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('blog_sub_heading') }}</b></span>
                        @endif
                    </div>

                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="blogs_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- ------------------------------ --}}
        <div class="d-flex align-items-center my-2" style="gap: 20px;">
            <h4 class="section-header">Gallery Section</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('home.store') }}" method="post" id="gallery_section" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($home) ? $home->id : '' }}">
                    <div class="mb-2">
                        <label for="ban_heading" class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="gallery_heading" id="gallery_heading" class="form-control" value="{{ !empty($home) ? $home->gallery_heading : '' }}">
                        @if($errors->has('gallery_heading'))
                        <span class="text-danger"><b>* {{ $errors->first('gallery_heading') }}</b></span>
                        @endif
                    </div>
                 
                    <div class="mb-0">
                        <button class="btn btn-success" type="submit" name="gallery_section"> {{ empty($home) ? 'Submit' : 'Update' }} </button>
                        @if(empty($home)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    // function fileSelected(input) {
    //      const file = input.files[0]; // Get the first file selected (can be extended for multiple files)
    //      const fileName = file.name; // Get the file name

    //      const uploadedFileNameElement = document.querySelector(".uploaded_file_name");
    //      uploadedFileNameElement.textContent = fileName; // Set the text content to the file name
    // }
</script>

<script>
    // function fileSelected(input, fileNameId) {
    //     const file = input.files[0];
    //     const fileName = file ? file.name : 'Browse Your Image';
    //     document.getElementById(fileNameId).textContent = fileName;
    // }

    function fileSelected(input, fileNameId) {
    const file = input.files[0];
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Allow only .jpg, .jpeg, and .png

    if (file) {
        if (!allowedExtensions.exec(file.name)) {
            alert('Invalid file type. Please select a .jpg, .jpeg, or .png image.');
            input.value = ''; // Clear the input field if validation fails
            document.getElementById(fileNameId).textContent = 'Browse Your Image';
            return;
        }
        document.getElementById(fileNameId).textContent = file.name; // Display valid file name
    } else {
        document.getElementById(fileNameId).textContent = 'Browse Your Image';
    }
}


</script>

<script>
    $(document).ready(function () {
        // Function to capitalize the first letter of a string
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    
        // Event handler for input on heading field
        $('#heading,#sub_heading,#card_heading_1,#card_heading_2,#card_heading_3,#lessons_heading,#lessons_sub_heading,#founders_heading,#podcasts_heading,#podcasts_sub_heading,#jain_edu_heading,#jain_acd_heading,#testimonials_heading,#blog_heading,#blog_sub_heading,#gallery_heading').on('input', function() {
            var currentValue = $(this).val();
            $(this).val(capitalizeFirstLetter(currentValue));
        });
    
        $.validator.addMethod("checkFileType", function(value, element) {
            if (!element.files || !element.files[0]) {
                return true;
            }
            var fileType = element.files[0]['type'];
            var validExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg']; // Allowed file extensions
            return validExtensions.includes(fileType.toLowerCase());
        }, "Please select a valid image file (jpg, jpeg, png).");


        $.validator.addMethod("jqteRequired", function (value, element) {
        // Get the content from the jqte editor
        var editorContent = $(element).val();
        
        // Function to strip HTML tags (similar to PHP's strip_tags)
        function stripTags(input) {
            return input.replace(/<\/?[^>]+(>|$)/g, "");
        }
        // Strip tags from the editor content and remove spaces and newlines
        var strippedContent = stripTags(editorContent).replace(/\s+/g, '').trim();

        // Check if content is empty or only contains tags like <br> or <p><br></p>
        var isInvalid = strippedContent.length === 0 || strippedContent === '<br>' || strippedContent === '';

        return !isInvalid; // Return true if valid content exists
    }, "This field is required.");
    
     
     
        jQuery.validator.addMethod("checkFileSize", function(value, element) {
        const maxSize = 50 * 1024 * 1024; // 50 MB
        const file = element.files[0];
        if (!file) return true; // If no file is selected, do not validate for file size
        return file.size <= maxSize;
    }, "File size must be less than 50 MB.");


    jQuery.validator.addMethod("checkFileTypes", function(value, element) {
        const allowedExtensions = ['mp4', 'avi', 'mov'];
        const file = element.files[0];
        if (!file) return true; // If no file is selected, do not validate for file type
        const extension = file.name.split('.').pop().toLowerCase();
        return allowedExtensions.includes(extension);
    }, "Please upload a valid video file.");

        // Custom method to validate YouTube link
    $.validator.addMethod("youtubeUrl", function(value, element) {
        // Regular expression to match valid YouTube URLs
        var youtubePattern = /^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/;
        return this.optional(element) || youtubePattern.test(value);
    }, "Please enter a valid YouTube URL.");
     
     
        $("#home_banner_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                heading: {
                    required: true,
                    maxlength: 50 
                },
                sub_heading:{
                    required: true,
                    maxlength: 100 
                },
                play_link: {
                    required: true,
                    url: true
                },
                app_link:{
                    required: true,
                    url: true
                },
                you_tube_link:{
                    required: true,
                    url: true, // For general URL format check
                    youtubeUrl: true // Custom method to validate YouTube URL
                },
                banner_video_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileTypes: true,
                    checkFileSize: true
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "banner_video_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".banner_video_path"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "banner_video_path") {
                    $(element).valid();
                }
            },
        });


        $("#banner_cards_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                card_heading_1: {
                    required: true,
                    maxlength: 50 
                },
                card_heading_2:{
                    required: true,
                    maxlength: 50 
                },
                card_heading_3: {
                    required: true,
                    maxlength: 50 
                },
                card_description_1:{
                    required: true,
                    maxlength: 100 
                },
                card_description_2:{
                    required: true,
                    maxlength: 100 
                },
                card_description_3:{
                    required: true,
                    maxlength: 100 
                },
                card_icon_1_path: {
                 //   checkFileType: true,
                },
                card_icon_2_path: {
                  //  checkFileType: true,
                },
                card_icon_3_path: {
                 //   checkFileType: true,
                },
                card_image_1_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileType: true,
                },
                card_image_2_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileType: true,
                },
                card_image_3_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileType: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "banner_video_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".banner_video_path"));
                } else if (element.attr("name") == "card_icon_1_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".card_icon_1_path"));
                }
                else if (element.attr("name") == "card_icon_2_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".card_icon_2_path"));
                }
                else if (element.attr("name") == "card_icon_3_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".card_icon_1_path"));
                }else if (element.attr("name") == "card_image_1_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".card_image_1_path"));
                }
                else if (element.attr("name") == "card_image_2_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".card_image_2_path"));
                }
                else if (element.attr("name") == "card_image_3_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".card_image_3_path"));
                }
                 else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "banner_video_path") {
                    $(element).valid();
                }
            },
        });



        $("#about_us_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                about_heading: {
                    required: true,
                },
                about_description:{
                    required: true,
                    jqteRequired: true
                },
             
                about_image_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileType: true,
                },
                about_video_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileTypes: true,
                    checkFileSize: true
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "about_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_image_path"));
                }  else if (element.attr("name") == "about_video_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_video_path"));
                }else if (element.attr("name") == "about_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_description"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });

       
        $("#lessons_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                lessons_heading: {
                    required: true,
                },
                lessons_sub_heading:{
                    required: true,
                },
             
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "about_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_image_path"));
                }  else if (element.attr("name") == "about_video_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_video_path"));
                }else if (element.attr("name") == "about_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_description"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
              
                    $(element).valid();
                
            },
        });


        $("#founders_message_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                founders_heading: {
                    required: true,
                },
                founders_description:{
                    required: true,
                    jqteRequired: true
                },
             
                founders_image_path: {
                    required: function(element) {
                        return $(element).data('dropify').settings.defaultFile === '';
                    },
                    checkFileType: true,
                },
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "founders_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_image_path"));
                }  else if (element.attr("name") == "founders_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_description"));
                }else if (element.attr("name") == "about_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_description"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });

        $("#podcasts_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                podcasts_heading: {
                    required: true,
                },
                podcasts_sub_heading:{
                    required: true,
                   // jqteRequired: true
                },
            
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "founders_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_image_path"));
                }  else if (element.attr("name") == "founders_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_description"));
                }else if (element.attr("name") == "about_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_description"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });


        $("#jainism_additional_educational_resources_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                jain_edu_heading: {
                    required: true,
                },
            
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "founders_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_image_path"));
                }  else if (element.attr("name") == "founders_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_description"));
                }else if (element.attr("name") == "about_description") {
                    error.addClass("text-danger");
                    error.insertAfter($(".about_description"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });

        $("#jainism_research_and_academic_resources_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                jain_acd_heading: {
                    required: true,
                },
            
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "founders_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_image_path"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });


        $("#testimonials_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                testimonials_heading: {
                    required: true,
                },
            
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "founders_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_image_path"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });


        $("#blogs_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                blog_heading: {
                    required: true,
                },
                blog_sub_heading: {
                    required: true,
                },

            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "founders_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_image_path"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });

        
        $("#gallery_section").validate({
            ignore: ".jqte_editor *",
            debug: false,
            rules: {
                gallery_heading: {
                    required: true,
                },
            
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                if (element.attr("name") == "founders_image_path") {
                    error.addClass("text-danger");
                    error.insertAfter($(".founders_image_path"));
                } else {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                }
            },
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                if ($(element).attr("name") !== "about_video_path" || $(element).attr("name") !== "about_image_path") {
                    $(element).valid();
                }
            },
        });
    
    });
    </script>

@endsection