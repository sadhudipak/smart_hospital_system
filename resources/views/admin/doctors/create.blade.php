{{-- resources/views/admin/doctors/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Add New Doctor')
@section('page-title', 'Add New Doctor')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Add New Doctor</h1>
                <p class="text-gray-600 mt-2">Create a new doctor profile</p>
            </div>
            <a href="{{ route('admin.doctors.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 smooth-transition flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Doctors</span>
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.doctors.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Personal Information -->
            <div class="border-b border-gray-200 pb-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Create a secure password">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Confirm password">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <select id="gender" name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="border-b border-gray-200 pb-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Professional Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">Department *</label>
                        <select id="department_id" name="department_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">Specialization *</label>
                        <input type="text" id="specialization" name="specialization" value="{{ old('specialization') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="qualification" class="block text-sm font-medium text-gray-700 mb-2">Qualification *</label>
                        <input type="text" id="qualification" name="qualification" value="{{ old('qualification') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="e.g., MD, MBBS">
                    </div>

                    <div>
                        <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">Experience (Years) *</label>
                        <input type="number" id="experience_years" name="experience_years" value="{{ old('experience_years') }}" required min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="consultation_fee" class="block text-sm font-medium text-gray-700 mb-2">Consultation Fee (₹) *</label>
                        <input type="number" id="consultation_fee" name="consultation_fee" value="{{ old('consultation_fee') }}" required min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none" placeholder="Brief professional bio...">{{ old('bio') }}</textarea>
                </div>
            </div>

            <!-- Availability -->
            <div class="border-b border-gray-200 pb-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Availability</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="available_from" class="block text-sm font-medium text-gray-700 mb-2">Available From *</label>
                        <input type="time" id="available_from" name="available_from" value="{{ old('available_from', '09:00') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="available_to" class="block text-sm font-medium text-gray-700 mb-2">Available To *</label>
                        <input type="time" id="available_to" name="available_to" value="{{ old('available_to', '17:00') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Available Days *</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @php
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $selectedDays = old('available_days', []);
                        @endphp
                        @foreach($days as $day)
                            <label class="flex items-center">
                                <input type="checkbox" name="available_days[]" value="{{ $day }}"
                                       {{ in_array($day, $selectedDays) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">{{ $day }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Account Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Active Account</span>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.doctors.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 smooth-transition">
                    Cancel
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 smooth-transition flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Create Doctor</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection