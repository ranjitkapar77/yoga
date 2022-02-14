<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'slug',
        'description',
        'publish_status',
        'delete_status',
        'show_in_menu'
    ];


    protected static function boot() {
        parent::boot();

        static::creating(function ($value) {
            $value->slug = Str::slug($value->title);
        });
    }
}
