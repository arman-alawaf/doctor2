@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(!$doctor)
                <div class="alert alert-warning">
                    <p>You need to create your doctor profile first.</p>
                    <a href="{{ route('doctor.create-profile') }}" class="btn btn-primary">Create Profile</a>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi bi-person-badge"></i> Doctor Profile</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('doctor.update-profile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Profile Image Section -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Profile Image</label>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($doctor->image)
                                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="Profile Image" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #667eea;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light" style="width: 100px; height: 100px; border: 3px solid #667eea;">
                                                <i class="bi bi-person-circle" style="font-size: 3rem; color: #667eea;"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                            <small class="form-text text-muted">Upload a profile picture (Max: 2MB, JPG/PNG/GIF)</small>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Basic Information -->
                            <h5 class="mb-3"><i class="bi bi-info-circle"></i> Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}" placeholder="+1234567890">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="specialty_id" class="form-label">Specialty <span class="text-danger">*</span></label>
                                    <select class="form-control @error('specialty_id') is-invalid @enderror" id="specialty_id" name="specialty_id" required>
                                        @foreach($specialties as $specialty)
                                            <option value="{{ $specialty->id }}" {{ old('specialty_id', $doctor->specialty_id) == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialty_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="Clinic/Hospital address">{{ old('address', $doctor->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <!-- Professional Information -->
                            <h5 class="mb-3"><i class="bi bi-briefcase"></i> Professional Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="license_number" class="form-label">License Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('license_number') is-invalid @enderror" id="license_number" name="license_number" value="{{ old('license_number', $doctor->license_number) }}" required>
                                    @error('license_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="experience_years" class="form-label">Experience Years <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('experience_years') is-invalid @enderror" id="experience_years" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}" min="0" required>
                                    @error('experience_years')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="hospital_clinic_name" class="form-label">Hospital/Clinic Name</label>
                                    <input type="text" class="form-control @error('hospital_clinic_name') is-invalid @enderror" id="hospital_clinic_name" name="hospital_clinic_name" value="{{ old('hospital_clinic_name', $doctor->hospital_clinic_name) }}" placeholder="e.g., City General Hospital">
                                    @error('hospital_clinic_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="working_hours" class="form-label">Working Hours</label>
                                    <input type="text" class="form-control @error('working_hours') is-invalid @enderror" id="working_hours" name="working_hours" value="{{ old('working_hours', $doctor->working_hours) }}" placeholder="e.g., Mon-Fri: 9 AM - 5 PM">
                                    @error('working_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="education" class="form-label">Education</label>
                                <textarea class="form-control @error('education') is-invalid @enderror" id="education" name="education" rows="3" placeholder="e.g., MBBS, MD in Cardiology, etc.">{{ old('education', $doctor->education) }}</textarea>
                                <small class="form-text text-muted">List your medical degrees and qualifications</small>
                                @error('education')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="certifications" class="form-label">Certifications</label>
                                <textarea class="form-control @error('certifications') is-invalid @enderror" id="certifications" name="certifications" rows="2" placeholder="e.g., Board Certified, Fellowship in...">{{ old('certifications', $doctor->certifications) }}</textarea>
                                <small class="form-text text-muted">List any additional certifications or memberships</small>
                                @error('certifications')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="languages" class="form-label">Languages Spoken</label>
                                <input type="text" class="form-control @error('languages') is-invalid @enderror" id="languages" name="languages" value="{{ old('languages', $doctor->languages) }}" placeholder="e.g., English, Spanish, French">
                                <small class="form-text text-muted">Separate languages with commas</small>
                                @error('languages')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <!-- Additional Information -->
                            <h5 class="mb-3"><i class="bi bi-file-text"></i> Additional Information</h5>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4" placeholder="Tell patients about yourself, your approach to healthcare, etc.">{{ old('bio', $doctor->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="consultation_fee" class="form-label">Consultation Fee <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control @error('consultation_fee') is-invalid @enderror" id="consultation_fee" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}" min="0" required>
                                </div>
                                @error('consultation_fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('doctor.dashboard') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
