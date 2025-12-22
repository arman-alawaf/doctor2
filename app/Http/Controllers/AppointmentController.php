<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Check if doctor is available
        $existingAppointment = Appointment::where('doctor_id', $validated['doctor_id'])
            ->where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingAppointment) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked.'])->withInput();
        }

        $validated['patient_id'] = Auth::id();
        $validated['status'] = 'pending';

        Appointment::create($validated);

        return redirect()->route('patient.appointments')->with('success', 'Appointment requested successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        if (Auth::user()->isPatient() && $appointment->patient_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        if (Auth::user()->isDoctor() && $appointment->doctor_id !== Auth::user()->doctor->id) {
            abort(403, 'Unauthorized access.');
        }

        $appointment->delete();

        if (Auth::user()->isPatient()) {
            return redirect()->route('patient.appointments')->with('success', 'Appointment cancelled successfully.');
        } else {
            return redirect()->route('doctor.appointments')->with('success', 'Appointment deleted successfully.');
        }
    }
}
