<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConsultationController extends Controller
{
   

    public function index(): View
    {
        $consultations = Consultation::with(['patient', 'doctor'])->get();
        return view('dashboard.consultations.index', compact('consultations'));
    }

    public function create(): View
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('dashboard.Consultations.create', compact('patients', 'doctors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'Consultations' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ]);

        Consultation::create($request->all());

        return redirect()->route('admin.Consultations.index')->with('success', 'Consultation created successfully.');
    }

    public function edit(Consultation $Consultation): View
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('dashboard.Consultations.edit', compact('Consultation', 'patients', 'doctors'));
    }

    public function update(Request $request, Consultation $Consultation): RedirectResponse
    {
        $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'Consultations' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ]);

        $Consultation->update($request->all());

        return redirect()->route('admin.Consultations.index')->with('success', 'Consultation updated successfully.');
    }

    public function destroy(Consultation $Consultation): RedirectResponse
    {
        $Consultation->delete();

        return redirect()->route('admin.Consultations.index')->with('success', 'Consultation deleted successfully.');
    }
}