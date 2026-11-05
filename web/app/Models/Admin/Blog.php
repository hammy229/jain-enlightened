<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'blog_by',
        'slug_url',
        'short_description',
        'date',
        'location',
        'description',
        'blog_img_path',
        'blog_img_name',

        'meta_title', 
        'meta_keyword', 
        'meta_description',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
         'status',
    ];
}
