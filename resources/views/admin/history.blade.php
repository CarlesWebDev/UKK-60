@extends('layout.appadmin')

@section('content')
    <div class="space-y- max-w-7xl mx-auto font-sans">

        <div class="bg-white rounded-xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">
                    Histori Aspirasi
                </h2>
            </div>


            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-center">Foto</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Isi Laporan</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3 text-center">Kategori</th>
                            <th class="px-4 py-3 text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-50">
                        @forelse ($aspirations as $aspiration)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="px-4 py-3">
                                    <div
                                        class="h-12 w-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200 mx-auto">
                                        @if ($aspiration->photo)
                                            <img src="{{ asset('storage/' . $aspiration->photo) }}" alt="Bukti"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-900">
                                    {{ $aspiration->title }}
                                </td>

                                <td class="px-4 py-3 text-gray-500 max-w-xs truncate">
                                    {{ $aspiration->description }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                                        <span>{{ $aspiration->location }}</span>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $aspiration->category->category_name }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if ($aspiration->status == 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                            Pending
                                        </span>
                                    @elseif ($aspiration->status == 'progress')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            progress
                                        </span>
                                    @elseif ($aspiration->status == 'completed')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            completed
                                        </span>
                                    @elseif ($aspiration->status == 'rejected')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            rejected
                                        </span>
                                    @elseif ($aspiration->status == 'archived')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-700 border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                            archived
                                        </span>
                                    @endif
                                </td>

                                {{-- <td class="px-4 py-3 text-center align-middle" x-data="{ open: false }">
                                    <div class="flex justify-center items-center relative">
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
                                            class="absolute right-4 top-full mt-1 w-32 bg-white rounded-lg shadow-lg border border-gray-100 z-50">

                                            <a href="{{ route('student.show.history.aspiration', $aspiration->id) }}"
                                                class="group  items-center p-2  text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 flex ">
                                                <i class="fa-solid fa-eye mr-3 text-blue-500 group-hover:text-blue-600"></i>
                                                 Detail
                                            </a>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada aspirasi yang tersedia.
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
                    Aspirasi
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
