@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto font-sans pb-8">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Aspirasi</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola daftar laporan dan pantau status penyelesaian.</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <form action="{{ route('admin.management.aspiration') }}" method="GET"
                class="flex flex-col md:flex-row flex-wrap items-center gap-3">

                <div class="w-full md:w-auto">
                    <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none transition-colors">
                </div>

                <div class="w-full md:w-auto">
                    <select name="category_id" onchange="this.form.submit()"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none min-w-[150px] transition-colors">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-auto">
                    <select name="status" onchange="this.form.submit()"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none min-w-[150px] transition-colors">
                        <option value="">Semua (Aktif)</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>Progress</option>
                    </select>
                </div>

                <div class="relative flex-grow w-full md:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul, pengirim, lokasi..."
                        class="pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition-colors">
                </div>

                @if (request()->anyFilled(['date', 'category_id', 'status', 'search']))
                    <a href="{{ route('admin.management.aspiration') }}"
                        class="w-full md:w-auto text-center px-4 py-2.5 text-sm text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 font-medium rounded-lg transition-colors border border-red-100">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-visible">
            <div class="overflow-x-auto overflow-y-visible">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-center w-20">Foto</th>
                            <th class="px-6 py-4">Judul & Laporan</th>
                            <th class="px-6 py-4">Pengirim</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse ($aspirations as $item)
                            <tr class="hover:bg-blue-50/50 transition duration-150">
                                <td class="px-6 py-4">
                                    <div
                                        class="h-12 w-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200 mx-auto">
                                        @if ($item->photo)
                                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Bukti"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <i class="fa-regular fa-image text-lg"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-900 block truncate max-w-[200px]"
                                        title="{{ $item->title }}">{{ $item->title }}</span>
                                    <p class="text-gray-500 text-xs mt-1 truncate max-w-[200px]"
                                        title="{{ $item->description }}">
                                        {{ Str::limit($item->description, 40) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-9 w-9 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs border border-blue-200 flex-shrink-0">
                                            {{ strtoupper(substr($item->student->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $item->student->name ?? 'Unknown' }}
                                            </p>
                                            <p class="text-gray-400 text-xs mt-0.5">{{ $item->student->nisn ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-gray-600 text-sm">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        <span class="truncate max-w-[150px]"
                                            title="{{ $item->location }}">{{ $item->location }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                        {{ $item->category->category_name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 text-sm font-medium">{{ $item->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-gray-500 text-xs mt-0.5">{{ $item->created_at->format('H:i') }} WIB
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = match ($item->status) {
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'progress' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            default => 'bg-gray-50 text-gray-700 border-gray-200',
                                        };
                                        $dotClass = match ($item->status) {
                                            'pending' => 'bg-amber-500',
                                            'progress' => 'bg-blue-500',
                                            default => 'bg-gray-500',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 relative" x-data="{ open: false }">
                                    <div class="flex justify-center items-center">
                                        <button @click="open = !open" @click.outside="open = false"
                                            class="text-gray-400 hover:text-blue-600 focus:outline-none p-2 rounded-full hover:bg-blue-50 transition-colors">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>

                                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-10 top-1/2 -translate-y-1/2 w-32 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                                            <a href="{{ route('admin.show.aspirations', $item->id) }}"
                                                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors rounded-lg m-1">
                                                <i class="fa-regular fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <div
                                            class="h-16 w-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fa-regular fa-folder-open text-2xl text-gray-400"></i>
                                        </div>
                                        <p class="text-base font-medium text-gray-900">Tidak ada aspirasi</p>
                                        <p class="text-sm mt-1">Belum ada data yang sesuai dengan pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div
                class="p-5 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4 bg-gray-50/50 rounded-b-xl">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $aspirations->firstItem() ?? 0 }}</span>
                    sampai <span class="font-semibold text-gray-900">{{ $aspirations->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-900">{{ $aspirations->total() }}</span> laporan
                </div>

                <div class="flex items-center space-x-2">
                    @if ($aspirations->onFirstPage())
                        <span
                            class="px-3 py-1.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-md cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $aspirations->previousPageUrl() }}"
                            class="px-3 py-1.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-900 transition-colors">Prev</a>
                    @endif

                    @if ($aspirations->hasMorePages())
                        <a href="{{ $aspirations->nextPageUrl() }}"
                            class="px-3 py-1.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-900 transition-colors">Next</a>
                    @else
                        <span
                            class="px-3 py-1.5 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-md cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
