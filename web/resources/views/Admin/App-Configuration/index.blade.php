
@section('meta_title') Dashboard | Jain Enlightened @endsection
@extends('Admin.Layouts.layout')

@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center my-2">
                <h4 class="section-header">{{ !empty($app_config->id) ? 'Edit App Configuration' :  'App Configuration' }}</h4>
            </div>
            <div class="col-4">
                <div class="card department-card">
                    <div class="card-body">
                        <form action="{{ route('config.store') }}" method="post" id="app_config_section" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $app_config->id ?? '') }}">
                            <div class="mb-2">
                                <label class="form-label">Configuration Type<span class="text-danger"><b>*</b></span></label>
                                <select class="form-select" name="config_type" id="config_type" aria-label="Default select example">
                                    <option value="">Select Type</option>
                                    @foreach(config('constant.app_config_type') as $key => $value)
                                    <option value="{{ $key }}" {{ old('config_type', $app_config->config_type ?? '') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach

                             
                                </select>
                                @if($errors->has('config_type'))
                                <span class="text-danger"><b>* {{ $errors->first('config_type') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="heading" class="form-label">Configuration Version<span class="text-danger"><b>*</b></span></label>
                                <input type="text" class="form-control" id="config_version" name="config_version" value="{{ !empty($app_config->config_version) ? $app_config->config_version : old('config_version') }}">
                                @if($errors->has('config_version'))
                                <span class="text-danger"><b>* {{ $errors->first('config_version') }}</b></span>
                                @endif
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-success" type="submit">{{ !empty($app_config) ? 'Update' : 'Submit' }}</button>
                                @if(empty($app_config))
                                 <button type="reset" class="btn btn-danger reset-button">Cancel</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body table-responsive department-card">
                        <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                            <thead class="table-light">
                                <tr role="row">
                                    <th width="5%">Sr. No.</th>
                                    <th width="35%">Configuration Type</th>
                                    <th width="35%">Configuration Version</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Action</th>
                               
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

<script>
    $(".item-app-configuration").addClass("menuitem-active");
    $(".item-app-configuration a").addClass("active");
</script>
<script src="{{ URL::asset('admin_panel/controller_js/cn_app_config.js')}}"></script>

<script>
    $(document).ready(function () {
   
        // Function to capitalize the first letter of a string
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // $('#config_version').on('input', function() {
    //         this.value = this.value.replace(/\D/g, ''); // Remove any non-numeric characters
    //     });

    $('#config_version').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, ''); // Allow only digits and dot

    // Ensure only one dot is allowed and it is not at the start
    if ((this.value.match(/\./g) || []).length > 1) {
        this.value = this.value.substring(0, this.value.length - 1); // Remove extra dots
    }
    
    // Prevent the dot from being the first character
    if (this.value.startsWith('.')) {
        this.value = '0' + this.value;
    }
});

    // Event handler for input on heading field
    $('#heading,#designation,#location,#meta_title,#meta_keyword').on('input', function() {
        var currentValue = $(this).val();
        $(this).val(capitalizeFirstLetter(currentValue));
    });

     $.validator.addMethod("checkFileType", function(value, element) {
    if (!element.files || !element.files[0]) {
        return true;
    }
    var fileType = element.files[0]['type'];
    var validExtensions = ['image/jpeg', 'image/jpg', 'image/png']; // Allowed file extensions
    var fileExtension = fileType.toLowerCase();
    return validExtensions.includes(fileExtension);
    }, "Please select a valid image file (jpg, jpeg, png).");

        

    $("#app_config_section").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            config_type: {
                required: true,
            },
            config_version: {
                required: true,
            },
        },
          errorElement: "span",
          errorPlacement: function(error, element) {
            if (element.attr("name") == "imptact_img_path") {
                error.addClass("text-danger");
                error.insertAfter($(".imptact_img_path"));
            }else{
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

});
  </script>



@endsection