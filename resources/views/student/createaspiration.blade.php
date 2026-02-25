@extends('layout.appstudent')

@section('content')
    <div class="max-w-4xl mx-auto font-sans">
       

        <div class=" rounded-xl  p-6 sm:p-8">

            <div class="mb-6 flex flex-col justify-between md:flex-row border-b border-gray-100 pb-4">
                <div class="">
                    <h1 class="text-2xl font-bold text-gray-800">Buat Aspirasi Baru</h1>
                    <p class="text-gray-500 text-sm mt-1">
                        Silakan isi form di bawah ini untuk menyampaikan laporan atau aspirasi Anda.
                    </p>
                </div>
                <div class="">
                    <a href="{{ route('student.dashboard') }}"
                        class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>

                </div>
            </div>

            <form action="{{ route('student.storeaspirations') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition duration-150 ease-in-out @error('title') border-red-500 @enderror"
                        placeholder=" AC di Lab Komputer Bocor">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm @error('category_id') border-red-500 @enderror">
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kejadian</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm @error('location') border-red-500 @enderror"
                            placeholder="Gedung B Lantai 2">
                        @error('location')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm @error('description') border-red-500 @enderror"
                        placeholder="Jelaskan detail permasalahan..."></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti (Opsional)</label>
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="photo"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span id="file-name">Upload file</span>
                                    <input id="photo" name="photo" type="file" class="sr-only" accept="image/*"
                                        onchange="document.getElementById('file-name').innerText = this.files[0].name">
                                </label>

                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                        </div>
                    </div>
                    @error('photo')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium transition-colors">
                        Kirim Aspirasi
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection




{{-- Demo --}}
{{-- @extends('layout.appstudent')

@section('content')
    @php
        $categories = [
            (object) ['id' => 1, 'category_name' => 'Fasilitas Kelas'],
            (object) ['id' => 2, 'category_name' => 'Sanitasi (Toilet/Air)'],
            (object) ['id' => 3, 'category_name' => 'Kelistrikan'],
            (object) ['id' => 4, 'category_name' => 'Kebersihan Lingkungan'],
            (object) ['id' => 5, 'category_name' => 'Kantin & Makanan'],
            (object) ['id' => 6, 'category_name' => 'Kesiswaan (Ekskul/OSIS)'],
        ];
    @endphp

    <div class="max-w-4xl mx-auto font-sans">

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm p-6 sm:p-8">

            <div class="mb-6 flex flex-col justify-between md:flex-row border-b border-gray-100 pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Buat Aspirasi Baru</h1>
                    <p class="text-gray-500 text-sm mt-1">
                        Silakan isi form di bawah ini untuk menyampaikan laporan atau aspirasi Anda.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('student.dashboard') }}"
                        class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>

            <form id="createAspirationForm" class="space-y-6">

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" id="title"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition duration-150 ease-in-out"
                        placeholder="Contoh: AC di Lab Komputer Bocor">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="category_id"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kejadian</label>
                        <input type="text" id="location"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                            placeholder="Contoh: Gedung B Lantai 2">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                    <textarea id="description" rows="4"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                        placeholder="Jelaskan detail permasalahan secara singkat dan jelas..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition cursor-pointer relative">
                        <input id="photo" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*"
                            onchange="updateFileName(this)">

                        <div class="space-y-1 text-center pointer-events-none">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <span class="relative bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span id="file-name-display">Upload file</span>
                                </span>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium transition-colors flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Aspirasi
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('file-name-display');
            if (input.files && input.files[0]) {
                fileNameDisplay.innerText = input.files[0].name;
                fileNameDisplay.classList.add('text-green-600');
            } else {
                fileNameDisplay.innerText = "Upload file";
                fileNameDisplay.classList.remove('text-green-600');
            }
        }

        document.getElementById('createAspirationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Kirim',
                text: "Pastikan laporan Anda sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mengirim...',
                        text: 'Mohon tunggu sebentar',
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        Swal.fire({
                            title: 'Terkirim!',
                            text: 'Aspirasi Anda berhasil dikirim (Mode Demo).',
                            icon: 'success',
                            confirmButtonText: 'Lihat Dashboard'
                        }).then(() => {
                            window.location.href = "{{ route('student.dashboard') }}";
                        });
                    });
                }
            });
        });
    </script>
@endsection --}}
