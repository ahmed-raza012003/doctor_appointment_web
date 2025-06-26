<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        return view('dashboard.blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $blog->load('category');
        return view('dashboard.blogs.show', compact('blog'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description_card' => 'required|string',
            'description_page' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description_card', 'description_page', 'category_id']);
        // Generate slug from title
        $data['slug'] = Blog::generateSlug($request->title);
        // Handle feature image upload
        if ($request->hasFile('feature_image')) {
            $data['feature_image'] = $request->file('feature_image')->store('images', 'public');
        }

        // Handle description image 1 upload
        if ($request->hasFile('description_image_1')) {
            $data['description_image_1'] = $request->file('description_image_1')->store('images', 'public');
        }

        // Handle description image 2 upload
        if ($request->hasFile('description_image_2')) {
            $data['description_image_2'] = $request->file('description_image_2')->store('images', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        $blog->load('category');
        return view('dashboard.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description_card' => 'required|string',
            'description_page' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description_card', 'description_page', 'category_id']);

        // Handle feature image update
        if ($request->hasFile('feature_image')) {
            // Delete old image
            if ($blog->feature_image) {
                Storage::disk('public')->delete($blog->feature_image);
            }
            $data['feature_image'] = $request->file('feature_image')->store('images', 'public');
        }

        // Handle description image 1 update
        if ($request->hasFile('description_image_1')) {
            // Delete old image if exists
            if ($blog->description_image_1) {
                Storage::disk('public')->delete($blog->description_image_1);
            }
            $data['description_image_1'] = $request->file('description_image_1')->store('images', 'public');
        } elseif ($request->has('remove_description_image_1')) {
            // Remove description image 1 if requested
            if ($blog->description_image_1) {
                Storage::disk('public')->delete($blog->description_image_1);
            }
            $data['description_image_1'] = null;
        }

        // Handle description image 2 update
        if ($request->hasFile('description_image_2')) {
            // Delete old image if exists
            if ($blog->description_image_2) {
                Storage::disk('public')->delete($blog->description_image_2);
            }
            $data['description_image_2'] = $request->file('description_image_2')->store('images', 'public');
        } elseif ($request->has('remove_description_image_2')) {
            // Remove description image 2 if requested
            if ($blog->description_image_2) {
                Storage::disk('public')->delete($blog->description_image_2);
            }
            $data['description_image_2'] = null;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        // Delete associated images
        if ($blog->feature_image) {
            Storage::disk('public')->delete($blog->feature_image);
        }
        if ($blog->description_image_1) {
            Storage::disk('public')->delete($blog->description_image_1);
        }
        if ($blog->description_image_2) {
            Storage::disk('public')->delete($blog->description_image_2);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

   public function apiIndex()
{
    try {
        $blogs = Blog::with('category')->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $blogs->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'description_card' => $blog->description_card,
                    'description_page' => $blog->description_page,
                    'category' => $blog->category ? [
                        'id' => $blog->category->id,
                        'name' => $blog->category->name,
                    ] : null,
                    'feature_image' => $blog->feature_image ? Storage::url($blog->feature_image) : null,
                    'description_image_1' => $blog->description_image_1 ? Storage::url($blog->description_image_1) : null,
                    'description_image_2' => $blog->description_image_2 ? Storage::url($blog->description_image_2) : null,
                  
                ];
            }),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while fetching blogs.',
        ], 500);
    }
}
}