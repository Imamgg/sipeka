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
    <main>
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 text-gray-100 min-h-screen">
            <div class="flex flex-col md:flex-row">
                <div class="flex-1 md:ml-64 w-full flex flex-col">
                    <x-admin-sidebar />
                    <x-admin-header />

                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>

    @stack('scripts')
    <script>
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
