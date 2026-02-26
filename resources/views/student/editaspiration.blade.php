@extends('layout.appstudent')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6 font-sans">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-800">Edit Laporan Aspirasi</h1>
            <a href="{{ route('student.dashboard') }}"
                class="text-sm font-medium text-gray-500 hover:text-blue-600 transition flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden p-6 md:p-8">
            <form action="{{ route('student.update.aspiration', $aspiration->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                        <input type="text" name="title" id="title"
                            class="w-full bg-white border border-gray-200 rounded-lg p-3 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('title') border-red-500 @enderror"
                            value="{{ old('title', $aspiration->title) }}">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="category_id" id="category_id"
                                class="w-full bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $aspiration->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input type="text" name="location" id="location"
                                class="w-full bg-white border border-gray-200 rounded-lg p-3 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('location') border-red-500 @enderror"
                                value="{{ old('location', $aspiration->location) }}">
                            @error('location')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Isi Laporan</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full bg-white border border-gray-200 rounded-lg p-3 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y @error('description') border-red-500 @enderror">{{ old('description', $aspiration->description) }}
                        </textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti
                            (Opsional)</label>

                        @if ($aspiration->photo)
                            <div class="mb-4">
                                <p class="text-xs text-gray-500 mb-2">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $aspiration->photo) }}" alt=""
                                    class="h-32 w-auto rounded-lg border border-gray-200 object-cover shadow-sm">
                            </div>
                        @endif

                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full bg-white border border-gray-200 rounded-lg p-2 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('photo') border-red-500 @enderror">
                        @error('photo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-5 border-t border-gray-100">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl text-sm transition  flex items-center gap-2 hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
