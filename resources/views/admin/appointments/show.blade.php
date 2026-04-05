{{-- resources/views/admin/appointments/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Appointment Details')
@section('page-title', 'Appointment Details')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Appointment Details</h2>
                <p class="text-gray-500 mt-1">{{ $appointment->appointment_number }}</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($appointment->status === 'approved') bg-green-100 text-green-800
                @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                @elseif($appointment->status === 'cancelled') bg-gray-100 text-gray-800
                @else bg-red-100 text-red-800 @endif">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Patient Information</h3>
            <div class="space-y-3 text-sm text-gray-700">
                <p><strong>Name:</strong> {{ $appointment->patient->name }}</p>
                <p><strong>Email:</strong> {{ $appointment->patient->email }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($appointment->patient->gender ?? 'N/A') }}</p>
                <p><strong>Phone:</strong> {{ $appointment->patient->phone ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Doctor Information</h3>
            <div class="space-y-3 text-sm text-gray-700">
                <p><strong>Name:</strong> Dr. {{ $appointment->doctor->user->name }}</p>
                <p><strong>Specialization:</strong> {{ $appointment->doctor->specialization }}</p>
                <p><strong>Department:</strong> {{ $appointment->doctor->department->name }}</p>
                <p><strong>Experience:</strong> {{ $appointment->doctor->experience_years }} years</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Appointment Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
            <div>
                <p><strong>Date:</strong> {{ $appointment->appointment_date->format('l, F d, Y') }}</p>
                <p><strong>Time:</strong> {{ date('g:i A', strtotime($appointment->appointment_time)) }}</p>
                <p><strong>Booked on:</strong> {{ $appointment->created_at->format('M d, Y \a\t g:i A') }}</p>
            </div>
            <div>
                <p><strong>Symptoms:</strong></p>
                <p class="text-gray-600">{{ $appointment->symptoms ?: 'No symptoms provided' }}</p>
                <p class="mt-4"><strong>Patient Notes:</strong></p>
                <p class="text-gray-600">{{ $appointment->patient_note ?: 'No additional notes' }}</p>
            </div>
        </div>
    </div>

    @if($appointment->doctor_note)
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Doctor's Notes</h3>
            <p class="text-gray-700">{{ $appointment->doctor_note }}</p>
        </div>
    @endif

    @if($appointment->prescription)
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Prescription</h3>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="font-medium text-gray-800">Prescription #{{ $appointment->prescription->id }}</p>
                        <p class="text-sm text-gray-600">Issued on {{ $appointment->prescription->created_at->format('M d, Y') }}</p>
                    </div>
                    <a href="{{ route('patient.prescriptions.show', $appointment->prescription) }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 smooth-transition">
                        <i class="fas fa-eye mr-2"></i>View Prescription
                    </a>
                </div>
                <p class="text-sm text-gray-700"><strong>Diagnosis:</strong> {{ $appointment->prescription->diagnosis }}</p>
            </div>
        </div>
    @endif

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.appointments.index') }}"
           class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 smooth-transition">
            <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
        </a>
    </div>
</div>
@endsection