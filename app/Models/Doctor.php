<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'experience',
        'patients_satisfied',
        'description',
        'bio',
        'qualifications',
        'experience_details',
        'activism',
        'special_interests',
        'profile_image',
    ];

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specialization');
    }
}