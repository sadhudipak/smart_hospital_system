<header class="bg-white shadow-sm border-b border-gray-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between" aria-label="Main navigation">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center">
                <i class="fas fa-hospital text-white text-lg"></i>
            </div>
            <span class="text-xl font-bold text-gray-800">
                Smart<span class="bg-gradient-to-r from-indigo-600 to-indigo-700 bg-clip-text text-transparent">Hospital</span>
            </span>
        </div>
        
        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-1">
            <a href="{{ route('home') }}" class="px-4 py-2 text-gray-600 hover:text-indigo-600 smooth-transition font-medium">Home</a>
            <a href="{{ route('about') }}" class="px-4 py-2 text-gray-600 hover:text-indigo-600 smooth-transition font-medium">About</a>
            <a href="{{ route('doctors.list') }}" class="px-4 py-2 text-gray-600 hover:text-indigo-600 smooth-transition font-medium">Doctors</a>
            <a href="{{ route('contact') }}" class="px-4 py-2 text-gray-600 hover:text-indigo-600 smooth-transition font-medium">Contact</a>
        </div>
        
        <!-- Auth Links -->
        <div class="flex items-center space-x-3">
            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600" aria-label="User menu">
                        <div class="w-9 h-9 gradient-bg rounded-full flex items-center justify-center text-white text-sm font-medium">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="hidden sm:inline-block text-sm font-medium">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 smooth-transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-indigo-600 hover:bg-indigo-50 rounded-lg smooth-transition font-medium">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 gradient-bg text-white rounded-lg smooth-transition font-medium hover:shadow-lg">Register</a>
            @endauth
        </div>
        
        <!-- Mobile Menu Button -->
        <button class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg" aria-label="Toggle menu">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </nav>
</header>