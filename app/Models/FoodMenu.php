<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;
    protected $fillable =['name','menu_type','price','food_type','description','publish_status','featured_img','slug'];
}
