<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-100 shadow-sm">
    <div class="px-4 py-3 lg:px-6">
        <div class="flex items-center max-w-7xl mx-auto justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors duration-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="#" class="flex ms-2  items-center">

                    <span
                        class="self-center text-xl  whitespace-nowrap font-sans font-bold text-blue-500">SIPASAR</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 transition-all duration-200"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <div
                                class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-full">
                                <span
                                    class="font-medium  text-sm text-white">{{ strtoupper(substr(Auth::guard('admin')->user()->name, 0, 1)) }}
                                </span>
                            </div>
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900" role="none">
                                {{ Auth::guard('admin')->user()->name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate" role="none">
                                {{ Auth::guard('admin')->user()->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>


<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-100 shadow-sm sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white flex flex-col place-content-between">
        <ul class="space-y-1 ">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm6 2a1 1 0 00-2 0v8a1 1 0 002 0V8zm4 4a1 1 0 10-2 0v4a1 1 0 002 0v-4zm3-2a1 1 0 112 0v6a1 1 0 11-2 0V10z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="ms-3 font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user.management') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.user.management') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.user.management') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267A6.439 6.439 0 0 1 11.27 8.905 4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                    </div>
                    <span class="ms-3 font-medium">Manajemen Pengguna</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.management') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.category.management') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.category.management') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                     <i class="fa-solid fa-tag"></i>
                    </div>
                    <span class="ms-3 font-medium">Category Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.management.aspiration') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.management.aspiration') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.management.aspiration') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                      <i class="fa-solid fa-list"></i>
                    </div>
                    <span class="ms-3 font-medium">Management Aspiration</span>
                </a>
            </li>
        </ul>
        <div class="mt-8 pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('admin.logout') }}" id="logoutForm">
                @csrf
                <button id="logoutBtn" type="submit"
                    class="flex items-center w-full p-3  text-red-500 rounded-lg hover:text-red-900 hover:bg-gray-50 group transition-colors duration-200">
                    <div
                        class="flex items-center justify-center w-6 h-6 text-gray-500 group-hover:text-red-500 transition-colors duration-200">
                       <i class="fa-solid text-red-500 fa-arrow-right-from-bracket"></i>
                    </div>
                    <span class="ms-3 font-medium">Sign out</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('#logo-sidebar a[href]');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('bg-blue-50', 'text-blue-600');
                link.querySelector('div').classList.add('text-blue-600');
                link.querySelector('div').classList.remove('text-gray-500',
                    'group-hover:text-blue-600');
            }
        });
    });

    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah kamu yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>






{{-- Demo --}}
{{-- <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-100 shadow-sm">
    <div class="px-4 py-3 lg:px-6">
        <div class="flex items-center max-w-7xl mx-auto justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors duration-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="#" class="flex ms-2  items-center">

                    <span
                        class="self-center text-xl  whitespace-nowrap font-sans font-bold text-blue-500">SIPASAR</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 transition-all duration-200"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <div
                                class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-full">
                                <span class="font-medium  text-sm text-white">
                                    A
                                </span>
                            </div>
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900" role="none">
                                Administrator
                            </p>
                            <p class="text-sm text-gray-500 truncate" role="none">

                                admin@sekolah.sch.id
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>


<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-100 shadow-sm sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-1 ">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm6 2a1 1 0 00-2 0v8a1 1 0 002 0V8zm4 4a1 1 0 10-2 0v4a1 1 0 002 0v-4zm3-2a1 1 0 112 0v6a1 1 0 11-2 0V10z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="ms-3 font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user.management') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.user.management') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.user.management') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267A6.439 6.439 0 0 1 11.27 8.905 4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                    </div>
                    <span class="ms-3 font-medium"> User Manajemen</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.management') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.category.management') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.category.management') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                      <i class="fa-solid fa-list"></i>
                    </div>
                    <span class="ms-3 font-medium">Category Management</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.management.aspiration') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200 {{ request()->routeIs('admin.management.aspiration') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                    <div
                        class="flex items-center justify-center w-6 h-6 {{ request()->routeIs('admin.management.aspiration') ? 'text-blue-600' : 'text-gray-500 group-hover:text-blue-600' }} transition-colors duration-200">
                      <i class="fa-solid fa-list"></i>
                    </div>
                    <span class="ms-3 font-medium">Management Aspiration</span>
                </a>
            </li>
        </ul>
        <div class="mt-8 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.login.form') }}" id="logoutBtn"
                class="flex items-center w-full p-3 text-gray-600 rounded-lg hover:bg-gray-50 group transition-colors duration-200">
                <div
                    class="flex items-center justify-center w-6 h-6 text-gray-500 group-hover:text-red-500 transition-colors duration-200">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </div>
                <span class="ms-3 font-medium">Sign out</span>
            </a>
        </div>
    </div>
</aside> --}}

{{-- <script>
    // Script Sidebar Active State
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('#logo-sidebar a[href]');

        navLinks.forEach(link => {
            // Check if link matches path OR if path contains the link (for sub-menus)
            if (link.getAttribute('href') === currentPath || (currentPath.includes(link.getAttribute('href')) && link.getAttribute('href') !== '/')) {
                link.classList.add('bg-blue-50', 'text-blue-600');
                const iconDiv = link.querySelector('div');
                if(iconDiv) {
                    iconDiv.classList.add('text-blue-600');
                    iconDiv.classList.remove('text-gray-500', 'group-hover:text-blue-600');
                }
            }
        });
    });

    // Script Logout SweetAlert (Modified for Link)
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href'); // Ambil link tujuan

        Swal.fire({
            title: 'Apakah kamu yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href; // Redirect manual
            }
        });
    });
</script> --}}
