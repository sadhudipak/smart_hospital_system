{{-- resources/views/doctor/appointments/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header with Filters -->
    <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800">My Appointments</h2>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Manage your patient appointments</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row gap-4">
            <div class="flex-1 min-w-0">
                <form method="GET" class="flex flex-col sm:flex-row gap-4">
                    <select name="status" onchange="this.form.submit()"
                            class="px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm sm:text-base">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>

                    <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                           class="px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm sm:text-base">
                </form>
            </div>
        </div>
    </div>

    <!-- Appointments List -->
    @if($appointments->count() > 0)
        <div class="space-y-4">
            @foreach($appointments as $appointment)
                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 hover:shadow-md smooth-transition">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                        <!-- Appointment Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start gap-3 sm:gap-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <i class="fas fa-user text-base sm:text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                        <h3 class="font-semibold text-gray-800 truncate text-sm sm:text-base">{{ $appointment->patient->name }}</h3>
                                        <span class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-0.5 rounded-full text-xs font-medium whitespace-nowrap
                                            @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status === 'approved') bg-green-100 text-green-800
                                            @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status === 'cancelled') bg-gray-100 text-gray-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 text-xs sm:text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar mr-1 sm:mr-2 text-indigo-500"></i>
                                            <span class="truncate">{{ $appointment->appointment_date->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-clock mr-1 sm:mr-2 text-indigo-500"></i>
                                            <span>{{ date('g:i A', strtotime($appointment->appointment_time)) }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-hashtag mr-1 sm:mr-2 text-indigo-500"></i>
                                            <span class="truncate">{{ $appointment->appointment_number }}</span>
                                        </div>
                                    </div>
                                    @if($appointment->symptoms)
                                        <p class="text-xs sm:text-sm text-gray-600 mt-2 line-clamp-2">
                                            <strong>Symptoms:</strong> {{ Str::limit($appointment->symptoms, 100) }}
                                        </p>
                                    @endif
                                    @if($appointment->patient_note)
                                        <p class="text-xs sm:text-sm text-gray-600 mt-1 line-clamp-2">
                                            <strong>Patient Note:</strong> {{ Str::limit($appointment->patient_note, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row gap-2 lg:flex-shrink-0 min-w-0">
                            @if($appointment->status === 'pending')
                                <form method="POST" action="{{ route('doctor.appointments.approve', $appointment) }}" class="inline-block w-full sm:w-auto">
                                    @csrf
                                    <button type="submit"
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-3 sm:px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 smooth-transition text-sm">
                                        <i class="fas fa-check mr-1 sm:mr-2"></i><span class="hidden xs:inline">Approve</span>
                                    </button>
                                </form>

                                <button type="button" onclick="rejectAppointment({{ $appointment->id }})"
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-3 sm:px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 smooth-transition text-sm">
                                    <i class="fas fa-times mr-1 sm:mr-2"></i><span class="hidden xs:inline">Reject</span>
                                </button>
                            @elseif($appointment->status === 'approved')
                                <form method="POST" action="{{ route('doctor.appointments.complete', $appointment) }}" class="inline-block w-full sm:w-auto">
                                    @csrf
                                    <button type="submit"
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-3 sm:px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 smooth-transition text-sm">
                                        <i class="fas fa-check-circle mr-1 sm:mr-2"></i><span class="hidden xs:inline">Complete</span>
                                    </button>
                                </form>
                            @endif

                            @if($appointment->prescription)
                                <a href="{{ route('doctor.prescriptions.show', $appointment->prescription) }}"
                                   class="w-full sm:w-auto inline-flex items-center justify-center px-3 sm:px-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 smooth-transition text-sm">
                                    <i class="fas fa-file-medical mr-1 sm:mr-2"></i><span class="hidden xs:inline">View</span>
                                </a>
                            @else
                                <a href="{{ route('doctor.prescriptions.create', ['appointment' => $appointment->id]) }}"
                                   class="w-full sm:w-auto inline-flex items-center justify-center px-3 sm:px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 smooth-transition text-sm">
                                    <i class="fas fa-plus mr-1 sm:mr-2"></i><span class="hidden xs:inline">Create</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $appointments->appends(request()->query())->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-6">
                <i class="fas fa-calendar-times text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No Appointments Found</h3>
            <p class="text-gray-600 mb-6">You don't have any appointments scheduled for the selected criteria.</p>
            <button onclick="window.location.reload()"
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 smooth-transition">
                <i class="fas fa-refresh mr-2"></i>Refresh
            </button>
        </div>
    @endif
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Appointment</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for rejection</label>
                    <textarea name="reason" rows="3" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                              placeholder="Please provide a reason for rejecting this appointment..."></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeRejectModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Reject Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function rejectAppointment(appointmentId) {
    document.getElementById('rejectForm').action = `/doctor/appointments/${appointmentId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectForm').reset();
}
</script>
@endsection