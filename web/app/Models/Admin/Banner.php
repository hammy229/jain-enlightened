<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'page',
        'heading',
        'ban_image_path',
        'ban_image_name',
        
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];

}
