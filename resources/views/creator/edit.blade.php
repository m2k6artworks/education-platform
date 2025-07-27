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

                                <!-- Article Content -->
                                <div id="article_wrapper" class="mb-4 content-wrapper hidden">
                                    <label for="article_content" class="form-label fw-bold">Article Content</label>
                                    <div id="snow-editor-article" style="height: 300px;">
                                        <p></p>
                                    </div>
                                    <textarea name="article_content" id="article_content" class="form-control hidden">{{ old('article_content', $course->description) }}</textarea>
                                </div>

                                <!-- Video Options -->
                                <div id="video_wrapper" class="hidden content-wrapper">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Video Source</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input type="radio" name="video_option" value="upload" 
                                                       {{ old('video_option', $course->video_path ? 'upload' : 'url') == 'upload' ? 'checked' : '' }}
                                                       class="form-check-input" id="video_upload_radio">
                                                <label class="form-check-label" for="video_upload_radio">Upload Video</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="video_option" value="url" 
                                                       {{ old('video_option', $course->video_url ? 'url' : 'upload') == 'url' ? 'checked' : '' }}
                                                       class="form-check-input" id="video_url_radio">
                                                <label class="form-check-label" for="video_url_radio">Video URL</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="video_upload" class="mb-4">
                                        <label for="video_file" class="form-label fw-bold">Upload Video File</label>
                                        <input type="file" name="video_file" accept="video/*" class="form-control">
                                        @if($course->video_path && $course->video_path !== '-')
                                            <small class="text-muted">Current: {{ basename($course->video_path) }}</small>
                                        @endif
                                    </div>

                                    <div id="video_url" class="hidden mb-4">
                                        <label for="video_url_input" class="form-label fw-bold">Video URL</label>
                                        <input type="url" name="video_url" id="video_url_input" 
                                               class="form-control" placeholder="https://youtube.com/..."
                                               value="{{ old('video_url', $course->video_url) }}">
                                    </div>
                                </div>

                                <!-- Audio -->
                                <div id="audio_wrapper" class="hidden mb-4 content-wrapper">
                                    <label for="audio_file" class="form-label fw-bold">Upload Audio (.mp3)</label>
                                    <input type="file" name="audio_file" accept="audio/mpeg" class="form-control">
                                    @if($course->audio_path && $course->audio_path !== '-')
                                        <small class="text-muted">Current: {{ basename($course->audio_path) }}</small>
                                    @endif
                                </div>

                                <!-- PDF -->
                                <div id="pdf_wrapper" class="hidden mb-4 content-wrapper">
                                    <label for="pdf_file" class="form-label fw-bold">Upload PDF</label>
                                    <input type="file" name="pdf_file" accept="application/pdf" class="form-control">
                                    @if($course->pdf_path && $course->pdf_path !== '-')
                                        <small class="text-muted">Current: {{ basename($course->pdf_path) }}</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-12 col-lg-4">
                                <!-- Thumbnail -->
                                <div class="mb-4">
                                    <label for="thumbnail" class="form-label fw-bold">Course Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" 
                                           class="form-control dropify" data-plugins="dropify" data-height="200"
                                           data-default-file="{{ $course->thumbnail && $course->thumbnail !== '-' ? asset('storage/' . $course->thumbnail) : '' }}">
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
                                        <div class="mb-3">
                                            <small class="text-muted">Content:</small>
                                            <div id="preview_content" class="fw-bold text-muted" style="font-size: 0.875rem;">Content will appear here</div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Thumbnail:</small>
                                            <div class="mt-2">
                                                <img id="preview_thumbnail" src="{{ $course->thumbnail && $course->thumbnail !== '-' ? asset('storage/' . $course->thumbnail) : '' }}" alt="Preview" class="img-fluid rounded" style="max-height: 100px; {{ $course->thumbnail && $course->thumbnail !== '-' ? '' : 'display: none;' }}">
                                                <div id="preview_thumbnail_placeholder" class="text-muted" style="font-size: 0.875rem; {{ $course->thumbnail && $course->thumbnail !== '-' ? 'display: none;' : '' }}">{{ $course->thumbnail && $course->thumbnail !== '-' ? basename($course->thumbnail) : 'No thumbnail selected' }}</div>
                                            </div>
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

<style>
.hidden {
    display: none !important;
}

.content-wrapper {
    transition: all 0.3s ease-in-out;
}

.preview-card {
    transition: all 0.3s ease-in-out;
}

#preview_thumbnail {
    transition: opacity 0.3s ease-in-out;
}
</style>
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
    const titleInput = document.getElementById('title');
    const categorySelect = document.getElementById('category_id');
    const thumbnailInput = document.getElementById('thumbnail');
    const articleWrapper = document.getElementById('article_wrapper');
    const videoWrapper = document.getElementById('video_wrapper');
    const audioWrapper = document.getElementById('audio_wrapper');
    const pdfWrapper = document.getElementById('pdf_wrapper');
    const videoUpload = document.getElementById('video_upload');
    const videoURL = document.getElementById('video_url');
    const videoRadios = document.querySelectorAll('input[name="video_option"]');
    let articleQuill = null;

    function hideAllContentWrappers() {
        articleWrapper.classList.add('hidden');
        videoWrapper.classList.add('hidden');
        audioWrapper.classList.add('hidden');
        pdfWrapper.classList.add('hidden');
    }

    function showContentWrapper(wrapper) {
        wrapper.classList.remove('hidden');
    }

    function showVideoUpload() {
        videoUpload.classList.remove('hidden');
        videoURL.classList.add('hidden');
    }

    function showVideoURL() {
        videoUpload.classList.add('hidden');
        videoURL.classList.remove('hidden');
    }

    // Content type change handler
    contentType.addEventListener('change', function () {
        const selectedType = this.value;
        hideAllContentWrappers();
        
        switch (selectedType) {
            case 'article':
                showContentWrapper(articleWrapper);
                if (!articleQuill) {
                    articleQuill = new Quill('#snow-editor-article', {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{ 'font': [] }, { 'size': [] }],
                                ['bold', 'italic', 'underline', 'strike'],
                                [{ 'color': [] }, { 'background': [] }],
                                [{ 'script': 'super' }, { 'script': 'sub' }],
                                [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'],
                                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                                ['direction', { 'align': [] }],
                                ['link', 'image', 'video'],
                                ['clean']
                            ]
                        },
                        placeholder: 'Write your article content here...'
                    });
                    
                    // Set initial content for edit mode
                    const initialContent = document.getElementById('article_content').value;
                    if (initialContent) {
                        articleQuill.root.innerHTML = initialContent;
                    }
                    
                    articleQuill.on('text-change', function() {
                        updatePreview();
                        const content = articleQuill.root.innerHTML;
                        document.getElementById('article_content').innerHTML = content;
                    });
                }
                break;
            case 'video':
                showContentWrapper(videoWrapper);
                // Show appropriate video option based on current data
                if ('{{ $course->video_path && $course->video_path !== "-" }}') {
                    showVideoUpload();
                } else if ('{{ $course->video_url }}') {
                    showVideoURL();
                } else {
                    showVideoUpload(); // Default to upload
                }
                break;
            case 'audio':
                showContentWrapper(audioWrapper);
                break;
            case 'pdf':
                showContentWrapper(pdfWrapper);
                break;
        }
        
        updatePreview();
    });

    // Video option change handler
    videoRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'upload') {
                showVideoUpload();
            } else {
                showVideoURL();
            }
            updatePreview();
        });
    });

    function updatePreview() {
        const title = titleInput.value || 'Your course title will appear here';
        const category = categorySelect.options[categorySelect.selectedIndex]?.text || 'Category will appear here';
        const type = contentType.options[contentType.selectedIndex]?.text || 'Content type will appear here';
        
        let contentPreview = 'Content will appear here';
        if (contentType.value === 'article' && articleQuill) {
            const content = articleQuill.getText().trim();
            contentPreview = content ? (content.length > 50 ? content.substring(0, 50) + '...' : content) : 'Article content will appear here';
        } else if (contentType.value === 'video') {
            const selectedVideoOption = document.querySelector('input[name="video_option"]:checked');
            if (selectedVideoOption) {
                if (selectedVideoOption.value === 'upload') {
                    contentPreview = 'Video file will be uploaded';
                } else {
                    const videoUrl = document.getElementById('video_url_input').value;
                    contentPreview = videoUrl || 'Video URL will be added here';
                }
            }
        } else if (contentType.value === 'audio') {
            contentPreview = 'Audio file will be uploaded';
        } else if (contentType.value === 'pdf') {
            contentPreview = 'PDF file will be uploaded';
        }

        document.getElementById('preview_title').textContent = title;
        document.getElementById('preview_category').textContent = category;
        document.getElementById('preview_type').textContent = type;
        const contentPreviewElement = document.getElementById('preview_content');
        if (contentPreviewElement) {
            contentPreviewElement.textContent = contentPreview;
        }
    }

    // Preview update handlers
    titleInput.addEventListener('input', updatePreview);
    categorySelect.addEventListener('change', updatePreview);
    contentType.addEventListener('change', updatePreview);
    videoRadios.forEach(radio => {
        radio.addEventListener('change', updatePreview);
    });

    // Thumbnail preview
    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewImage = document.getElementById('preview_thumbnail');
            const placeholder = document.getElementById('preview_thumbnail_placeholder');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    placeholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
                placeholder.style.display = 'block';
            }
        });
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