@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-gray-500 text-sm font-medium truncate">Total Doctors</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_doctors'] ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0 ml-4">
                    <i class="fas fa-user-md text-blue-600 text-xl sm:text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-gray-500 text-sm font-medium truncate">Total Patients</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_patients'] ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0 ml-4">
                    <i class="fas fa-users text-green-600 text-xl sm:text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-gray-500 text-sm font-medium truncate">Total Appointments</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_appointments'] ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0 ml-4">
                    <i class="fas fa-calendar-alt text-purple-600 text-xl sm:text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-gray-500 text-sm font-medium truncate">Pending</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 mt-2">{{ $stats['pending_appointments'] ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0 ml-4">
                    <i class="fas fa-hourglass-half text-yellow-600 text-xl sm:text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

<!-- Recent Appointments Table -->
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Recent Appointments</h3>
        <a href="{{ route('admin.appointments.index') }}" class="text-indigo-600 text-sm hover:text-indigo-800 font-medium">View All</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Patient</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Doctor</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Date</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Time</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Status</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recent_appointments as $appointment)
                <tr class="hover:bg-gray-50 smooth-transition">
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $appointment->patient->name }}</p>
                                <p class="text-sm text-gray-500">{{ $appointment->appointment_number }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user-md text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Dr. {{ $appointment->doctor->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $appointment->doctor->specialization }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <p class="font-medium text-gray-800">{{ $appointment->appointment_date->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment->appointment_date->format('l') }}</p>
                    </td>
                    <td class="py-3 px-4">
                        <p class="font-medium text-gray-800">{{ date('g:i A', strtotime($appointment->appointment_time)) }}</p>
                    </td>
                    <td class="py-3 px-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($appointment->status === 'approved') bg-green-100 text-green-800
                            @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                            @elseif($appointment->status === 'cancelled') bg-gray-100 text-gray-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <a href="{{ route('admin.appointments.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            View Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="hover:bg-gray-50 smooth-transition">
                    <td colspan="6" class="text-center py-8 text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-3 opacity-40"></i>
                        <p>No appointments to display</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection