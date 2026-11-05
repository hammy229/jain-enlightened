<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable =[
        
        'name',
        'designation',
        'team',
        'linkedin_url',
        'description',
        'team_img_path',
        'team_img_name',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];
}
