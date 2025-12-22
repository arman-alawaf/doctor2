@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Medical Specialties</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        @foreach($specialties as $specialty)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $specialty->name }}</h5>
                        <p class="card-text">{{ $specialty->description }}</p>
                        <p class="card-text"><small class="text-muted">{{ $specialty->doctors_count }} Doctors</small></p>
                        <a href="{{ route('specialties.show', $specialty) }}" class="btn btn-primary">View Doctors</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

