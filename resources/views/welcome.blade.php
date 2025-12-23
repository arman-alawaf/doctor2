<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyDoctorr - Doctor Management System</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
<body>
    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-content">
            <div class="topbar-left">
                <div class="topbar-item">
                    <i class="bi bi-telephone"></i>
                    <span>+1 234 567 8900</span>
                </div>
                <div class="topbar-item">
                    <i class="bi bi-envelope"></i>
                    <span>info@dms.com</span>
                </div>
            </div>
            <div class="topbar-right">
                <div class="topbar-item">
                    <i class="bi bi-clock"></i>
                    <span>Mon - Sat: 8:00 AM - 8:00 PM</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="navbar-content">
            <a href="/" class="navbar-brand">
                <img src="https://mydoctorr.com/images/apps/logo1762790479.webp" alt="MyDoctorr Logo" style="height: 40px; width: auto;">
            </a>
            <button class="navbar-toggle" id="navbarToggle" aria-label="Toggle navigation">
                <i class="bi bi-list" id="menuIcon"></i>
            </button>
            <div class="menu-overlay" id="menuOverlay"></div>
            <ul class="navbar-nav" id="navbarNav">
                <li><a href="#home" class="nav-link" onclick="closeMobileMenu()">Home</a></li>
                <li><a href="#specialties" class="nav-link" onclick="closeMobileMenu()">Specialties</a></li>
                <li><a href="#doctors" class="nav-link" onclick="closeMobileMenu()">Doctors</a></li>
                <li><a href="#posts" class="nav-link" onclick="closeMobileMenu()">Health Tips</a></li>
                <li><a href="#about" class="nav-link" onclick="closeMobileMenu()">About</a></li>
                <li><a href="#contact" class="nav-link" onclick="closeMobileMenu()">Contact</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/home') }}" class="btn-nav btn-primary-nav">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn-nav btn-primary-nav">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="btn-nav btn-outline-nav">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Carousel -->
    <section class="carousel-section" id="home">
        <div class="carousel-slide active" style="background-image: url('https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=1920');">
            <div class="carousel-content">
                <h1>Your Health, Our Priority</h1>
                <p>Connect with expert doctors and manage your healthcare needs with ease</p>
                <a href="#specialties" class="carousel-btn">Find Your Doctor</a>
            </div>
        </div>
        <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=1920');">
            <div class="carousel-content">
                <h1>Expert Medical Care</h1>
                <p>Book appointments with verified healthcare professionals</p>
                <a href="#doctors" class="carousel-btn">View Doctors</a>
            </div>
        </div>
        <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1551601651-2a8555f1a136?w=1920');">
            <div class="carousel-content">
                <h1>24/7 Healthcare Support</h1>
                <p>Access quality healthcare services anytime, anywhere</p>
                <a href="{{ route('register') }}" class="carousel-btn">Get Started</a>
            </div>
        </div>
        <div class="carousel-indicators">
            <span class="carousel-indicator active" onclick="currentSlide(1)"></span>
            <span class="carousel-indicator" onclick="currentSlide(2)"></span>
            <span class="carousel-indicator" onclick="currentSlide(3)"></span>
        </div>
    </section>

    <!-- Specialties Section -->
    <section class="section specialties-section" id="specialties">
        <div class="container">
            <div class="section-title">
                <h2>Medical Specialties</h2>
                <p>Choose from our wide range of medical specialties and find the right doctor for your needs</p>
            </div>
            <div class="specialties-grid">
                @forelse($specialties as $specialty)
                <a href="{{ route('specialties.show', $specialty) }}" class="specialty-card">
                    <div class="specialty-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h3>{{ $specialty->name }}</h3>
                    <p>{{ Str::limit($specialty->description ?? 'Expert care in this specialty', 80) }}</p>
                    <div class="specialty-count">
                        <i class="bi bi-people"></i>
                        <span>{{ $specialty->doctors_count }} Doctors</span>
                    </div>
                </a>
                @empty
                <div class="specialty-card">
                    <div class="specialty-icon">
                        <i class="bi bi-hospital"></i>
                    </div>
                    <h3>No Specialties Available</h3>
                    <p>Check back soon for available specialties</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Action Buttons Section -->
    <section class="section action-buttons-section" id="about">
        <div class="container">
            <div class="action-buttons-grid">
                <div class="action-card">
                    <i class="bi bi-calendar-check"></i>
                    <h3>Book Appointment</h3>
                    <p>Schedule your appointment with our expert doctors in just a few clicks</p>
                    @auth
                        <a href="{{ url('/home') }}" class="action-btn">Book Now</a>
                    @else
                        <a href="{{ route('register') }}" class="action-btn">Get Started</a>
                    @endauth
                </div>
                <div class="action-card">
                        <i class="bi bi-search"></i>
                    <h3>Find Doctor</h3>
                    <p>Search and filter doctors by specialty, experience, and availability</p>
                    <a href="#doctors" class="action-btn">Search Doctors</a>
                </div>
                <div class="action-card">
                    <i class="bi bi-shield-check"></i>
                    <h3>Secure Platform</h3>
                    <p>Your health data is protected with industry-standard security measures</p>
                    <a href="#contact" class="action-btn">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="section doctors-section" id="doctors">
        <div class="container">
            <div class="section-title">
                <h2>Our Expert Doctors</h2>
                <p>Meet our team of experienced and qualified healthcare professionals</p>
            </div>
            <div class="doctors-grid">
                @forelse($doctors as $doctor)
                <div class="doctor-card" style="cursor: pointer;" onclick="window.location.href='{{ route('doctors.show', $doctor) }}'">
                    <div class="doctor-image">
                        @if($doctor->image)
                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->user->name }}" onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'bi bi-person-circle\'></i>'">
                        @else
                            <i class="bi bi-person-circle"></i>
                        @endif
                    </div>
                    <div class="doctor-info">
                        <h3 class="doctor-name">
                            <a href="{{ route('doctors.show', $doctor) }}" style="text-decoration: none; color: inherit; transition: color 0.3s ease;" onmouseover="this.style.color='#667eea'" onmouseout="this.style.color='inherit'">
                                {{ $doctor->user->name }}
                            </a>
                        </h3>
                        <span class="doctor-specialty">{{ $doctor->specialty->name ?? 'General' }}</span>
                        <div class="doctor-details">
                            <div class="doctor-detail-item">
                                <i class="bi bi-award"></i>
                                <span>{{ $doctor->experience_years ?? 0 }} Years</span>
                            </div>
                            <div class="doctor-detail-item">
                                <i class="bi bi-star-fill"></i>
                                <span>4.8 Rating</span>
                            </div>
                        </div>
                        <div class="doctor-fee">${{ number_format($doctor->consultation_fee ?? 0, 2) }}</div>
                        @auth
                            @if(auth()->user()->isPatient())
                                <button type="button" class="doctor-btn" onclick="event.stopPropagation(); openAppointmentModal({{ $doctor->id }}, '{{ $doctor->user->name }}')">Book Appointment</button>
                            @else
                                <a href="{{ route('register') }}" class="doctor-btn" onclick="event.stopPropagation();">Register as Patient</a>
                            @endif
                        @else
                            <button type="button" class="doctor-btn" onclick="event.stopPropagation(); handleBookAppointment({{ $doctor->id }})">Book Appointment</button>
                        @endauth
                    </div>
                </div>
                @empty
                <div class="doctor-card">
                    <div class="doctor-image">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="doctor-info">
                        <h3 class="doctor-name">No Doctors Available</h3>
                        <span class="doctor-specialty">Check back soon</span>
                    </div>
                </div>
                @endforelse
            </div>
                    </div>
    </section>

    <!-- Posts/Blog Section -->
    <section class="section posts-section" id="posts">
        <div class="container">
            <div class="section-title">
                <h2><i class="bi bi-journal-text"></i> Health Tips & Blog Posts</h2>
                <p>Expert advice and insights from our doctors</p>
            </div>
            <div class="posts-grid">
                @forelse($posts as $post)
                <div class="post-card">
                    <div class="post-image">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <i class="bi bi-image"></i>
                        @endif
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-author">
                                <i class="bi bi-person-circle"></i> {{ $post->doctor->user->name }}
                            </span>
                            <span class="post-date">
                                <i class="bi bi-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        <h3 class="post-title">{{ $post->title }}</h3>
                        <p class="post-description">{{ Str::limit($post->description, 120) }}</p>
                        <div class="post-footer">
                            <span class="post-views">
                                <i class="bi bi-eye"></i> {{ $post->views }} views
                            </span>
                            <a href="{{ route('posts.show', $post) }}" class="post-read-more">
                                Read More <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="post-card empty">
                    <div class="post-content">
                        <i class="bi bi-journal-x" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                        <h3>No Posts Available</h3>
                        <p>Check back soon for health tips and blog posts from our doctors.</p>
                    </div>
                </div>
                @endforelse
            </div>
            @if($posts->count() > 0)
            <div class="text-center mt-4">
                <a href="{{ route('posts.index') }}" class="btn-primary-nav">
                    View All Posts <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <img src="https://mydoctorr.com/images/apps/logo1762790479.webp" alt="MyDoctorr Logo" style="height: 50px; width: auto;">
                    </div>
                    <h3>MyDoctorr</h3>
                    <p>Your trusted platform for managing doctor appointments. We connect patients with qualified healthcare professionals.</p>
                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="#specialties"><i class="bi bi-chevron-right"></i> Specialties</a></li>
                        <li><a href="#doctors"><i class="bi bi-chevron-right"></i> Doctors</a></li>
                        <li><a href="#about"><i class="bi bi-chevron-right"></i> About Us</a></li>
                        <li><a href="#contact"><i class="bi bi-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Appointment Booking</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Doctor Search</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Medical Records</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Health Tips</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i> Emergency Care</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-geo-alt"></i> 123 Medical Street, Health City</a></li>
                        <li><a href="#"><i class="bi bi-telephone"></i> +1 234 567 8900</a></li>
                        <li><a href="#"><i class="bi bi-envelope"></i> info@dms.com</a></li>
                        <li><a href="#"><i class="bi bi-clock"></i> Mon - Sat: 8:00 AM - 8:00 PM</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MyDoctorr. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Back to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel"><i class="bi bi-box-arrow-in-right"></i> Login to Book Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <input type="hidden" name="redirect_to" id="loginRedirectTo" value="/book-appointment-redirect">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="login_email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="login_email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="login_password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="login_password" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <div class="text-center">
                            <p class="mb-0">Don't have an account? <a href="#" onclick="event.preventDefault(); closeLoginModal(); openRegisterModal();" class="text-primary">Register here</a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
            
    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel"><i class="bi bi-person-plus"></i> Register to Book Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf
                    <input type="hidden" name="redirect_to" id="registerRedirectTo" value="/book-appointment-redirect">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="register_name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="register_name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="register_email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="register_email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="register_password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="register_password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="register_password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="register_password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="register_role" class="form-label">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="register_role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="Patient" {{ old('role') == 'Patient' ? 'selected' : 'selected' }}>Patient</option>
                                    <option value="Doctor" {{ old('role') == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="register_phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="register_phone" name="phone" value="{{ old('phone') }}" autocomplete="phone">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="register_date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="register_date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="register_address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="register_address" name="address" rows="2">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="mb-0">Already have an account? <a href="#" onclick="event.preventDefault(); closeRegisterModal(); openLoginModal();" class="text-primary">Login here</a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Appointment Booking Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel"><i class="bi bi-calendar-plus"></i> Book Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('appointments.store') }}" method="POST" id="appointmentForm">
                    @csrf
                    <input type="hidden" name="doctor_id" id="appointment_doctor_id" value="">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Doctor</label>
                            <p class="form-control-plaintext fw-bold" id="appointment_doctor_name"></p>
                        </div>
                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">Date</label>
                            <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" id="appointment_date" name="appointment_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            @error('appointment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="appointment_time" class="form-label">Time</label>
                            <input type="time" class="form-control @error('appointment_time') is-invalid @enderror" id="appointment_time" name="appointment_time" required>
                            @error('appointment_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="appointment_notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="appointment_notes" name="notes" rows="3" placeholder="Any additional information..."></textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Book Appointment</button>
                    </div>
                </form>
                </div>
        </div>
    </div>

    <script>
        // Mobile Menu Toggle
        const navbarToggle = document.getElementById('navbarToggle');
        const navbarNav = document.getElementById('navbarNav');
        const menuOverlay = document.getElementById('menuOverlay');
        const menuIcon = document.getElementById('menuIcon');

        function toggleMobileMenu() {
            navbarNav.classList.toggle('active');
            menuOverlay.classList.toggle('active');
            if (navbarNav.classList.contains('active')) {
                menuIcon.classList.remove('bi-list');
                menuIcon.classList.add('bi-x-lg');
                document.body.style.overflow = 'hidden';
            } else {
                menuIcon.classList.remove('bi-x-lg');
                menuIcon.classList.add('bi-list');
                document.body.style.overflow = '';
            }
        }

        function closeMobileMenu() {
            navbarNav.classList.remove('active');
            menuOverlay.classList.remove('active');
            menuIcon.classList.remove('bi-x-lg');
            menuIcon.classList.add('bi-list');
            document.body.style.overflow = '';
        }

        if (navbarToggle) {
            navbarToggle.addEventListener('click', toggleMobileMenu);
        }

        if (menuOverlay) {
            menuOverlay.addEventListener('click', closeMobileMenu);
        }

        // Close menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeMobileMenu();
            }
        });

        // Carousel functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));
            
            if (index >= slides.length) currentSlideIndex = 0;
            if (index < 0) currentSlideIndex = slides.length - 1;
            
            slides[currentSlideIndex].classList.add('active');
            indicators[currentSlideIndex].classList.add('active');
        }

        function currentSlide(index) {
            currentSlideIndex = index - 1;
            showSlide(currentSlideIndex);
        }

        function nextSlide() {
            currentSlideIndex++;
            showSlide(currentSlideIndex);
        }

        // Auto-advance carousel
        setInterval(nextSlide, 5000);

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            const backToTop = document.getElementById('backToTop');
            
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Show/hide back to top button
            if (backToTop) {
                if (window.scrollY > 300) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            }
        });

        // Back to top functionality
        const backToTopBtn = document.getElementById('backToTop');
        if (backToTopBtn) {
            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#home') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const offsetTop = target.offsetTop - 80;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Store doctor ID in session when booking
        let selectedDoctorId = null;
        let selectedDoctorName = null;

        function handleBookAppointment(doctorId) {
            selectedDoctorId = doctorId;
            // Store doctor ID in session via AJAX
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                console.error('CSRF token not found');
                openLoginModal();
                return;
            }
            
            fetch(`/book-appointment/${doctorId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Show login modal
                openLoginModal();
            })
            .catch(error => {
                console.error('Error:', error);
                // Still show login modal even if AJAX fails
                openLoginModal();
            });
        }

        function openLoginModal() {
            const loginModalElement = document.getElementById('loginModal');
            if (loginModalElement) {
                const loginModal = new bootstrap.Modal(loginModalElement);
                loginModal.show();
            }
        }

        function closeLoginModal() {
            const loginModalElement = document.getElementById('loginModal');
            if (loginModalElement) {
                const loginModal = bootstrap.Modal.getInstance(loginModalElement);
                if (loginModal) {
                    loginModal.hide();
                }
            }
        }

        function openRegisterModal() {
            const registerModalElement = document.getElementById('registerModal');
            if (registerModalElement) {
                const registerModal = new bootstrap.Modal(registerModalElement);
                registerModal.show();
            }
        }

        function closeRegisterModal() {
            const registerModalElement = document.getElementById('registerModal');
            if (registerModalElement) {
                const registerModal = bootstrap.Modal.getInstance(registerModalElement);
                if (registerModal) {
                    registerModal.hide();
                }
            }
        }

        function openAppointmentModal(doctorId, doctorName) {
            selectedDoctorId = doctorId;
            selectedDoctorName = doctorName;
            const appointmentModalElement = document.getElementById('appointmentModal');
            if (appointmentModalElement) {
                document.getElementById('appointment_doctor_id').value = doctorId;
                document.getElementById('appointment_doctor_name').textContent = doctorName;
                const appointmentModal = new bootstrap.Modal(appointmentModalElement);
                appointmentModal.show();
            }
        }

        // Check if user just logged in/registered and should book appointment
        @if(session('booking_doctor_id') && session('open_booking_modal'))
            @php
                $doctor = \App\Models\Doctor::with('user')->find(session('booking_doctor_id'));
            @endphp
            @if($doctor && auth()->check() && auth()->user()->isPatient())
                window.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        openAppointmentModal({{ $doctor->id }}, '{{ addslashes($doctor->user->name) }}');
                    }, 500);
                });
                @php 
                    session()->forget('open_booking_modal');
                    session()->keep('booking_doctor_id');
                @endphp
            @endif
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
