<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_doctors' => Doctor::count(),
            'total_patients' => User::where('role', 'Patient')->count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // User Management
    public function users()
    {
        $users = User::with('doctor')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Patient,Doctor',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:Admin,Patient,Doctor',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // Doctor Management
    public function doctors()
    {
        $doctors = Doctor::with(['user', 'specialty'])->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function editDoctor(Doctor $doctor)
    {
        $specialties = Specialty::all();
        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    public function updateDoctor(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required|string|unique:doctors,license_number,' . $doctor->id,
            'experience_years' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'education' => 'nullable|string|max:1000',
            'hospital_clinic_name' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'certifications' => 'nullable|string|max:1000',
            'consultation_fee' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }
            $validated['image'] = $request->file('image')->store('doctors', 'public');
        } else {
            unset($validated['image']);
        }

        $doctor->update($validated);

        return redirect()->route('admin.doctors')->with('success', 'Doctor updated successfully.');
    }

    public function destroyDoctor(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('admin.doctors')->with('success', 'Doctor deleted successfully.');
    }

    // Specialty Management
    public function specialties()
    {
        $specialties = Specialty::withCount('doctors')->paginate(10);
        return view('admin.specialties.index', compact('specialties'));
    }

    public function createSpecialty()
    {
        return view('admin.specialties.create');
    }

    public function storeSpecialty(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialties',
            'description' => 'nullable|string',
        ]);

        Specialty::create($validated);

        return redirect()->route('admin.specialties')->with('success', 'Specialty created successfully.');
    }

    public function editSpecialty(Specialty $specialty)
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    public function updateSpecialty(Request $request, Specialty $specialty)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable|string',
        ]);

        $specialty->update($validated);

        return redirect()->route('admin.specialties')->with('success', 'Specialty updated successfully.');
    }

    public function destroySpecialty(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->route('admin.specialties')->with('success', 'Specialty deleted successfully.');
    }

    // Appointment Management
    public function appointments()
    {
        $appointments = Appointment::with(['patient', 'doctor.user', 'doctor.specialty'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function updateAppointmentStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments')->with('success', 'Appointment status updated successfully.');
    }
}
