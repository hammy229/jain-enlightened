<?php

// Start Common Controllers Needed For All Projects
use App\Http\Controllers\Admin\AppConfig\App_Config_Controller;
use App\Http\Controllers\Admin\Blog\Blog_controller;
use App\Http\Controllers\Admin\CMS\About_Us_Controller;
use App\Http\Controllers\Admin\CMS\App_Banner_Controller;
use App\Http\Controllers\Admin\CMS\Banner_controller;
use App\Http\Controllers\Admin\CMS\Home_Controller;
use App\Http\Controllers\Admin\CMS\Internship_Controller;
use App\Http\Controllers\Admin\CMS\PrivacyController;
use App\Http\Controllers\Admin\CMS\Strategi_Goals_Controller;
use App\Http\Controllers\Admin\CMS\Team_Controller;
use App\Http\Controllers\Admin\CMS\Teastimonial_Controller;
use App\Http\Controllers\Admin\CMS\TermsController;
use App\Http\Controllers\Admin\Contact\ContactEnquiry_Controller;
use App\Http\Controllers\Admin\CMS\SEOController;
use App\Http\Controllers\Admin\Donate\Donate_Controller;
use App\Http\Controllers\Admin\Gallery\Gallery_Controller;
use App\Http\Controllers\Admin\Impact\Impact_Controller;
use App\Http\Controllers\Admin\Lesson\Lesson_Controller;
use App\Http\Controllers\Admin\Master\Language_Controller;
use App\Http\Controllers\Admin\Podcast\Podcast_Controller;
use App\Http\Controllers\Admin\Research\Research_Controller;
use App\Http\Controllers\Front\Contact_Us_Controller;
use App\Http\Controllers\Front\Front_Blog_Controller;
use App\Http\Controllers\Front\Front_Gallery_Controller;
use App\Http\Controllers\Front\Front_Internship_Controller;
use App\Http\Controllers\Front\Front_Resource_Controller;
use App\Http\Controllers\Front\Home_Controller_Front;
use App\Http\Controllers\Front\lessons_Controller;
use App\Http\Controllers\Front\Terms_Privacy_Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Login\ForgotPasswordController;
use App\Http\Controllers\Admin\Settings\GeneralSettings;
use App\Http\Controllers\Admin\Settings\VisualSettings;
use App\Http\Controllers\Admin\SystemUsers\RolesPrivilegesController;
use App\Http\Controllers\Admin\SystemUsers\SystemUserController;
use App\Http\Controllers\Admin\NotFoundController\NotFoundController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Intern\Internship_Enquiry_Controller;

// End Common Controllers Needed For All Project

// Project Controller Start Here

// Project Controller Ends Here

// Start Common Routes For The Projects
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'storage linked';
});
Route::get('clear', function () {
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    return 'clear';
});

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/admin', [LoginController::class, 'index']);
});


Route::post('login-action', [LoginController::class, 'admin_login'])->name('login');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('reset-password', function(){ return abort(404); });




// End Common Routes For The Projects


// Start FrontEnd Routes

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/',[Home_Controller_Front::class,'index']);
Route::get('/about-us',[Home_Controller_Front::class,'about']);
Route::get('/impact',[Home_Controller_Front::class,'impact']);
Route::get('/donation',[Home_Controller_Front::class,'donate']);
Route::get('/podcasts',[Home_Controller_Front::class,'podcast']);

// Define the route for research with optional query parameters for resource type
// Route::get('/research', [Front_Resource_Controller::class, 'index'])->name('research.index');
Route::get('/research', [Front_Resource_Controller::class, 'publishing']);
Route::get('/research/academic', [Front_Resource_Controller::class, 'academic']);
Route::get('/research/educational', [Front_Resource_Controller::class, 'educational']);
// Route::view('research', 'Front.Research.publishing-resources');
// Route::view('research/academic', 'Front.Research.academic-resources');
// Route::view('research/educational', 'Front.Research.educational-resources');

Route::controller(Front_Blog_Controller::class)->group(function () {
    Route::get('blogs','index');
    Route::get('/blog/{url}','blog_details');

});

Route::get('lessons',[lessons_Controller::class,'index']);
Route::get('lesson/{url}',[lessons_Controller::class, 'lesson_details']);
// Route::get('lesson-details/{url}',[lessons_Controller::class, 'lesson_details']);
Route::post('filter-lessons', [lessons_Controller::class, 'filterByLanguage']);

Route::get('gallery',[Front_Gallery_Controller::class,'index']);
Route::post('filter-gallery', [Front_Gallery_Controller::class, 'filterByLanguage']);

Route::get('/contact-us',[Contact_Us_Controller::class,'index']);
Route::post('/contact-us/store', [Contact_Us_Controller::class, 'store'])->name('contacts.store');

Route::post('/internship/store', [Front_Internship_Controller::class, 'store'])->name('internship.store');


Route::get('/terms-and-condition',[Terms_Privacy_Controller::class,'terms']);
Route::get('/privacy-policy',[Terms_Privacy_Controller::class,'privacy']);


// *
// *----------- CODE HERE  -------------
// *

// End Frontend Routes


// Start Backend Routes
Route::group(['prefix' => 'admin', 'middleware' => ['prevent-back-history', 'is_admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::controller(Language_Controller::class)->group(function () {
        Route::get('master/language','index');
        Route::post('master/language/store','store')->name('language.store');
        Route::get('master/language/data-table','data_table');
        Route::get('master/language/edit/{id}','edit');
        Route::get('master/language/check-url-exist','check_url_exist');
    });

    Route::controller(Banner_controller::class)->group(function () {
        Route::get('cms/banner','index');
        Route::post('cms/banner/store','store')->name('banner.store');
        Route::get('banner/edit/{id}','edit');
        Route::get('/banner-data/{page}','fetchBannerData')->name('banner.fetchData');
    });

    Route::controller(App_Banner_Controller::class)->group(function () {
        Route::get('cms/app-banner','index');
        Route::post('cms/app-banner/store','store')->name('appbanner.store');
        Route::get('cms/app-banner/data-table','data_table');
        Route::get('cms/app-banner/edit/{id}','edit');
        Route::get('cms/app-banner/check-url-exist','check_url_exist');
    });

    Route::controller(Home_Controller::class)->group(function () {
        Route::get('cms/home','index');
        Route::post('cms/home/store','store')->name('home.store');
    });

    Route::controller(About_Us_Controller::class)->group(function () {
        Route::get('cms/about-us','index');
        Route::post('cms/about-us/store','store')->name('about.store');
    });


    Route::controller(Team_Controller::class)->group(function () {
        Route::get('cms/team/add-team','index');
        Route::post('cms/team/store','store')->name('team.store');
        Route::get('cms/team/data-table','data_table');
        Route::get('cms/team/edit/{id}','edit');
    });


    Route::controller(Teastimonial_Controller::class)->group(function () {
        Route::get('cms/testimonials/add-testimonial','index');
        Route::post('cms/testimonials/store','store')->name('testimonials.store');
        Route::get('cms/testimonials/data-table','data_table');
        Route::get('cms/testimonials/edit/{id}','edit');
    });

    Route::controller(Internship_Controller::class)->group(function () {
        Route::get('cms/internship','index');
        Route::post('cms/internship/store','store')->name('intern.store');
    });

    Route::controller(Strategi_Goals_Controller::class)->group(function () {
        Route::get('cms/strategic-goals','index');
        Route::post('cms/strategic-goals/store','store')->name('strategic.store');
        Route::get('cms/strategic-goals/data-table','data_table');
        Route::get('cms/strategic-goals/edit/{id}','edit');
        Route::get('cms/strategic-goals/view/{id}','view');
    });


    Route::controller(SEOController::class)->group(function () {
        Route::get('cms/seo','index');
        Route::post('cms/seo/store','store')->name('seo.store');
        Route::get('seo/edit/{id}','edit');
        Route::get('/seo-data/{page}','fetchSeoData')->name('seo.fetchData');
    });


    Route::controller(Lesson_Controller::class)->group(function () {
        Route::get('add-lessons','index');
        Route::post('lessons/store','store')->name('lessons.store');
        Route::get('lessons/data-table','data_table');
        Route::get('lessons/edit/{id}','edit');
        Route::get('lessons/check-url-exist','check_url_exist');
        Route::get('lessons/view/{id}','view');
    });


    Route::controller(Blog_controller::class)->group(function () {
        Route::get('blogs/add','index');
        Route::post('blogs/store','store')->name('blogs.store');
        Route::get('blogs/data-table','data_table');
        Route::get('blogs/edit/{id}','edit');
        Route::get('blogs/check-url-exist','check_url_exist');
        Route::get('blogs/view/{id}','view');
    });

    
    Route::controller(ContactEnquiry_Controller::class)->group(function () {
        Route::get('contact-us','index');
        Route::get('contact-us/data-table','data_table');
        Route::delete('/contact-us/deleteSelected', 'deleteSelected')->name('contact.deleteSelected');
        Route::get('contact-us/export','exportcontacts')->name('export.contacts');
      
    });
   
    Route::controller(Internship_Enquiry_Controller::class)->group(function () {
        Route::get('internship-enquiry','index');
        Route::get('internship-enquiry/view/{id}','view');
        Route::get('internship-enquiry/data-table','data_table');
        Route::delete('internship-enquiry/deleteSelected', 'deleteSelected')->name('intern.deleteSelected');
        Route::get('internship-enquiry/export','exportcontacts')->name('export.interns');
    });

    // Route::view('admin/internship-enquiry', 'Admin.Internship.index');

    Route::controller(TermsController::class)->group(function () {
        Route::get('cms/terms-conditions','index');
        Route::post('cms/terms-conditions/store','store')->name('terms.store');
    });

    Route::controller(PrivacyController::class)->group(function () {
        Route::get('cms/privacy-policy','index');
        Route::post('cms/privacy-policy/store','store')->name('privacy.store');
    });


    Route::controller(Podcast_Controller::class)->group(function () {
        Route::get('podcast','index');
        Route::post('podcast/store','store')->name('podcast.store');
        Route::get('podcast/data-table','data_table');
        Route::get('podcast/edit/{id}','edit');
    });

    Route::controller(Impact_Controller::class)->group(function () {
        Route::get('impact','index');
        Route::post('impact/store','store')->name('impacts.store');
        Route::get('impact/data-table','data_table');
        Route::get('impact/edit/{id}','edit');
    });

    Route::controller(Donate_Controller::class)->group(function () {
        Route::get('donate','index');
        Route::post('donate/store','store')->name('donate.store');
    });


    Route::controller(Research_Controller::class)->group(function () {
        Route::get('add-research','index');
        Route::post('research/store','store')->name('podcasts.store');
        Route::get('research/data-table','data_table');
        Route::get('research/edit/{id}','edit');
        Route::get('research/view/{id}','view');
        Route::post('research/update-latest-checked', 'updateLatestChecked')->name('research.updateLatestChecked');
    });

    Route::controller(App_Config_Controller::class)->group(function () {
        Route::get('app-configuration','index');
        Route::post('app-configuration/store','store')->name('config.store');
        Route::get('app-configuration/data-table','data_table');
        Route::get('app-configuration/edit/{id}','edit');
    });


    Route::controller(Gallery_Controller::class)->group(function () {
        Route::get('gallery/img','index');
        Route::get('gallery/video','index_video');

        Route::post('gallery/store','store')->name('gallery.store');
        Route::post('gallery-video/store','store_video')->name('gallery_video.store');
        Route::get('gallery/img/edit/{id}','edit');
        Route::get('gallery/video/edit/{id}','edit_video');
        Route::get('gallery/img/data-table','data_table');
        Route::get('gallery/video/data-table','data_table_video');
        Route::delete('gallery/delete-image/{id}',  'deleteImage')->name('admin.gallery.delete-image');

        Route::delete('gallery/delete-video/{id}', 'deleteVideo')->name('admin.gallery.delete-video');
    });




    // Start Backend Common Routes For The Projects

    Route::controller(GeneralSettings::class)->group(function () {
        Route::get('general-setting', 'index');
        Route::post('general-settings-store', 'store')->name('geraral.settings.store');
    });

    Route::controller(VisualSettings::class)->group(function () {
        Route::get('visual-setting', 'index');
        Route::post('visual-settings-store', 'store')->name('visual.settings.store');
    });

    Route::controller(RolesPrivilegesController::class)->group(function () {
        Route::get('roles-privileges','index');
        Route::get('roles-privileges/add','create');
        Route::post('roles-privileges/store','store')->name('roles-previllages.store');
        Route::get('roles-privileges/data-table','data_table');
        Route::get('roles-privileges/edit/{id}','edit');
        Route::get('roles-privileges/check-role-exist','check_role_exist');
    });

    Route::controller(SystemUserController::class)->group(function () {
        Route::get('system-user','index');
        Route::get('system-user/add','create');
        Route::post('system-user/store','store')->name('system-user.store');
        Route::get('system-user/data-table','data_table');
        Route::get('system-user/edit/{id}','edit');
        Route::get('system-user/check-user-exist','check_user_exist');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('change-password', 'view_change_password');
        Route::post('change-password', 'change_password');
        Route::get('logout', 'logout');
    });

    Route::controller(BaseController::class)->group(function () {
        Route::get('sub-category-list', 'subCategoryList');
        Route::get('common-delete', 'delete');
        Route::post('change-status', 'status')->name('change-status');
    });
    // End Backend Common Routes For The Projects

    Route::get('/404', [NotFoundController::class, 'adminIndex'])->name('admin.404');
});
//End Backend Routes

Route::get('/404', [NotFoundController::class, 'index'])->name('front.404');
// Route::fallback(function () {
//     return redirect('404');
// });

Route::fallback(function () {
    if (request()->is('admin/*')) {
        return redirect()->route('admin.404');
    } else {
        return redirect()->route('front.404');
    }
});



Route::view('admin/blogs', 'Admin.Blogs.index');
Route::view('admin/cms/testimonials/index', 'Admin.CMS.Testimonials.index');
Route::view('admin/cms/team/index', 'Admin.CMS.Team.index');
Route::view('admin/research', 'Admin.Research.index');
Route::view('admin/lessons', 'Admin.Lessons.index');

// Route::view('admin/app-configuration', 'Admin.App-Configuration.index');



// Route::view('/', 'Front.index');
// Route::view('about-us', 'Front.about-us');
// Route::view('contact-us', 'Front.contact-us');
// Route::view('blogs', 'Front.blogs');
// Route::view('lessons', 'Front.lessons');
// Route::view('lessons-details', 'Front.lessons-details');
// Route::view('blog-details', 'Front.blog-details');
// Route::view('podcasts', 'Front.podcasts');
// research
// Route::view('research', 'Front.Research.publishing-resources');
// Route::view('research/academic', 'Front.Research.academic-resources');
// Route::view('research/educational', 'Front.Research.educational-resources');
// Route::view('impact', 'Front.impact');
// Route::view('gallery', 'Front.gallery');
// Route::view('privacy-policy', 'Front.privacy-policy');
// Route::view('terms-of-service', 'Front.terms-of-service');
// Route::view('donation', 'Front.donate');

    // Route::view('404-page-not-found', 'Front.404-page');


// Master
// Route::view('admin/Master/language', 'Admin.Master.language');


// CMS
// Route::view('admin/cms/app-banner', 'Admin.CMS.app-banner');
// Route::view('admin/CMS/home', 'Admin.CMS.home');
// Route::view('admin/CMS/about-us', 'Admin.CMS.about-us');
// Route::view('admin/cms/team', 'Admin.CMS.team');
// CMS / Testimonials

// Route::view('admin/cms/testimonials/add-testimonial', 'Admin.CMS.Testimonials.add-testimonial');
// CMS / Team

// Route::view('admin/cms/team/add-team', 'Admin.CMS.Team.add-team');
// Route::view('admin/cms/internship', 'Admin.CMS.internship');
// Route::view('admin/cms/strategic-goals', 'Admin.CMS.strategic-goals');
// Route::view('admin/cms/view-strategic-goal', 'Admin.CMS.Goals.view-strategic-goal');
// Route::view('admin/CMS/privacy-policy', 'Admin.CMS.privacy-policy');
// Route::view('admin/CMS/terms-conditions', 'Admin.CMS.terms-conditions');
// Route::view('admin/cms/SEO', 'Admin.CMS.seo');


// admin/lessons
// Route::view('admin/lessons', 'Admin.Lessons.index');
// Route::view('admin/view-lesson', 'Admin.Lessons.view-lesson');
// Route::view('admin/add-lessons', 'Admin.Lessons.add-lessons');
// admin/podcast
// Route::view('admin/podcast', 'Admin.Podcasts.index');
// admin/blogs
// Route::view('admin/blogs', 'Admin.Blogs.index');
// Route::view('admin/view-blog', 'Admin.Blogs.view-blog');
// Route::view('admin/add-blogs', 'Admin.Blogs.add-blogs');
// admin/contact-us
// Route::view('admin/contact-us', 'Admin.Contact-Us.index');
// Route::view('admin/contact-us', 'Admin.Contact-Us.index');
// Route::view('admin/internship-enquiry', 'Admin.Internship.index');
// Route::view('admin/internship-enquiry/view', 'Admin.Internship.view-enquiry');
// admin/Research
// Route::view('admin/research', 'Admin.Research.index');
// Route::view('admin/view-research', 'Admin.Research.view-research');
// Route::view('admin/add-research', 'Admin.Research.add-research');
// admin/gallery
// Route::view('admin/gallery', 'Admin.Gallery.gallery');
// Route::view('admin/gallery/img', 'Admin.Gallery.img');
// Route::view('admin/gallery/video', 'Admin.Gallery.video');
// admin/donate
// Route::view('admin/donate', 'Admin.Donate.index');
// admin/Impact
// Route::view('admin/impact', 'Admin.Impact.index');
