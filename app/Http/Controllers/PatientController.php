<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function appointments()
    {
        $appointments = Appointment::where('patient_id', Auth::id())
            ->with(['doctor' => function ($query) {
                $query->select('id', 'name');
            }, 'service' => function ($query) {
                $query->select('id', 'name');
            }])
            ->orderBy('appointment_time', 'desc')
            ->get();

        return view('dashboard.patients.appointments', compact('appointments'));
    }

     public function profile()
    {
        $patient = Patient::where('user_id', Auth::id())->first();
        return view('dashboard.patients.profile', compact('patient'));
    }

    public function contact()
    {
        return view('dashboard.patients.contact');
    }
    public function storeProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'cnic' => ['required', 'string', 'max:15', 'unique:patients,cnic,' . Auth::id() . ',user_id'],
            'date_of_birth' => ['required', 'date'],
        ]);

        $patient = Patient::where('user_id', Auth::id())->first();

        if ($patient) {
            // Update existing patient record
            $patient->update([
                'cnic' => $request->cnic,
                'date_of_birth' => $request->date_of_birth,
            ]);
            $message = 'Profile updated successfully.';
        } else {
            // Create new patient record
            Patient::create([
                'user_id' => Auth::id(),
                'cnic' => $request->cnic,
                'date_of_birth' => $request->date_of_birth,
            ]);
            $message = 'Profile created successfully.';
        }

        return redirect()->route('patient.profile')->with('success', 'Profile saved successfully.');
    }
}