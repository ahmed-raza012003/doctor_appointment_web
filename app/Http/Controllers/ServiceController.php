<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
   

    public function index(): View
    {
        $services = Service::with(['patient', 'doctor'])->get();
        return view('dashboard.services.index', compact('services'));
    }

    public function create(): View
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('dashboard.services.create', compact('patients', 'doctors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'services' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('dashboard.services.edit', compact('service', 'patients', 'doctors'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'services' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}