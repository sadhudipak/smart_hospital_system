{{-- resources/views/patient/dashboard.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Patient Dashboard')
@section('page-title', 'My Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="gradient-bg rounded-xl p-6 mb-8 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h2>
            <p class="text-indigo-100 mt-1">Here's your health overview</p>
        </div>
        <a href="{{ route('patient.appointments.create') }}" class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-medium hover:bg-indigo-50 transition">
            <i class="fas fa-plus mr-2"></i>Book Appointment
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Appointments</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_appointments'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Upcoming</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['upcoming_appointments'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pending Approval</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['pending_appointments'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Prescriptions</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_prescriptions'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-prescription text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Upcoming Appointments -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Upcoming Appointments</h3>
            <a href="{{ route('patient.appointments.index') }}" class="text-indigo-600 text-sm hover:text-indigo-800">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($upcoming_appointments as $appointment)
                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                    <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center text-white mr-4">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-800">Dr. {{ $appointment->doctor->user->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $appointment->doctor->specialization }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium text-gray-800">{{ $appointment->appointment_date->format('M d') }}</p>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                    </div>
                    <span class="ml-4 px-3 py-1 rounded-full text-xs font-medium 
                        {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-calendar-times text-4xl mb-3"></i>
                    <p>No upcoming appointments</p>
                    <a href="{{ route('patient.appointments.create') }}" class="text-indigo-600 text-sm mt-2 inline-block">Book one now</a>
                </div>
            @endforelse
        </div>
    </div>
    
    <!-- Recent Prescriptions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Recent Prescriptions</h3>
            <a href="{{ route('patient.prescriptions.index') }}" class="text-indigo-600 text-sm hover:text-indigo-800">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($recent_prescriptions as $prescription)
                <a href="{{ route('patient.prescriptions.show', $prescription) }}" class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $prescription->diagnosis }}</h4>
                            <p class="text-sm text-gray-500">Dr. {{ $prescription->doctor->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">{{ $prescription->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-indigo-600">{{ count($prescription->medicines) }} medicines</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-file-medical text-4xl mb-3"></i>
                    <p>No prescriptions yet</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
