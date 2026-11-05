<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teastimonial extends Model
{
    use HasFactory;

    protected $fillable =[
        
       'name',
       'location',
       'description',
       'teastimonial_img_path',
       'teastimonial_img_name',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];
}
