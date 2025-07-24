@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-xl font-bold text-indigo-600 mb-4">🎓 Kursus yang Kamu Ikuti</h2>
    @if($enrolledCourses->isEmpty())
        <p class="text-gray-500 mb-6">Kamu belum mengikuti kursus apa pun.</p>
    @else
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            @foreach($enrolledCourses as $course)
                <div class="bg-white rounded-xl shadow p-4 relative">
                   <!-- Badge Diikuti -->
                    <span class="absolute top-2 left-2 bg-green-600 text-white text-[10px] font-semibold px-2 py-1 rounded-full shadow">
                        ✅ Diikuti
                    </span>

                   <!-- Gambar -->
                    <img src="{{ $course->thumbnail && $course->thumbnail !== '-' 
                        ? asset('storage/'.$course->thumbnail) 
                        : 'https://via.placeholder.com/400x200' }}" 
                        class="rounded-lg mb-3 w-full h-40 object-cover">

                   <!-- Judul -->
                    <h3 class="font-bold text-lg">{{ $course->title }}</h3>

                   <!-- Deskripsi -->
                    <p class="text-sm text-gray-500">{{ Str::limit($course->description, 100) }}</p>

                   <!-- Tombol -->
                    <a href="{{ route('courses.show', $course) }}" class="inline-block mt-3 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Lanjutkan Belajar
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <h2 class="text-xl font-bold text-indigo-600 mb-4">🌟 Rekomendasi Kursus</h2>
    @if($unjoinedCourses->isEmpty())
        <p class="text-gray-500">Kamu sudah mengikuti semua kursus yang tersedia.</p>
    @else
        <div class="flex space-x-4 overflow-x-auto pb-4">
            @foreach($unjoinedCourses as $course)
                <div class="min-w-[280px] bg-white rounded-xl shadow p-4 flex-shrink-0 relative">
                   <!-- Gambar -->
                    <img src="{{ $course->thumbnail && $course->thumbnail !== '-' 
                        ? asset('storage/'.$course->thumbnail) 
                        : 'https://via.placeholder.com/400x200' }}" 
                        class="rounded-lg mb-3 w-full h-40 object-cover">

                   <!-- Judul -->
                    <h3 class="font-bold text-lg">{{ $course->title }}</h3>

                   <!-- Deskripsi -->
                    <p class="text-sm text-gray-500">{{ Str::limit($course->description, 80) }}</p>

                   <!-- Tombol Enroll -->
                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                        @csrf