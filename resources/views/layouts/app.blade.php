<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Hospital')</title>
    <meta name="description" content="Smart Hospital - Quality Healthcare Services">
    
    <!-- Compiled CSS -->
    @vite('resources/css/app.css')
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('layouts.partials.header')
        
        <!-- Main Content -->
        <main class="flex-grow container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('layouts.partials.footer')
    </div>
    
    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Compiled JS -->
    @vite('resources/js/app.js')
</body>
</html>