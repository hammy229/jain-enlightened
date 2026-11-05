<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',                // Add this to allow mass assignment
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'scanner_heading_1',
        'scanner_img_path_1',
        'scanner_img_name_1',
        'scanner_heading_2',
        'scanner_img_path_2',
        'scanner_img_name_2',
        
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
