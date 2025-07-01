<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'doctor_education';

    protected $fillable = ['doctor_id', 'degree', 'institution', 'year'];

    /**
     * Get the doctor that owns the education entry.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}