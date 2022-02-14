<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLevel extends Model
{
    use HasFactory;
    protected $table = "couese_level";
    protected $fillable = [
        'title',
        'slug',
        'publish_status',
        'delete_status',
        'show_in_menu'
    ];
}
