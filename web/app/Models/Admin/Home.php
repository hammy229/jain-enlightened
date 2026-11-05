<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
            // Home Banner Section

            'heading',
            'sub_heading',
            'play_link',
            'app_link',
            'banner_video_path',
            'banner_video_name',
            'you_tube_link',

            // Banner Cards Section

            'card_heading_1',
            'card_heading_2',
            'card_heading_3',
            'card_description_1',
            'card_description_2',
            'card_description_3',
    
            'card_icon_1_path',
            'card_icon_1_name',
            'card_icon_2_path',
            'card_icon_2_name',
            'card_icon_3_path',
            'card_icon_3_name',

            'card_image_1_path',
            'card_image_1_name',
            'card_image_2_path',
            'card_image_2_name',
            'card_image_3_path',
            'card_image_3_name',
     
           // About Us Section

           'about_heading',
           'about_description',
           'about_video_path',
           'about_video_name',
           'about_image_path',
           'about_image_name',

           // Lessons Section

           'lessons_heading',
           'lessons_sub_heading',

           // Founders Message Section
           
           'founders_heading',
           'founders_description',
           'founders_image_path',
           'founders_image_name',

           // Podcasts Section

           'podcasts_heading',
           'podcasts_sub_heading',

           // Jainism Additional Educational Resources Section

           'jain_edu_heading',
           
             // Jainism Research and Academic Resources Section

            'jain_acd_heading',

            // Testimonials Section

            'testimonials_heading',

            // Blogs Section

            'blog_heading',
            'blog_sub_heading',

            // Gallery Section

            'gallery_heading',
         
            'created_ip_address',
            'modified_ip_address',
            'created_by',
            'modified_by',
            'status', 
    ];
}
