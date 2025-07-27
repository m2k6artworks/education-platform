@extends('layouts.app')

@section('content')
<section class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <p class="text-center text-md-start text-primary col-12 mb-2" style="font-size: 0.825rem">
            Course
        </p>
        <h4 class="mb-4 col-12 text-center text-md-start" style="font-weight: 600">
            Popular Category for you
        </h4>
        
        <!-- Course Categories -->
        <div class="row justify-content-between w-100 h-100 mb-5">
            @foreach($categories as $category)
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <a href="{{ route('courses.index', ['category' => $category->id]) }}" class="card border-0 h-100 text-decoration-none">
                    <div class="pt-3 pb-3 px-3 text-start">
                        <img src="{{ asset('assets/' . $category->icon) }}" class="img-fluid" alt="{{ $category->name }}" 
                             style="object-fit: contain; object-position: center; width: 90px; height: 90px;" />
                    </div>
                    <div class="card-body px-3">
                        <h5 class="card-title mb-2">{{ $category->name }}</h5>
                        <p class="card-text" style="font-size: 0.875rem; color: #828282">
                            {{ $category->description }}
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Category Filter -->
        <div class="col-12 mb-4">
            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <a href="{{ route('courses.index') }}" 
                   class="btn {{ request('category') ? 'btn-outline-primary' : 'btn-primary' }} px-4 me-2 mb-2">
                    All Courses
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('courses.index', ['category' => $category->id]) }}" 
                       class="btn {{ request('category') == $category->id ? 'btn-primary' : 'btn-outline-primary' }} px-4 me-2 mb-2">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Available Courses -->
        <div class="col-12" id="allCourses">
            <h4 class="mb-4 text-center" style="font-weight: 600">
                Available Courses
                @if(request('category'))
                    <span class="text-muted">- {{ $categories->find(request('category'))->name ?? '' }}</span>
                @endif
            </h4>
            
            <!-- Isotope Filter Buttons -->
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div id="filterButtons" class="d-flex flex-row col-12 col-md-auto overflow-auto p-1">
                    <a href="#" data-filter="*" class="btn btn-secondary px-4 me-2 col-auto mb-2">All Course</a>
                    @foreach($categories as $category)
                        <a href="#" data-filter=".category-{{ $category->id }}" class="btn bg-white px-4 me-2 col-auto mb-2">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
                <div class="col-12 col-md-auto text-end mt-3 mt-md-0">
                    <a class="link-primary" style="font-weight: 600" href="{{ route('courses.index') }}">Show All</a>
                </div>
            </div>
            
            <!-- Isotope Grid -->
            <div id="filterCardArea" data-isotope='{ "itemSelector": ".card-theme", "layoutMode": "fitRows" }' class="row justify-content-between w-100">
                @foreach($courses as $course)
                    <div class="col-12 col-md-6 col-lg-3 px-2 mb-3 card-theme category-{{ $course->category_id ?? 'uncategorized' }}">
                        <div class="card border-0">
                            @if($course->thumbnail && $course->thumbnail !== '-')
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top" alt="{{ $course->title }}">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center" 
                                     style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-book text-white" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('courses.show', $course) }}" class="card-title mb-3 link-primary text-decoration-none">
                                    <h6 class="courseName">{{ Str::limit($course->title, 50) }}</h6>
                                </a>
                                <div class="row justify-content-between">
                                    <div class="col-auto d-flex flex-wrap align-items-center">
                                        <div class="w-8 h-8 rounded-full bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                            {{ strtoupper(substr($course->creator->name, 0, 1)) }}
                                        </div>
                                        <p class="card-text text-center text-md-start teacherName" style="font-size: 0.8rem; color: #828282">
                                            {{ $course->creator->name }}
                                        </p>
                                    </div>
                                    <div class="col-auto d-flex flex-wrap align-items-center">
                                        <i class="fas fa-users text-warning me-2"></i>
                                        <p class="card-text text-center text-md-start rating" style="font-size: 0.8rem; color: #828282">
                                            {{ $course->students_count ?? 0 }} students
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white py-3">
                                <div class="row justify-content-between">
                                    <div class="col-auto d-flex flex-wrap align-items-center">
                                        <p class="card-text text-md-start" style="color: #828282">
                                            @if($course->category)
                                                {{ $course->category->name }}
                                            @else
                                                Uncategorized
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-auto d-flex flex-wrap align-items-center">
                                        <p class="card-text text-center text-md-start text-primary price" style="font-weight: 600">
                                            Free
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Testimonies Section -->
<section class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container pt-0 pb-0 pt-lg-5">
        <h1 class="mb-3">Our Student Voices</h1>
        <div id="testimoniesSlider">
            <div>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center position-relative mb-4">
                        <img class="width-xs-inherit" src="{{ asset('assets/khalil-gibran.png') }}" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="mb-3">
                            "Kyulearn has transformed my learning experience with its comprehensive and easy-to-follow courses. The mentors are incredibly knowledgeable, and the support team is always ready to help. I feel more confident in my skills and ready to take on new challenges!"
                        </p>
                        <div class="d-flex flex-wrap align-items-center mt-5">
                            <h5 class="col-12" style="font-weight: 600">Khalil Gibran</h5>
                            <p>Chief Technology Officer at Kyulearn</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center position-relative mb-4">
                        <img class="width-xs-inherit" src="{{ asset('assets/ketsar-ali.png') }}" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="mb-3">
                            "Joining Kyulearn was a game-changer for me. The platform's user-friendly interface and well-structured content have made learning enjoyable and highly effective. The mentors provide insightful feedback and the community is incredibly supportive. Thanks to Kyulearn, I've gained the confidence to excel in my field and tackle complex projects with ease."
                        </p>
                        <div class="d-flex flex-wrap align-items-center mt-5">
                            <h5 class="col-12" style="font-weight: 600">Ketsar Ali</h5>
                            <p>Head Quality Assurance at Kyulearn</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center position-relative mb-4">
                        <img class="width-xs-inherit" src="{{ asset('assets/wiji-subekti.png') }}" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="mb-3">
                            "The quality of courses on Kyulearn is exceptional. I've learned so much from the practical projects and real-world examples. The instructors are experts in their fields and the community is very helpful. This platform has been instrumental in my career growth."
                        </p>
                        <div class="d-flex flex-wrap align-items-center mt-5">
                            <h5 class="col-12" style="font-weight: 600">Wiji Subekti</h5>
                            <p>Senior Developer at TechCorp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex flex-wrap justify-content-end align-items-center mb-4">
            <div class="col-auto me-3">
                <strong>
                    <span id="currentSlide">0</span> / <span id="endSlide">0</span>
                </strong>
            </div>
            <div class="col-auto">
                <button id="testimoniesLeftArrow" class="btn" style="-webkit-clip-path: circle(); clip-path: circle()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="testimoniesRightArrow" class="btn" style="-webkit-clip-path: circle(); clip-path: circle()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-light pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <div class="bg-primary text-white row col-12 col-lg-10 rounded-3 justify-content-center p-4 p-sm-5">
            <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center mb-4 mb-lg-0 text-center text-lg-start">
                <h3>Are you ready to join the Course Now?</h3>
            </div>
            <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
                @auth
                    <a href="{{ route('courses.create') }}" class="btn btn-light btn-lg col-12 col-md-8 fs-6">
                        Create Course
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg col-12 col-md-8 fs-6">
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('vendor/js/custom.js') }}"></script>
@endpush
@endsection