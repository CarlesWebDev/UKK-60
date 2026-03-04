@extends('layout.login_layout')

@section('content')
    <div class="min-h-screen flex items-center justify-center md:bg-gray-50 p-4">
        <div class="w-full max-w-3xl flex flex-col md:flex-row rounded-2xl overflow-hidden md:border md:border-gray-100 md:shadow-lg">
            <div class="md:w-1/2 hidden bg-blue-600 p-8 text-white md:flex flex-col justify-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div class="absolute -top-10 -left-10 w-40 h-40 md:bg-white rounded-full mix-blend-overlay blur-3xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 md:bg-white rounded-full mix-blend-overlay blur-3xl">
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-xl font-bold tracking-tight">ADMIN PANEL</span>
                    </div>

                    <h2 class="text-3xl font-bold leading-tight mb-4">Selamat Datang, Admin.</h2>
                    <p class="text-blue-100 text-sm mb-8 leading-relaxed">
                        Akses panel kontrol untuk memantau dan mengelola laporan sekolah secara terpusat.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                            <p class="text-sm font-medium">Monitoring dashboard real-time</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                            <p class="text-sm font-medium">Verifikasi & tindak lanjut laporan</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                            <p class="text-sm font-medium">Manajemen data pengguna</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 bg-white p-8 flex flex-col justify-center">
                <div class="mb-6">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center text-gray-400 hover:text-blue-600 transition-colors text-sm group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Login Admin</h1>
                    <p class="text-xs text-gray-500 mt-1">Silakan masuk menggunakan kredensial Anda.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-3 rounded">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <small class="ml-2 text-red-500">{{ $errors->first() }}</small>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">email</label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="admin@sekolah.sch.id"
                            class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') border-red-500 bg-red-50 @enderror">
                        @error('email')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Password</label>
                        <div class="relative flex items-center">
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password') border-red-500 bg-red-50 @enderror">

                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm mt-2">
                        Masuk
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500">
                        Bukan Admin?
                        <a href="{{ route('student.login.form') }}"
                            class="text-blue-600 font-bold hover:underline ml-1">Student Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.querySelector('input[name="password"]');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.563-4.306m5.858 5.858a3 3 0 104.243 4.243m-4.243-4.243L3 3m8.25 8.25l7.5 7.5M10.5 6.75h.008v.008H10.5V6.75zm3 0h.008v.008H13.5V6.75z" />
            `;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script>












{{-- Demo --}}

{{-- @extends('layout.login_layout')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
        <div class="w-full max-w-3xl flex flex-col md:flex-row rounded-2xl overflow-hidden border border-gray-100 shadow-lg">
            <div class="md:w-1/2 bg-blue-600 p-8 text-white flex flex-col justify-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-white rounded-full mix-blend-overlay blur-3xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white rounded-full mix-blend-overlay blur-3xl">
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-xl font-bold tracking-tight">ADMIN PANEL</span>
                    </div>

                    <h2 class="text-3xl font-bold leading-tight mb-4">Selamat Datang, Admin.</h2>
                    <p class="text-blue-100 text-sm mb-8 leading-relaxed">
                        Akses panel kontrol untuk memantau dan mengelola laporan sekolah secara terpusat.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                            <p class="text-sm font-medium">Monitoring dashboard real-time</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                            <p class="text-sm font-medium">Verifikasi & tindak lanjut laporan</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                            <p class="text-sm font-medium">Manajemen data pengguna</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 bg-white p-8 flex flex-col justify-center">
                <div class="mb-6">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center text-gray-400 hover:text-blue-600 transition-colors text-sm group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Login Admin</h1>
                    <p class="text-xs text-gray-500 mt-1">Silakan masuk menggunakan kredensial Anda.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-3 rounded">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <small class="ml-2 text-red-500">{{ $errors->first() }}</small>
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">email</label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="admin@sekolah.sch.id"
                            class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') border-red-500 bg-red-50 @enderror">
                        @error('email')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Password</label>
                        <div class="relative flex items-center">
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password') border-red-500 bg-red-50 @enderror">

                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ url('/admin/dashboard') }}"
                        class="block text-center w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm mt-2">
                        Masuk
                    </a>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500">
                        Bukan Admin?
                        <a href="{{ route('student.login.form') }}"
                            class="text-blue-600 font-bold hover:underline ml-1">Student Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

{{-- <script>
    function togglePasswordVisibility() {
        const passwordInput = document.querySelector('input[name="password"]');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.563-4.306m5.858 5.858a3 3 0 104.243 4.243m-4.243-4.243L3 3m8.25 8.25l7.5 7.5M10.5 6.75h.008v.008H10.5V6.75zm3 0h.008v.008H13.5V6.75z" />
            `;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script> --}}


{{-- <div class="md:w-1/2 bg-white p-8 flex flex-col justify-center">
                <div class="mb-6">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center text-gray-400 hover:text-blue-600 transition-colors text-sm group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Login Admin</h1>
                    <p class="text-xs text-gray-500 mt-1">Silakan masuk menggunakan kredensial Anda.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-3 rounded">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <small class="ml-2 text-red-500">{{ $errors->first() }}</small>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">email</label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="admin@sekolah.sch.id"
                            class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') border-red-500 bg-red-50 @enderror">
                        @error('email')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Password</label>
                        <div class="relative flex items-center">
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password') border-red-500 bg-red-50 @enderror">

                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm mt-2">
                        Masuk
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500">
                        Bukan Admin?
                        <a href="{{ route('student.login.form') }}"
                            class="text-blue-600 font-bold hover:underline ml-1">Student Login</a>
                    </p>
                </div>
            </div> --}}
