<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learn extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'title',
        'page_title',
        'slug',
        'description',
        'language',
        'fee',
        'total_mark',
        'required_mark',
        'publish_status',
        'delete_status',
        'show_in_menu'
    ];
}
