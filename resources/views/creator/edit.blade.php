@extends('layouts.app')

@section('content')
<div class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <div class="col-12 col-lg-10">
            <div class="card border-0" style="border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h1 class="mb-2" style="font-weight: 600">✏️ Edit Course</h1>
                        <p class="text-muted">Update your course information and content.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('creator.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-12 col-lg-8">
                                <!-- Title -->
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-bold">Course Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" required
                                        class="form-control form-control-lg"
                                        placeholder="e.g. Mastering Laravel for Beginners"
                                        value="{{ old('title', $course->title) }}">
                                    @error('title') 
                                        <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="mb-4">
                                    <label for="category_id" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" required class="form-select form-select-lg">
                                        <option value="">-- Choose Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') 
                                        <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Content Type -->
                                <div class="mb-4">
                                    <label for="content_type" class="form-label fw-bold">Content Type <span class="text-danger">*</span></label>
                                    <select name="content_type" id="content_type" required class="form-select form-select-lg">
                                        <option value="">-- Choose Type --</option>
                                        <option value="article" {{ old('content_type', $course->content_type) == 'article' ? 'selected' : '' }}>Article</option>
                                        <option value="video" {{ old('content_type', $course->content_type) == 'video' ? 'selected' : '' }}>Video</option>
                                        <option value="audio" {{ old('content_type', $course->content_type) == 'audio' ? 'selected' : '' }}>Audio Podcast</option>
                                        <option value="pdf" {{ old('content_type', $course->content_type) == 'pdf' ? 'selected' : '' }}>PDF</option>
                                    </select>
                                    @error('content_type') 
                                        <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div id="desc_wrapper" class="hidden mb-4">
                                    <label for="description" class="form-label fw-bold">Article Content</label>
                                    <textarea name="description" id="description" rows="8"
                                        class="form-control"
                                        placeholder="Write your article content here...">{{ old('description', $course->description) }}</textarea>
                                </div>

                                <!-- Video Options -->
                                <div id="video_wrapper" class="hidden">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Video Source</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input type="radio" name="video_option" value="upload" checked class="form-check-input" id="video_upload_radio">
                                                <label class="form-check-label" for="video_upload_radio">Upload Video</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="video_option" value="url" class="form-check-input" id="video_url_radio">
                                                <label class="form-check-label" for="video_url_radio">Video URL</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="video_upload" class="mb-4">
                                        <label for="video_file" class="form-label fw-bold">Upload Video File</label>
                                        <input type="file" name="video_file" accept="video/*" class="form-control">
                                    </div>

                                    <div id="video_url" class="hidden mb-4">
                                        <label for="video_url_input" class="form-label fw-bold">Video URL</label>
                                        <input type="url" name="video_url" id="video_url_input" 
                                               class="form-control" placeholder="https://youtube.com/..."
                                               value="{{ old('video_url', $course->video_url) }}">
                                    </div>
                                </div>

                                <!-- Audio -->
                                <div id="audio_wrapper" class="hidden mb-4">
                                    <label for="audio_file" class="form-label fw-bold">Upload Audio (.mp3)</label>
                                    <input type="file" name="audio_file" accept="audio/mpeg" class="form-control">
                                </div>

                                <!-- PDF -->
                                <div id="pdf_wrapper" class="hidden mb-4">
                                    <label for="pdf_file" class="form-label fw-bold">Upload PDF</label>
                                    <input type="file" name="pdf_file" accept="application/pdf" class="form-control">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-12 col-lg-4">
                                <!-- Thumbnail -->
                                <div class="mb-4">
                                    <label for="thumbnail" class="form-label fw-bold">Course Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" 
                                           class="form-control" data-plugins="dropify" data-height="200">
                                    <small class="text-muted">Recommended size: 800x600 pixels</small>
                                </div>

                                <!-- Course Preview Card -->
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">Course Preview</h6>
                                        <div class="mb-3">
                                            <small class="text-muted">Title:</small>
                                            <div id="preview_title" class="fw-bold">{{ $course->title }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Category:</small>
                                            <div id="preview_category" class="fw-bold">
                                                @if($course->category)
                                                    {{ $course->category->name }}
                                                @else
                                                    Category will appear here
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Content Type:</small>
                                            <div id="preview_type" class="fw-bold">{{ ucfirst($course->content_type) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('creator.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4" style="font-weight: 600;">
                                <i class="fas fa-save me-2"></i>Update Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<!-- Plugins css -->
<link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<!-- Plugins js -->
<script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Dropify
    $('.dropify').dropify({
        messages: {
            default: 'Drag and drop a file here or click',
            replace: 'Drag and drop or click to replace',
            remove: 'Remove',
            error: 'Oops, something wrong happened.'
        }
    });

    const contentType = document.getElementById('content_type');
    const descWrapper = document.getElementById('desc_wrapper');
    const videoWrapper = document.getElementById('video_wrapper');
    const audioWrapper = document.getElementById('audio_wrapper');
    const pdfWrapper = document.getElementById('pdf_wrapper');

    const videoUpload = document.getElementById('video_upload');
    const videoURL = document.getElementById('video_url');
    const videoRadios = document.querySelectorAll('input[name="video_option"]');

    // Content type change handler
    contentType.addEventListener('change', function () {
        descWrapper.classList.add('hidden');
        videoWrapper.classList.add('hidden');
        audioWrapper.classList.add('hidden');
        pdfWrapper.classList.add('hidden');

        switch (this.value) {
            case 'article':
                descWrapper.classList.remove('hidden');
                break;
            case 'video':
                videoWrapper.classList.remove('hidden');
                break;
            case 'audio':
                audioWrapper.classList.remove('hidden');
                break;
            case 'pdf':
                pdfWrapper.classList.remove('hidden');
                break;
        }
        
        updatePreview();
    });

    // Video option change handler
    videoRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'upload') {
                videoUpload.classList.remove('hidden');
                videoURL.classList.add('hidden');
            } else {
                videoUpload.classList.add('hidden');
                videoURL.classList.remove('hidden');
            }
        });
    });

    // Preview update handlers
    document.getElementById('title').addEventListener('input', updatePreview);
    document.getElementById('category_id').addEventListener('change', updatePreview);
    contentType.addEventListener('change', updatePreview);

    function updatePreview() {
        const title = document.getElementById('title').value || 'Your course title will appear here';
        const category = document.getElementById('category_id');
        const categoryText = category.options[category.selectedIndex]?.text || 'Category will appear here';
        const type = contentType.options[contentType.selectedIndex]?.text || 'Content type will appear here';

        document.getElementById('preview_title').textContent = title;
        document.getElementById('preview_category').textContent = categoryText;
        document.getElementById('preview_type').textContent = type;
    }

    // Show current content type fields on page load
    if (contentType.value) {
        contentType.dispatchEvent(new Event('change'));
    }

    // Initial preview update
    updatePreview();
});
</script>
@endpush
@endsection