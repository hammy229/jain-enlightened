@php
$role_id = Auth::guard('master_admins')->user()->role_id;
$RolesPrivileges = App\Models\Master\Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
@endphp
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li>
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="fa-solid fa-layer-group fa-xl"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="master">
                    <a href="#master" data-bs-toggle="collapse">
                        <i class="fa-brands fa-windows fa-xl"></i>
                        <span> Master </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="master">
                        <ul class="nav-second-level">
                            <li class="site-master">
                                <a href="{{ url('admin/banner') }}">Banner</a>
                            </li>
                            <li class="department-master">
                                <a href="{{ url('admin/CMS/home') }}">Home</a>
                            <li class="designation-master">
                                <a href="{{ url('admin/CMS/about-us') }}">About Us</a>
                            </li>
                            <li class="team-master">
                                <a href="{{ url('admin/CMS/Team/index') }}">Team</a>
                            </li>
                            <li class="testimoials-master">
                                <a href="{{ url('admin/CMS/Testimonials/index') }}">Testimoials</a>
                            </li>
                            <li class="designation-master">
                                <a href="{{ url('admin/CMS/internship') }}">Internship</a>
                            </li>
                            <li class="designation-master">
                                <a href="{{ url('admin/CMS/strategic-goals') }}">Strategic Goals</a>
                            </li>
                            <li class="category-master">
                                <a href="{{ url('admin/terms-conditions') }}">Terms & Conditions</a>
                            </li>
                            <li class="sub-category-master">
                                <a href="{{ url('admin/privacy-policy') }}">Privacy Policy</a>
                            </li>
                            <li class="unit-master">
                    <a href="{{ url('admin/lessons') }}">
                        <i class="fa-solid fa-graduation-cap fa-xl"></i>
                        <span> Lessons </span>
                    </a>
                </li>
                <li class="item-requisition">
                    <a href="{{ url('admin/podcast') }}">
                        <i class="fa-solid fa-radio fa-xl"></i>
                        <span> Podcasts </span>
                    </a>
                </li>
                <li class="utilized-item">
                    <a href="{{ url('admin/blogs') }}">
                        <i class="fa-solid fa-clipboard fa-xl"></i>
                        <span> Blogs </span>
                    </a>
                </li>
                <li class="documents">
                    <a href="{{ url('admin/contact-us') }}">
                        <i class="fa-solid fa-address-book fa-xl"></i>
                        <span>Contact Us </span>
                    </a>
                </li>
                <li class="setting">
                    <a href="#setting" data-bs-toggle="collapse">
                        <i class="fa-solid fa-sliders fa-xl"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="nav-second-level">
                            <li class="general-setting">
                                <a href="{{ url('/admin/general-setting') }}">
                                    <span> General Settings</span>
                                </a>
                            </li>
                            <li class="visual-setting">
                                <a href="{{ url('/admin/visual-setting') }}">
                                    <span> Visual Settings</span>
                                </a>
                            </li>
                            <li class="change-password">
                                <a href="{{ url('/admin/change-password') }}">
                                    <span> Change Password</span>
                                </a>
                            </li>
                            <li class="logout">
                                <a href="{{ url('admin/logout') }}">
                                    <span> Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>