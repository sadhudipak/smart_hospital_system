{{-- resources/views/doctor/dashboard.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Doctor Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Today's Appointments</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['today_appointments'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-day text-blue-600 text-xl"></i>
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
                <p class="text-gray-500 text-sm">Total Appointments</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_appointments'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-check text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Completed</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['completed_appointments'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-check-circle text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Today's Schedule -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Today's Schedule</h3>
        <div class="space-y-4">
            @forelse($today_appointments as $appointment)
                <div class="flex items-center p-4 border rounded-lg {{ $appointment->isApproved() ? 'border-green-200 bg-green-50' : 'border-yellow-200 bg-yellow-50' }}">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center mr-4 shadow-sm">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-800">{{ $appointment->patient->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $appointment->symptoms }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                        <span class="text-xs px-2 py-1 rounded-full {{ $appointment->isApproved() ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-calendar-times text-4xl mb-3"></i>
                    <p>No appointments scheduled for today</p>
                </div>
            @endforelse
        </div>
    </div>
    
    <!-- Pending Approvals -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Pending Approvals</h3>
            <a href="{{ route('doctor.appointments.index') }}?status=pending" class="text-indigo-600 text-sm hover:text-indigo-800">View All</a>
        </div>
        <div class="space-y-4">
            @forelse($pending_appointments as $appointment)
                <div class="p-4 border border-yellow-200 bg-yellow-50 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $appointment->patient->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $appointment->appointment_date->format('M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($appointment->symptoms, 100) }}</p>
                    <div class="flex space-x-2">
                        <form action="{{ route('doctor.appointments.approve', $appointment) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600 transition">
                                <i class="fas fa-check mr-1"></i>Approve
                            </button>
                        </form>
                        <button onclick="document.getElementById('reject-{{ $appointment->id }}').classList.toggle('hidden')" 
                                class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600 transition">
                            <i class="fas fa-times mr-1"></i>Reject
                        </button>
                    </div>
                    <form id="reject-{{ $appointment->id }}" action="{{ route('doctor.appointments.reject', $appointment) }}" method="POST" class="hidden mt-3">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="reason" placeholder="Reason for rejection..." class="w-full px-3 py-2 border rounded-lg text-sm mb-2">
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm">Confirm Reject</button>
                    </form>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-check-circle text-4xl mb-3"></i>
                    <p>No pending approvals</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
