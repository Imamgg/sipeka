<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Welcome to Student Dashboard') }}</h3>
                    <p>{{ __('You are logged in as a Student. Here you can view your schedule, grades, and class materials.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
