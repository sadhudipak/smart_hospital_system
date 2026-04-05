{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer class="bg-gray-900 text-gray-300 mt-20 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- About Section -->
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-hospital-alt text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold text-white">Smart<span class="text-indigo-400">Hospital</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Providing quality healthcare services with modern technology. Book appointments, consult with doctors, and manage your health records all in one place.
                </p>
                <!-- Social Links -->
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-lg flex items-center justify-center smooth-transition" aria-label="Facebook">
                        <i class="fab fa-facebook-f text-gray-300"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-lg flex items-center justify-center smooth-transition" aria-label="Twitter">
                        <i class="fab fa-twitter text-gray-300"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-lg flex items-center justify-center smooth-transition" aria-label="Instagram">
                        <i class="fab fa-instagram text-gray-300"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-lg flex items-center justify-center smooth-transition" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in text-gray-300"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-semibold mb-4 text-lg">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>Home</span></a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>About Us</span></a></li>
                    <li><a href="{{ route('doctors.list') }}" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>Our Doctors</span></a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>Contact</span></a></li>
                </ul>
            </div>
            
            <!-- Services -->
            <div>
                <h4 class="text-white font-semibold mb-4 text-lg">Services</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>Book Appointment</span></a></li>
                    <li><a href="#" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>Prescriptions</span></a></li>
                    <li><a href="#" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>Health Records</span></a></li>
                    <li><a href="#" class="text-gray-400 hover:text-indigo-400 smooth-transition flex items-center space-x-2"><i class="fas fa-chevron-right text-xs w-3"></i><span>Reports</span></a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h4 class="text-white font-semibold mb-4 text-lg">Contact Info</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-indigo-400 flex-shrink-0 mt-1 w-4"></i>
                        <span class="text-gray-400">123 Healthcare Ave, Medical City, MC 12345</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-phone text-indigo-400 flex-shrink-0 w-4"></i>
                        <a href="tel:+1234567890" class="text-gray-400 hover:text-indigo-400 smooth-transition">+1 (234) 567-8900</a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-indigo-400 flex-shrink-0 w-4"></i>
                        <a href="mailto:info@smarthospital.com" class="text-gray-400 hover:text-indigo-400 smooth-transition">info@smarthospital.com</a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-clock text-indigo-400 flex-shrink-0 w-4"></i>
                        <span class="text-gray-400">24/7 Available</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="border-t border-gray-800 pt-8">
            <!-- Bottom Section -->
            <div class="flex flex-col md:flex-row items-center justify-between text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} SmartHospital. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-indigo-400 smooth-transition">Privacy Policy</a>
                    <a href="#" class="hover:text-indigo-400 smooth-transition">Terms of Service</a>
                    <a href="#" class="hover:text-indigo-400 smooth-transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
                        <span>+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-indigo-400"></i>
                        <span>info@smarthospital.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="border-gray-800 my-8">
        
        <div class="flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} SmartHospital. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-500 hover:text-gray-300 text-sm">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-gray-300 text-sm">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
