{{-- resources/views/patient/prescriptions/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'My Prescriptions')
@section('page-title', 'My Prescriptions')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">My Prescriptions</h1>
                <p class="text-gray-600 mt-2">View and manage your medical prescriptions</p>
            </div>
        </div>
    </div>

    @if($prescriptions->count() > 0)
        <!-- Prescriptions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($prescriptions as $prescription)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md smooth-transition">
                    <div class="gradient-bg p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center">
                                    <i class="fas fa-file-medical text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Prescription</h3>
                                    <p class="text-xs text-indigo-100">{{ $prescription->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-1 bg-white/20 backdrop-blur rounded-full text-xs font-medium">
                                    {{ $prescription->appointment->appointment_date->format('M d') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Doctor Info -->
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-800 mb-1">Dr. {{ $prescription->doctor->user->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $prescription->doctor->specialization }}</p>
                        </div>

                        <!-- Appointment Details -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Appointment:</span> {{ $prescription->appointment->appointment_date->format('F d, Y') }} at {{ $prescription->appointment->appointment_time }}
                            </p>
                        </div>

                        <!-- Medicines Preview -->
                        @if($prescription->medicines && count($prescription->medicines) > 0)
                            <div class="mb-4">
                                <h5 class="font-medium text-gray-800 mb-2">Medicines:</h5>
                                <div class="space-y-1">
                                    @foreach(array_slice($prescription->medicines, 0, 2) as $medicine)
                                        <div class="text-sm text-gray-600">
                                            • {{ $medicine['name'] }} - {{ $medicine['dosage'] }}
                                        </div>
                                    @endforeach
                                    @if(count($prescription->medicines) > 2)
                                        <p class="text-sm text-gray-500">+{{ count($prescription->medicines) - 2 }} more medicines</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Action Button -->
                        <a href="{{ route('patient.prescriptions.show', $prescription) }}"
                           class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-indigo-700 smooth-transition flex items-center justify-center space-x-2 text-sm">
                            <i class="fas fa-eye"></i>
                            <span>View Details</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $prescriptions->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 text-4xl mx-auto mb-6">
                <i class="fas fa-file-medical"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">No Prescriptions Yet</h3>
            <p class="text-gray-600 mb-8">You haven't received any prescriptions yet. Book an appointment to get started.</p>
            <a href="{{ route('patient.appointments.create') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 smooth-transition">
                Book Appointment
            </a>
        </div>
    @endif
</div>
@endsection