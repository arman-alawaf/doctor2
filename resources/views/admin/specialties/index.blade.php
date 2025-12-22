@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Specialties Management</h2>
                <a href="{{ route('admin.specialties.create') }}" class="btn btn-primary">Create New Specialty</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Doctors Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specialties as $specialty)
                                <tr>
                                    <td>{{ $specialty->id }}</td>
                                    <td>{{ $specialty->name }}</td>
                                    <td>{{ Str::limit($specialty->description, 50) }}</td>
                                    <td>{{ $specialty->doctors_count }}</td>
                                    <td>
                                        <a href="{{ route('admin.specialties.edit', $specialty) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.specialties.destroy', $specialty) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $specialties->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

