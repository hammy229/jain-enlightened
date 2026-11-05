<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable =[

        'heading',
        'slug_url',
        'language_id',
        'lesson_description',
        'additional_description',
        'lesson_img_path',
        'lesson_img_name',
        'youtube_link',

        'meta_title',
        'meta_keyword',
        'meta_description',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];


    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}
