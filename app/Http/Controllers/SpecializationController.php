<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SpecializationController extends Controller
{
    public function index(): View
    {
        
        $specializations = Specialization::with('category')->get();
        return view('dashboard.specializations.index', compact('specializations'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('dashboard.specializations.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:specializations,name'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $data = $request->only(['name', 'description', 'category_id']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('specializations', 'public');
            $data['image'] = $path;
        }

        Specialization::create($data);

        return redirect()->route('admin.specializations.index')->with('success', 'Specialization created successfully.');
    }

    public function edit(Specialization $specialization): View
    {
        $categories = Category::all();
        return view('dashboard.specializations.edit', compact('specialization', 'categories'));
    }

    public function update(Request $request, Specialization $specialization): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:specializations,name,' . $specialization->id],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $data = $request->only(['name', 'description', 'category_id']);

        if ($request->hasFile('image')) {
            if ($specialization->image) {
                Storage::disk('public')->delete($specialization->image);
            }
            $path = $request->file('image')->store('specializations', 'public');
            $data['image'] = $path;
        }

        $specialization->update($data);

        return redirect()->route('admin.specializations.index')->with('success', 'Specialization updated successfully.');
    }

    public function destroy(Specialization $specialization): RedirectResponse
    {
        if ($specialization->image) {
            Storage::disk('public')->delete($specialization->image);
        }
        $specialization->delete();
        return redirect()->route('admin.specializations.index')->with('success', 'Specialization deleted successfully.');
    }
}