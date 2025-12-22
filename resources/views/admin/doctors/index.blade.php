@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Doctors Management</h2>

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
                                <th>Email</th>
                                <th>Specialty</th>
                                <th>License Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->id }}</td>
                                    <td>{{ $doctor->user->name }}</td>
                                    <td>{{ $doctor->user->email }}</td>
                                    <td>{{ $doctor->specialty->name }}</td>
                                    <td>{{ $doctor->license_number }}</td>
                                    <td><span class="badge bg-{{ $doctor->status == 'active' ? 'success' : 'secondary' }}">{{ $doctor->status }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $doctors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

