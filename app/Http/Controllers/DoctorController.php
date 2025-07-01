<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\Specialization;
use App\Models\Category;
use App\Models\Education;
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
     * Show the specified doctor by slug.
     */
    public function show(Doctor $doctor): View
    {
        $doctor->load(['specializations', 'services', 'educations']);
        return view('dashboard.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for creating a new doctor.
     */
    public function create(): View
    {
        $specializations = Specialization::all();
        $categories = Category::all();
        $services = Service::all();
        return view('dashboard.doctors.create', compact('specializations', 'categories', 'services'));
    }

    /**
     * Store a newly created doctor in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
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
            'specializations.*' => ['exists:specializations,id'],
            'services' => ['required', 'array'],
            'services.*' => ['exists:services,id'],
            'education' => ['required', 'array', 'min:1'],
            'education.*.degree' => ['required', 'string', 'max:255'],
            'education.*.institution' => ['required', 'string', 'max:255'],
            'education.*.year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
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
            'special_interests',
        ]);

        // Generate slug from name
        $data['slug'] = Doctor::generateSlug($request->name);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('doctors', 'public');
        }

        // Create doctor
        $doctor = Doctor::create($data);

        // Store education entries
        foreach ($request->input('education', []) as $education) {
            $doctor->educations()->create([
                'degree' => $education['degree'],
                'institution' => $education['institution'],
                'year' => $education['year'] ?? null,
            ]);
        }

        // Sync specializations
        $specializationData = [];
        foreach ($request->input('specializations', []) as $specId) {
            $specialization = Specialization::find($specId);
            if ($specialization) {
                $specializationData[$specId] = ['category_id' => $specialization->category_id];
            }
        }
        $doctor->specializations()->sync($specializationData);

        // Sync services
        $doctor->services()->sync($request->input('services', []));

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * Show the form for editing the specified doctor.
     */
    public function edit(Doctor $doctor): View
    {
        $specializations = Specialization::all();
        $categories = Category::all();
        $services = Service::all();
        $doctor->load(['specializations', 'services', 'educations']);
        return view('dashboard.doctors.edit', compact('doctor', 'specializations', 'categories', 'services'));
    }

    /**
     * Update the specified doctor in storage.
     */
    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $validated = $request->validate([
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
            'specializations.*' => ['exists:specializations,id'],
            'services' => ['required', 'array'],
            'services.*' => ['exists:services,id'],
            'education' => ['required', 'array', 'min:1'],
            'education.*.degree' => ['required', 'string', 'max:255'],
            'education.*.institution' => ['required', 'string', 'max:255'],
            'education.*.year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
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
            'special_interests',
        ]);

        // Update slug if name has changed
        if ($doctor->name !== $request->name) {
            $data['slug'] = Doctor::generateSlug($request->name, $doctor->id);
        }

        // Handle profile image update
        if ($request->hasFile('profile_image')) {
            if ($doctor->profile_image) {
                Storage::disk('public')->delete($doctor->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('doctors', 'public');
        } elseif ($request->has('remove_profile_image')) {
            if ($doctor->profile_image) {
                Storage::disk('public')->delete($doctor->profile_image);
            }
            $data['profile_image'] = null;
        }

        // Update doctor
        $doctor->update($data);

        // Update education entries (delete existing and create new)
        $doctor->educations()->delete();
        foreach ($request->input('education', []) as $education) {
            $doctor->educations()->create([
                'degree' => $education['degree'],
                'institution' => $education['institution'],
                'year' => $education['year'] ?? null,
            ]);
        }

        // Sync specializations
        $specializationData = [];
        foreach ($request->input('specializations', []) as $specId) {
            $specialization = Specialization::find($specId);
            if ($specialization) {
                $specializationData[$specId] = ['category_id' => $specialization->category_id];
            }
        }
        $doctor->specializations()->sync($specializationData);

        // Sync services
        $doctor->services()->sync($request->input('services', []));

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
        $doctor->services()->detach();
        $doctor->educations()->delete();
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }

    /**
     * Display a listing of doctors for API.
     */
    public function apiIndex()
    {
        try {
            $doctors = Doctor::with(['specializations', 'services', 'educations'])->get()->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'slug' => $doctor->slug,
                    'email' => $doctor->email,
                    'phone_number' => $doctor->phone_number,
                    'experience' => $doctor->experience,
                    'patients_satisfied' => $doctor->patients_satisfied,
                    'qualifications' => $doctor->qualifications,
                    'description' => $doctor->description,
                    'bio' => $doctor->bio,
                    'experience_details' => $doctor->experience_details,
                    'activism' => $doctor->activism,
                    'special_interests' => $doctor->special_interests,
                    'profile_image' => $doctor->profile_image ? Storage::url($doctor->profile_image) : null,
                    'specializations' => $doctor->specializations->map(function ($specialization) {
                        return [
                            'id' => $specialization->id,
                            'name' => $specialization->name,
                            'category_id' => $specialization->pivot->category_id,
                        ];
                    }),
                    'services' => $doctor->services->map(function ($service) {
                        return [
                            'id' => $service->id,
                            'name' => $service->name,
                            'category_id' => $service->category_id,
                        ];
                    }),
                    'educations' => $doctor->educations->map(function ($education) {
                        return [
                            'id' => $education->id,
                            'degree' => $education->degree,
                            'institution' => $education->institution,
                            'year' => $education->year,
                        ];
                    }),
                    'created_at' => $doctor->created_at,
                    'updated_at' => $doctor->updated_at,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $doctors,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching doctors.',
            ], 500);
        }
    }
}