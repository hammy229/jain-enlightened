<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable =[
        
        'heading',
        'youtube_url',
        'podcast_img_path',
        'podcast_img_name',
 
         'created_ip_address',
         'modified_ip_address',
         'created_by',
         'modified_by',
         'status', 
     ];
}
