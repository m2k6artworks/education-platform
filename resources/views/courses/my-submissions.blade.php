@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-12">
    <h1 class="text-2xl font-bold mb-6">My Submitted Courses</h1>

    @if($courses->count())
        <div class="space-y-6">
            @foreach($courses as $course)
                <div class="p-6 bg-white shadow rounded">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h2>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $course->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($course->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($course->status) }}
                        </span>
                    </div>

                    @foreach($course->contents as $content)
                        <div class="mb-2">
                            <p class="text-sm text-gray-600"><strong>Type:</strong> {{ ucfirst($content->content_type) }}</p>
                            <div class="mt-1 text-gray-700">
                                @if($content->content_type === 'article')
                                    <p>{{ $content->content }}</p>
                                @elseif($content->content_type === 'video')
                                    @if(Str::startsWith($content->content, 'http'))
                                        <a href="{{ $content->content }}" target="_blank" class="text-indigo-600 hover:underline">View Video</a>
                                    @else
                                        <video src="{{ asset('storage/' . $content->content) }}" controls class="w-full max-w-md"></video>
                                    @endif
                                @elseif($content->content_type === 'audio')
                                    <audio controls src="{{ asset('storage/' . $content->content) }}" class="w-full"></audio>
                                @elseif($content->content_type === 'pdf')
                                    <a href="{{ asset('storage/' . $content->content) }}" target="_blank" class="text-indigo-600 hover:underline">View PDF</a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirmDelete(event)" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">Cancel Submission</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    @else
        <p class="text-gray-600">You haven't submitted any courses yet.</p>
    @endif
</div>

<script>
function confirmDelete(event) {
    if (!confirm('Are you sure you want to cancel this submission? This action cannot be undone.')) {
        event.preventDefault();
        return false;
    }
    return true;
}
</script>
@endsection