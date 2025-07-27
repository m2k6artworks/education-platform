<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                break;
            case 'video':
                if ($request->video_option === 'upload' && $request->hasFile('video_file')) {
                    $course->video_path = $request->file('video_file')->store('videos', 'public');
                } elseif ($request->video_option === 'url') {
                    $course->video_url = $request->video_url;
                }
                break;
            case 'audio':
                if ($request->hasFile('audio_file')) {
                    $course->audio_path = $request->file('audio_file')->store('audio', 'public');
                }
                break;
            case 'pdf':
                if ($request->hasFile('pdf_file')) {
                    $course->pdf_path = $request->file('pdf_file')->store('pdfs', 'public');
                }
                break;
        }

        if ($request->hasFile('thumbnail')) {
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

        $course->delete();

        return redirect()->route('creator.dashboard')->with('success', 'Kursus berhasil dihapus.');
    }
}
