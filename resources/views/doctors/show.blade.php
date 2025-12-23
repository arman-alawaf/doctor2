<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $doctor->user->name }} - MyDoctorr</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!-- Simple Navbar -->
    <nav class="navbar" style="position: sticky; top: 0; z-index: 1000;">
        <div class="navbar-content">
            <a href="/" class="navbar-brand">
                <img src="https://mydoctorr.com/images/apps/logo1762790479.webp" alt="MyDoctorr Logo" style="height: 40px; width: auto;">
            </a>
            <ul class="navbar-nav">
                <li><a href="/" class="nav-link">Home</a></li>
                <li><a href="/#doctors" class="nav-link">Doctors</a></li>
                <li><a href="/posts" class="nav-link">Health Tips</a></li>
                @auth
                    <li><a href="{{ url('/home') }}" class="btn-nav btn-primary-nav">Dashboard</a></li>
                @else
                    <li><a href="{{ route('login') }}" class="btn-nav btn-primary-nav">Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Doctor Profile Section -->
    <section class="section" style="padding: 4rem 0; background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card" style="position: sticky; top: 100px;">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                @if($doctor->image)
                                    <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->user->name }}" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover; border: 4px solid #667eea;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="bi bi-person-circle text-white" style="font-size: 6rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <h2 class="mb-2">{{ $doctor->user->name }}</h2>
                            <p class="text-primary mb-3" style="font-size: 1.2rem; font-weight: 600;">
                                <i class="bi bi-bookmark-star"></i> {{ $doctor->specialty->name ?? 'General Medicine' }}
                            </p>
                            <div class="mb-3">
                                <span class="badge bg-success" style="font-size: 1rem; padding: 0.5rem 1rem;">
                                    <i class="bi bi-check-circle"></i> Active
                                </span>
                            </div>
                            <hr>
                            <div class="text-start">
                                <div class="mb-2">
                                    <i class="bi bi-award text-primary"></i> 
                                    <strong>{{ $doctor->experience_years ?? 0 }} Years</strong> Experience
                                </div>
                                <div class="mb-2">
                                    <i class="bi bi-currency-dollar text-success"></i> 
                                    <strong>${{ number_format($doctor->consultation_fee ?? 0, 2) }}</strong> Consultation Fee
                                </div>
                                @if($doctor->phone)
                                <div class="mb-2">
                                    <i class="bi bi-telephone text-primary"></i> 
                                    <strong>{{ $doctor->phone }}</strong>
                                </div>
                                @endif
                                @if($doctor->working_hours)
                                <div class="mb-2">
                                    <i class="bi bi-clock text-primary"></i> 
                                    <strong>{{ $doctor->working_hours }}</strong>
                                </div>
                                @endif
                                @if($doctor->languages)
                                <div class="mb-2">
                                    <i class="bi bi-translate text-primary"></i> 
                                    <strong>{{ $doctor->languages }}</strong>
                                </div>
                                @endif
                            </div>
                            <hr>
                            @auth
                                @if(auth()->user()->isPatient())
                                    <button type="button" class="btn btn-primary w-100 mb-2" onclick="window.location.href='{{ route('patient.doctors') }}'">
                                        <i class="bi bi-calendar-plus"></i> Book Appointment
                                    </button>
                                @else
                                    <a href="{{ route('register') }}" class="btn btn-primary w-100 mb-2">
                                        <i class="bi bi-person-plus"></i> Register as Patient
                                    </a>
                                @endif
                            @else
                                <button type="button" class="btn btn-primary w-100 mb-2" onclick="window.location.href='/'">
                                    <i class="bi bi-calendar-plus"></i> Book Appointment
                                </button>
                            @endauth
                            <a href="/#doctors" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-left"></i> Back to Doctors
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Basic Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="bi bi-info-circle"></i> About Doctor</h4>
                        </div>
                        <div class="card-body">
                            @if($doctor->bio)
                                <p style="font-size: 1.1rem; line-height: 1.8; color: #4b5563;">{{ $doctor->bio }}</p>
                            @else
                                <p class="text-muted">No bio available.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Professional Information -->
                    @if($doctor->education || $doctor->certifications || $doctor->hospital_clinic_name || $doctor->address)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="bi bi-briefcase"></i> Professional Information</h4>
                        </div>
                        <div class="card-body">
                            @if($doctor->education)
                            <div class="mb-3">
                                <h6><i class="bi bi-mortarboard text-primary"></i> Education</h6>
                                <p class="mb-0">{{ $doctor->education }}</p>
                            </div>
                            @endif

                            @if($doctor->certifications)
                            <div class="mb-3">
                                <h6><i class="bi bi-award text-primary"></i> Certifications</h6>
                                <p class="mb-0">{{ $doctor->certifications }}</p>
                            </div>
                            @endif

                            @if($doctor->hospital_clinic_name)
                            <div class="mb-3">
                                <h6><i class="bi bi-hospital text-primary"></i> Hospital/Clinic</h6>
                                <p class="mb-0">{{ $doctor->hospital_clinic_name }}</p>
                            </div>
                            @endif

                            @if($doctor->address)
                            <div class="mb-3">
                                <h6><i class="bi bi-geo-alt text-primary"></i> Address</h6>
                                <p class="mb-0">{{ $doctor->address }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Recent Posts -->
                    @if($doctor->posts->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="bi bi-journal-text"></i> Recent Health Tips</h4>
                        </div>
                        <div class="card-body">
                            @foreach($doctor->posts as $post)
                            <div class="mb-3 pb-3 border-bottom">
                                <h5><a href="{{ route('posts.show', $post) }}" style="text-decoration: none; color: #667eea;">{{ $post->title }}</a></h5>
                                <p class="text-muted mb-2">{{ Str::limit($post->description, 150) }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> {{ $post->created_at->format('M d, Y') }} | 
                                    <i class="bi bi-eye"></i> {{ $post->views }} views
                                </small>
                            </div>
                            @endforeach
                            <a href="{{ route('posts.index') }}?doctor={{ $doctor->id }}" class="btn btn-outline-primary">
                                View All Posts <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <img src="https://mydoctorr.com/images/apps/logo1762790479.webp" alt="MyDoctorr Logo" style="height: 50px; width: auto;">
                    </div>
                    <h3>MyDoctorr</h3>
                    <p>Your trusted platform for managing doctor appointments.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="/"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="/#doctors"><i class="bi bi-chevron-right"></i> Doctors</a></li>
                        <li><a href="/posts"><i class="bi bi-chevron-right"></i> Health Tips</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MyDoctorr. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>

