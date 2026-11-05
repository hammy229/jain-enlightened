{{-- Navbar Start --}}
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                {{-- <img src="{{ !empty(Auth::guard('master_admins')->user()->user_profile_image_path) && Storage::exists(Auth::guard('master_admins')->user()->user_profile_image_path) ? url('/').Storage::url(Auth::guard('master_admins')->user()->user_profile_image_path) : URL::asset('package_assets/images/default-images/profile-image.png')}}" alt="user-image" class="rounded-circle"> --}}
                <span class="pro-user-name ms-1"> {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }} <i class="fa-solid fa-angle-down"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                {{-- <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }}!</h6>
                    <div class="text-center mt-1" style="background-color: #f3f9ff;"><span>{{ App\Helpers\Helpers\Helper::getRoleName() }}</span></div>
                </div>
                <div class="dropdown-divider"></div> --}}

                <a href="{{ url('admin/logout') }}" class="dropdown-item notify-item">
                    <i class="fa-solid fa-right-from-bracket fa-xl"></i>
                    <span>Logout</span>
                </a> 

            </div>
        </li>
    </ul>

    <div class="logo-box">
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) : URL::asset('package_assets/images/construction_inventory_old.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name : '' }}" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('package_assets/images/construction_inventory_old.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" height="16">
            </span>
        </a>
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) : URL::asset('package_assets/images/Logo/logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name : '' }}" height="22">
            </span>
            <span class="logo-lg text-dark fs-4">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('package_assets/images/Logo/logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" height="55">
            </span>
        </a>
    </div>    

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                {{-- <i class="fe-menu"></i> --}}
                <i class="fa-solid fa-bars fa-xl"></i>
            </button>
        </li>
    </ul>

</div>
{{-- Navbar End --}}