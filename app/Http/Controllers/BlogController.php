<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('dashboard.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('dashboard.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

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

    public function show(Blog $blog)
    {
        return view('dashboard.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('dashboard.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

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
}