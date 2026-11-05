<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strategicgoals extends Model
{
    use HasFactory;

    protected $fillable =[
        
        'heading',
        'description',
        'strategic_img_path',
        'strategic_img_name',
 
         'created_ip_address',
         'modified_ip_address',
         'created_by',
         'modified_by',
         'status', 
     ];

}
