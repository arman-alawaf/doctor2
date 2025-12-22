@extends('layouts.app')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-speedometer2"></i> Admin Dashboard</h2>
    <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}! Here's an overview of your system.</p>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-4">
        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="bi bi-person-badge"></i>
            </div>
            <div class="stat-value">{{ $stats['total_doctors'] }}</div>
            <div class="stat-label">Total Doctors</div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card info">
            <div class="stat-icon info">
                <i class="bi bi-person-heart"></i>
            </div>
            <div class="stat-value">{{ $stats['total_patients'] }}</div>
            <div class="stat-label">Total Patients</div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="stat-value">{{ $stats['total_appointments'] }}</div>
            <div class="stat-label">Total Appointments</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Pending Appointments</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-value text-warning me-3">{{ $stats['pending_appointments'] }}</div>
                    <div class="stat-label">Appointments awaiting confirmation</div>
                </div>
                <a href="{{ route('admin.appointments') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-arrow-right"></i> View All Appointments
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

