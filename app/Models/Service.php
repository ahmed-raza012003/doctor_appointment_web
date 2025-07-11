<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_service');
    }
}