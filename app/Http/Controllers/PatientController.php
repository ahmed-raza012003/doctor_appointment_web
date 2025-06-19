<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PatientController extends Controller
{
  
    public function index(): View
    {
        $patients = Patient::with('user')->get();
        return view('dashboard.patients.index', compact('patients'));
    }

    public function create(): View
    {
        $users = User::all();
        return view('dashboard.patients.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'cnic' => ['required', 'string', 'unique:patients,cnic', 'max:15'],
            'date_of_birth' => ['required', 'date'],
        ]);

        Patient::create($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Patient created successfully.');
    }

    public function edit(Patient $patient): View
    {
        $users = User::all();
        return view('dashboard.patients.edit', compact('patient', 'users'));
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'cnic' => ['required', 'string', 'unique:patients,cnic,' . $patient->id, 'max:15'],
            'date_of_birth' => ['required', 'date'],
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()->route('admin.patients.index')->with('success', 'Patient deleted successfully.');
    }
}