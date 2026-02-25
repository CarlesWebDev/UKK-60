@extends('layout.appadmin')

@section('content')
    <div class="space-y-6 max-w-4xl mx-auto font-sans">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Aspirasi</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola daftar laporan dan status penyelesaian</p>
            </div>

            <form action="{{ route('admin.management.aspiration') }}" method="GET" class="flex flex-wrap gap-2">
                <select name="status" onchange="this.form.submit()"
                    class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none min-w-[150px]">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Aspirasi..."
                        class="pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg w-full md:w-64 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm transition">
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-visible">
            <div class="overflow-x-auto overflow-y-visible">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-medium">Foto</th>
                            <th class="px-6 py-4 font-medium">Judul & Laporan</th>
                            <th class="px-6 py-4 font-medium">Pengirim</th>
                            <th class="px-6 py-4 font-medium">Lokasi</th>
                            <th class="px-6 py-4 font-medium">Kategori</th>
                            <th class="px-6 py-4 font-medium">Tanggal</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($aspirations as $item)
                            <tr class="bg-white hover:bg-blue-50/30 transition">
                                <td class="px-6 py-4">
                                    <div
                                        class="h-12 w-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                        @if ($item->photo)
                                            <img src="{{ asset('storage/' . $item->photo) }}" alt="Bukti"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900 block">{{ $item->title }}</span>
                                    <p class="text-gray-500 text-xs mt-0.5 line-clamp-1 w-48"
                                        title="{{ $item->description }}">
                                        {{ Str::limit($item->description, 50) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs border border-blue-100">
                                            {{ substr($item->student->name ?? 'User', 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $item->student->name ?? 'Unknown' }}
                                            </p>
                                            <p class="text-gray-400 text-xs">{{ $item->student->nisn ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-gray-700 text-xs">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        <span>{{ $item->location }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                        {{ $item->category->category_name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 text-xs font-medium">{{ $item->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-gray-400 text-[10px]">{{ $item->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = match ($item->status) {
                                            'pending' => 'bg-gray-100 text-gray-600 border-gray-200',
                                            'progress' => 'bg-blue-50 text-blue-600 border-blue-200',
                                            'completed' => 'bg-green-50 text-green-700 border-green-200',
                                            'rejected' => 'bg-red-50 text-red-600 border-red-200',
                                            default => 'bg-gray-100 text-gray-600 border-gray-200',
                                        };
                                        $dotClass = match ($item->status) {
                                            'pending' => 'bg-gray-500',
                                            'progress' => 'bg-blue-500',
                                            'completed' => 'bg-green-500',
                                            'rejected' => 'bg-red-500',
                                            default => 'bg-gray-500',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusClass }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 relative whitespace-nowrap" x-data="{ open: false }">
                                    <div class="flex justify-center items-center">
                                        <button @click="open = !open" @click.outside="open = false"
                                            class="text-gray-500 hover:text-blue-600 focus:outline-none p-2 rounded-full hover:bg-gray-100 transition">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>

                                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-12 top-2 w-32 bg-white rounded-lg shadow-lg border border-gray-100 z-50">
                                            <a href="{{ route('admin.show.aspirations', $item->id) }}"
                                                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition rounded-lg">
                                                <i class="fa-regular fa-eye"></i> Detail
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                        <p class="text-sm">Belum ada data aspirasi yang ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-xs text-gray-500">
                    Menampilkan
                    <span class="font-medium text-gray-900">{{ $aspirations->firstItem() ?? 0 }}</span>
                    sampai
                    <span class="font-medium text-gray-900">{{ $aspirations->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-medium text-gray-900">{{ $aspirations->total() }}</span>
                    siswa
                </div>

                <div class="flex items-center space-x-1">
                    @if ($aspirations->onFirstPage())
                        <span
                            class="px-3 py-1 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $aspirations->previousPageUrl() }}"
                            class="px-3 py-1 text-xs font-medium text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50">Prev</a>
                    @endif

                    @if ($aspirations->hasMorePages())
                        <a href="{{ $aspirations->nextPageUrl() }}"
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
