@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 font-sans">

        <div class="flex max-w-4xl mx-auto flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola kategori aspirasi dalam sistem</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.create.category') }}"
                    class="flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm font-medium">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kategori
                </a>
            </div>
        </div>

        <div class="bg-white max-w-4xl  mx-auto rounded-xl border border-blue-100 shadow-sm">

            <div class="p-5 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <form method="GET" action="{{ route('admin.category.management') }}" class="flex w-full md:w-auto gap-2">
                    <div class="relative w-full md:w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg w-full focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm">
                        <i class="fas fa-search text-blue-500"></i>
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium w-16">No</th>
                            <th scope="col" class="px-6 py-3 font-medium">Nama Kategori</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($categories as $category)
                            <tr class="bg-white hover:bg-blue-50/30 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $category->category_name }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div x-data="{ modalIsOpen: false }" class="flex justify-end items-center">
                                        <button x-on:click="modalIsOpen = true" type="button"
                                            class="p-2 text-red-600 rounded-lg cursor-pointer hover:bg-red-50 transition"
                                            title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                            x-trap.inert.noscroll="modalIsOpen"
                                            x-on:keydown.esc.window="modalIsOpen = false"
                                            x-on:click.self="modalIsOpen = false"
                                            class="fixed inset-0 z-50 flex items-end justify-center  p-4 pb-8 sm:items-center lg:p-8"
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
                                                            Kategori</h3>
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
                                                        ingin menghapus kategori ini? Jika Anda menghapus kategori ini, data
                                                        tidak dapat dikembalikan!</p>
                                                </div>

                                                <div
                                                    class="flex flex-col-reverse justify-between gap-2 border-t border-gray-200 bg-gray-50 p-4 sm:flex-row sm:items-center md:justify-end">
                                                    <button x-on:click="modalIsOpen = false" type="button"
                                                        class="whitespace-nowrap rounded-lg px-4 py-2 text-center text-sm font-medium tracking-wide text-gray-700 bg-white border border-gray-300 transition hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 sm:w-auto w-full">Batal</button>

                                                    <form action="{{ route('admin.delete.category', $category->id) }}"
                                                        method="POST" class="m-0 p-0 sm:w-auto w-full">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full whitespace-nowrap rounded-lg bg-red-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Hapus</button>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                    Data kategori tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row justify-between">
                <div class="text-xs p-4 text-gray-500">
                    Menampilkan
                    <span class="font-medium text-gray-900">{{ $categories->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-medium text-gray-900">{{ $categories->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-medium text-gray-900">{{ $categories->total() }}</span>
                    kategori
                </div>

                <div class=" p-2 border-gray-100">
                    @if ($categories->onFirstPage())
                        <span
                            class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $categories->previousPageUrl() }}"
                            class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Prev</a>
                    @endif

                    @if ($categories->hasMorePages())
                        <a href="{{ $categories->nextPageUrl() }}"
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
{{-- @extends('layout.appadmin')

@section('content')
    @php
        $categories = [
            (object) ['id' => 1, 'category_name' => 'Fasilitas Sekolah'],
            (object) ['id' => 2, 'category_name' => 'Kurikulum & Pembelajaran'],
            (object) ['id' => 3, 'category_name' => 'Kebersihan Lingkungan'],
            (object) ['id' => 4, 'category_name' => 'Kantin & Makanan'],
            (object) ['id' => 5, 'category_name' => 'Ekstrakurikuler'],
        ];
    @endphp

    <div class="space-y-6 font-sans">

        <div class="flex max-w-4xl mx-auto flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola kategori aspirasi dalam sistem</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.create.category') }}"
                    class="flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm font-medium">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kategori
                </a>
            </div>
        </div>

        <div class="bg-white max-w-4xl mx-auto rounded-xl border border-blue-100 shadow-sm">

            <div class="p-5 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <form id="searchForm" class="flex w-full md:w-auto gap-2">
                    <div class="relative w-full md:w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="searchInput" placeholder="Cari kategori..."
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg w-full focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm">
                        <i class="fas fa-search text-blue-500"></i>
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium w-16">No</th>
                            <th scope="col" class="px-6 py-3 font-medium">Nama Kategori</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($categories as $index => $category)
                            <tr class="bg-white hover:bg-blue-50/30 transition group">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $category->category_name }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button
                                            class="p-2 text-blue-600 rounded-lg cursor-pointer hover:bg-blue-50 transition"
                                            title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <button type="button"
                                            class="p-2 text-red-600 rounded-lg cursor-pointer hover:bg-red-50 transition"
                                            onclick="confirmDelete(this)" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row justify-between items-center border-t border-gray-100">
                <div class="text-xs p-5 text-gray-500">
                    Menampilkan
                    <span class="font-medium text-gray-900">1</span>
                    sampai
                    <span class="font-medium text-gray-900">5</span>
                    dari
                    <span class="font-medium text-gray-900">5</span>
                    kategori
                </div>

                <div class="p-4 flex gap-1">
                    <span
                        class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</span>
                    <span
                        class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Next</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = document.getElementById('searchInput').value;
            Swal.fire({
                title: 'Mencari...',
                text: `Mencari kategori: "${keyword}"`,
                timer: 800,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        });

        function confirmDelete(button) {
            Swal.fire({
                title: 'Hapus Kategori?',
                text: "Kategori yang dihapus tidak dapat dikembalikan!",
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
                    setTimeout(() => {
                        row.remove();
                    }, 500);

                    Swal.fire(
                        'Terhapus!',
                        'Kategori berhasil dihapus',
                        'success'
                    );
                }
            });
        }
    </script>
@endsection --}}
