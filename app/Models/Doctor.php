<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Doctor extends Model
{
    protected $fillable = [
        'name',
        'slug',
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
    public function services()
    {
        return $this->belongsToMany(Service::class, 'doctor_services');
    }

      public static function generateSlug($name, $id = null)
    {
        // Handle empty or invalid title
        if (empty(trim($name))) {
            $name = 'untitled';
        }

        // Generate base slug
        $slug = Str::slug($name);
        if (empty($slug)) {
            $slug = 'doctor-profile';
        }

        // Check for existing slugs, excluding the current blog (for updates)
        $query = self::where('slug', 'LIKE', $slug . '%');
        if ($id) {
            $query->where('id', '!=', $id);
        }
        $existingSlugs = $query->pluck('slug')->toArray();

        // If no duplicates, return the base slug
        if (!in_array($slug, $existingSlugs)) {
            return $slug;
        }

        // Find a unique slug by appending a number
        $count = 1;
        while (in_array("{$slug}-{$count}", $existingSlugs)) {
            $count++;
        }
        return "{$slug}-{$count}";
    }
        public function educations()
    {
        return $this->hasMany(Education::class);
    }
}