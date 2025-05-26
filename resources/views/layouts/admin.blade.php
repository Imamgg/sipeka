<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <x-admin-sidebar />
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
