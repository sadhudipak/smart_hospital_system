{{-- resources/views/admin/patients/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Manage Patients')
@section('page-title', 'Patients Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Patients Management</h1>
                <p class="text-gray-600 mt-2">Manage patient profiles and information</p>
            </div>
        </div>
    </div>

    <!-- Patients Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Appointments</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prescriptions</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($patients as $patient)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center text-white font-bold mr-3">
                                        {{ substr($patient->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $patient->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $patient->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $patient->phone ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $patient->gender ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $patient->appointments->count() }} total
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    {{ $patient->prescriptions->count() }} total
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($patient->is_active)
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.patients.show', $patient) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    <p>No patients found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($patients->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $patients->links() }}
            </div>
        @endif
    </div>
</div>
@endsection