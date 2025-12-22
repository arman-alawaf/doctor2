@extends('layouts.app')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-speedometer2"></i> Patient Dashboard</h2>
    <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}!</p>
</div>

<div class="row mb-4">
    <div class="col-md-6 mb-4">
        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="stat-value">{{ $stats['total_appointments'] }}</div>
            <div class="stat-label">Total Appointments</div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="bi bi-calendar-event"></i>
            </div>
            <div class="stat-value">{{ $stats['upcoming_appointments'] }}</div>
            <div class="stat-label">Upcoming Appointments</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Recent Appointments</h5>
            </div>
            <div class="card-body">
                @if($appointments->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-person-badge"></i> Doctor</th>
                                    <th><i class="bi bi-bookmark-star"></i> Specialty</th>
                                    <th><i class="bi bi-calendar"></i> Date</th>
                                    <th><i class="bi bi-clock"></i> Time</th>
                                    <th><i class="bi bi-info-circle"></i> Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td><strong>Dr. {{ $appointment->doctor->user->name }}</strong></td>
                                        <td>{{ $appointment->doctor->specialty->name }}</td>
                                        <td>{{ $appointment->appointment_date->format('M d, Y') }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                        <td>
                                            <span class="badge bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'pending' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-4">No appointments yet. <a href="{{ route('patient.doctors') }}">Book your first appointment!</a></p>
                @endif
                <div class="mt-3">
                    <a href="{{ route('patient.appointments') }}" class="btn btn-primary me-2">
                        <i class="bi bi-arrow-right"></i> View All Appointments
                    </a>
                    <a href="{{ route('patient.doctors') }}" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Find Doctors
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

