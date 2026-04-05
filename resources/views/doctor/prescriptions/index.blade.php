{{-- resources/views/doctor/prescriptions/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'My Prescriptions')
@section('page-title', 'My Prescriptions')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">My Prescriptions</h2>
            <p class="text-gray-600">View and manage prescriptions you've created</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('doctor.appointments.index') }}"
               class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                <i class="fas fa-calendar-alt mr-2"></i>View Appointments
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="bg-blue-100 rounded-lg p-3">
                    <i class="fas fa-prescription-bottle text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Prescriptions</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $prescriptions->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="bg-green-100 rounded-lg p-3">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Completed Appointments</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $prescriptions->where('appointment.status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="bg-yellow-100 rounded-lg p-3">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $prescriptions->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Prescriptions Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        @if($prescriptions->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Appointment Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnosis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medicines</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($prescriptions as $prescription)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $prescription->appointment->patient->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $prescription->appointment->patient->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $prescription->appointment->appointment_date->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ date('g:i A', strtotime($prescription->appointment->appointment_time)) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $prescription->diagnosis }}">
                                        {{ Str::limit($prescription->diagnosis, 50) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ count($prescription->medicines ?? []) }} medicines
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($prescription->appointment->status === 'completed') bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        @if($prescription->appointment->status === 'completed')
                                            <i class="fas fa-check-circle mr-1"></i>Completed
                                        @else
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $prescription->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('doctor.prescriptions.show', $prescription) }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <button onclick="printPrescription({{ $prescription->id }})"
                                                class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($prescriptions->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $prescriptions->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="mx-auto h-24 w-24 text-gray-400">
                    <i class="fas fa-prescription-bottle text-6xl"></i>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No prescriptions yet</h3>
                <p class="mt-2 text-sm text-gray-500">
                    You haven't created any prescriptions yet. Prescriptions are created after completing appointments.
                </p>
                <div class="mt-6">
                    <a href="{{ route('doctor.appointments.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white gradient-bg hover:shadow-lg">
                        <i class="fas fa-calendar-alt mr-2"></i>View Appointments
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function printPrescription(prescriptionId) {
    // Open prescription in new window for printing
    const printWindow = window.open(`/doctor/prescriptions/${prescriptionId}?print=1`, '_blank');
    printWindow.onload = function() {
        printWindow.print();
    };
}
</script>
@endsection