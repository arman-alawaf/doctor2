@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $specialty->name }}</h2>
            <p>{{ $specialty->description }}</p>
            <hr>
        </div>
    </div>

    <div class="row">
        @foreach($doctors as $doctor)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $doctor->user->name }}</h5>
                        <p class="card-text">
                            <strong>Experience:</strong> {{ $doctor->experience_years }} years<br>
                            <strong>Fee:</strong> ${{ number_format($doctor->consultation_fee, 2) }}<br>
                            @if($doctor->bio)
                                <strong>Bio:</strong> {{ Str::limit($doctor->bio, 100) }}
                            @endif
                        </p>
                        @auth
                            @if(auth()->user()->isPatient())
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentModal{{ $doctor->id }}">Book Appointment</button>
                            @endif
                        @endauth
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

