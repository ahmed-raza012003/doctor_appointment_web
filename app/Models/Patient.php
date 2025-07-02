<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'cnic',
        'date_of_birth',
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}