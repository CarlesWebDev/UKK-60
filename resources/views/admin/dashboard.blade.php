@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 font-sans py-6">

        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white p-6 rounded-xl border border-blue-100 shadow-sm gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1"> Selamat Datang
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
                class="bg-white p-4 rounded-xl border border-blue-100 shadow-sm flex flex-col xl:flex-row xl:items-center justify-between gap-4">
                <h2 class="text-lg font-bold text-gray-800 whitespace-nowrap">Daftar Aspirasi Terbaru</h2>

                <form action="{{ url()->current() }}" method="GET"
                    class="flex flex-col sm:flex-row flex-wrap gap-2 w-full xl:w-auto justify-end">
                    <select name="category_id" onchange="this.form.submit()"
                        class="w-full sm:w-auto bg-gray-50 border pe-8 border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none hover:bg-white transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="student_id" onchange="this.form.submit()"
                        class="w-full sm:w-auto bg-gray-50 border pe-8 border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none hover:bg-white transition">
                        <option value="">Semua Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}"
                                {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                        title="Filter per Tanggal"
                        class="w-full sm:w-auto bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none hover:bg-white transition">

                    @if (request()->anyFilled(['category_id', 'student_id', 'date', 'month']))
                        <a href="{{ url()->current() }}"
                            class="flex items-center justify-center px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium border border-red-100 hover:bg-red-100 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($Dataaspirations as $aspiration)
                    <div
                        class="bg-white rounded-xl border border-blue-100 shadow-sm hover:shadow-md hover:border-blue-300 transition duration-200 p-5 flex flex-col justify-between h-full">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span
                                        class="bg-blue-50 text-blue-700 text-xs font-bold px-2 py-1 rounded border border-blue-100">Laporan
                                        - {{ str_pad($aspiration->id, 3, '0', STR_PAD_LEFT) }}</span>
                                    <p class="text-xs text-gray-400 mt-2">{{ $aspiration->created_at->format('d M Y') }}
                                    </p>
                                </div>

                                @if ($aspiration->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-600 border border-orange-100">
                                        {{ ucfirst($aspiration->status) }}
                                    </span>
                                @elseif ($aspiration->status === 'progress')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-50 text-purple-600 border border-purple-100">
                                        {{ ucfirst($aspiration->status) }}
                                    </span>
                                @elseif ($aspiration->status === 'completed')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-50 text-teal-600 border border-teal-100">
                                        {{ ucfirst($aspiration->status) }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-600 border border-red-100">
                                        {{ ucfirst($aspiration->status) }}
                                    </span>
                                @endif
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
                                    <i class="fa-solid w-4 h-4 mr-2 fa-tag"></i>
                                    <span class="font-medium">{{ $aspiration->category->category_name ?? '-' }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fa-solid w-4 h-4 mr-2 fa-location-dot"></i>
                                    <span class="truncate">{{ $aspiration->location ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-8 text-center rounded-xl border border-gray-100">
                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                        <p class="text-gray-500 text-sm">Belum ada data aspirasi yang ditemukan.</p>
                    </div>
                @endforelse
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
