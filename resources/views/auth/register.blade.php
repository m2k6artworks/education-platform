@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="w-full max-w-5xl bg-white rounded-xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
        
        {{-- Kiri (Optional info / welcome text) --}}
        <div class="hidden md:flex items-center justify-center bg-indigo-100 p-10">
            <div>
                <h2 class="text-2xl font-bold text-indigo-700 mb-4">Selamat Datang!</h2>
                <p class="text-gray-600">Buat akun dan mulai belajar dengan berbagai kursus menarik.</p>
            </div>
        </div>

        {{-- Kanan (Form) --}}
        <div class="p-8 md:p-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Daftar Akun Baru</h1>

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="name"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        required value="{{ old('name') }}">
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        required value="{{ old('email') }}">
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        required>
                    @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        required>
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Daftar Sebagai</label>
                    <select name="role" id="role"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3"
                        required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Peserta)</option>
                        <option value="creator" {{ old('role') == 'creator' ? 'selected' : '' }}>Creator (Pengajar)</option>
                    </select>
                    @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md bg-indigo-600 text-white font-semibold shadow-sm hover:bg-indigo-700 transition-colors">
                    Daftar
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection