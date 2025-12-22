@extends('layouts.app')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-search"></i> Find Doctors</h2>
    <p class="text-muted mb-0">Search and book appointments with qualified doctors</p>
</div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('patient.doctors') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="specialty_id" class="form-label">Filter by Specialty</label>
                                <select class="form-control" id="specialty_id" name="specialty_id">
                                    <option value="">All Specialties</option>
                                    @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="search" class="form-label">Search by Name</label>
                                <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Doctor name...">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($doctors as $doctor)
            <div class="col-md-4 mb-4">
                <div class="doctor-card">
                    <div class="doctor-name">
                        <i class="bi bi-person-badge text-primary"></i> Dr. {{ $doctor->user->name }}
                    </div>
                    <div class="doctor-specialty">
                        <i class="bi bi-bookmark-star"></i> {{ $doctor->specialty->name }}
                    </div>
                    <div class="doctor-info">
                        <i class="bi bi-award"></i> {{ $doctor->experience_years }} years experience
                    </div>
                    @if($doctor->bio)
                        <div class="doctor-info mt-2">
                            <i class="bi bi-info-circle"></i> {{ Str::limit($doctor->bio, 80) }}
                        </div>
                    @endif
                    <div class="doctor-fee">
                        <i class="bi bi-currency-dollar"></i>{{ number_format($doctor->consultation_fee, 2) }}
                    </div>
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#appointmentModal{{ $doctor->id }}">
                        <i class="bi bi-calendar-plus"></i> Book Appointment
                    </button>
                </div>
            </div>

            <!-- Appointment Modal -->
            <div class="modal fade" id="appointmentModal{{ $doctor->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Book Appointment with {{ $doctor->user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                
                                <div class="mb-3">
                                    <label for="appointment_date" class="form-label">Date</label>
                                    <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" id="appointment_date" name="appointment_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="appointment_time" class="form-label">Time</label>
                                    <input type="time" class="form-control @error('appointment_time') is-invalid @enderror" id="appointment_time" name="appointment_time" required>
                                    @error('appointment_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes (Optional)</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3"></textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Book Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $doctors->links() }}
        </div>
    </div>
</div>
@endsection

