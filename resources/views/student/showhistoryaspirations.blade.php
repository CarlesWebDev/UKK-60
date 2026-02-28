@extends('layout.appstudent')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Detail dan Progress Aspirasi</h2>
                <p class="text-sm text-gray-500 mt-1">Pantau status dan tindak lanjut dari laporan Anda.</p>
            </div>
            <a href="{{ route('student.history') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="md:col-span-1 p-6 bg-gray-50/50 border-b md:border-b-0 md:border-r border-gray-100 flex flex-col items-center justify-center">
                    <div class="w-full aspect-square bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm flex items-center justify-center">
                        @if ($aspiration->photo)
                            <img src="{{ asset('storage/' . $aspiration->photo) }}" alt="Foto Aspirasi" class="w-full h-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-2 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-3">{{ $aspiration->title }}</h2>
                    <p class="text-gray-600 text-sm mb-8 leading-relaxed whitespace-pre-wrap">{{ $aspiration->description }}</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Pengirim</div>
                            <div class="font-medium text-gray-900 text-sm">{{ $aspiration->student->name ?? 'Unknown' }}</div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Lokasi</div>
                            <div class="font-medium text-gray-900 text-sm">{{ $aspiration->location }}</div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Kategori</div>
                            <div class="font-medium text-gray-900 text-sm">{{ $aspiration->category->category_name ?? 'Tanpa Kategori' }}</div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 shadow-sm">
                            <div class="text-xs text-gray-400 mb-1 uppercase tracking-wider">Tanggal</div>
                            <div class="font-medium text-gray-900 text-sm">{{ $aspiration->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $aspiration->created_at->format('H:i') }} WIB</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden p-6 md:p-8">
            @php
                $status = $aspiration->status === 'archived' ? 'completed' : $aspiration->status;
            @endphp

            <h3 class="text-lg font-bold text-gray-800 mb-6">Status & Tindak Lanjut</h3>

            <div class="mb-8">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ in_array($status, ['pending', 'progress', 'completed', 'rejected']) ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-500' }}">
                        Pending
                    </span>

                    @if ($status === 'rejected')
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-600 text-white shadow-sm">
                            Rejected
                        </span>
                    @else
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ in_array($status, ['progress', 'completed']) ? 'bg-yellow-400 text-yellow-900 shadow-sm' : 'bg-gray-100 text-gray-500' }}">
                            Progress
                        </span>

                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $status === 'completed' ? 'bg-green-600 text-white shadow-sm' : 'bg-gray-100 text-gray-500' }}">
                            Completed
                        </span>
                    @endif
                </div>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-5 rounded-r-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h6 class="text-sm font-bold text-blue-900 mb-1">Feedback Admin:</h6>
                        <p class="text-sm text-blue-800 m-0">
                            {{ $aspiration->feedback->information ?? 'Belum ada tanggapan atau feedback dari admin.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
