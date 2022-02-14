<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'title',
       'slug',
       'category_id',
       'featured_img',
       'price',
       'publish_status',
       'brief_description',
       'main_description',

       'meta_title',
       'meta_keywords',
       'meta_description',
       'og_image'
    ];

    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class);
    // }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
