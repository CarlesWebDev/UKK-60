<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@2.3.0/dist/flowbite.bundle.min.js"></script> --}}

    <link href="{{ asset('asset/css/fontawesome/css/all.min.css') }}" rel="stylesheet">

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script> --}}
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
    @stack('scripts')
    <title>@yield('title', '')</title>
</head>

<body class="bg-gray-50">

    @include('partials.sidebarstudent')

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            @yield('content')
        </div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ session('error') }}',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            </script>
        @endif
    </div>

    <script>
        // Script Logout
        const btnLogout = document.getElementById('btn-logout-sidebar');
        if (btnLogout) {
            btnLogout.addEventListener('click', function() {
                Swal.fire({
                    title: 'Keluar?',
                    text: "Apakah kamu yakin ingin keluar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, keluar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-sidebar-form').submit();
                    }
                });
            });
        }
    </script>
</body>

</html>
