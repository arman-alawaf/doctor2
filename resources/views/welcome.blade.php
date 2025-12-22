<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DMS - Doctor Management System</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
            <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        .welcome-container {
            max-width: 1200px;
            width: 100%;
            padding: 0 1rem;
        }
        .welcome-card {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .welcome-hero {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 4rem 3rem;
            text-align: center;
        }
        .welcome-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }
        .welcome-icon i {
            font-size: 4rem;
            color: white;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .welcome-title {
            font-size: 3rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }
        .welcome-subtitle {
            font-size: 1.25rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }
        .welcome-features {
            padding: 3rem;
            background: white;
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            background: #f9fafb;
            transform: translateX(5px);
        }
        .feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .welcome-actions {
            padding: 2rem 3rem;
            background: #f9fafb;
            text-align: center;
        }
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }
            .welcome-hero {
                padding: 2rem 1.5rem;
            }
            .welcome-features {
                padding: 2rem 1.5rem;
            }
            .welcome-actions {
                padding: 2rem 1.5rem;
            }
        }
            </style>
    </head>
<body>
    <div class="welcome-container">
        <div class="welcome-card">
            <div class="welcome-hero">
                <div class="welcome-icon">
                    <i class="bi bi-hospital"></i>
                </div>
                <h1 class="welcome-title">Doctor Management System</h1>
                <p class="welcome-subtitle">
                    Your trusted platform for managing doctor appointments.<br>
                    Book appointments, manage schedules, and connect with healthcare professionals.
                </p>
            </div>
            
            <div class="welcome-features">
                <h3 class="mb-4 fw-bold">Key Features</h3>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Easy Appointment Booking</h5>
                        <p class="text-muted mb-0">Book appointments with qualified doctors in just a few clicks</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Find by Specialty</h5>
                        <p class="text-muted mb-0">Search and filter doctors by medical specialty</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Verified Doctors</h5>
                        <p class="text-muted mb-0">All doctors are verified professionals with proper credentials</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Secure Platform</h5>
                        <p class="text-muted mb-0">Your data is protected with industry-standard security</p>
                    </div>
                </div>
            </div>
            
            <div class="welcome-actions">
            @if (Route::has('login'))
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                    @auth
                            <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-speedometer2"></i> Go to Dashboard
                        </a>
                    @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-person-plus"></i> Register
                                </a>
                            @endif
                        @endauth
                </div>
                @endif
                </div>
        </div>
    </div>
    </body>
</html>
