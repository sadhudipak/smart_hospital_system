{{-- resources/views/admin/doctors/index.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Manage Doctors')
@section('page-title', 'Doctors Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Doctors Management</h1>
                <p class="text-gray-600 mt-2">Manage doctor profiles and information</p>
            </div>
            <a href="{{ route('admin.doctors.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 smooth-transition flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add New Doctor</span>
            </a>
        </div>
    </div>

    <!-- Doctors Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($doctors as $doctor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center text-white font-bold mr-3">
                                        {{ substr($doctor->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $doctor->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $doctor->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $doctor->specialization }}</div>
                                <div class="text-sm text-gray-500">{{ $doctor->qualification }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $doctor->department->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($doctor->user->is_active)
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
                                    <a href="{{ route('admin.doctors.show', $doctor) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this doctor?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-user-md text-4xl mb-4"></i>
                                    <p>No doctors found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($doctors->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $doctors->links() }}
            </div>
        @endif
    </div>
</div>
@endsection