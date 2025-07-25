@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">My Courses</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Title</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $course->title }}</td>
                    <td class="px-6 py-4 capitalize">{{ $course->status }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('creator.courses.edit', $course->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('creator.courses.destroy', $course->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection