@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">
                    <i class="bi bi-hospital text-primary"></i> Doctor Management System
                </h1>
                <p class="lead mb-4 text-muted">
                    Your trusted platform for managing doctor appointments. Book appointments, manage schedules, and connect with healthcare professionals seamlessly.
                </p>
                @guest
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-person-plus"></i> Get Started
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </div>
                @else
                    <div class="d-flex gap-3 flex-wrap">
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Go to Dashboard
                            </a>
                        @elseif(Auth::user()->isDoctor())
                            <a href="{{ route('doctor.dashboard') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('patient.dashboard') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Go to Dashboard
                            </a>
                        @endif
                        <a href="{{ route('patient.doctors') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-search"></i> Find Doctors
                        </a>
                    </div>
                @endguest
            </div>
        </div>
        <div class="col-lg-6">
            <div class="hero-image text-center">
                <div class="hero-icon-wrapper">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section mb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3">Why Choose Our Platform?</h2>
        <p class="text-muted">Experience the best in healthcare management</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h4>Easy Booking</h4>
                <p class="text-muted">Book appointments with your preferred doctors in just a few clicks. Simple, fast, and convenient.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-search"></i>
                </div>
                <h4>Find Specialists</h4>
                <p class="text-muted">Search and filter doctors by specialty to find the perfect healthcare provider for your needs.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4>Secure & Reliable</h4>
                <p class="text-muted">Your data is protected with industry-standard security measures. Your privacy is our priority.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h4>24/7 Access</h4>
                <p class="text-muted">Access your appointments and medical information anytime, anywhere from any device.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h4>Verified Doctors</h4>
                <p class="text-muted">All doctors are verified professionals with proper credentials and licenses.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-bell"></i>
                </div>
                <h4>Appointment Reminders</h4>
                <p class="text-muted">Never miss an appointment with our smart reminder system.</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
@if(!Auth::check())
<div class="stats-section mb-5">
    <div class="row g-4">
        <div class="col-md-3 col-6">
            <div class="stat-box text-center">
                <div class="stat-number">100+</div>
                <div class="stat-label">Doctors</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-box text-center">
                <div class="stat-number">8+</div>
                <div class="stat-label">Specialties</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-box text-center">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Appointments</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-box text-center">
                <div class="stat-number">500+</div>
                <div class="stat-label">Happy Patients</div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- CTA Section -->
@guest
<div class="cta-section">
    <div class="card cta-card">
        <div class="card-body text-center p-5">
            <h2 class="fw-bold mb-3">Ready to Get Started?</h2>
            <p class="text-muted mb-4">Join thousands of patients and doctors using our platform</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-person-plus"></i> Register as Patient
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-person-badge"></i> Register as Doctor
                </a>
            </div>
        </div>
    </div>
</div>
@endguest

<style>
.hero-section {
    padding: 4rem 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 1rem;
    margin: 2rem 0;
}

.hero-content {
    padding: 2rem;
}

.hero-icon-wrapper {
    width: 300px;
    height: 300px;
    margin: 0 auto;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 20px 60px rgba(102, 126, 234, 0.3);
    animation: float 3s ease-in-out infinite;
}

.hero-icon-wrapper i {
    font-size: 8rem;
    color: white;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    height: 100%;
    text-align: center;
}

.feature-card:hover {
    box-shadow: var(--card-shadow-hover);
    transform: translateY(-5px);
}

.feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
}

.feature-card h4 {
    color: var(--dark-color);
    font-weight: 600;
    margin-bottom: 1rem;
}

.stats-section {
    padding: 3rem 0;
}

.stat-box {
    padding: 2rem;
    background: white;
    border-radius: 1rem;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
}

.stat-box:hover {
    box-shadow: var(--card-shadow-hover);
    transform: translateY(-5px);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #6b7280;
    font-weight: 500;
    font-size: 1.1rem;
}

.cta-section {
    margin: 4rem 0;
}

.cta-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
}

.cta-card h2,
.cta-card p {
    color: white;
}

.cta-card .btn-outline-primary {
    border-color: white;
    color: white;
}

.cta-card .btn-outline-primary:hover {
    background: white;
    color: #667eea;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 0;
    }
    
    .hero-icon-wrapper {
        width: 200px;
        height: 200px;
        margin-top: 2rem;
    }
    
    .hero-icon-wrapper i {
        font-size: 5rem;
    }
    
    .display-4 {
        font-size: 2rem;
    }
}
</style>
@endsection
