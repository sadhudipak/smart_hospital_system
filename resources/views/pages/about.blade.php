@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<section class="mb-16">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 sm:px-12 py-16 sm:py-20 text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">About SmartHospital</h1>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl">Learn more about our mission to provide quality healthcare services through innovative technology.</p>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="mb-16">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-8 md:p-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission</h2>
            <p class="text-gray-600 text-lg leading-relaxed mb-8">
                At SmartHospital, we are committed to revolutionizing healthcare delivery through innovative technology and patient-centered care. Our platform connects patients with qualified healthcare professionals, making healthcare accessible, efficient, and personalized.
            </p>

            <h2 class="text-3xl font-bold text-gray-800 mb-6">What We Offer</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Easy Appointment Booking</h3>
                    <p class="text-gray-600">Book appointments with your preferred doctors instantly through our user-friendly platform.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Digital Health Records</h3>
                    <p class="text-gray-600">Access your medical history, prescriptions, and test results securely from anywhere.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Expert Medical Team</h3>
                    <p class="text-gray-600">Consult with experienced doctors across various specialties for comprehensive care.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">24/7 Support</h3>
                    <p class="text-gray-600">Get round-the-clock assistance and emergency medical guidance when you need it.</p>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Compassion</h3>
                    <p class="text-gray-600">We care deeply about our patients and their well-being.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Trust</h3>
                    <p class="text-gray-600">We maintain the highest standards of privacy and security.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center text-white text-3xl mx-auto mb-4">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Innovation</h3>
                    <p class="text-gray-600">We leverage technology to improve healthcare delivery.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection