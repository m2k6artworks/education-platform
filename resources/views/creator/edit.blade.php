@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-6">
    <h2 class="text-2xl font-bold text-indigo-600 mb-4">✏️ Edit Kursus</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('creator.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('description', $course->description) }}</textarea>
        </div>

        {{-- Content Type --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tipe Konten</label>
            <select name="type" id="contentType" class="w-full border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="article" {{ $course->type == 'article' ? 'selected' : '' }}>📝 Artikel</option>
                <option value="video" {{ $course->type == 'video' ? 'selected' : '' }}>📹 Video</option>
                <option value="audio" {{ $course->type == 'audio' ? 'selected' : '' }}>🎧 Audio (Upload)</option>
                <option value="pdf" {{ $course->type == 'pdf' ? 'selected' : '' }}>📄 PDF (Upload)</option>
            </select>
        </div>

        {{-- Video Input (link or file) --}}
        <div id="videoOptions" class="mb-4" style="display: none;">
            <label class="block font-semibold mb-1">Jenis Video</label>
            <select name="video_source_type" id="videoSourceType" class="w-full border-gray-300 rounded px-3 py-2">
                <option value="link" {{ $course->video_url ? 'selected' : '' }}>🔗 Link Video</option>
                <option value="file" {{ $course->video_path ? 'selected' : '' }}>📁 Upload Video File</option>
            </select>

            <div id="videoLinkInput" class="mt-2" style="display: none;">
                <label class="block font-semibold mb-1">URL Video</label>
                <input type="url" name="video_url" value="{{ old('video_url', $course->video_url) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>

            <div id="videoFileInput" class="mt-2" style="display: none;">
                <label class="block font-semibold mb-1">Upload Video File</label>
                <input type="file" name="video_path" accept="video/*" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        {{-- Audio --}}
        <div class="mb-4" id="audioInput" style="display: none;">
            <label class="block font-semibold mb-1">Upload Audio</label>
            <input type="file" name="audio_path" accept="audio/*" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        {{-- PDF --}}
        <div class="mb-4" id="pdfInput" style="display: none;">
            <label class="block font-semibold mb-1">Upload PDF</label>
            <input type="file" name="pdf_path" accept="application/pdf" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Thumbnail --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Thumbnail (Opsional)</label>
            <input type="file" name="thumbnail" accept="image/*" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded">
            Simpan Perubahan
        </button>
    </form>
</div>

<script>
    function toggleContentFields(type) {
        document.getElementById('videoOptions').style.display = (type === 'video') ? 'block' : 'none';
        document.getElementById('audioInput').style.display = (type === 'audio') ? 'block' : 'none';
        document.getElementById('pdfInput').style.display = (type === 'pdf') ? 'block' : 'none';
    }

    function toggleVideoInput(source) {
        document.getElementById('videoLinkInput').style.display = (source === 'link') ? 'block' : 'none';
        document.getElementById('videoFileInput').style.display = (source === 'file') ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const contentType = document.getElementById('contentType');
        const videoSourceType = document.getElementById('videoSourceType');

        toggleContentFields(contentType.value);
        if (videoSourceType) toggleVideoInput(videoSourceType.value);

        contentType.addEventListener('change', function () {
            toggleContentFields(this.value);
        });

        if (videoSourceType) {
            videoSourceType.addEventListener('change', function () {
                toggleVideoInput(this.value);
            });
        }
    });
</script>
@endsection