{{-- resources/views/admin/reports.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Appointment Reports')
@section('page-title', 'Appointment Reports')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Appointment Reports</h2>
                <p class="text-gray-600 mt-1">Comprehensive statistics and analytics for appointments</p>
            </div>
            <a href="{{ route('admin.appointments.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 smooth-transition">
                <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Appointments</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_appointments'] ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pending</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['pending_appointments'] ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hourglass-half text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Approved</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['approved_appointments'] ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md smooth-transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Completed</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['completed_appointments'] ?? 0 }}</h3>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-double text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Today's Appointments</h3>
            <div class="text-center">
                <div class="text-4xl font-bold text-indigo-600 mb-2">{{ $stats['today_appointments'] ?? 0 }}</div>
                <p class="text-gray-600">Appointments scheduled for today</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Rejected Appointments</h3>
            <div class="text-center">
                <div class="text-4xl font-bold text-red-600 mb-2">{{ $stats['rejected_appointments'] ?? 0 }}</div>
                <p class="text-gray-600">Appointments that were rejected</p>
            </div>
        </div>
    </div>

    <!-- Monthly Statistics Chart Placeholder -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Appointments Trend</h3>
        <div class="bg-gray-50 rounded-lg p-8 text-center">
            <i class="fas fa-chart-line text-4xl text-gray-400 mb-4"></i>
            <h4 class="text-lg font-medium text-gray-600 mb-2">Chart Visualization</h4>
            <p class="text-gray-500">Monthly appointment statistics for {{ date('Y') }}</p>

            @if($monthly_stats->count() > 0)
                <div class="mt-6 grid grid-cols-1 md:grid-cols-6 gap-4">
                    @foreach($monthly_stats as $stat)
                        <div class="text-center">
                            <div class="text-2xl font-bold text-indigo-600">{{ $stat->count }}</div>
                            <div class="text-sm text-gray-500">{{ date('M', mktime(0, 0, 0, $stat->month, 1)) }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mt-4">No appointment data available for this year yet.</p>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.appointments.index') }}"
               class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 smooth-transition">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-list text-indigo-600"></i>
                </div>
                <div>
                    <h4 class="font-medium text-gray-800">View All Appointments</h4>
                    <p class="text-sm text-gray-500">Manage all appointments</p>
                </div>
            </a>

            <a href="{{ route('admin.patients.index') }}"
               class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 smooth-transition">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-users text-green-600"></i>
                </div>
                <div>
                    <h4 class="font-medium text-gray-800">Manage Patients</h4>
                    <p class="text-sm text-gray-500">View patient records</p>
                </div>
            </a>

            <a href="{{ route('admin.doctors.index') }}"
               class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 smooth-transition">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-user-md text-blue-600"></i>
                </div>
                <div>
                    <h4 class="font-medium text-gray-800">Manage Doctors</h4>
                    <p class="text-sm text-gray-500">View doctor profiles</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection