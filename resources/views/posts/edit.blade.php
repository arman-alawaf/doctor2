@extends('layouts.app')

@section('content')
<div class="page-header">
    <h2><i class="bi bi-pencil-square"></i> Edit Post</h2>
    <p class="text-muted mb-0">Update your health tips and insights</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('doctor.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10" required>{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if($post->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current image" style="max-width: 200px; border-radius: 8px;">
                </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Upload a new image to replace the current one (optional). Max size: 2MB</small>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('doctor.posts') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

