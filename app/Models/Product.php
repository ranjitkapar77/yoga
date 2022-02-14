<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
       'name',
       'slug',
       'brand_id',
       'series_id',
       'price',
       'color',
       'size',
       'guarantee_time',
       'brief_description',
       'main_description',
       'meta_title',
       'meta_keywords',
       'meta_description',
       'og_image'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
