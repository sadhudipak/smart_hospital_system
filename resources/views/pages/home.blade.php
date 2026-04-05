@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="mb-16">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 sm:px-12 py-16 sm:py-20 text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Your Health, Our Priority</h1>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl">Book appointments, consult with expert doctors, and manage your health records all in one secure platform.</p>
            
            <div class="flex flex-wrap gap-4">
                @auth
                    <a href="{{ route('patient.appointments.create') }}" class="px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 smooth-transition flex items-center space-x-2">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Book Appointment</span>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 smooth-transition flex items-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Get Started</span>
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 smooth-transition flex items-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="mb-16">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Why Choose SmartHospital</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-8 text-center hover:shadow-md smooth-transition">
            <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                <i class="fas fa-user-md"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $stats['doctors'] ?? '50+' }}</h3>
            <p class="text-gray-600 font-medium">Expert Doctors</p>
            <p class="text-sm text-gray-500 mt-2">Highly qualified medical professionals</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-8 text-center hover:shadow-md smooth-transition">
            <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $stats['patients'] ?? '10K+' }}</h3>
            <p class="text-gray-600 font-medium">Happy Patients</p>
            <p class="text-sm text-gray-500 mt-2">Trusted by thousands worldwide</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-8 text-center hover:shadow-md smooth-transition">
            <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $stats['appointments'] ?? '5K+' }}</h3>
            <p class="text-gray-600 font-medium">Appointments</p>
            <p class="text-sm text-gray-500 mt-2">Successfully completed monthly</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-8 text-center hover:shadow-md smooth-transition">
            <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                <i class="fas fa-clock"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">24/7</h3>
            <p class="text-gray-600 font-medium">Available</p>
            <p class="text-sm text-gray-500 mt-2">Round the clock support</p>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="mb-16">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Our Features</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature 1: Easy Booking -->
        <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md smooth-transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                    <i class="fas fa-list-check text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Easy Booking</h3>
            </div>
            <p class="text-gray-600">Simple and fast appointment booking process. Choose your preferred doctor and time slot in just a few clicks.</p>
        </div>
        
        <!-- Feature 2: Expert Doctors -->
        <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md smooth-transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600">
                    <i class="fas fa-stethoscope text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Expert Doctors</h3>
            </div>
            <p class="text-gray-600">Experienced and certified medical professionals ready to provide you with the best healthcare services.</p>
        </div>
        
        <!-- Feature 3: Digital Prescriptions -->
        <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md smooth-transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">
                    <i class="fas fa-file-prescription text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Digital Prescriptions</h3>
            </div>
            <p class="text-gray-600">Receive prescriptions digitally and access them anytime. Share with pharmacists for quick medicine delivery.</p>
        </div>
        
        <!-- Feature 4: Health Records -->
        <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md smooth-transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600">
                    <i class="fas fa-file-medical text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Health Records</h3>
            </div>
            <p class="text-gray-600">Maintain comprehensive health records securely. Access your medical history anytime, anywhere.</p>
        </div>
        
        <!-- Feature 5: Secure Platform -->
        <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md smooth-transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Secure & Private</h3>
            </div>
            <p class="text-gray-600">Your health data is protected with industry-standard encryption and privacy protocols.</p>
        </div>
        
        <!-- Feature 6: Support -->
        <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md smooth-transition">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                    <i class="fas fa-headset text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">24/7 Support</h3>
            </div>
            <p class="text-gray-600">Get help whenever you need it. Our dedicated support team is always available to assist you.</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="mb-16">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl shadow-xl p-12 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
        <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">Join thousands of patients who trust SmartHospital for their healthcare needs.</p>
        @auth
            <a href="{{ route('patient.appointments.create') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 smooth-transition inline-flex items-center space-x-2">
                <i class="fas fa-calendar-plus"></i>
                <span>Book Your First Appointment</span>
            </a>
        @else
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 smooth-transition inline-flex items-center space-x-2">
                <i class="fas fa-user-plus"></i>
                <span>Create Free Account</span>
            </a>
        @endauth
    </div>
</section>
@endsection
                <i class="fa fa-check"></i>
                <h3>Reports</h3>
                <h1>8</h1>
            </div>
        </div>
    </div>

</div>

<!-- FOOTER -->
<footer>
    © 2026 SmartHospital | All Rights Reserved
</footer>

</body>
</html>