<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable =[
        
        'heading',
        'sub_heading',
        'description',
        'intern_img_path',
        'intern_img_name',
 
         'created_ip_address',
         'modified_ip_address',
         'created_by',
         'modified_by',
         'status', 
     ];
}
