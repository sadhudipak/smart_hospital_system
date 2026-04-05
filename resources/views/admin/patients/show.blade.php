{{-- resources/views/admin/patients/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Patient Details')
@section('page-title', 'Patient Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Patient Details</h1>
                <p class="text-gray-600 mt-2">View patient profile and medical history</p>
            </div>
            <a href="{{ route('admin.patients.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 smooth-transition flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Patients</span>
            </a>
        </div>
    </div>

    <!-- Patient Profile -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Profile Header -->
        <div class="gradient-bg p-8 text-white">
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold">
                    {{ substr($patient->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold">{{ $patient->name }}</h2>
                    <p class="text-indigo-100 text-lg">{{ $patient->email }}</p>
                    <p class="text-indigo-200">{{ $patient->phone ?? 'No phone number' }}</p>
                    @if($patient->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mt-2">
                            <i class="fas fa-circle text-green-400 mr-2"></i>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 mt-2">
                            <i class="fas fa-circle text-red-400 mr-2"></i>
                            Inactive
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- Personal Information -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
                        <p class="text-gray-800 font-medium">{{ $patient->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Email Address</label>
                        <p class="text-gray-800 font-medium">{{ $patient->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Phone Number</label>
                        <p class="text-gray-800 font-medium">{{ $patient->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Gender</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($patient->gender ?? 'Not specified') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Date of Birth</label>
                        <p class="text-gray-800 font-medium">{{ $patient->date_of_birth ? $patient->date_of_birth->format('F d, Y') : 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Medical Statistics</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border border-blue-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white mr-4">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-blue-800">{{ $stats['total_appointments'] }}</p>
                                <p class="text-sm text-blue-600">Total Appointments</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 border border-green-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white mr-4">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-green-800">{{ $stats['completed_appointments'] }}</p>
                                <p class="text-sm text-green-600">Completed</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-6 border border-yellow-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center text-white mr-4">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-yellow-800">{{ $stats['pending_appointments'] }}</p>
                                <p class="text-sm text-yellow-600">Pending</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 border border-purple-200">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center text-white mr-4">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-purple-800">{{ $stats['total_prescriptions'] }}</p>
                                <p class="text-sm text-purple-600">Prescriptions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Appointments -->
            @if($patient->appointments->count() > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Recent Appointments</h3>
                    <div class="space-y-4">
                        @foreach($patient->appointments->take(5) as $appointment)
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{ $appointment->doctor->user->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $appointment->appointment_date->format('F d, Y') }} at {{ $appointment->appointment_time }}</p>
                                        <p class="text-sm text-gray-500">{{ $appointment->symptoms }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($appointment->status === 'completed') bg-green-100 text-green-800
                                        @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($appointment->status === 'approved') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Recent Prescriptions -->
            @if($patient->prescriptions->count() > 0)
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Recent Prescriptions</h3>
                    <div class="space-y-4">
                        @foreach($patient->prescriptions->take(5) as $prescription)
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Dr. {{ $prescription->doctor->user->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $prescription->created_at->format('F d, Y') }}</p>
                                    </div>
                                    <a href="{{ route('admin.prescriptions.show', $prescription) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        View Details →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection