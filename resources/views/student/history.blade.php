@extends('layout.appstudent')

@section('content')
    <div class="space-y- max-w-7xl mx-auto font-sans">

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">
                    Histori Aspirasi Saya
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
                                <td class="px-4 py-3">
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

                                <td class="px-4 py-3 font-medium text-gray-900">
                                    {{ $aspiration->title }}
                                </td>

                                <td class="px-4 py-3 text-gray-500 max-w-xs truncate">
                                    {{ $aspiration->description }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                                        <span>{{ $aspiration->location }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $aspiration->category->category_name ?? '-' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">
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
                                            completed
                                        </span>
                                    @elseif ($aspiration->status == 'rejected')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            rejected
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-6 relative whitespace-nowrap text-center align-middle" x-data="{ open: false }">
                                    <div class="flex justify-end items-end relative">
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
                                            class="absolute right-2 top-2  mb-1 w-32 bg-white rounded-lg shadow-lg border border-gray-100 z-50">

                                            <a href="{{ route('student.show.history.aspiration', $aspiration->id) }}"
                                                class="group  items-center p-2  text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 flex ">
                                                <i class="fa-solid fa-eye mr-3 text-blue-500 group-hover:text-blue-600"></i>
                                                 Detail
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada aspirasi yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xs text-gray-500">
                    Menampilkan
                    <span class="font-medium text-gray-900">{{ $aspirations->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-medium text-gray-900">{{ $aspirations->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-medium text-gray-900">{{ $aspirations->total() }}</span>
                    siswa
                </div>

                <div class="flex items-center space-x-1">
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
























{{-- Demo --}}
{{-- @extends('layout.appstudent')

@section('content')

    @php
        $aspirations = [
            (object) [
                'id' => 201,
                'title' => 'Kaca Jendela Kelas Pecah',
                'description' => 'Kaca jendela nako di ruang X PPLG 2 pecah terkena bola, berbahaya bagi siswa.',
                'location' => 'Ruang X PPLG 2',
                'category' => (object) ['category_name' => 'Fasilitas Kelas'],
                'status' => 'pending',
                'photo' => null,
            ],
            (object) [
                'id' => 202,
                'title' => 'Wifi Lab Komputer Down',
                'description' => 'Koneksi internet di Lab 3 mati total sejak pagi, menghambat praktik.',
                'location' => 'Lab Komputer 3',
                'category' => (object) ['category_name' => 'Jaringan & IT'],
                'status' => 'progress',
                'photo' => 'dummy.jpg',
            ],
            (object) [
                'id' => 203,
                'title' => 'Lampu Toilet Kedap-kedip',
                'description' => 'Lampu di toilet siswa lantai 1 kedap-kedip seperti film horor.',
                'location' => 'Toilet Lantai 1',
                'category' => (object) ['category_name' => 'Kelistrikan'],
                'status' => 'completed',
                'photo' => null,
            ],
            (object) [
                'id' => 204,
                'title' => 'Permintaan Kolam Renang',
                'description' => 'Mohon dibangun kolam renang olympic size di belakang sekolah.',
                'location' => 'Area Belakang',
                'category' => (object) ['category_name' => 'Pembangunan'],
                'status' => 'rejected',
                'photo' => null,
            ],
        ];
    @endphp


    <div class="space-y-6 max-w-7xl mx-auto font-sans">

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide flex items-center gap-2">
                    <i class="fas fa-history text-gray-400"></i> Histori Aspirasi Saya
                </h2>
                <div class="text-xs text-gray-400">Total: 4 Laporan</div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-center w-20">Foto</th>
                            <th class="px-6 py-4">Judul</th>
                            <th class="px-6 py-4">Isi Laporan</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4 text-center">Kategori</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
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

                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $aspiration->title }}
                                </td>

                                <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                                    {{ $aspiration->description }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                                        <span>{{ $aspiration->location }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $aspiration->category->category_name }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($aspiration->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @elseif ($aspiration->status == 'progress')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            progress
                                        </span>
                                    @elseif ($aspiration->status == 'completed')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Selesai
                                        </span>
                                    @elseif ($aspiration->status == 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="relative inline-block text-left">
                                        <button id="btn-dropdown-{{ $aspiration->id }}"
                                            onclick="toggleDropdown('{{ $aspiration->id }}')"
                                            class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all focus:outline-none">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>

                                        <div id="menu-dropdown-{{ $aspiration->id }}"
                                            class="hidden absolute right-0 mt-2 w-32 origin-top-right bg-white divide-y divide-gray-100 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 transform transition-all duration-200 ease-out scale-95 opacity-0">

                                            <div class="py-1 text-left">
                                                <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                                    <i class="fa-solid fa-pen-to-square mr-3 text-blue-500 group-hover:text-blue-600"></i>
                                                    Edit
                                                </a>
                                            </div>

                                            <div class="py-1 text-left">
                                                <button type="button" onclick="confirmDelete(this)"
                                                    class="group flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                                    <i class="fa-solid fa-trash mr-3 group-hover:text-red-700"></i>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                        <p>Belum ada histori aspirasi.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xs text-gray-500">
                    Menampilkan <span class="font-medium text-gray-900">1</span> sampai <span class="font-medium text-gray-900">4</span> dari <span class="font-medium text-gray-900">4</span> data
                </div>

                <div class="flex items-center space-x-1">
                    <button class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</button>
                    <button class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Next</button>
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
            title: 'Hapus Histori?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const row = button.closest('tr');
                row.style.transition = 'all 0.5s';
                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';
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
                    title: 'Histori berhasil dihapus'
                });
            }
        });
    }
</script> --}}
