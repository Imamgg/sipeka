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

<body>
    @include('sweetalert::alert')
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 text-gray-100 fixed w-full z-30 top-0">
        <x-admin-header />

        <x-admin-sidebar />

        <div class="flex flex-col flex-1 lg:ml-64">
            <main class="flex-1 pt-16">
                {{ $slot }}
            </main>
        </div>

        <!-- Mobile sidebar backdrop -->
        <div class="hidden fixed inset-0 z-10 bg-gray-600 bg-opacity-50 lg:hidden" id="sidebarBackdrop"></div>
    </div>

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
