@extends('layouts.app')

@section('content')
<div class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <div class="col-12 col-lg-10">
            <div class="card border-0" style="border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="mb-2" style="font-weight: 600">🎓 My Courses</h1>
                            <p class="text-muted">Manage your created courses and track their status.</p>
                        </div>
                        <a href="{{ route('courses.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create New Course
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Course Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    @if($course->thumbnail && $course->thumbnail !== '-')
                                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                             alt="{{ $course->title }}" 
                                                             class="rounded" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" 
                                                             style="width: 50px; height: 50px;">
                                                            <i class="fas fa-book"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 fw-bold">{{ $course->title }}</h6>
                                                    <small class="text-muted">{{ Str::limit($course->description, 50) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($course->category)
                                                <span class="badge" style="background-color: {{ $course->category->color }}; color: white;">
                                                    {{ $course->category->name }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Uncategorized</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($course->status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($course->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $course->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('courses.show', $course) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="View Course">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('creator.courses.edit', $course->id) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Edit Course">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('creator.courses.destroy', $course->id) }}" 
                                                      method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Delete Course">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-book-open mb-3" style="font-size: 3rem;"></i>
                                                <h5>No courses found</h5>
                                                <p>You haven't created any courses yet. Start by creating your first course!</p>
                                                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Create Your First Course
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection