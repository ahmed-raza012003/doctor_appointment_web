<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SpecializationController extends Controller
{
public function index()
    {
        $specializations = Specialization::all();
        return view('dashboard.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('dashboard.specializations.create');
    }



    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:specializations,name'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('specializations', 'public');
            $data['image'] = $path;
        }

        Specialization::create($data);

        return redirect()->route('admin.specializations.index')->with('success', 'Specialization created successfully.');
    }
}