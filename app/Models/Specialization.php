<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
    ];
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_specialization');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}