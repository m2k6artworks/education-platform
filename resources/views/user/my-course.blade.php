@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Kursus Saya</h1>

    @foreach ($enrolledCourses as $course)
        <div class="bg-white rounded shadow p-4 mb-4">
            <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
            <p class="text-gray-600">{{ $course->description }}</p>
            <form action="{{ route('user.courses.unenroll', $course->id) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Keluar dari Kursus</button>
            </form>
        </div>
    @endforeach
</div>
@endsection