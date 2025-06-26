<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description_card',
        'slug',
        'description_page',
        'category_id',
        'feature_image',
        'description_image_1',
        'description_image_2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function generateSlug($title, $id = null)
    {
        // Handle empty or invalid title
        if (empty(trim($title))) {
            $title = 'untitled';
        }

        // Generate base slug
        $slug = Str::slug($title);
        if (empty($slug)) {
            $slug = 'blog-post';
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
}