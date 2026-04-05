{{-- resources/views/patient/appointments/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Appointment Details')
@section('page-title', 'Appointment Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Appointment Header -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Appointment Details</h2>
                <p class="text-gray-600">{{ $appointment->appointment_number }}</p>
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Doctor Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-user-md text-indigo-600 mr-2"></i>Doctor Information
                </h3>
                <div class="space-y-2">
                    <p class="text-sm"><strong>Name:</strong> Dr. {{ $appointment->doctor->user->name }}</p>
                    <p class="text-sm"><strong>Specialization:</strong> {{ $appointment->doctor->specialization }}</p>
                    <p class="text-sm"><strong>Department:</strong> {{ $appointment->doctor->department->name }}</p>
                    <p class="text-sm"><strong>Experience:</strong> {{ $appointment->doctor->experience_years }} years</p>
                    <p class="text-sm"><strong>Consultation Fee:</strong> ₹{{ number_format($appointment->doctor->consultation_fee) }}</p>
                </div>
            </div>

            <!-- Appointment Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-calendar text-indigo-600 mr-2"></i>Appointment Information
                </h3>
                <div class="space-y-2">
                    <p class="text-sm"><strong>Date:</strong> {{ $appointment->appointment_date->format('l, F d, Y') }}</p>
                    <p class="text-sm"><strong>Time:</strong> {{ date('g:i A', strtotime($appointment->appointment_time)) }}</p>
                    <p class="text-sm"><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
                    <p class="text-sm"><strong>Booked on:</strong> {{ $appointment->created_at->format('M d, Y \a\t g:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Symptoms & Notes -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-notes-medical text-indigo-600 mr-2"></i>Medical Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Patient Symptoms -->
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Your Symptoms</h4>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700">{{ $appointment->symptoms ?: 'No symptoms provided' }}</p>
                </div>
            </div>

            <!-- Patient Notes -->
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Additional Notes</h4>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700">{{ $appointment->patient_note ?: 'No additional notes' }}</p>
                </div>
            </div>
        </div>

        @if($appointment->doctor_note)
            <div class="mt-6">
                <h4 class="font-medium text-gray-700 mb-2">Doctor's Notes</h4>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-gray-700">{{ $appointment->doctor_note }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Prescription -->
    @if($appointment->prescription)
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-file-medical text-green-600 mr-2"></i>Prescription
            </h3>

            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="font-medium text-gray-800">Prescription #{{ $appointment->prescription->id }}</p>
                        <p class="text-sm text-gray-600">Issued on {{ $appointment->prescription->created_at->format('M d, Y') }}</p>
                    </div>
                    <a href="{{ route('patient.prescriptions.show', $appointment->prescription) }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 smooth-transition">
                        <i class="fas fa-eye mr-2"></i>View Full Prescription
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600"><strong>Diagnosis:</strong></p>
                        <p class="text-sm">{{ $appointment->prescription->diagnosis ?: 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600"><strong>Instructions:</strong></p>
                        <p class="text-sm">{{ Str::limit($appointment->prescription->instructions, 100) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4">Actions</h3>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('patient.appointments.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 smooth-transition">
                <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
            </a>

            @if($appointment->status === 'pending')
                <form method="POST" action="{{ route('patient.appointments.destroy', $appointment) }}"
                      onsubmit="return confirm('Are you sure you want to cancel this appointment?')"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 smooth-transition">
                        <i class="fas fa-times mr-2"></i>Cancel Appointment
                    </button>
                </form>
            @endif

            @if($appointment->prescription)
                <a href="{{ route('patient.prescriptions.show', $appointment->prescription) }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 smooth-transition">
                    <i class="fas fa-file-medical mr-2"></i>View Prescription
                </a>
            @endif
        </div>
    </div>
</div>
@endsection