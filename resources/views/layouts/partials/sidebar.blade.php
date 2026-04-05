<aside id="sidebar" class="w-64 h-screen bg-gray-900 text-gray-100 p-6 fixed lg:relative z-40 shadow-xl border-r border-gray-800 overflow-y-auto custom-scrollbar transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out" aria-label="Sidebar navigation">
    <!-- Logo -->
    <div class="flex items-center space-x-3 mb-8 pb-6 border-b border-gray-800">
        <!-- <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center flex-shrink-0">
            <i class="fas fa-hospital text-white text-lg"></i>
        </div> -->
        <!-- <div>
            <h2 class="text-lg font-bold">Smart<span class="text-indigo-400">Hospital</span></h2>
            <p class="text-xs text-gray-400">Dashboard</p>
        </div> -->
    </div>
    
    <!-- Navigation Menu -->
    <nav class="space-y-2">
        @auth
            @if(auth()->user()->role === 'admin')
                <!-- Admin Menu -->
                <div class="mb-6">
                    <p class="text-xs uppercase font-semibold text-gray-400 mb-3 px-4">Administration</p>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.doctors.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('admin.doctors.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-user-md w-5 text-center"></i>
                        <span>Doctors</span>
                    </a>
                    <a href="{{ route('admin.patients.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('admin.patients.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span>Patients</span>
                    </a>
                    <a href="{{ route('admin.appointments.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('admin.appointments.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                        <span>Appointments</span>
                    </a>
                </div>
            @endif
            
            @if(auth()->user()->role === 'doctor')
                <!-- Doctor Menu -->
                <div class="mb-6">
                    <p class="text-xs uppercase font-semibold text-gray-400 mb-3 px-4">Doctor Area</p>
                    <a href="{{ route('doctor.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('doctor.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('doctor.appointments.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('doctor.appointments.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-calendar-check w-5 text-center"></i>
                        <span>Appointments</span>
                    </a>
                    <a href="{{ route('doctor.prescriptions.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('doctor.prescriptions.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-prescription-bottle w-5 text-center"></i>
                        <span>Prescriptions</span>
                    </a>
                </div>
            @endif
            
            @if(auth()->user()->role === 'patient')
                <!-- Patient Menu -->
                <div class="mb-6">
                    <p class="text-xs uppercase font-semibold text-gray-400 mb-3 px-4">Patient Area</p>
                    <a href="{{ route('patient.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('patient.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('patient.appointments.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('patient.appointments.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                        <span>My Appointments</span>
                    </a>
                    <a href="{{ route('patient.appointments.create') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('patient.appointments.create') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-plus-circle w-5 text-center"></i>
                        <span>Book Appointment</span>
                    </a>
                    <a href="{{ route('patient.prescriptions.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition {{ request()->routeIs('patient.prescriptions.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <i class="fas fa-file-medical w-5 text-center"></i>
                        <span>Prescriptions</span>
                    </a>
                </div>
            @endif
            
            <!-- Common Menu -->
            <div class="border-t border-gray-800 pt-4">
                <p class="text-xs uppercase font-semibold text-gray-400 mb-3 px-4">General</p>
                <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Homepage</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center space-x-3 px-4 py-3 rounded-lg smooth-transition text-red-400 hover:bg-red-900/20">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        @endauth
    </nav>
</aside>