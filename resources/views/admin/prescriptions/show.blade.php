{{-- resources/views/admin/prescriptions/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'View Prescription')
@section('page-title', 'Prescription Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-8">
        <!-- Header -->
        <div class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Prescription Details</h2>
                <p class="text-gray-600">Prescription for {{ $prescription->patient->user->name }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.prescriptions.index') }}"
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Prescriptions
                </a>
                <button onclick="window.print()"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700">
                    <i class="fas fa-print mr-2"></i>Print
                </button>
            </div>
        </div>

        <!-- Prescription Header -->
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Prescription ID</h4>
                    <p class="text-lg font-semibold text-gray-800">#{{ $prescription->id }}</p>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Date Created</h4>
                    <p class="text-lg font-semibold text-gray-800">{{ $prescription->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Status</h4>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($prescription->appointment->status === 'completed') bg-green-100 text-green-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        @if($prescription->appointment->status === 'completed')
                            <i class="fas fa-check-circle mr-1"></i>Completed
                        @else
                            <i class="fas fa-clock mr-1"></i>Pending
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Patient & Doctor Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Patient Info -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user mr-2 text-indigo-600"></i>Patient Information
                </h3>
                <div class="space-y-2">
                    <p class="font-medium text-gray-800">{{ $prescription->patient->name }}</p>
                    <p class="text-sm text-gray-600">{{ $prescription->patient->email }}</p>
                    @if($prescription->patient->phone)
                        <p class="text-sm text-gray-600">{{ $prescription->patient->phone }}</p>
                    @endif
                    @if($prescription->patient->date_of_birth)
                        <p class="text-sm text-gray-600">DOB: {{ $prescription->patient->date_of_birth->format('M d, Y') }}</p>
                    @endif
                </div>
            </div>

            <!-- Doctor Info -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-md mr-2 text-indigo-600"></i>Doctor Information
                </h3>
                <div class="space-y-2">
                    <p class="font-medium text-gray-800">Dr. {{ $prescription->doctor->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $prescription->doctor->specialization }}</p>
                    <p class="text-sm text-gray-600">{{ $prescription->doctor->qualification }}</p>
                </div>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-calendar-alt mr-2 text-indigo-600"></i>Appointment Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Date: {{ $prescription->appointment->appointment_date->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-600">Time: {{ date('g:i A', strtotime($prescription->appointment->appointment_time)) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Symptoms: {{ $prescription->appointment->symptoms ?: 'Not specified' }}</p>
                </div>
            </div>
        </div>

        <!-- Diagnosis -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-red-800 mb-4 flex items-center">
                <i class="fas fa-stethoscope mr-2"></i>Diagnosis
            </h3>
            <p class="text-gray-800">{{ $prescription->diagnosis }}</p>
        </div>

        <!-- Medicines -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-pills mr-2 text-indigo-600"></i>Medicines
            </h3>

            @if($prescription->medicines && count($prescription->medicines) > 0)
                <div class="space-y-4">
                    @foreach($prescription->medicines as $index => $medicine)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="font-medium text-gray-800">Medicine {{ $index + 1 }}</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Name:</span>
                                    <p class="text-gray-800">{{ $medicine['name'] }}</p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Dosage:</span>
                                    <p class="text-gray-800">{{ $medicine['dosage'] }}</p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Duration:</span>
                                    <p class="text-gray-800">{{ $medicine['duration'] }}</p>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Instructions:</span>
                                    <p class="text-gray-800">{{ $medicine['instructions'] ?: 'None specified' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 italic">No medicines prescribed</p>
            @endif
        </div>

        <!-- Additional Information -->
        @if($prescription->advice || $prescription->next_visit)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>Additional Information
                </h3>

                @if($prescription->advice)
                    <div class="mb-4">
                        <h4 class="font-medium text-blue-800 mb-2">Doctor's Advice</h4>
                        <p class="text-gray-800">{{ $prescription->advice }}</p>
                    </div>
                @endif

                @if($prescription->next_visit)
                    <div>
                        <h4 class="font-medium text-blue-800 mb-2">Next Visit</h4>
                        <p class="text-gray-800">{{ $prescription->next_visit->format('M d, Y') }}</p>
                    </div>
                @endif
            </div>
        @endif

        <!-- Actions -->
        <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.prescriptions.index') }}"
               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                Back to Prescriptions
            </a>
            <button onclick="window.print()"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700">
                <i class="fas fa-print mr-2"></i>Print Prescription
            </button>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    body {
        font-size: 12px;
    }
    .bg-gradient-to-r, .bg-gray-50, .bg-red-50, .bg-blue-50 {
        background: white !important;
    }
    .border {
        border: 1px solid #e5e7eb !important;
    }
}
</style>
@endsection