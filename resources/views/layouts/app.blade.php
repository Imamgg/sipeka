<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
</head>

<body class="bg-gray-50 overflow-x-hidden">
    @include('sweetalert::alert')

    <!-- Admin Header (Fixed) -->
    <x-admin-header />

    <!-- Admin Sidebar (Fixed) -->
    <x-admin-sidebar />

    <!-- Main Content Area -->
    <div class="lg:ml-64 min-h-screen">
        <main class="pt-16 pb-6 overflow-y-auto">
            <div class="w-full min-h-full">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Mobile sidebar backdrop -->
    <div class="hidden fixed inset-0 z-10 bg-gray-600 bg-opacity-50 lg:hidden" id="sidebarBackdrop"></div>

    @stack('scripts')
    <script>
        // Sidebar toggle functionality
        const toggleSidebarMobile = document.getElementById('toggleSidebarMobile');
        const sidebar = document.getElementById('sidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const hamburger = document.getElementById('toggleSidebarMobileHamburger');
        const close = document.getElementById('toggleSidebarMobileClose');

        // Show sidebar on desktop by default
        if (sidebar) {
            sidebar.classList.add('flex');
        }

        if (toggleSidebarMobile && sidebar && sidebarBackdrop && hamburger && close) {
            toggleSidebarMobile.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                sidebarBackdrop.classList.toggle('hidden');
                hamburger.classList.toggle('hidden');
                close.classList.toggle('hidden');
            });

            sidebarBackdrop.addEventListener('click', function() {
                sidebar.classList.add('hidden');
                sidebarBackdrop.classList.add('hidden');
                hamburger.classList.remove('hidden');
                close.classList.add('hidden');
            });
        }

        // Toast functionality
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if (Session::has('toast_success'))
            Toast.fire({
                icon: 'success',
                title: '{{ Session::get('toast_success') }}'
            });
        @endif

        @if (Session::has('toast_error'))
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get('toast_error') }}'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonText: 'Ok'
            });
        @endif
    </script>
</body>

</html>
