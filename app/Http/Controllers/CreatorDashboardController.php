<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreatorDashboardController extends Controller
{
    // Tampilkan semua course yang dibuat oleh creator
    public function index()
    {
        $courses = Course::where('user_id', Auth::id())->latest()->get();
        return view('creator.dashboard', compact('courses'));
    }

    // Tampilkan form edit
    public function edit(Course $course)
    {
        // Hanya izinkan edit kalau course milik user tersebut
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('creator.edit', compact('course', 'categories'));
    }

    // Simpan hasil edit
    public function update(Request $request, Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content_type' => 'required|in:article,video,audio,pdf',
            'thumbnail' => 'nullable|image|max:2048',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov|max:102400', // 100MB
            'video_url' => 'nullable|url',
            'audio_file' => 'nullable|file|mimes:mp3|max:51200', // 50MB
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB
            'article_content' => 'nullable|string',
        ]);

        $course->title = $request->title;
        $course->category_id = $request->category_id;
        $course->content_type = $request->content_type;
        $course->status = 'pending'; // reset ke pending setelah diedit

        // Handle content based on type
        switch ($request->content_type) {
            case 'article':
                $course->description = $request->article_content;
                // Clear all other content fields when switching to article
                $course->clearOtherContentFields();
                break;
                
            case 'video':
                if ($request->video_option === 'upload' && $request->hasFile('video_file')) {
                    // Delete old video file if exists
                    $course->deleteFile('video_path');
                    $course->video_path = $request->file('video_file')->store('videos', 'public');
                    $course->video_url = null; // Clear URL when uploading file
                } elseif ($request->video_option === 'url') {
                    // Delete old video file if exists
                    $course->deleteFile('video_path');
                    $course->video_url = $request->video_url;
                }
                // Clear other content fields
                $course->clearOtherContentFields('video_path');
                break;
                
            case 'audio':
                if ($request->hasFile('audio_file')) {
                    // Delete old audio file if exists
                    $course->deleteFile('audio_path');
                    $course->audio_path = $request->file('audio_file')->store('audio', 'public');
                }
                // Clear other content fields
                $course->clearOtherContentFields('audio_path');
                break;
                
            case 'pdf':
                if ($request->hasFile('pdf_file')) {
                    // Delete old PDF file if exists
                    $course->deleteFile('pdf_path');
                    $course->pdf_path = $request->file('pdf_file')->store('pdfs', 'public');
                }
                // Clear other content fields
                $course->clearOtherContentFields('pdf_path');
                break;
        }

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            $course->deleteFile('thumbnail');
            $course->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->save();

        return redirect()->route('creator.dashboard')->with('success', 'Course updated successfully and waiting for admin approval.');
    }

    // Hapus kursus
    public function destroy(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete all associated files before deleting the course
        $course->deleteAllFiles();

        $course->delete();

        return redirect()->route('creator.dashboard')->with('success', 'Kursus berhasil dihapus.');
    }
}
