@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 font-sans">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Siswa</h1>
                <p class="text-gray-500 text-sm mt-1">Perbarui informasi siswa dalam sistem</p>
            </div>
            <a href="{{ route('admin.user.management') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class=" p-6 max-w-2xl rounded-lg">
            <form action="{{ route('admin.update.student', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                        <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $student->nisn) }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                            @error('nisn') border-red-500 @enderror"
                            placeholder="Masukkan NISN">
                        @error('nisn')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                            @error('name') border-red-500 @enderror"
                            placeholder="Masukkan nama lengkap">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <input type="text" name="grade" id="grade" value="{{ old('grade', $student->grade) }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                            @error('grade') border-red-500 @enderror"
                            placeholder="Contoh: X RPL 1">
                        @error('grade')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                            @error('password') border-red-500 @enderror"
                            placeholder="Biarkan kosong jika tidak ingin mengganti password">
                        <p class="text-xs text-gray-400 mt-1">Minimal 8 karakter.</p>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex items-center gap-3">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition">
                        Simpan Perubahan
                    </button>
                    {{-- <a href="{{ route('admin.user.management') }}"
                        class="px-6 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                        Batal
                    </a> --}}
                </div>
            </form>
        </div>
    </div>
@endsection
