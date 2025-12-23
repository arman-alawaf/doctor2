@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-journal-text"></i> My Posts</h2>
        <p class="text-muted mb-0">Manage your health tips and blog posts</p>
    </div>
    <a href="{{ route('doctor.posts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Create New Post
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    @forelse($posts as $post)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('posts.show', $post) }}"><i class="bi bi-eye"></i> View</a></li>
                            <li><a class="dropdown-item" href="{{ route('doctor.posts.edit', $post) }}"><i class="bi bi-pencil"></i> Edit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('doctor.posts.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="card-text text-muted">{{ Str::limit($post->description, 150) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                        <span class="ms-2"><i class="bi bi-eye"></i> {{ $post->views }} views</span>
                    </small>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-journal-x" style="font-size: 3rem; color: #ccc;"></i>
                <h4 class="mt-3">No Posts Yet</h4>
                <p class="text-muted">Start sharing health tips and insights with your patients.</p>
                <a href="{{ route('doctor.posts.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Create Your First Post
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($posts->hasPages())
<div class="row">
    <div class="col-md-12">
        {{ $posts->links() }}
    </div>
</div>
@endif
@endsection

