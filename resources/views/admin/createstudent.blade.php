@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 font-sans">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Buat Siswa Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Tambah Siswa Baru Ke sistem</p>
            </div>
            <a href="{{ route('admin.user.management') }}"
                class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <div class="bg-white p-6  max-w-2xl">
            <form action="{{ route('admin.store.student') }}" method="POST">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                        <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                    @error('nisn') border-red-500 @enderror"
                            placeholder="Enter NISN">
                        @error('nisn')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                            @error('name') border-red-500 @enderror"
                            placeholder="Enter full name">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
                        <input type="text" name="grade" id="grade" value="{{ old('grade') }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                            @error('grade') border-red-500 @enderror"
                            placeholder="e.g. X RPL 1">
                        @error('grade')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                             @error('password') border-red-500 @enderror"
                            placeholder="Set account password">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-3">
                    {{-- <button type="button" onclick="history.back()"
                        class="px-5 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium transition">
                        Cancel
                    </button> --}}
                    <button type="submit"
                        class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium shadow-sm transition flex items-center">
                        Tambah Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection













{{-- Demo --}}
{{-- @extends('layout.appadmin')

@section('content')
    <div class="space-y-6 font-sans">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Buat Siswa Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Tambah Siswa Baru Ke sistem</p>
            </div>
            <a href="{{ route('admin.user.management') }}"
                class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white p-6 max-w-2xl rounded-xl border border-gray-100 shadow-sm">
            <form id="createStudentForm" class="space-y-5">
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                    <input type="text" id="nisn"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400"
                        placeholder="Masukkan NISN">
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="name"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400"
                        placeholder="Masukkan nama lengkap">
                </div>

                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <input type="text" id="grade"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400"
                        placeholder="Contoh: XII RPL 1">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400"
                        placeholder="Set password akun">
                </div>

                <div class="mt-8 flex items-center justify-end gap-3">
                    <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium shadow-sm transition flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('createStudentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: "Pastikan data siswa yang dimasukkan sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data siswa berhasil disimpan.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('admin.user.management') }}";
                        });
                    });
                }
            });
        });
    </script>
@endsection --}}
