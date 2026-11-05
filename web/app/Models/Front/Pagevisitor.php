<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagevisitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'visited_at',
        'status',
    ];
}
