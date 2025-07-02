<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\Timeslot;
use App\Models\Appointment;
use App\Models\DoctorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display the booking form
     */
    public function create(): View
    {
        Log::info('Booking form accessed', ['user_id' => Auth::id()]);
        
        $doctors = Doctor::with(['specializations', 'services', 'educations', 'timeSlots'])->get()->map(function ($doctor) {
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
                'time_slots' => $doctor->timeSlots->map(function ($timeSlot) {
                    return [
                        'id' => $timeSlot->id,
                        'day' => $timeSlot->day,
                        'start_time' => $timeSlot->start_time,
                        'end_time' => $timeSlot->end_time,
                    ];
                }),
                'created_at' => $doctor->created_at,
                'updated_at' => $doctor->updated_at,
            ];
        });

        Log::info('Doctors data prepared for view', ['doctor_count' => $doctors->count(), 'user_id' => Auth::id()]);

        $services = Service::all(); // Keep this for fallback or initial display if needed
        return view('dashboard.booking.create', compact('doctors', 'services'));
    }

    /**
     * Get available timeslots for a doctor for a date range
     */
    public function getTimeslots(Request $request)
    {
        try {
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ]);

            Log::info('Fetching timeslots', [
                'doctor_id' => $request->doctor_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => Auth::id()
            ]);

            $doctorId = $request->doctor_id;
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            
            $availableTimeslots = [];
            
            while ($startDate <= $endDate) {
                $dayOfWeek = $startDate->format('l'); // e.g., "Monday"
                Log::debug('Checking timeslot for day', ['doctor_id' => $doctorId, 'day' => $dayOfWeek]);

                $timeslot = Timeslot::where('doctor_id', $doctorId)
                    ->where('day', $dayOfWeek)
                    ->first();

                if ($timeslot) {
                    Log::debug('Timeslot found', ['doctor_id' => $doctorId, 'day' => $dayOfWeek, 'start_time' => $timeslot->start_time, 'end_time' => $timeslot->end_time]);
                    $startTime = Carbon::parse($startDate->format('Y-m-d') . ' ' . $timeslot->start_time);
                    $endTime = Carbon::parse($startDate->format('Y-m-d') . ' ' . $timeslot->end_time);

                    // Adjust end_time if it’s earlier than start_time (assuming PM intent)
                    if ($endTime->lessThan($startTime)) {
                        $endTime->addHours(12); // Assume 03:24:00 is 15:24:00
                        Log::warning('Adjusted end_time due to earlier value', ['original_end_time' => $timeslot->end_time, 'adjusted_end_time' => $endTime->format('H:i:s')]);
                    }

                    $interval = 30;
                    $currentTime = $startTime;

                    while ($currentTime < $endTime) {
                        $formattedTime = $currentTime->format('Y-m-d H:i:s');

                        $isBooked = Appointment::where('doctor_id', $doctorId)
                            ->where('appointment_time', $formattedTime)
                            ->exists();

                        if (!$isBooked) {
                            $availableTimeslots[] = [
                                'time' => $currentTime->format('h:i A'),
                                'value' => $formattedTime,
                                'booked' => false
                            ];
                        }

                        $currentTime->addMinutes($interval);
                    }
                } else {
                    Log::debug('No timeslot found for day', ['doctor_id' => $doctorId, 'day' => $dayOfWeek]);
                }
                
                $startDate->addDay();
            }

            Log::info('Timeslots retrieved successfully', [
                'doctor_id' => $doctorId,
                'timeslot_count' => count($availableTimeslots)
            ]);

            return response()->json($availableTimeslots);
        } catch (\Exception $e) {
            Log::error('Error fetching timeslots', [
                'doctor_id' => $request->doctor_id,
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);
            return response()->json(['error' => 'Failed to fetch timeslots'], 500);
        }
    }

    /**
     * Get services for a specific doctor
     */
    public function getServices(Request $request)
    {
        try {
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id'
            ]);

            Log::info('Fetching services for doctor', [
                'doctor_id' => $request->doctor_id,
                'user_id' => Auth::id()
            ]);

            $services = Service::whereIn('id', function ($query) use ($request) {
                $query->select('service_id')
                    ->from('doctor_services')
                    ->where('doctor_id', $request->doctor_id);
            })->get(['id', 'name']);

            Log::info('Services retrieved successfully', [
                'doctor_id' => $request->doctor_id,
                'service_count' => $services->count()
            ]);

            return response()->json($services);
        } catch (\Exception $e) {
            Log::error('Error fetching services', [
                'doctor_id' => $request->doctor_id,
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);
            return response()->json(['error' => 'Failed to fetch services'], 500);
        }
    }

    /**
     * Store a new appointment
     */
 public function store(Request $request): RedirectResponse
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'service_id' => 'required|exists:services,id',
                'appointment_time' => 'required|date',
            ]);

            // Log the attempt
            Log::info('Attempting to book appointment', [
                'doctor_id' => $request->doctor_id,
                'service_id' => $request->service_id,
                'appointment_time' => $request->appointment_time,
                'user_id' => Auth::id(),
            ]);

            // Check if the doctor offers the selected service
            $doctorServiceExists = DoctorService::where('doctor_id', $request->doctor_id)
                ->where('service_id', $request->service_id)
                ->exists();

            if (!$doctorServiceExists) {
                Log::warning('Invalid service selection for doctor', [
                    'doctor_id' => $request->doctor_id,
                    'service_id' => $request->service_id,
                    'user_id' => Auth::id(),
                ]);
                return redirect()->route('booking.create')->withErrors(['service_id' => 'Selected service is not offered by this doctor.']);
            }

            // Create the appointment
            Appointment::create([
                'doctor_id' => $request->doctor_id,
                'patient_id' => Auth::id(),
                'service_id' => $request->service_id,
                'appointment_time' => $request->appointment_time,
                'status' => 'pending',
            ]);

            // Log success
            Log::info('Appointment booked successfully', [
                'doctor_id' => $request->doctor_id,
                'service_id' => $request->service_id,
                'appointment_time' => $request->appointment_time,
                'user_id' => Auth::id(),
            ]);

            // Redirect to dashboard with success message
            return redirect()->route('patient.profile')->with('success', 'Appointment booked successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error booking appointment', [
                'doctor_id' => $request->doctor_id,
                'service_id' => $request->service_id,
                'appointment_time' => $request->appointment_time,
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            // Redirect back to booking page with error message
            return redirect()->route('booking.create')->withErrors(['error' => 'Failed to book appointment. Please try again.']);
        }
    }
    

    public function appointments()
{
    $appointments = Appointment::with([
        'doctor' => function ($query) {
            $query->select('id', 'name');
        },
        'service' => function ($query) {
            $query->select('id', 'name');
        },
        'patient' => function ($query) {
            $query->select('id', 'name', 'email');
        },
        'patient.patient' => function ($query) {
            $query->select('id', 'user_id', 'cnic', 'date_of_birth');
        }
    ])
        ->orderBy('appointment_time', 'desc')
        ->get();

    return view('dashboard.booking.appointments', compact('appointments'));
}

   public function updateStatus(Request $request, Appointment $appointment): RedirectResponse
{
    $request->validate([
        'status' => ['required', 'in:pending,confirmed,cancelled,completed'],
    ]);

    try {
        $appointment->update([
            'status' => $request->status,
        ]);

        Log::info('Appointment status updated', [
            'appointment_id' => $appointment->id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.appointments')->with('success', 'Appointment status updated successfully.');
    } catch (\Exception $e) {
        Log::error('Error updating appointment status', [
            'appointment_id' => $appointment->id,
            'status' => $request->status,
            'error' => $e->getMessage(),
        ]);

        return redirect()->route('admin.appointments')->withErrors(['error' => 'Failed to update appointment status.']);
    }
}
}