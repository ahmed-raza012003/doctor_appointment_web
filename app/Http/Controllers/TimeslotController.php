<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimeslotController extends Controller
{
    /**
     * Display a listing of the timeslots.
     */

        public function manage($doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);
        $timeslots = Timeslot::where('doctor_id', $doctor_id)->get();
        return view('dashboard.timeslots.manage', compact('doctor', 'timeslots'));
    }

    public function index()
    {
        $timeslots = Timeslot::with('doctor')->get();
        return view('dashboard.timeslots.index', compact('timeslots'));
    }

    /**
     * Show the form for creating a new timeslot.
     */
    public function create()
    {
        $doctors = Doctor::all();
        return view('dashboard.timeslots.create', compact('doctors'));
    }

    /**
     * Store a newly created timeslot in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Timeslot::create($request->all());

        return redirect()->route('admin.timeslots.index')->with('success', 'Timeslot created successfully.');
    }

    /**
     * Show the form for editing the specified timeslot.
     */
    public function edit($id)
    {
        $timeslot = Timeslot::findOrFail($id);
        $doctors = Doctor::all();
        return view('dashboard.timeslots.edit', compact('timeslot', 'doctors'));
    }

    /**
     * Update the specified timeslot in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $timeslot = Timeslot::findOrFail($id);
        $timeslot->update($request->all());

        return redirect()->route('admin.timeslots.index')->with('success', 'Timeslot updated successfully.');
    }

    /**
     * Remove the specified timeslot from storage.
     */
    public function destroy($id)
    {
        $timeslot = Timeslot::findOrFail($id);
        $timeslot->delete();

        return redirect()->route('admin.timeslots.index')->with('success', 'Timeslot deleted successfully.');
    }
}