<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $table = 'course_category';
    protected $fillable = [
        'title',
        'image',
        'front_image',
        'slug',
        'description',
        'publish_status',
        'delete_status',
    ];


}
