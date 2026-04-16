<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\PrescriptionController as AdminPrescriptionController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboard;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\PrescriptionController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboard;
use App\Http\Controllers\Patient\AppointmentController as PatientAppointmentController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors.list');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Doctor Management
    Route::resource('doctors', AdminDoctorController::class);
    
    // Patient Management
    Route::get('/patients', [AdminPatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{patient}', [AdminPatientController::class, 'show'])->name('patients.show');
    
    // Appointment Management
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/reports', [AdminAppointmentController::class, 'reports'])->name('reports');
    
    // Prescription Management
    Route::get('/prescriptions', [AdminPrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/{prescription}', [AdminPrescriptionController::class, 'show'])->name('prescriptions.show');
});

// Doctor Routes
Route::prefix('doctor')->name('doctor.')->middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/dashboard', [DoctorDashboard::class, 'index'])->name('dashboard');
    
    // Appointment Management
    Route::get('/appointments', [DoctorAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}/approve', [DoctorAppointmentController::class, 'approve'])->name('appointments.approve');
    Route::patch('/appointments/{appointment}/reject', [DoctorAppointmentController::class, 'reject'])->name('appointments.reject');
    Route::patch('/appointments/{appointment}/complete', [DoctorAppointmentController::class, 'complete'])->name('appointments.complete');
    
    // Prescriptions
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/create/{appointment}', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('/prescriptions/{prescription}', [PrescriptionController::class, 'show'])->name('prescriptions.show');
});

// Patient Routes
Route::prefix('patient')->name('patient.')->middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/dashboard', [PatientDashboard::class, 'index'])->name('dashboard');
    
    // Appointments
    Route::get('/appointments', [PatientAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [PatientAppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [PatientAppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [PatientAppointmentController::class, 'show'])->name('appointments.show');
    Route::delete('/appointments/{appointment}', [PatientAppointmentController::class, 'destroy'])->name('appointments.destroy');
    
    // Prescriptions
    Route::get('/prescriptions', [PatientAppointmentController::class, 'prescriptions'])->name('prescriptions.index');
    Route::get('/prescriptions/{prescription}', [PatientAppointmentController::class, 'showPrescription'])->name('prescriptions.show');
});
