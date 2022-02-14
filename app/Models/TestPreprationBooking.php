<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPreprationBooking extends Model
{
    use HasFactory;
    protected $table = 'test_prepration_booking';

    protected $fillable = ['name', 'email', 'phone', 'testprepration_id', 'destination_id'];
    protected $casts = [
        'testprepration_id' => 'array',
        'destination_id' => 'array'
    ];

    public function getTestPrepration()
    {
        return $this->belongsTo(Learn::class, 'testprepration_id');
    }
    public function getDestination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}
