<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_heading',
        'about_description',
        'about_img_1_path',
        'about_img_1_name',
        'about_img_2_path',
        'about_img_2_name',

        // Vision & Mission Section

        'vision_heading',
        'vision_description',
        'vision_icon_path',
        'vision_icon_name',


        'mission_heading',
        'mission_description',
        'mission_icon_path',
        'mission_icon_name',

        // Personal Journey Section

        'journey_heading',
        'journey_description',
        'journey_img_path',
        'journey_img_name',
        'linkedin_url',

        // Guidance Section

        'guidance_heading',
        'guidance_description',
        'guidance_img_path',
        'guidance_img_name',

         // Acknowledgment Section

         'acknow_heading',
         'acknow_description',
         
        //  Strategic Goals Section
        'strategic_heading',
    
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
    
}
