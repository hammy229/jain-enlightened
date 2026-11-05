<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appbanner extends Model
{
    use HasFactory;

    protected $fillable =[
        'heading',
        'app_banner_img_name',
        'app_banner_img_path',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];

}
