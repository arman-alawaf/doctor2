@extends('layouts.app')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-journal-text"></i> Health Tips & Blog Posts</h2>
    <p class="text-muted mb-0">Expert advice and insights from our doctors</p>
</div>

<div class="row">
    @forelse($posts as $post)
    <div class="col-md-4 mb-4">
        <div class="card h-100 post-card-custom">
            <div class="post-image-custom">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                    </div>
                @endif
            </div>
            <div class="card-body d-flex flex-column">
                <div class="post-meta-custom mb-2">
                    <small class="text-muted">
                        <i class="bi bi-person-circle"></i> {{ $post->doctor->user->name }}
                    </small>
                    <small class="text-muted ms-2">
                        <i class="bi bi-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                    </small>
                </div>
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text flex-grow-1">{{ Str::limit($post->description, 120) }}</p>
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <small class="text-muted">
                        <i class="bi bi-eye"></i> {{ $post->views }} views
                    </small>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-primary">
                        Read More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-journal-x" style="font-size: 3rem; color: #ccc;"></i>
                <h4 class="mt-3">No Posts Available</h4>
                <p class="text-muted">Check back soon for health tips and blog posts from our doctors.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($posts->hasPages())
<div class="row mt-4">
    <div class="col-md-12">
        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endif
@endsection

