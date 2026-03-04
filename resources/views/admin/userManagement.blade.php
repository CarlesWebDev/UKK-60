@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 font-sans">

        <div class="flex flex-col max-w-4xl mx-auto  md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Data Siswa</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola data siswa dalam sistem</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.create.student') }}"
                    class="flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm font-medium">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Siswa
                </a>
            </div>
        </div>

        <div class="bg-white max-w-4xl mx-auto rounded-xl border border-blue-100 shadow-sm">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-5 border-b border-gray-100 bg-blue-50/20">
                <div class="flex justify-between items-start p-2">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Siswa</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalStudents }}</p>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                        <i class="fas fa-users text-lg"></i>
                    </div>
                </div>

                <div class="flex justify-between items-start p-2 border-l-0 md:border-l border-gray-100 pl-0 md:pl-6">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Terdaftar</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalClasses }}</p>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                </div>
            </div>

            <div class="p-5 border-b border-gray-100">
                <form action="{{ route('admin.user.management') }}" method="GET"
                    class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari siswa (Nama/NISN)..."
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg w-full focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <select name="grade" onchange="this.form.submit()"
                            class="bg-white border  border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 pe-10 outline-none">
                            <option value="Semua Kelas">Semua Kelas</option>
                            @foreach ($grades as $gradeOption)
                                <option value="{{ $gradeOption }}"
                                    {{ request('grade') == $gradeOption ? 'selected' : '' }}>
                                    {{ $gradeOption }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class="bg-white text-gray-600 border border-gray-200 px-4 py-2 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition text-sm">
                            <i class="fas fa-search text-blue-500"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full mx-auto text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">NISN</th>
                            <th scope="col" class="px-6 py-3 font-medium">Nama</th>
                            <th scope="col" class="px-6 py-3 font-medium">Kelas</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($students as $student)
                            <tr class="bg-white hover:bg-blue-50/30 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $student->nisn }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs mr-3 uppercase">
                                            {{ substr($student->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $student->name }}</div>
                                            <div class="text-xs text-gray-500">Siswa Sekolah</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-gray-600 bg-gray-100 px-2 py-1 rounded text-xs">{{ $student->grade }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
    <div class="flex justify-end items-center" x-data="{modalIsOpen: false}">
        <a href="{{ route('admin.edit.student', $student->id) }}" class="text-blue-600 hover:text-blue-900 text-xs font-medium mr-3 cursor-pointer">
            <i class="fa-solid fa-pen"></i>
        </a>

        <button x-on:click="modalIsOpen = true" type="button" class="text-red-600 hover:text-red-900 cursor-pointer" title="Hapus">
            <i class="fa-solid fa-trash"></i>
        </button>

        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false" class="fixed inset-0 z-50 flex items-end justify-center bg-black/20 p-4 pb-8  sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">

            <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" class="flex max-w-lg w-full flex-col gap-4 overflow-hidden rounded-xl border border-gray-200 bg-white text-gray-900 text-left shadow-xl">

                <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50/60 p-4">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-full bg-red-100">
                            <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                        </div>
                        <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-gray-900 text-lg">Hapus Siswa</h3>
                    </div>
                    <button x-on:click="modalIsOpen = false" aria-label="close modal" class="text-gray-400 hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="px-4 py-6 text-left">
                    <p class="text-sm text-gray-600 whitespace-normal">Apakah Anda yakin ingin menghapus data siswa ini? Jika dihapus, data tidak dapat dikembalikan.</p>
                </div>

                <div class="flex flex-col-reverse justify-between gap-2 border-t border-gray-200 bg-gray-50 p-4 sm:flex-row sm:items-center md:justify-end">
                    <button x-on:click="modalIsOpen = false" type="button" class="whitespace-nowrap rounded-lg px-4 py-2 text-center text-sm font-medium tracking-wide text-gray-700 bg-white border border-gray-300 transition hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 sm:w-auto w-full">Batal</button>

                    <form action="{{ route('admin.delete.student', $student->id) }}" method="POST" class="m-0 p-0 sm:w-auto w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full whitespace-nowrap rounded-lg bg-red-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Hapus</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xs text-gray-500">
                    Menampilkan
                    <span class="font-medium text-gray-900">{{ $students->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-medium text-gray-900">{{ $students->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-medium text-gray-900">{{ $students->total() }}</span>
                    siswa
                </div>

                <div class="flex items-center space-x-1">
                    @if ($students->onFirstPage())
                        <span
                            class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $students->previousPageUrl() }}"
                            class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Prev</a>
                    @endif

                    @if ($students->hasMorePages())
                        <a href="{{ $students->nextPageUrl() }}"
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
        $students = [
            (object) ['id' => 1, 'nisn' => '0081234567', 'name' => 'Ahmad Rizky', 'grade' => 'XII RPL 1'],
            (object) ['id' => 2, 'nisn' => '0081234568', 'name' => 'Bunga Lestari', 'grade' => 'XI PPLG 2'],
            (object) ['id' => 3, 'nisn' => '0081234569', 'name' => 'Chandra Gunawan', 'grade' => 'X DKV 1'],
            (object) ['id' => 4, 'nisn' => '0081234570', 'name' => 'Dinda Kirana', 'grade' => 'XII RPL 1'],
            (object) ['id' => 5, 'nisn' => '0081234571', 'name' => 'Erik Setiawan', 'grade' => 'XI TKJ 2'],
        ];
    @endphp

    <div class="space-y-6 font-sans">

        <div class="flex flex-col max-w-4xl mx-auto md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Data Siswa</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola data siswa dalam sistem</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.create.student') }}"
                    class="flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm font-medium">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Siswa
                </a>
            </div>
        </div>

        <div class="bg-white max-w-4xl mx-auto rounded-xl border border-blue-100 shadow-sm">


            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-5 border-b border-gray-100 bg-blue-50/20">
                <div class="flex justify-between items-start p-2">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Siswa</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">452</p>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                        <i class="fas fa-users text-lg"></i>
                    </div>
                </div>

                <div class="flex justify-between items-start p-2 border-l-0 md:border-l border-gray-100 pl-0 md:pl-6">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Terdaftar</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">12</p>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                </div>
            </div>


            <div class="p-5 border-b border-gray-100">
                <form id="searchForm" class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="searchInput" placeholder="Cari siswa (Nama/NISN)..."
                            class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg w-full focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <select class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 pe-10 outline-none">
                            <option value="Semua Kelas">Semua Kelas</option>
                            <option value="XII RPL 1">XII RPL 1</option>
                            <option value="XI PPLG 2">XI PPLG 2</option>
                            <option value="X DKV 1">X DKV 1</option>
                        </select>

                        <button type="submit"
                            class="bg-white text-gray-600 border border-gray-200 px-4 py-2 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition text-sm">
                            <i class="fas fa-search text-blue-500"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full mx-auto text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">NISN</th>
                            <th scope="col" class="px-6 py-3 font-medium">Nama</th>
                            <th scope="col" class="px-6 py-3 font-medium">Kelas</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($students as $student)
                            <tr class="bg-white hover:bg-blue-50/30 transition group">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $student->nisn }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs mr-3 uppercase">
                                            {{ substr($student->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $student->name }}</div>
                                            <div class="text-xs text-gray-500">Siswa Sekolah</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600 bg-gray-100 px-2 py-1 rounded text-xs">{{ $student->grade }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">

                                    <a href="{{ route('admin.edit.student', $student->id) }}"
                                        class="text-blue-600 hover:text-blue-900 text-xs font-medium mr-3 cursor-pointer">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <button type="button" onclick="confirmDelete(this)"
                                        class="text-red-600 hover:text-red-900 cursor-pointer transition-colors">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xs text-gray-500">
                    Menampilkan <span class="font-medium text-gray-900">1</span> sampai <span class="font-medium text-gray-900">5</span> dari <span class="font-medium text-gray-900">452</span> siswa
                </div>

                <div class="flex items-center space-x-1">
                    <span class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</span>
                    <a href="#" class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Next</a>
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
                text: `Mencari siswa dengan kata kunci: "${keyword}"`,
                timer: 800,
                didOpen: () => { Swal.showLoading() }
            });
        });

        // Simulasi Delete
        function confirmDelete(button) {
            Swal.fire({
                title: 'Hapus Siswa?',
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
                    setTimeout(() => {
                        row.remove();
                    }, 500);

                    Swal.fire(
                        'Terhapus!',
                        'Data siswa berhasil dihapus (Demo Mode).',
                        'success'
                    );
                }
            });
        }
    </script>
@endsection --}}
