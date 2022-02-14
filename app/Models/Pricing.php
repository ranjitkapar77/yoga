<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $table = 'pricing';
    protected $fillable = ['title', 'slug', 'plantype_id', 'regular_price', 'offer_price', 'status'];


    public function plantype(){
        return $this->belongsTo(PlanType::class, 'plantype_id');
    }

    public function planfeatures(){
        return $this->hasMany(PlanFeatures::class, 'price_id', 'id');
    }
}
