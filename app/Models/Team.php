<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'post', 'image', 'address', 'phone', 'email', 'website', 'content', 'facebook', 'linkedin', 'youtube', 'twitter', 'status', 'in_order'];
}
