<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'btn_title',
        'image',
        'image_1',
        'name',
        'designation',
        'description',
    ];
}
