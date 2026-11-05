<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $fillable =[
        
        'heading',
        'resources',
        'description',
        'research_url',
        'research_img_path',
        'research_img_name',
        'latest_checked',
 
         'created_ip_address',
         'modified_ip_address',
         'created_by',
         'modified_by',
         'status', 
     ];
}
