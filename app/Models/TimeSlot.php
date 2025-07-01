<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    use HasFactory;

    protected $table = 'doctor_timeslots';

    protected $fillable = [
        'doctor_id',
        'day',
        'start_time',
        'end_time',
    ];

    /**
     * Get the doctor that owns the timeslot.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}