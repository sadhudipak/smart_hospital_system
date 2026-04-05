{{-- resources/views/patient/appointments/create.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Book Appointment')
@section('page-title', 'Book New Appointment')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <div class="mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Book New Appointment</h2>
            <p class="text-gray-600">Fill in the details below to schedule your appointment</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <h3 class="text-red-800 font-medium mb-2">Please fix the following errors:</h3>
                <ul class="text-red-700 text-sm">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('patient.appointments.store') }}" class="space-y-6">
            @csrf

            <!-- Doctor Selection -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-user-md text-indigo-600 mr-2"></i>Choose a Doctor
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($doctors as $doctor)
                        <label class="cursor-pointer block">
                            <input type="radio" name="doctor_id" value="{{ $doctor->id }}"
                                   class="hidden peer" {{ old('doctor_id') == $doctor->id ? 'checked' : '' }}>
                            <div class="p-4 sm:p-6 border-2 rounded-lg transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 border-gray-300 hover:border-indigo-300">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 gradient-bg rounded-full flex items-center justify-center text-white mr-3 flex-shrink-0">
                                        <i class="fas fa-user-md text-base sm:text-lg"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-semibold text-gray-800 truncate">Dr. {{ $doctor->user->name }}</h4>
                                        <p class="text-sm text-gray-600 truncate">{{ $doctor->specialization }}</p>
                                    </div>
                                </div>
                                <div class="text-xs sm:text-sm text-indigo-600 font-medium">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>Available
                                    ₹{{ number_format($doctor->consultation_fee) }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $doctor->department->name }}
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('doctor_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date & Time Selection -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-calendar text-indigo-600 mr-2"></i>Select Date & Time
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Appointment Date</label>
                        <input type="date" name="appointment_date" value="{{ old('appointment_date') }}"
                               min="{{ date('Y-m-d') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('appointment_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Appointment Time</label>
                        <select name="appointment_time" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Select Time</option>
                            <option value="09:00" {{ old('appointment_time') == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                            <option value="09:30" {{ old('appointment_time') == '09:30' ? 'selected' : '' }}>09:30 AM</option>
                            <option value="10:00" {{ old('appointment_time') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                            <option value="10:30" {{ old('appointment_time') == '10:30' ? 'selected' : '' }}>10:30 AM</option>
                            <option value="11:00" {{ old('appointment_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                            <option value="11:30" {{ old('appointment_time') == '11:30' ? 'selected' : '' }}>11:30 AM</option>
                            <option value="14:00" {{ old('appointment_time') == '14:00' ? 'selected' : '' }}>02:00 PM</option>
                            <option value="14:30" {{ old('appointment_time') == '14:30' ? 'selected' : '' }}>02:30 PM</option>
                            <option value="15:00" {{ old('appointment_time') == '15:00' ? 'selected' : '' }}>03:00 PM</option>
                            <option value="15:30" {{ old('appointment_time') == '15:30' ? 'selected' : '' }}>03:30 PM</option>
                            <option value="16:00" {{ old('appointment_time') == '16:00' ? 'selected' : '' }}>04:00 PM</option>
                            <option value="16:30" {{ old('appointment_time') == '16:30' ? 'selected' : '' }}>04:30 PM</option>
                        </select>
                        @error('appointment_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Symptoms & Notes -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-notes-medical text-indigo-600 mr-2"></i>Medical Information
                </h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Symptoms / Reason for Visit <span class="text-red-500">*</span></label>
                        <textarea name="symptoms" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                  placeholder="Please describe your symptoms or reason for visiting the doctor...">{{ old('symptoms') }}</textarea>
                        @error('symptoms')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes (Optional)</label>
                        <textarea name="patient_note" rows="2"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                  placeholder="Any additional information for the doctor...">{{ old('patient_note') }}</textarea>
                        @error('patient_note')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('patient.dashboard') }}"
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 gradient-bg text-white rounded-lg font-medium hover:shadow-lg">
                    <i class="fas fa-check mr-2"></i>Book Appointment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
