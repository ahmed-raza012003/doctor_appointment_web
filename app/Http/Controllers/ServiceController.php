<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $services = Service::with('category')->latest()->paginate(10);
        return view('dashboard.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->only(['name', 'description', 'category_id']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            Service::create($data);

            return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
        } catch (\Exception $e) {
            \Log::error('Service creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }

    public function show(Service $service)
    {
        $service->load('category');
        $categories = Category::all();
        return view('dashboard.services.show', compact('service', 'categories'));
    }

    public function edit(Service $service)
    {
        $categories = Category::all();
        $service->load('category');
        return view('dashboard.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->only(['name', 'description', 'category_id']);

            if ($request->hasFile('image')) {
                if ($service->image) {
                    Storage::disk('public')->delete($service->image);
                }
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            $service->update($data);

            return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Service update failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }

    public function destroy(Service $service)
    {
        try {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $service->delete();

            return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Service deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }

    public function apiIndex()
    {
        $services = Service::with('category')->latest()->get();
        return response()->json([
            'success' => true,
            'data' => $services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'description' => $service->description,
                    'category' => $service->category ? [
                        'id' => $service->category->id,
                        'name' => $service->category->name,
                    ] : null,
                    'image' => $service->image ? Storage::url($service->image) : null,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                ];
            }),
        ], 200);
    }
}