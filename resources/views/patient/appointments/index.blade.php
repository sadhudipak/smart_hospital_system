{{-- resources/views/patient/appointments/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')

@section('content')
<div class="space-y-6">
    <!-- Header with Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">My Appointments</h2>
                <p class="text-gray-600 mt-1">Manage your upcoming and past appointments</p>
            </div>
            <a href="{{ route('patient.appointments.create') }}"
               class="inline-flex items-center px-4 py-2 gradient-bg text-white rounded-lg font-medium hover:shadow-lg smooth-transition">
                <i class="fas fa-plus mr-2"></i>Book New Appointment
            </a>
        </div>

        <!-- Filters -->
        <div class="mt-6 flex flex-wrap gap-4">
            <div class="flex-1 min-w-0">
                <form method="GET" class="flex gap-4">
                    <select name="status" onchange="this.form.submit()"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- Appointments List -->
    @if($appointments->count() > 0)
        <div class="space-y-4">
            @foreach($appointments as $appointment)
                <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md smooth-transition">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                        <!-- Appointment Info -->
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white flex-shrink-0">
                                    <i class="fas fa-user-md text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                        <h3 class="font-semibold text-gray-800">Dr. {{ $appointment->doctor->user->name }}</h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($appointment->status === 'approved') bg-green-100 text-green-800
                                            @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status === 'cancelled') bg-gray-100 text-gray-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1">{{ $appointment->doctor->specialization }}</p>
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar mr-2 text-indigo-500"></i>
                                            {{ $appointment->appointment_date->format('M d, Y') }}
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-clock mr-2 text-indigo-500"></i>
                                            {{ date('g:i A', strtotime($appointment->appointment_time)) }}
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-hashtag mr-2 text-indigo-500"></i>
                                            {{ $appointment->appointment_number }}
                                        </div>
                                    </div>
                                    @if($appointment->symptoms)
                                        <p class="text-sm text-gray-600 mt-2">
                                            <strong>Symptoms:</strong> {{ Str::limit($appointment->symptoms, 100) }}
                                        </p>
                                    @endif
                                    @if($appointment->doctor_note)
                                        <p class="text-sm text-gray-600 mt-1">
                                            <strong>Doctor Note:</strong> {{ Str::limit($appointment->doctor_note, 100) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row gap-2 lg:flex-shrink-0">
                            <a href="{{ route('patient.appointments.show', $appointment) }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 smooth-transition">
                                <i class="fas fa-eye mr-2"></i>View Details
                            </a>

                            @if($appointment->status === 'pending')
                                <form method="POST" action="{{ route('patient.appointments.destroy', $appointment) }}"
                                      onsubmit="return confirm('Are you sure you want to cancel this appointment?')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 smooth-transition">
                                        <i class="fas fa-times mr-2"></i>Cancel
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
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $appointments->appends(request()->query())->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center text-white mx-auto mb-6">
                <i class="fas fa-calendar-times text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No Appointments Found</h3>
            <p class="text-gray-600 mb-6">You haven't booked any appointments yet. Start by booking your first appointment.</p>
            <a href="{{ route('patient.appointments.create') }}"
               class="inline-flex items-center px-6 py-3 gradient-bg text-white rounded-lg font-medium hover:shadow-lg smooth-transition">
                <i class="fas fa-plus mr-2"></i>Book Your First Appointment
            </a>
        </div>
    @endif
</div>
@endsection