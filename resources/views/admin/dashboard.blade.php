@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 font-sans py-6">

        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white p-6 rounded-xl border border-blue-100 shadow-sm gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1"> welcome
                    <span class="text-blue-500">{{ auth()->user()->name }}</span>
                    Pantau aspirasi dan pengaduan sarana sekolah.
                </p>
            </div>
            <div class="w-full md:w-auto">
                <div
                    class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium border border-blue-100 text-center md:text-left">
                    {{ \Carbon\Carbon::now()->format('l, d F Y') }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div
                class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between transition hover:-translate-y-1 hover:shadow-md duration-200">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Aspirasi</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $total }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                   <i class="fa-solid text-2xl fa-file"></i>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between transition hover:-translate-y-1 hover:shadow-md duration-200">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Sedang progress</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $proccessingaspirations }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <i class="fa-solid text-2xl fa-arrows-rotate"></i>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between transition hover:-translate-y-1 hover:shadow-md duration-200">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $aspirationdone }}</p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg text-green-600">
                    <i class="fa-regular text-2xl fa-circle-check"></i>
                </div>
            </div>
            <div
                class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm flex items-center justify-between transition hover:-translate-y-1 hover:shadow-md duration-200">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Ditolak</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $rejectedAspirations }}</p>
                </div>
                <div class="p-3 bg-red-50 rounded-lg text-red-600">
                    <i class="fa-solid text-2xl fa-x"></i>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div
                class="bg-white p-4 rounded-xl border border-blue-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h2 class="text-lg font-bold text-gray-800">Daftar Aspirasi Terbaru</h2>

                <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                    <select
                        class="w-full sm:w-auto bg-gray-50 border pe-8 border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none hover:bg-white transition">
                        <option selected>Semua Kategori</option>
                        <option value="1">Sarana</option>
                        <option value="2">Prasarana</option>
                        <option value="3">Kebersihan</option>
                    </select>

                    <select
                        class="w-full sm:w-auto bg-gray-50 border pe-8 border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none hover:bg-white transition">
                        <option selected>Semua Status</option>
                        <option value="pending">pending</option>
                        <option value="progress">progress</option>
                        <option value="completed">completed</option>
                        <option value="rejected">rejected</option>
                    </select>

                    <input type="date"
                        class="w-full sm:w-auto bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none hover:bg-white transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($Dataaspirations as $aspiration)
                    @php
                        $displayStatus = $aspiration->status === 'archived' ? 'completed' : $aspiration->status;
                    @endphp
                    <div
                        class="bg-white rounded-xl border border-blue-100 shadow-sm hover:shadow-md hover:border-blue-300 transition duration-200 p-5 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span
                                        class="bg-blue-50 text-blue-700 text-xs font-bold px-2 py-1 rounded border border-blue-100">Laporan - {{ str_pad($aspiration->id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <p class="text-xs text-gray-400 mt-2">{{ $aspiration->created_at->format('d M Y') }}</p>
                                </div>

                                <span
                                    class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-full border
                                    @if ($displayStatus == 'pending') bg-gray-100 text-gray-600 border-gray-200
                                    @elseif($displayStatus == 'progress') bg-blue-50 text-blue-700 border-blue-100
                                    @elseif($displayStatus == 'completed') bg-green-50 text-green-700 border-green-100
                                    @elseif($displayStatus == 'rejected') bg-red-50 text-red-700 border-red-100
                                    @else bg-gray-100 text-gray-600 border-gray-200 @endif">
                                    <span
                                        class="w-1.5 h-1.5 me-1.5 rounded-full
                                        @if ($displayStatus == 'pending') bg-gray-400
                                        @elseif($displayStatus == 'progress') bg-blue-600
                                        @elseif($displayStatus == 'completed') bg-green-600
                                        @elseif($displayStatus == 'rejected') bg-red-600
                                        @else bg-gray-400 @endif">
                                    </span>
                                    {{ ucfirst($displayStatus) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <h3 class="font-bold text-gray-800 text-lg line-clamp-1">{{ $aspiration->title }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <p class="text-sm text-gray-500 font-medium">
                                        {{ $aspiration->student->name ?? 'Unknown' }}</p>
                                </div>
                                <p class="font-normal text-gray-500">{{ $aspiration->student->grade ?? '-' }}</p>
                            </div>

                            <div class="space-y-2 border-t border-gray-50 pt-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    <span class="font-medium">{{ $aspiration->category->category_name ?? '-' }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $aspiration->location ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

             <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xs text-gray-500">
                    Menampilkan
                    <span class="font-medium text-gray-900">{{ $Dataaspirations->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-medium text-gray-900">{{ $Dataaspirations->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-medium text-gray-900">{{ $Dataaspirations->total() }}</span>
                    siswa
                </div>

                <div class="flex items-center space-x-1">
                    @if ($Dataaspirations->onFirstPage())
                        <span
                            class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $Dataaspirations->previousPageUrl() }}"
                            class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Prev</a>
                    @endif

                    @if ($Dataaspirations->hasMorePages())
                        <a href="{{ $Dataaspirations->nextPageUrl() }}"
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
