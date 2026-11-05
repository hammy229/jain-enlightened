{{-- @php
$role_id = Auth::guard('master_admins')->user()->role_id;
$RolesPrivileges = App\Models\Master\Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
@endphp --}}
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
                          
                            <li class="language-master">
                                <a href="{{ url('admin/master/language') }}">Language</a>
                            </li>
                          
                        </ul>
                    </div>
                </li>
            
                <li class="cms">
                    <a href="#cms" data-bs-toggle="collapse">
                        <i class="fa-brands fa-windows fa-xl"></i>
                        <span> CMS </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="cms">
                        <ul class="nav-second-level">
                          
                            <li class="banner-cms">
                                <a href="{{ url('admin/cms/banner') }}">Banner</a>
                            </li>
                            
                            <li class="app-banner-cms">
                                <a href="{{ url('admin/cms/app-banner') }}">App Banner</a>
                            </li>
                            <li class="home-cms">
                                <a href="{{ url('admin/cms/home') }}">Home</a>
                            </li>
                          
                            <li class="about-cms">
                                <a href="{{ url('admin/cms/about-us') }}">About Us</a>
                            </li>
                          
                            <li class="team-cms">
                                <a href="{{ url('admin/cms/team/index') }}">Team</a>
                            </li>
                         
                            <li class="testimoials-cms">
                                <a href="{{ url('admin/cms/testimonials/index') }}">Testimonials </a>
                            </li>
                         
                            <li class="internship-cms">
                                <a href="{{ url('admin/cms/internship') }}">Internship</a>
                            </li>
                           
                            <li class="goals-cms">
                                <a href="{{ url('admin/cms/strategic-goals') }}">Strategic Goals</a>
                            </li>
                           
                            <li class="terms-conditions-cms">
                                <a href="{{ url('admin/cms/terms-conditions') }}">Terms & Conditions</a>
                            </li>
                           
                            <li class="privacy-policy-cms">
                                <a href="{{ url('admin/cms/privacy-policy') }}">Privacy Policy</a>
                            </li>
                           
                            <li class="seo-cms">
                                <a href="{{ url('admin/cms/seo') }}">SEO Content</a>
                            </li>
                           
                        </ul>
                    </div>
                </li>
               
                <li class ="item-lessons">
                    <a href="{{ url('admin/lessons') }}">
                        <i class="fa-solid fa-graduation-cap fa-xl"></i>
                        <span> Lessons </span>
                    </a>
                </li>
                
                <li class="item-podcast">
                    <a href="{{ url('admin/podcast') }}">
                        <i class="fa-solid fa-radio fa-xl"></i>
                        <span> Podcasts </span>
                    </a>
                </li>
               
                <li class="item-research">
                    <a href="{{ url('admin/research') }}">
                        <i class="fa-solid fa-book fa-xl"></i>
                        <span> Research </span>
                    </a>
                </li>
                <li class="item-impact">
                    <a href="{{ url('admin/impact') }}">
                        <i class="fa-solid fa-earth-americas fa-xl"></i>
                        <span> Impact </span>
                    </a>
                </li>
                <li class="item-donate">
                    <a href="{{ url('admin/donate') }}">
                        <i class="fa-solid fa-circle-dollar-to-slot fa-xl"></i>
                        <span> Donate </span>
                    </a>
                </li>

                <li class="gallery">
                    <a href="#gallery" data-bs-toggle="collapse">
                        <i class="fa-solid fa-images fa-xl"></i>
                        <span> Gallery </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="gallery">
                        <ul class="nav-second-level">
                          
                            <li class="img-gallery">
                                <a href="{{ url('admin/gallery/img') }}">Images</a>
                            </li>
                            <li class="video-gallery">
                                <a href="{{ url('admin/gallery/video') }}">Videos</a>
                            </li>
                        </ul>
                    </div>
                </li>
             
                <li class="item-blogs">
                    <a href="{{ url('admin/blogs') }}">
                        <i class="fa-solid fa-clipboard fa-xl"></i>
                        <span> Blogs </span>
                    </a>
                </li>
               
                <li class="item-Internship">
                    <a href="{{ url('admin/internship-enquiry') }}">
                        <i class="fa-solid fa-user-graduate fa-xl"></i>
                        <span>Internship Enquiry</span>
                    </a>
                </li>
                <li class="item-contact">
                    <a href="{{ url('admin/contact-us') }}">
                        <i class="fa-solid fa-address-book fa-xl"></i>
                        <span>Contact Us </span>
                    </a>
                </li>

                <li class="item-app-configuration">
                    <a href="{{ url('admin/app-configuration') }}">
                        <i class="fa-solid fa-gear fa-xl"></i>
                        <span>App Configuration </span>
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