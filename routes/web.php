<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    $specialties = \App\Models\Specialty::withCount('doctors')->take(8)->get();
    $doctors = \App\Models\Doctor::where('status', 'active')
        ->with(['user', 'specialty'])
        ->take(6)
        ->get();
    $posts = \App\Models\Post::where('status', 'published')
        ->with(['doctor.user', 'doctor.specialty'])
        ->latest()
        ->take(6)
        ->get();
    return view('welcome', compact('specialties', 'doctors', 'posts'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Public routes
Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
Route::get('/specialties/{specialty}', [SpecialtyController::class, 'show'])->name('specialties.show');
Route::get('/doctors/{doctor}', [DoctorController::class, 'showPublic'])->name('doctors.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/book-appointment/{doctor}', function (\App\Models\Doctor $doctor) {
    session(['booking_doctor_id' => $doctor->id]);
    return response()->json(['success' => true, 'doctor_id' => $doctor->id]);
})->middleware('web')->name('book.appointment');

Route::get('/book-appointment-redirect', function () {
    $doctorId = session('booking_doctor_id');
    if ($doctorId && auth()->check() && auth()->user()->isPatient()) {
        session()->keep('booking_doctor_id');
        return redirect('/#doctors')->with('open_booking_modal', true);
    }
    return redirect('/');
})->middleware('auth')->name('book.appointment.redirect');

// Admin routes
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::resource('users', AdminController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    
    // Doctor Management
    Route::get('/doctors', [AdminController::class, 'doctors'])->name('doctors');
    Route::get('/doctors/{doctor}/edit', [AdminController::class, 'editDoctor'])->name('doctors.edit');
    Route::put('/doctors/{doctor}', [AdminController::class, 'updateDoctor'])->name('doctors.update');
    Route::delete('/doctors/{doctor}', [AdminController::class, 'destroyDoctor'])->name('doctors.destroy');
    
    // Specialty Management
    Route::get('/specialties', [AdminController::class, 'specialties'])->name('specialties');
    Route::get('/specialties/create', [AdminController::class, 'createSpecialty'])->name('specialties.create');
    Route::post('/specialties', [AdminController::class, 'storeSpecialty'])->name('specialties.store');
    Route::get('/specialties/{specialty}/edit', [AdminController::class, 'editSpecialty'])->name('specialties.edit');
    Route::put('/specialties/{specialty}', [AdminController::class, 'updateSpecialty'])->name('specialties.update');
    Route::delete('/specialties/{specialty}', [AdminController::class, 'destroySpecialty'])->name('specialties.destroy');
    
    // Appointment Management
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::put('/appointments/{appointment}/status', [AdminController::class, 'updateAppointmentStatus'])->name('appointments.update-status');
});

// Doctor routes
Route::middleware(['auth', 'role:Doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('profile');
    Route::get('/profile/create', [DoctorController::class, 'createProfile'])->name('create-profile');
    Route::post('/profile', [DoctorController::class, 'storeProfile'])->name('store-profile');
    Route::put('/profile', [DoctorController::class, 'updateProfile'])->name('update-profile');
    Route::get('/appointments', [DoctorController::class, 'appointments'])->name('appointments');
    Route::put('/appointments/{appointment}/status', [DoctorController::class, 'updateAppointmentStatus'])->name('appointments.update-status');
    
    // Post routes for doctors
    Route::get('/posts', function() {
        $posts = \App\Models\Post::where('doctor_id', auth()->user()->doctor->id)
            ->latest()
            ->paginate(10);
        return view('posts.doctor-index', compact('posts'));
    })->name('posts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Patient routes
Route::middleware(['auth', 'role:Patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PatientController::class, 'profile'])->name('profile');
    Route::put('/profile', [PatientController::class, 'updateProfile'])->name('update-profile');
    Route::get('/doctors', [PatientController::class, 'doctors'])->name('doctors');
    Route::get('/appointments', [PatientController::class, 'appointments'])->name('appointments');
});

// Appointment routes
Route::middleware('auth')->group(function () {
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});
