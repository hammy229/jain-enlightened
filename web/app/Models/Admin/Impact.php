<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impact extends Model
{
    use HasFactory;

    protected $fillable =[

        'heading',
        'description',
        'imptact_img_path',
        'imptact_img_name',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
