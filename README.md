# Doctor Appointment Management System (DMS)

A full-featured Laravel application for managing doctor appointments with role-based access control.

## Features

- **Multi-role System**: Admin, Doctor, and Patient roles
- **Doctor Profile Management**: Doctors can create and edit their profiles with specialties
- **Patient Management**: Patients can search and book appointments with doctors
- **Admin Panel**: Full CRUD operations for users, doctors, specialties, and appointments
- **Specialty Filtering**: Filter doctors by medical specialty
- **Bootstrap UI**: Modern, responsive Bootstrap-based user interface
- **Appointment Management**: Book, confirm, cancel, and track appointments

## Requirements

- PHP >= 8.2
- MySQL
- Composer
- Node.js and NPM (for frontend assets)

## Installation

1. **Clone or navigate to the project directory**
   ```bash
   cd dms
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies and compile assets**
   ```bash
   npm install
   npm run dev
   ```

4. **Configure environment**
   - Update `.env` file with your database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=dms
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

5. **Create the database**
   ```sql
   CREATE DATABASE dms;
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## Default Admin Account

After running the seeder, you can login with:
- **Email**: admin@dms.com
- **Password**: password

## User Roles

### Admin
- Full CRUD operations on users, doctors, specialties, and appointments
- Access to admin dashboard with statistics
- Manage all system entities

### Doctor
- Create and edit doctor profile
- View and manage appointments
- Update appointment status (pending, confirmed, cancelled, completed)
- View dashboard with appointment statistics

### Patient
- Edit personal profile
- Search and filter doctors by specialty
- Book appointments with doctors
- View and cancel own appointments
- View dashboard with appointment history

## Database Structure

### Tables
- **users**: User accounts with role field (Admin, Patient, Doctor)
- **specialties**: Medical specialties
- **doctors**: Doctor profiles linked to users and specialties
- **appointments**: Appointment records linking patients and doctors

## Routes

### Public Routes
- `/` - Welcome page
- `/specialties` - List all specialties
- `/specialties/{id}` - View doctors in a specialty

### Admin Routes (requires Admin role)
- `/admin/dashboard` - Admin dashboard
- `/admin/users` - User management
- `/admin/doctors` - Doctor management
- `/admin/specialties` - Specialty management
- `/admin/appointments` - Appointment management

### Doctor Routes (requires Doctor role)
- `/doctor/dashboard` - Doctor dashboard
- `/doctor/profile` - View/Edit doctor profile
- `/doctor/appointments` - Manage appointments

### Patient Routes (requires Patient role)
- `/patient/dashboard` - Patient dashboard
- `/patient/profile` - Edit profile
- `/patient/doctors` - Find and book doctors
- `/patient/appointments` - View appointments

## Usage

1. **Register a new account** - Choose your role (Patient or Doctor)
2. **Doctors**: Create your profile with specialty, license number, experience, and consultation fee
3. **Patients**: Search for doctors, filter by specialty, and book appointments
4. **Admins**: Manage all users, doctors, specialties, and appointments from the admin panel

## Specialties

The system comes pre-seeded with the following specialties:
- Cardiology
- Dermatology
- Neurology
- Orthopedics
- Pediatrics
- Psychiatry
- General Medicine
- Gynecology

## Notes

- Appointment time slots are validated to prevent double-booking
- Only future dates can be selected for appointments
- Doctors can update appointment statuses
- Patients can cancel their own appointments
- Admins have full control over all entities

## License

This project is open-sourced software licensed under the MIT license.
