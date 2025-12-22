@extends('layouts.app')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-speedometer2"></i> Doctor Dashboard</h2>
    <p class="text-muted mb-0">Welcome, Dr. {{ Auth::user()->name }}!</p>
</div>

@if(!$doctor)
    <div class="alert alert-warning">
        <h5 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Profile Required</h5>
        <p class="mb-3">You need to create your doctor profile first to start receiving appointments.</p>
        <a href="{{ route('doctor.create-profile') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create Profile
        </a>
    </div>
@else
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="stat-card primary">
                <div class="stat-icon primary">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="stat-value">{{ $stats['total_appointments'] }}</div>
                <div class="stat-label">Total Appointments</div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-value">{{ $stats['pending_appointments'] }}</div>
                <div class="stat-label">Pending Appointments</div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card success">
                <div class="stat-icon success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-value">{{ $stats['confirmed_appointments'] }}</div>
                <div class="stat-label">Confirmed Appointments</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Recent Appointments</h5>
                </div>
                <div class="card-body">
                    @if($appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-person"></i> Patient</th>
                                        <th><i class="bi bi-calendar"></i> Date</th>
                                        <th><i class="bi bi-clock"></i> Time</th>
                                        <th><i class="bi bi-info-circle"></i> Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td><strong>{{ $appointment->patient->name }}</strong></td>
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
                        <p class="text-muted text-center py-4">No appointments yet.</p>
                    @endif
                    <a href="{{ route('doctor.appointments') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-right"></i> View All Appointments
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

