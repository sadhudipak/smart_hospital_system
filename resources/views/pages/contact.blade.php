@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Hero Section -->
<section class="mb-16">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 sm:px-12 py-16 sm:py-20 text-white">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl">Get in touch with us. We're here to help you with any questions or concerns.</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="mb-16">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Send us a Message</h2>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 smooth-transition flex items-center justify-center space-x-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-8">
                <!-- Contact Details -->
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Get in Touch</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center text-white flex-shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Address</h4>
                                <p class="text-gray-600">123 Healthcare Avenue<br>Medical District<br>City, State 12345</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center text-white flex-shrink-0">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Phone</h4>
                                <p class="text-gray-600">+1 (555) 123-4567</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center text-white flex-shrink-0">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600">info@smarthospital.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center text-white flex-shrink-0">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Hours</h4>
                                <p class="text-gray-600">Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 9:00 AM - 2:00 PM<br>Sun: Emergency Only</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-red-50 border border-red-200 rounded-xl p-8">
                    <h3 class="text-2xl font-bold text-red-800 mb-4">Emergency Contact</h3>
                    <p class="text-red-700 mb-4">For medical emergencies, please call emergency services immediately.</p>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-white">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-red-800">Emergency: 911</p>
                            <p class="text-sm text-red-600">Available 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection