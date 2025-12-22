<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Doctor');
    }

    public function dashboard()
    {
        $doctor = auth()->user()->doctor;
        
        if (!$doctor) {
            return view('doctor.dashboard', ['doctor' => null]);
        }

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderBy('appointment_date', 'desc')
            ->take(5)
            ->get();

        $stats = [
            'total_appointments' => Appointment::where('doctor_id', $doctor->id)->count(),
            'pending_appointments' => Appointment::where('doctor_id', $doctor->id)->where('status', 'pending')->count(),
            'confirmed_appointments' => Appointment::where('doctor_id', $doctor->id)->where('status', 'confirmed')->count(),
        ];

        return view('doctor.dashboard', compact('doctor', 'appointments', 'stats'));
    }

    public function profile()
    {
        $doctor = auth()->user()->doctor;
        $specialties = Specialty::all();
        return view('doctor.profile', compact('doctor', 'specialties'));
    }

    public function createProfile()
    {
        $specialties = Specialty::all();
        return view('doctor.create-profile', compact('specialties'));
    }

    public function storeProfile(Request $request)
    {
        $validated = $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required|string|unique:doctors',
            'experience_years' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'active';

        Doctor::create($validated);

        return redirect()->route('doctor.dashboard')->with('success', 'Profile created successfully.');
    }

    public function updateProfile(Request $request)
    {
        $doctor = auth()->user()->doctor;

        if (!$doctor) {
            return redirect()->route('doctor.create-profile');
        }

        $validated = $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required|string|unique:doctors,license_number,' . $doctor->id,
            'experience_years' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $doctor->update($validated);

        return redirect()->route('doctor.profile')->with('success', 'Profile updated successfully.');
    }

    public function appointments()
    {
        $doctor = auth()->user()->doctor;
        
        if (!$doctor) {
            return redirect()->route('doctor.create-profile')->with('error', 'Please create your doctor profile first.');
        }

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('doctor.appointments', compact('appointments'));
    }

    public function updateAppointmentStatus(Request $request, Appointment $appointment)
    {
        $doctor = auth()->user()->doctor;

        if (!$doctor || $appointment->doctor_id !== $doctor->id) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update($validated);

        return redirect()->route('doctor.appointments')->with('success', 'Appointment status updated successfully.');
    }
}
