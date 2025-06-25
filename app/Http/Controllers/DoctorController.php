<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DoctorController extends Controller
{
    /**
     * Display a listing of the doctors.
     */
    public function index(): View
    {
        $doctors = Doctor::with('specializations')->get();
        return view('dashboard.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new doctor.
     */
    public function create(): View
    {
        $specializations = Specialization::all();
        $categories = Category::all();
        return view('dashboard.doctors.create', compact('specializations', 'categories'));
    }

    /**
     * Store a newly created doctor in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:doctors,email'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'experience' => ['required', 'integer', 'min:0'],
            'patients_satisfied' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'qualifications' => ['nullable', 'string', 'max:1000'],
            'experience_details' => ['nullable', 'string', 'max:2000'],
            'activism' => ['nullable', 'string', 'max:1000'],
            'special_interests' => ['nullable', 'string', 'max:1000'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'specializations' => ['required', 'array'],
        ]);

        $data = $request->only([
            'name',
            'email',
            'phone_number',
            'experience',
            'patients_satisfied',
            'description',
            'bio',
            'qualifications',
            'experience_details',
            'activism',
            'special_interests'
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('doctors', 'public');
        }

        $doctor = Doctor::create($data);

        // Prepare specialization data with category_id
        $specializationData = [];
        foreach ($request->input('specializations', []) as $specId) {
            $specialization = Specialization::find($specId);
            if ($specialization) {
                $specializationData[$specId] = ['category_id' => $specialization->category_id];
            }
        }
        $doctor->specializations()->sync($specializationData);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * Show the form for editing the specified doctor.
     */
    public function edit(Doctor $doctor): View
    {
        $specializations = Specialization::all();
        $categories = Category::all();
        return view('dashboard.doctors.edit', compact('doctor', 'specializations', 'categories'));
    }

    /**
     * Update the specified doctor in storage.
     */
    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:doctors,email,' . $doctor->id],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'experience' => ['required', 'integer', 'min:0'],
            'patients_satisfied' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'qualifications' => ['nullable', 'string', 'max:1000'],
            'experience_details' => ['nullable', 'string', 'max:2000'],
            'activism' => ['nullable', 'string', 'max:1000'],
            'special_interests' => ['nullable', 'string', 'max:1000'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'specializations' => ['required', 'array'],
        ]);

        $data = $request->only([
            'name',
            'email',
            'phone_number',
            'experience',
            'patients_satisfied',
            'description',
            'bio',
            'qualifications',
            'experience_details',
            'activism',
            'special_interests'
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if ($doctor->profile_image) {
                Storage::disk('public')->delete($doctor->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('doctors', 'public');
        }

        $doctor->update($data);

        // Prepare specialization data with category_id
        $specializationData = [];
        foreach ($request->input('specializations', []) as $specId) {
            $specialization = Specialization::find($specId);
            if ($specialization) {
                $specializationData[$specId] = ['category_id' => $specialization->category_id];
            }
        }
        $doctor->specializations()->sync($specializationData);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified doctor from storage.
     */
    public function destroy(Doctor $doctor): RedirectResponse
    {
        if ($doctor->profile_image) {
            Storage::disk('public')->delete($doctor->profile_image);
        }
        $doctor->specializations()->detach();
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}