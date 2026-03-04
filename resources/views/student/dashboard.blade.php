@extends('layout.appstudent')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto font-sans">
        <div
            class="flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-xl border border-blue-100 shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Student Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Selamat datang
                    <span class="text-blue-500">{{ auth()->user()->name }}</span>
                    di sistem pengaduan sarana sekolah.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium border border-blue-100">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Aspirasi</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $total }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Dalam Proses</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $progress }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <i class="fas fa-spinner text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $completed }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('student.create.aspiration') }}"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm shadow-blue-200 transition-all hover:-translate-y-0.5">
                <i class="fas fa-plus"></i>
                <span>Buat Aspirasi Baru</span>
            </a>
        </div>

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">
                    Laporan Aspirasi
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-center">Foto</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Isi Laporan</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3 text-center">Kategori</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse ($aspirations as $aspiration)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="px-4 py-3 text-center align-middle">
                                    <div
                                        class="h-12 w-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200 mx-auto">
                                        @if ($aspiration->photo)
                                            <img src="{{ asset('storage/' . $aspiration->photo) }}" alt="Bukti"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-900 align-middle">
                                    {{ $aspiration->title ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-gray-500 max-w-xs truncate align-middle">
                                    {{ $aspiration->description ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-gray-600 align-middle">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                                        <span>{{ $aspiration->location ?? '-' }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-center align-middle">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $aspiration->category->category_name ?? '-' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center align-middle">
                                    @if ($aspiration->status == 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                            Pending
                                        </span>
                                    @elseif ($aspiration->status == 'progress')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            progress
                                        </span>
                                    @elseif ($aspiration->status == 'completed')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Complated
                                        </span>
                                    @elseif ($aspiration->status == 'rejected')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Rejected
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-center align-middle" x-data="{ open: false, modalIsOpen: false }">
                                    <div class="flex justify-end text-right align-top relative">
                                        <button @click="open = !open" @click.outside="open = false"
                                            class="text-gray-500 hover:text-blue-600 focus:outline-none p-2 rounded-full hover:bg-gray-100 transition">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>

                                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-12 top-2 w-32 bg-white rounded-lg shadow-lg border border-gray-100 z-40">

                                            @if ($aspiration->status === 'pending')
                                                <a href="{{ route('student.edit.aspiration', $aspiration->id) }}"
                                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition rounded-t-lg">
                                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                                </a>
                                            @endif

                                            @if ($aspiration->status === 'completed' || $aspiration->status === 'rejected' || $aspiration->status === 'progress')
                                                <button type="button" @click="modalIsOpen = true; open = false"
                                                    class="group flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors rounded-b-lg">
                                                    <i class="fa-solid fa-trash mr-3 group-hover:text-red-700"></i>
                                                    Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($aspiration->status === 'completed' || $aspiration->status === 'rejected' || $aspiration->status === 'progress')
                                        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                            x-trap.inert.noscroll="modalIsOpen"
                                            x-on:keydown.esc.window="modalIsOpen = false"
                                            x-on:click.self="modalIsOpen = false"
                                            class="fixed inset-0 z-50 flex items-end justify-center bg-black/20 p-4 pb-8  sm:items-center lg:p-8"
                                            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">

                                            <div x-show="modalIsOpen"
                                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                                x-transition:enter-start="opacity-0 scale-50"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                class="flex max-w-lg w-full flex-col gap-4 overflow-hidden rounded-xl border border-gray-200 bg-white text-gray-900 text-left shadow-xl">

                                                <div
                                                    class="flex items-center justify-between border-b border-gray-200 bg-gray-50/60 p-4">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-full bg-red-100">
                                                            <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                                                        </div>
                                                        <h3 id="defaultModalTitle"
                                                            class="font-semibold tracking-wide text-gray-900 text-lg">Hapus
                                                            Aspirasi</h3>
                                                    </div>
                                                    <button x-on:click="modalIsOpen = false" aria-label="close modal"
                                                        class="text-gray-400 hover:text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            aria-hidden="true" stroke="currentColor" fill="none"
                                                            stroke-width="1.4" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="px-4 py-6 text-left">
                                                    <p class="text-sm text-gray-600 whitespace-normal">Apakah Anda yakin
                                                        ingin menghapus data aspirasi ini? Jika dihapus, data tidak dapat
                                                        dikembalikan.</p>
                                                </div>

                                                <div
                                                    class="flex flex-col-reverse  gap-2 border-t border-gray-200 bg-gray-50 p-4 sm:flex-row sm:items-center md:justify-end">
                                                    <button x-on:click="modalIsOpen = false" type="button"
                                                        class="whitespace-nowrap rounded-lg px-4 py-2 text-center text-sm font-medium tracking-wide text-gray-700 bg-white border border-gray-300 transition hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 sm:w-auto w-full">Batal</button>

                                                    <form
                                                        action="{{ route('student.delete.aspirations', $aspiration->id) }}"
                                                        method="POST" class="m-0 p-0 sm:w-auto w-full">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full whitespace-nowrap rounded-lg bg-red-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Hapus</button>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500 align-middle">
                                    Tidak ada aspirasi yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row justify-between items-center border-t border-gray-100">
                <div class="text-xs p-4 text-gray-500">
                    Menampilkan
                    <span class="font-medium text-gray-900">{{ $aspirations->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-medium text-gray-900">{{ $aspirations->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-medium text-gray-900">{{ $aspirations->total() }}</span>
                    aspirasi
                </div>

                <div class="p-4">
                    @if ($aspirations->onFirstPage())
                        <span
                            class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $aspirations->previousPageUrl() }}"
                            class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Prev</a>
                    @endif

                    @if ($aspirations->hasMorePages())
                        <a href="{{ $aspirations->nextPageUrl() }}"
                            class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Next</a>
                    @else
                        <span
                            class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <script>
    function toggleDropdown(id) {
        const menu = document.getElementById(`menu-dropdown-${id}`);
        document.querySelectorAll('[id^="menu-dropdown-"]').forEach(el => {
            if (el.id !== `menu-dropdown-${id}`) {
                closeMenu(el);
            }
        });

        if (menu.classList.contains('hidden')) {
            openMenu(menu);
        } else {
            closeMenu(menu);
        }
    }

    function openMenu(el) {
        el.classList.remove('hidden');
        setTimeout(() => {
            el.classList.remove('scale-95', 'opacity-0');
            el.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeMenu(el) {
        el.classList.remove('scale-100', 'opacity-100');
        el.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            el.classList.add('hidden');
        }, 200);
    }

    window.addEventListener('click', function(e) {
        if (!e.target.closest('button[id^="btn-dropdown-"]') && !e.target.closest(
                'div[id^="menu-dropdown-"]')) {
            document.querySelectorAll('[id^="menu-dropdown-"]').forEach(el => {
                if (!el.classList.contains('hidden')) {
                    closeMenu(el);
                }
            });
        }
    });
</script> --}}





















{{-- Demo --}}
{{-- @extends('layout.appstudent')

@section('content')
    @php
        // 1. Statistik Dummy
        $total = 12;
        $progress = 3;
        $completed = 5;


        $aspirations = [
            (object) [
                'id' => 101,
                'title' => 'AC Kelas XI RPL 1 Bocor',
                'description' => 'AC di bagian belakang kelas meneteskan air cukup deras, mengganggu siswa yang duduk di bawahnya.',
                'location' => 'Ruang Kelas XI RPL 1',
                'category' => (object) ['category_name' => 'Fasilitas Kelas'],
                'status' => 'pending',
                'photo' => null,
                'created_at' => now(),
            ],
            (object) [
                'id' => 102,
                'title' => 'Wastafel Toilet Pria Rusak',
                'description' => 'Keran air di wastafel toilet lantai 2 patah dan air tidak mau keluar.',
                'location' => 'Toilet Siswa Lt. 2',
                'category' => (object) ['category_name' => 'Sanitasi'],
                'status' => 'progress',
                'photo' => 'dummy.jpg',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 103,
                'title' => 'Lampu Lorong Perpustakaan Mati',
                'description' => 'Lampu di lorong menuju perpustakaan mati total, area menjadi gelap saat sore hari.',
                'location' => 'Koridor Perpustakaan',
                'category' => (object) ['category_name' => 'Kelistrikan'],
                'status' => 'completed',
                'photo' => null,
                'created_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 104,
                'title' => 'Request Eskul Mobile Legends',
                'description' => 'Mohon diadakan ekstrakurikuler E-Sport khusus divisi Mobile Legends karena banyak peminatnya.',
                'location' => '-',
                'category' => (object) ['category_name' => 'Kesiswaan'],
                'status' => 'rejected',
                'photo' => null,
                'created_at' => now()->subDays(7),
            ],
        ];
    @endphp


    <div class="space-y-6 max-w-7xl mx-auto font-sans">
        <div class="flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-xl border border-blue-100 shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Siswa</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Selamat datang, <span class="font-semibold text-blue-600">Andi Saputra</span>. Pantau laporan Anda di sini.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium border border-blue-100 flex items-center gap-2">
                    <i class="far fa-calendar-alt"></i>
                    {{ date('l, d F Y') }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Aspirasi</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $total }}</p>
                </div>
                <div class="h-12 w-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Dalam Proses</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $progress }}</p>
                </div>
                <div class="h-12 w-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                    <i class="fas fa-spinner text-xl animate-spin-slow"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $completed }}</p>
                </div>
                <div class="h-12 w-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('student.create.aspiration') }}"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 transition-all hover:-translate-y-1">
                <i class="fas fa-plus"></i>
                <span>Buat Laporan Baru</span>
            </a>
        </div>

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide flex items-center gap-2">
                    <i class="fas fa-list text-gray-400"></i> Riwayat Laporan
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-medium text-center w-20">Foto</th>
                            <th class="px-6 py-4 font-medium">Judul Laporan</th>
                            <th class="px-6 py-4 font-medium">Kategori & Lokasi</th>
                            <th class="px-6 py-4 font-medium text-center">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse ($aspirations as $aspiration)
                            <tr class="hover:bg-blue-50/30 transition group">
                                <td class="px-6 py-4 text-center">
                                    <div class="w-12 h-12 rounded-lg border border-gray-200 mx-auto flex items-center justify-center bg-gray-50 text-gray-400 overflow-hidden">
                                        @if ($aspiration->photo)
                                             <i class="fa-solid fa-image text-blue-400 text-lg"></i>
                                        @else
                                            <i class="fa-regular fa-image text-lg"></i>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="block font-bold text-gray-900 mb-1">{{ $aspiration->title }}</span>
                                    <p class="text-gray-500 text-xs line-clamp-2 max-w-xs leading-relaxed">
                                        {{ $aspiration->description }}
                                    </p>
                                    <span class="text-[10px] text-gray-400 mt-2 block">
                                        {{ \Carbon\Carbon::parse($aspiration->created_at)->diffForHumans() }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-2">
                                        <span class="inline-flex items-center w-fit px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ $aspiration->category->category_name }}
                                        </span>
                                        <div class="flex items-center gap-1.5 text-gray-500 text-xs">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                            <span>{{ $aspiration->location }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($aspiration->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                            <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                            Menunggu
                                        </span>
                                    @elseif ($aspiration->status == 'progress')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                            Diproses
                                        </span>
                                    @elseif ($aspiration->status == 'completed')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                            Selesai
                                        </span>
                                    @elseif ($aspiration->status == 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="relative inline-block text-left">
                                        <button id="btn-dropdown-{{ $aspiration->id }}"
                                            onclick="toggleDropdown('{{ $aspiration->id }}')"
                                            class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all focus:outline-none">
                                            <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                        </button>

                                        <div id="menu-dropdown-{{ $aspiration->id }}"
                                            class="hidden absolute right-0 mt-2 w-40 origin-top-right bg-white divide-y divide-gray-100 rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none z-50 transform transition-all duration-200 ease-out scale-95 opacity-0">

                                            <div class="p-1">
                                                <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                                                    <i class="fa-solid fa-eye mr-3 text-gray-400 group-hover:text-blue-500"></i>
                                                    Detail
                                                </a>
                                                <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 rounded-lg transition-colors">
                                                    <i class="fa-solid fa-pen-to-square mr-3 text-gray-400 group-hover:text-amber-500"></i>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="p-1">
                                                <button type="button" onclick="confirmDelete(this)"
                                                    class="group flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors">
                                                    <i class="fa-solid fa-trash mr-3 group-hover:text-red-600"></i>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                        <p>Belum ada laporan aspirasi.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row justify-between items-center border-t border-gray-100 p-4 bg-gray-50/30">
                <div class="text-xs text-gray-500">
                    Menampilkan <span class="font-bold text-gray-900">1</span> - <span class="font-bold text-gray-900">4</span> dari <span class="font-bold text-gray-900">12</span> data
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 text-xs font-medium text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed shadow-sm">
                        <i class="fas fa-chevron-left mr-1"></i> Prev
                    </button>
                    <button class="px-3 py-1.5 text-xs font-medium text-blue-600 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-200 shadow-sm transition">
                        Next <i class="fas fa-chevron-right ml-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function toggleDropdown(id) {
        const menu = document.getElementById(`menu-dropdown-${id}`);
        document.querySelectorAll('[id^="menu-dropdown-"]').forEach(el => {
            if (el.id !== `menu-dropdown-${id}`) closeMenu(el);
        });

        if (menu.classList.contains('hidden')) {
            openMenu(menu);
        } else {
            closeMenu(menu);
        }
    }

    function openMenu(el) {
        el.classList.remove('hidden');
        requestAnimationFrame(() => {
            el.classList.remove('scale-95', 'opacity-0');
            el.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeMenu(el) {
        el.classList.remove('scale-100', 'opacity-100');
        el.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            el.classList.add('hidden');
        }, 200);
    }

    window.addEventListener('click', function(e) {
        if (!e.target.closest('button[id^="btn-dropdown-"]') && !e.target.closest('div[id^="menu-dropdown-"]')) {
            document.querySelectorAll('[id^="menu-dropdown-"]').forEach(el => {
                if (!el.classList.contains('hidden')) closeMenu(el);
            });
        }
    });

    function confirmDelete(button) {
        const dropdown = button.closest('div[id^="menu-dropdown-"]');
        closeMenu(dropdown);

        Swal.fire({
            title: 'Hapus Laporan?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const row = button.closest('tr');

                row.style.transition = 'all 0.5s ease';
                row.style.transform = 'translateX(20px)';
                row.style.opacity = '0';

                setTimeout(() => {
                    row.remove();
                }, 500);

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Laporan berhasil dihapus'
                });
            }
        });
    }
</script> --}}
