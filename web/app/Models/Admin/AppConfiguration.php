<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'config_type',
        'config_version',
        
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];

}
