@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Kursus Saya</h1>

    @foreach ($enrolledCourses as $course)
        <div class="bg-white rounded shadow p-4 mb-4 relative min-h-[180px] flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold">
                    <a href="{{ route('courses.show', $course->id) }}" class="text-blue-600 hover:underline">
                        {{ $course->title }}
                    </a>
                </h2>
                <p class="text-gray-600 mt-2">{{ $course->description }}</p>
            </div>

            <div class="flex justify-between items-center mt-6">
                {{-- Tombol keluar (kiri bawah) --}}
                <form action="{{ route('user.courses.unenroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline text-sm">Keluar</button>
                </form>

                {{-- Tombol lanjutkan belajar (kanan bawah) --}}
                <a href="{{ route('courses.show', $course->id) }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm shadow">
                    Lanjutkan Belajar
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection