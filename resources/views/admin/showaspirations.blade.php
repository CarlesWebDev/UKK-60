@extends('layout.appadmin')

@section('content')

<div class="max-w-4xl mx-auto space-y-6 font-sans">

@if(session('success'))
    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-sm shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <h1 class="text-2xl font-bold text-gray-800">Detail Aspirasi</h1>
    <a href="{{ route('admin.management.aspiration') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="md:col-span-1 p-6 bg-gray-50/50 border-b md:border-b-0 md:border-r border-gray-100 flex flex-col items-center justify-center">
            <div class="w-full aspect-square bg-white rounded-xl overflow-hidden border border-gray-200 mb-6 shadow-sm flex items-center justify-center">
                @if ($aspiration->photo)
                    <img src="{{ asset('storage/' . $aspiration->photo) }}" alt="Bukti" class="w-full h-full object-cover">
                @else
                    <i class="fa-regular fa-image text-5xl text-gray-300"></i>
                @endif
            </div>

            @php
                $statusClass = match ($aspiration->status) {
                    'pending' => 'bg-gray-50 text-gray-600 border-gray-200',
                    'progress' => 'bg-blue-50 text-blue-600 border-blue-200',
                    'completed' => 'bg-green-50 text-green-600 border-green-200',
                    'rejected' => 'bg-red-50 text-red-600 border-red-200',
                    default => 'bg-gray-50 text-gray-600 border-gray-200',
                };
                $dotClass = match ($aspiration->status) {
                    'pending' => 'bg-gray-400',
                    'progress' => 'bg-blue-500',
                    'completed' => 'bg-green-500',
                    'rejected' => 'bg-red-500',
                    default => 'bg-gray-400',
                };
            @endphp
            <div class="w-full">
                <span class="flex justify-center items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-bold border w-full {{ $statusClass }} uppercase tracking-wide">
                    <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                    {{ $aspiration->status }}
                </span>
            </div>
        </div>

        <div class="md:col-span-2 p-6 md:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-3">{{ $aspiration->title }}</h2>
            <p class="text-gray-600 text-sm mb-8 leading-relaxed whitespace-pre-line">{{ $aspiration->description }}</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Pengirim</div>
                    <div class="font-medium text-gray-900 text-sm">{{ $aspiration->student->name ?? 'Unknown' }}</div>
                    <div class="text-xs text-blue-600 mt-0.5">{{ $aspiration->student->nisn ?? '-' }}</div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Kategori</div>
                    <div class="font-medium text-gray-900 text-sm">{{ $aspiration->category->category_name ?? 'Uncategorized' }}</div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Lokasi</div>
                    <div class="font-medium text-gray-900 text-sm">{{ $aspiration->location }}</div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Waktu</div>
                    <div class="font-medium text-gray-900 text-sm">{{ $aspiration->created_at->format('d M Y') }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">{{ $aspiration->created_at->format('H:i') }} WIB</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden p-6 md:p-8">
    <h3 class="text-lg font-bold text-gray-800 mb-6">Tindak Lanjut & Feedback</h3>

    <form action="{{ route('admin.aspirations.feedback', $aspiration->id) }}" method="POST">
        @csrf
        <div class="space-y-5">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                <select name="status" id="status" class="w-full bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 block p-3 outline-none transition">
                    <option value="pending" {{ $aspiration->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="progress" {{ $aspiration->status == 'progress' ? 'selected' : '' }}>Progress</option>
                    <option value="completed" {{ $aspiration->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ $aspiration->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div>
                <label for="information" class="block text-sm font-medium text-gray-700 mb-2">Pesan Feedback</label>
                <textarea name="information" id="information" rows="4" class="w-full bg-white border border-gray-200 rounded-lg p-3 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-y" placeholder="Masukkan pesan feedback untuk siswa..." required>{{ $aspiration->feedback->information ?? '' }}</textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg text-sm transition shadow-sm flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Feedback
                </button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
