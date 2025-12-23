@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="card-img-top" style="max-height: 400px; object-fit: cover;">
            @endif
            <div class="card-body">
                <div class="post-meta-custom mb-3">
                    <span class="badge bg-primary">{{ $post->doctor->specialty->name ?? 'General' }}</span>
                    <small class="text-muted ms-2">
                        <i class="bi bi-person-circle"></i> {{ $post->doctor->user->name }}
                    </small>
                    <small class="text-muted ms-2">
                        <i class="bi bi-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                    </small>
                    <small class="text-muted ms-2">
                        <i class="bi bi-eye"></i> {{ $post->views }} views
                    </small>
                </div>
                <h1 class="card-title mb-3">{{ $post->title }}</h1>
                <div class="post-content">
                    {!! nl2br(e($post->description)) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5><i class="bi bi-person-badge"></i> About the Author</h5>
            </div>
            <div class="card-body">
                <h6>{{ $post->doctor->user->name }}</h6>
                <p class="text-muted mb-2">
                    <i class="bi bi-bookmark-star"></i> {{ $post->doctor->specialty->name ?? 'General Medicine' }}
                </p>
                <p class="text-muted mb-2">
                    <i class="bi bi-award"></i> {{ $post->doctor->experience_years }} years experience
                </p>
                @if($post->doctor->bio)
                <p class="small">{{ Str::limit($post->doctor->bio, 100) }}</p>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-link-45deg"></i> Quick Links</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-primary w-100 mb-2">
                    <i class="bi bi-arrow-left"></i> Back to Posts
                </a>
                <a href="{{ route('patient.doctors') }}" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Find Doctors
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

