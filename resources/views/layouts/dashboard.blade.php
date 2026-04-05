<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    
    <!-- Compiled CSS -->
    @vite('resources/css/app.css')
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    
    <style>
        [x-cloak] { display: none !important; }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Responsive fixes */
        @media (max-width: 1024px) {
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
        }
        .xs\:inline {
            display: none;
        }
        @media (min-width: 475px) {
            .xs\:inline {
                display: inline;
            }
        }
    </style>
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    <!-- Mobile sidebar overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="sidebar-overlay lg:hidden" x-transition></div>

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content Area -->
        <main class="flex-1 lg:ml-0 min-w-0">
            <!-- Dashboard Header -->
            @include('layouts.partials.dashboard-header')

            <!-- Page Content -->
            <div class="p-4 sm:p-6 lg:p-8 max-w-full overflow-x-hidden">
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sidebar', () => ({
                open: false,
                init() {
                    this.$el.addEventListener('toggle-sidebar', () => {
                        this.open = !this.open;
                    });
                }
            }));
        });

        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');

            document.addEventListener('toggle-sidebar', function() {
                const isOpen = sidebar.classList.contains('translate-x-0');
                if (window.innerWidth < 1024) { // lg breakpoint
                    if (isOpen) {
                        sidebar.classList.remove('translate-x-0');
                        sidebar.classList.add('-translate-x-full');
                    } else {
                        sidebar.classList.remove('-translate-x-full');
                        sidebar.classList.add('translate-x-0');
                    }
                }
            });

            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                } else {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                }
            });
        });
    </script>
    
    <!-- Compiled JS -->
    @vite('resources/js/app.js')
</body>
</html>