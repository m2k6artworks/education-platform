@extends('layouts.app')

@section('content')
<div class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <div class="col-12 col-lg-10">
            <div class="card border-0" style="border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h1 class="mb-2" style="font-weight: 600">📚 My Learning Journey</h1>
                        <p class="text-muted">Continue your learning adventure with these enrolled courses.</p>
                    </div>

                    @if($enrolledCourses->count() > 0)
                        <div class="row">
                            @foreach ($enrolledCourses as $course)
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <div class="card border-0 h-100" style="border-radius: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); transition: transform 0.2s;">
                                        <div class="card-body d-flex flex-column">
                                            <!-- Course Thumbnail -->
                                            <div class="mb-3">
                                                @if($course->thumbnail && $course->thumbnail !== '-')
                                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                         class="card-img-top rounded" 
                                                         alt="{{ $course->title }}"
                                                         style="height: 160px; object-fit: cover;">
                                                @else
                                                    <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" 
                                                         style="height: 160px;">
                                                        <i class="fas fa-book" style="font-size: 3rem;"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Course Info -->
                                            <div class="flex-grow-1">
                                                <h5 class="card-title fw-bold mb-2">
                                                    <a href="{{ route('courses.show', $course->id) }}" 
                                                       class="text-decoration-none text-dark">
                                                        {{ Str::limit($course->title, 50) }}
                                                    </a>
                                                </h5>
                                                
                                                <p class="card-text text-muted mb-3" style="font-size: 0.875rem;">
                                                    {{ Str::limit($course->description, 80) }}
                                                </p>

                                                <!-- Instructor -->
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 30px; height: 30px; font-size: 0.75rem;">
                                                        {{ strtoupper(substr($course->creator->name, 0, 1)) }}
                                                    </div>
                                                    <small class="text-muted">{{ $course->creator->name }}</small>
                                                </div>

                                                <!-- Category Badge -->
                                                @if($course->category)
                                                    <div class="mb-3">
                                                        <span class="badge" style="background-color: {{ $course->category->color }}; color: white;">
                                                            {{ $course->category->name }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                                <form action="{{ route('user.courses.unenroll', $course->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to unenroll from this course?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-sign-out-alt me-1"></i>Unenroll
                                                    </button>
                                                </form>
                                                
                                                <a href="{{ route('courses.show', $course->id) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-play me-1"></i>Continue Learning
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-graduation-cap mb-3" style="font-size: 4rem;"></i>
                                <h4 class="mb-3">No Courses Enrolled Yet</h4>
                                <p class="mb-4">Start your learning journey by enrolling in some amazing courses!</p>
                                <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search me-2"></i>Browse Courses
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection