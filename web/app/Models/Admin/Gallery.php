<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [

        'gallery_img_path',
        'gallery_img_name',
        'gallery_video_link',
        'description',
        'type',
    
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
         'status',
    ];
}
