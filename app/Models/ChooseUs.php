<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChooseUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'choose_icon_1',
        'choose_title_1',
        'choose_title_2',
        'choose_icon_2',
        'choose_title_3',
        'choose_title_4',
        'image_title_4',
        'image',
        'vedio_link',
        'title',
        'sub_title',
        'description',
        'btn_title'
    ];
}
