<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_image',
        'image',
        'title',
        'slug',
        'sub_title',
        'course_category',
        'destination',
        'course_level',
        'description',
        'content',
        'month_intake',
        'course_duration',
        'qualification',
        'visa_duration',
        'course_fee',
        'requirements',
        'youtube_link',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'publish_status',
        'delete_status',
        'show_in_menu'
    ];
    protected $casts = [
        'destination' => 'array',
        'course_category' => 'array'
    ];


    public function getCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category');
    }
    public function getDestination()
    {
        return $this->belongsTo(Destination::class, 'destination');
    }

    public function getlevel()
    {
        return $this->belongsTo(CourseLevel::class, 'course_level');
    }
}
