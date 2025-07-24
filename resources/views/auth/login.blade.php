@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-100 py-12 px-4">
    <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Left Side (Illustration or Info) -->
        <div class="hidden md:flex flex-col justify-center items-center bg-indigo-50 p-8">
            <img src="{{ asset('images/login-illustration.svg') }}" alt="Login Illustration" class="w-3/4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-700 mb-2">Selamat Datang Kembali!</h2>
            <p class="text-gray-500 text-center">Akses kursus terbaik dan tingkatkan kemampuanmu bersama kami.</p>
        </div>
        <!-- Right Side (Form) -->
        <div class="flex flex-col justify-center p-8">
            <div class="text-center mb-6">
                <a href="{{ route('home') }}" class="flex justify-center mb-4">
                    <span class="inline-block bg-indigo-600 text-white rounded-full p-3 shadow-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </span>
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Masuk ke Akun Anda</h1>
                <p class="text-gray-500">Silakan login untuk melanjutkan.</p>
            </div>
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" autocomplete="email" required
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 text-base"
                        value="{{ old('email') }}">
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" autocomplete="current-password" required
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 text-base">
                    @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Lupa password?</a>
                    </div>
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md bg-indigo-600 text-white font-semibold shadow-sm hover:bg-indigo-700 transition-colors text-base">
                    Login
                </button>
            </form>
            <p class="mt-6 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection