<header class="bg-white border-b border-gray-200 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                @yield('page-title', __('Dashboard'))
            </h1>
            @hasSection('page-subtitle')
                <p class="mt-2 text-sm text-gray-500">@yield('page-subtitle')</p>
            @endif
        </div>
        <div class="flex flex-wrap items-center gap-3">
            @yield('page-actions')
        </div>
    </div>
</header>
