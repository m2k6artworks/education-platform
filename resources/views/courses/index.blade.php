@extends('layouts.app')

@section('content')
<section class="relative isolate px-6 pt-14 lg:px-8">
  <div class="px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Latest Course</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($courses as $course)
        @include('components.course-card', ['course' => $course])
      @endforeach
    </div>
  </div>
</section>
@endsection