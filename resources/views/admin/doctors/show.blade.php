{{-- resources/views/admin/doctors/show.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Doctor Details')
@section('page-title', 'Doctor Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Doctor Details</h1>
                <p class="text-gray-600 mt-2">View doctor profile information</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.doctors.edit', $doctor) }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 smooth-transition flex items-center space-x-2">
                    <i class="fas fa-edit"></i>
                    <span>Edit Doctor</span>
                </a>
                <a href="{{ route('admin.doctors.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 smooth-transition flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Doctors</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Doctor Profile -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Profile Header -->
        <div class="gradient-bg p-8 text-white">
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold">
                    {{ substr($doctor->user->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold">{{ $doctor->user->name }}</h2>
                    <p class="text-indigo-100 text-lg">{{ $doctor->specialization }}</p>
                    <p class="text-indigo-200">{{ $doctor->department->name }} Department</p>
                    @if($doctor->user->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mt-2">
                            <i class="fas fa-circle text-green-400 mr-2"></i>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 mt-2">
                            <i class="fas fa-circle text-red-400 mr-2"></i>
                            Inactive
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- Personal Information -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Email Address</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Phone Number</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->user->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Gender</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($doctor->user->gender ?? 'Not specified') }}</p>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Professional Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Department</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->department->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Specialization</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->specialization }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Qualification</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->qualification }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Experience</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->experience_years }} years</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Consultation Fee</label>
                        <p class="text-gray-800 font-medium">₹{{ $doctor->consultation_fee }}</p>
                    </div>
                </div>

                @if($doctor->bio)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Bio</label>
                        <p class="text-gray-800">{{ $doctor->bio }}</p>
                    </div>
                @endif
            </div>

            <!-- Availability -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Availability</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Available Days</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($doctor->available_days as $day)
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full">{{ $day }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Available Hours</label>
                        <p class="text-gray-800 font-medium">
                            {{ date('h:i A', strtotime($doctor->available_from)) }} - {{ date('h:i A', strtotime($doctor->available_to)) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Account Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Account Status</label>
                        <p class="text-gray-800 font-medium">
                            @if($doctor->user->is_active)
                                <span class="text-green-600">Active</span>
                            @else
                                <span class="text-red-600">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Member Since</label>
                        <p class="text-gray-800 font-medium">{{ $doctor->user->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection