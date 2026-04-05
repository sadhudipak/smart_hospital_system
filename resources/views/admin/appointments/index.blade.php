{{-- resources/views/admin/appointments/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Appointments Management')
@section('page-title', 'Appointments Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">All Appointments</h2>
                <p class="text-gray-600 mt-1">Manage and monitor all patient appointments</p>
            </div>
            <a href="{{ route('admin.reports') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 smooth-transition">
                <i class="fas fa-chart-bar mr-2"></i>View Reports
            </a>
        </div>
    </div>

    <!-- Appointments Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Appointments List</h3>
        </div>

        <div class="overflow-x-auto">
            @if($appointments->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700 text-sm">Appointment #</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700 text-sm">Patient</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700 text-sm">Doctor</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700 text-sm">Date & Time</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700 text-sm">Status</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700 text-sm">Symptoms</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700 text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($appointments as $appointment)
                        <tr class="hover:bg-gray-50 smooth-transition">
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $appointment->appointment_number }}</p>
                                    <p class="text-sm text-gray-500">{{ $appointment->created_at->format('M d, Y') }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $appointment->patient->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $appointment->patient->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user-md text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Dr. {{ $appointment->doctor->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $appointment->doctor->specialization }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $appointment->appointment_date->format('M d, Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ date('g:i A', strtotime($appointment->appointment_time)) }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($appointment->status === 'approved') bg-green-100 text-green-800
                                    @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                    @elseif($appointment->status === 'cancelled') bg-gray-100 text-gray-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm text-gray-700 max-w-xs truncate">{{ $appointment->symptoms ?: 'No symptoms provided' }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <button onclick="showAppointmentDetails({{ $appointment->id }})"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $appointments->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-6">
                        <i class="fas fa-calendar-times text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No Appointments Found</h3>
                    <p class="text-gray-600 mb-6">There are no appointments in the system yet.</p>
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 smooth-transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Appointment Details Modal -->
<div id="appointmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Appointment Details</h3>
                <button onclick="closeAppointmentModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="appointmentDetails" class="space-y-4">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function showAppointmentDetails(appointmentId) {
    // For now, just redirect to the appointment details
    // In a real app, you might load details via AJAX
    window.location.href = '/admin/appointments/' + appointmentId;
}

function closeAppointmentModal() {
    document.getElementById('appointmentModal').classList.add('hidden');
}
</script>
@endsection