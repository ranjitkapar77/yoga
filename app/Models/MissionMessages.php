<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission',
        'vision',
        'company_values',
        'welcome_title',
        'welcome_sub_title',
        'welcome_message',
        'youtube_link'
    ];
}
