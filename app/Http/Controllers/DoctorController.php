<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DoctorController extends Controller
{
    

    public function index(): View
    {
        $doctors = Doctor::with('specializations')->get();
        return view('dashboard.doctors.index', compact('doctors'));
    }

    public function create(): View
    {
        $specializations = Specialization::all();
        return view('dashboard.doctors.create', compact('specializations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:doctors,email'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'experience' => ['required', 'integer', 'min:0'],
            'patients_satisfied' => ['required', 'integer', 'min:0'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'specializations' => ['required', 'array'],
        ]);

        $data = $request->only(['name', 'email', 'phone_number', 'experience', 'patients_satisfied']);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('doctors', 'public');
        }

        $doctor = Doctor::create($data);
        $doctor->specializations()->sync($request->input('specializations', []));

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }
}