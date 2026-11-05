<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'position',
        'about',
        'goals',
        'message',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];
}
