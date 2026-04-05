@extends('layouts.app')

@section('title', 'Our Doctors')

@section('content')
<!-- Hero Section -->
<section class="mb-16">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 sm:px-12 py-16 sm:py-20 text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Meet Our Expert Doctors</h1>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl">Our team of qualified healthcare professionals is dedicated to providing you with the best medical care.</p>
        </div>
    </div>
</section>

<!-- Doctors Section -->
<section class="mb-16">
    <div class="max-w-7xl mx-auto">
        <!-- Department Filter -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('doctors.list') }}"
                   class="px-6 py-3 rounded-lg font-medium smooth-transition {{ !request('department') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All Departments
                </a>
                @foreach($departments as $dept)
                    <a href="{{ route('doctors.list', ['department' => $dept->id]) }}"
                       class="px-6 py-3 rounded-lg font-medium smooth-transition {{ request('department') == $dept->id ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $dept->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Doctors Grid -->
        @if($doctors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($doctors as $doctor)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md smooth-transition">
                        <div class="p-8">
                            <!-- Doctor Avatar -->
                            <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-6">
                                {{ substr($doctor->user->name, 0, 1) }}
                            </div>

                            <!-- Doctor Info -->
                            <div class="text-center mb-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $doctor->user->name }}</h3>
                                <p class="text-indigo-600 font-medium mb-2">{{ $doctor->specialization }}</p>
                                <p class="text-gray-600 text-sm">{{ $doctor->department->name }}</p>
                            </div>

                            <!-- Doctor Details -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Experience:</span>
                                    <span class="font-medium text-gray-800">{{ $doctor->experience_years }} years</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Consultation Fee:</span>
                                    <span class="font-medium text-gray-800">₹{{ $doctor->consultation_fee }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Qualification:</span>
                                    <span class="font-medium text-gray-800">{{ $doctor->qualification }}</span>
                                </div>
                            </div>

                            <!-- Availability -->
                            <div class="mb-6">
                                <h4 class="font-semibold text-gray-800 mb-2">Available Days:</h4>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($doctor->available_days as $day)
                                        <span class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs rounded-full">{{ $day }}</span>
                                    @endforeach
                                </div>
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ date('h:i A', strtotime($doctor->available_from)) }} - {{ date('h:i A', strtotime($doctor->available_to)) }}
                                </p>
                            </div>

                            <!-- Action Button -->
                            @auth
                                @if(auth()->user()->role === 'patient')
                                    <a href="{{ route('patient.appointments.create', ['doctor' => $doctor->id]) }}"
                                       class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 smooth-transition flex items-center justify-center space-x-2">
                                        <i class="fas fa-calendar-plus"></i>
                                        <span>Book Appointment</span>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('register') }}"
                                   class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 smooth-transition flex items-center justify-center space-x-2">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Register to Book</span>
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $doctors->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 text-4xl mx-auto mb-6">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">No Doctors Found</h3>
                <p class="text-gray-600 mb-8">There are currently no doctors available in this department.</p>
                <a href="{{ route('doctors.list') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 smooth-transition">
                    View All Doctors
                </a>
            </div>
        @endif
    </div>
</section>
@endsection