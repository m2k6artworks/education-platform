@extends('layouts.app')

@section('content')
<div class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <div class="col-12 col-lg-10">
            <div class="card border-0" style="border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h1 class="mb-2" style="font-weight: 600">🎓 Create New Course</h1>
                        <p class="text-muted">Fill in the details below to add a new course for review.</p>
                    </div>

                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-12 col-lg-8">
                                <!-- Title -->
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-bold">Course Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" required
                                        class="form-control form-control-lg"
                                        placeholder="e.g. Mastering Laravel for Beginners"
                                        value="{{ old('title') }}">
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
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                        <option value="article" {{ old('content_type') == 'article' ? 'selected' : '' }}>Article</option>
                                        <option value="video" {{ old('content_type') == 'video' ? 'selected' : '' }}>Video</option>
                                        <option value="audio" {{ old('content_type') == 'audio' ? 'selected' : '' }}>Audio Podcast</option>
                                        <option value="pdf" {{ old('content_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
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
                                    <textarea name="article_content" id="article_content" class="form-control hidden">{{ old('description') }}</textarea>
                                </div>

                                <!-- Video Options -->
                                <div id="video_wrapper" class="hidden content-wrapper">
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
                                        <small class="text-muted">Supported formats: MP4, AVI, MOV (Max: 100MB)</small>
                                    </div>

                                    <div id="video_url" class="hidden mb-4">
                                        <label for="video_url_input" class="form-label fw-bold">Video URL</label>
                                        <input type="url" name="video_url" id="video_url_input" 
                                               class="form-control" placeholder="https://youtube.com/... or https://vimeo.com/...">
                                        <small class="text-muted">YouTube, Vimeo, or direct video links</small>
                                    </div>
                                </div>

                                <!-- Audio -->
                                <div id="audio_wrapper" class="hidden mb-4 content-wrapper">
                                    <label for="audio_file" class="form-label fw-bold">Upload Audio (.mp3)</label>
                                    <input type="file" name="audio_file" accept="audio/mpeg" class="form-control">
                                    <small class="text-muted">MP3 format recommended (Max: 50MB)</small>
                                </div>

                                <!-- PDF -->
                                <div id="pdf_wrapper" class="hidden mb-4 content-wrapper">
                                    <label for="pdf_file" class="form-label fw-bold">Upload PDF</label>
                                    <input type="file" name="pdf_file" accept="application/pdf" class="form-control">
                                    <small class="text-muted">PDF files only (Max: 10MB)</small>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-12 col-lg-4">
                                <!-- Thumbnail -->
                                <div class="mb-4">
                                    <label for="thumbnail" class="form-label fw-bold">Course Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" 
                                           class="form-control dropify" data-plugins="dropify" data-height="200">
                                    <small class="text-muted">Recommended size: 800x600 pixels</small>
                                </div>

                                <!-- Course Preview Card -->
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">Course Preview</h6>
                                        <div class="mb-3">
                                            <small class="text-muted">Title:</small>
                                            <div id="preview_title" class="fw-bold">Your course title will appear here</div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Category:</small>
                                            <div id="preview_category" class="fw-bold">Category will appear here</div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Content Type:</small>
                                            <div id="preview_type" class="fw-bold">Content type will appear here</div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Content:</small>
                                            <div id="preview_content" class="fw-bold text-muted" style="font-size: 0.875rem;">Content will appear here</div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Thumbnail:</small>
                                            <div class="mt-2">
                                                <img id="preview_thumbnail" src="" alt="Preview" class="img-fluid rounded" style="max-height: 100px; display: none;">
                                                <div id="preview_thumbnail_placeholder" class="text-muted" style="font-size: 0.875rem;">No thumbnail selected</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4" style="font-weight: 600;">
                                <i class="fas fa-save me-2"></i>Submit Course
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

    // Get all form elements
    const contentType = document.getElementById('content_type');
    const titleInput = document.getElementById('title');
    const categorySelect = document.getElementById('category_id');
    const thumbnailInput = document.getElementById('thumbnail');

    // Get all content wrappers
    const articleWrapper = document.getElementById('article_wrapper');
    const videoWrapper = document.getElementById('video_wrapper');
    const audioWrapper = document.getElementById('audio_wrapper');
    const pdfWrapper = document.getElementById('pdf_wrapper');

    // Get video-specific elements
    const videoUpload = document.getElementById('video_upload');
    const videoURL = document.getElementById('video_url');
    const videoRadios = document.querySelectorAll('input[name="video_option"]');

    // Initialize Snow Editor for article content
    let articleQuill = null;

    // Function to hide all content wrappers
    function hideAllContentWrappers() {
        articleWrapper.classList.add('hidden');
        videoWrapper.classList.add('hidden');
        audioWrapper.classList.add('hidden');
        pdfWrapper.classList.add('hidden');
    }

    // Function to show specific content wrapper
    function showContentWrapper(wrapper) {
        hideAllContentWrappers();
        wrapper.classList.remove('hidden');
    }

    // Content type change handler with enhanced logic
    contentType.addEventListener('change', function () {
        const selectedType = this.value;
        
        // Hide all wrappers first
        hideAllContentWrappers();

        // Show appropriate wrapper based on selection
        switch (selectedType) {
            case 'article':
                showContentWrapper(articleWrapper);
                // Initialize Snow Editor if not already done
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
                    
                    // Add change listener to Quill editor for preview updates
                    articleQuill.on('text-change', function() {
                        updatePreview();
                        const content = articleQuill.root.innerHTML;
                        document.getElementById('article_content').innerHTML = content;
                    });
                }
                break;
                
            case 'video':
                showContentWrapper(videoWrapper);
                // Show default video option (upload)
                showVideoUpload();
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

    // Video option change handler with enhanced logic
    videoRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'upload') {
                showVideoUpload();
            } else {
                showVideoURL();
            }
        });
    });

    // Function to show video upload option
    function showVideoUpload() {
        videoUpload.classList.remove('hidden');
        videoURL.classList.add('hidden');
    }

    // Function to show video URL option
    function showVideoURL() {
        videoUpload.classList.add('hidden');
        videoURL.classList.remove('hidden');
    }

    // Enhanced preview update function
    function updatePreview() {
        const title = titleInput.value || 'Your course title will appear here';
        const category = categorySelect.options[categorySelect.selectedIndex]?.text || 'Category will appear here';
        const type = contentType.options[contentType.selectedIndex]?.text || 'Content type will appear here';
        
        // Get content preview based on type
        let contentPreview = 'Content will appear here';
        if (contentType.value === 'article' && articleQuill) {
            const content = articleQuill.getText().substring(0, 100);
            contentPreview = content ? (content + (content.length >= 100 ? '...' : '')) : 'Article content will appear here';
        } else if (contentType.value === 'video') {
            const selectedVideoOption = document.querySelector('input[name="video_option"]:checked');
            if (selectedVideoOption) {
                contentPreview = selectedVideoOption.value === 'upload' ? 'Video file will be uploaded' : 'Video URL will be provided';
            }
        } else if (contentType.value === 'audio') {
            contentPreview = 'Audio file will be uploaded';
        } else if (contentType.value === 'pdf') {
            contentPreview = 'PDF file will be uploaded';
        }

        // Update preview elements
        document.getElementById('preview_title').textContent = title;
        document.getElementById('preview_category').textContent = category;
        document.getElementById('preview_type').textContent = type;
        
        // Update content preview if element exists
        const contentPreviewElement = document.getElementById('preview_content');
        if (contentPreviewElement) {
            contentPreviewElement.textContent = contentPreview;
        }
    }

    // Add event listeners for real-time preview updates
    titleInput.addEventListener('input', updatePreview);
    categorySelect.addEventListener('change', updatePreview);
    contentType.addEventListener('change', updatePreview);

    // Add event listeners for video option changes
    videoRadios.forEach(radio => {
        radio.addEventListener('change', updatePreview);
    });

    // Add event listener for thumbnail preview
    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewImage = document.getElementById('preview_thumbnail');
            const placeholder = document.getElementById('preview_thumbnail_placeholder');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (previewImage) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                    }
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                if (previewImage) {
                    previewImage.style.display = 'none';
                }
                if (placeholder) {
                    placeholder.style.display = 'block';
                    placeholder.textContent = 'No thumbnail selected';
                }
            }
        });
    }

    // Initial preview update
    updatePreview();

    // Handle form submission for article content
    // const form = document.querySelector('form');
    // form.addEventListener('submit', function(e) {
    //     if (contentType.value === 'article' && articleQuill) {
    //         // Get the HTML content from Quill editor
    //         const content = articleQuill.root.innerHTML;
    //         document.getElementById('article_content').innerHTML = content;
    //     }
    // });
});
</script>
@endpush
@endsection