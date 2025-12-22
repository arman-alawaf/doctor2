<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Patient');
    }

    public function dashboard()
    {
        $appointments = Appointment::where('patient_id', auth()->id())
            ->with(['doctor.user', 'doctor.specialty'])
            ->orderBy('appointment_date', 'desc')
            ->take(5)
            ->get();

        $stats = [
            'total_appointments' => Appointment::where('patient_id', auth()->id())->count(),
            'upcoming_appointments' => Appointment::where('patient_id', auth()->id())
                ->where('status', 'confirmed')
                ->where('appointment_date', '>=', now())
                ->count(),
        ];

        return view('patient.dashboard', compact('appointments', 'stats'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('patient.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        auth()->user()->update($validated);

        return redirect()->route('patient.profile')->with('success', 'Profile updated successfully.');
    }

    public function doctors(Request $request)
    {
        $query = Doctor::with(['user', 'specialty'])->where('status', 'active');

        if ($request->has('specialty_id') && $request->specialty_id) {
            $query->where('specialty_id', $request->specialty_id);
        }

        if ($request->has('search') && $request->search) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $doctors = $query->paginate(12);
        $specialties = Specialty::all();

        return view('patient.doctors', compact('doctors', 'specialties'));
    }

    public function appointments()
    {
        $appointments = Appointment::where('patient_id', auth()->id())
            ->with(['doctor.user', 'doctor.specialty'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);

        return view('patient.appointments', compact('appointments'));
    }
}
