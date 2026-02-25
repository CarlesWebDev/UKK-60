@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 font-sans">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Buat Kategori Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Tambah Kategori Baru Ke sistem</p>
            </div>
            <a href="{{ route('admin.category.management') }}"
                class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <div class="bg-white p-6  max-w-2xl">
            <form action="{{ route('admin.store.category') }}" method="POST">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="category_name" class="block text-sm font-medium text-gray-700 mb-1">Category
                            Name</label>
                        <input type="text" name="category_name" id="category_name" value="{{ old('category_name') }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400
                            @error('category_name') border-red-500 @enderror"
                            placeholder="Enter category name">
                        @error('category_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition text-sm">
                            Create Category
                        </button>
                    </div>
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
                <h1 class="text-2xl font-bold text-gray-800">Buat Kategori Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Tambah Kategori Baru Ke sistem</p>
            </div>
            <a href="{{ route('admin.category.management') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class=" p-6 max-w-2xl rounded-xl ">
            <form id="createCategoryForm">
                <div class="space-y-5">
                    <div>
                        <label for="category_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" id="category_name"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-800 placeholder-gray-400"
                            placeholder="Masukkan nama kategori">
                    </div>

                    <div>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition text-sm shadow-sm flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('createCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Simpan',
                text: "Pastikan nama kategori sudah sesuai.",
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
                            text: 'Kategori berhasil ditambahkan',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('admin.category.management') }}";
                        });
                    });
                }
            });
        });
    </script>
@endsection --}}
