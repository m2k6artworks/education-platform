<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseContent;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::where('status', 'approved')
                    ->withCount(['students'])
                    ->with(['category', 'creator'])
                    ->latest();

        // Filter by category if provided
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        $courses = $query->get();
        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        $contents = $course->contents()->orderBy('order')->get();

        $isEnrolled = false;
        if (auth()->check()) {
            $isEnrolled = $course->students()->where('user_id', auth()->id())->exists();
        }

        return view('courses.show', [
            'course' => $course,
            'contents' => $contents,
            'isEnrolled' => $isEnrolled,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image',
            'content_type' => 'required|in:article,video,audio,pdf',
            'description' => 'nullable|string',
            'video_option' => 'nullable|in:upload,url',
            'video_file' => 'nullable|file|mimetypes:video/*',
            'video_url' => 'nullable|url',
            'audio_file' => 'nullable|file|mimes:mp3',
            'pdf_file' => 'nullable|file|mimes:pdf',
        ]);

        // Upload thumbnail (optional)
        $thumbnailPath = '-';
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Create Course
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description ?? '-',
            'thumbnail' => $thumbnailPath,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        // Handle Course Content based on type
        $content = null;

        switch ($request->content_type) {
            case 'article':
                $content = $request->description;
                break;

            case 'video':
                if ($request->video_option === 'upload' && $request->hasFile('video_file')) {
                    $path = $request->file('video_file')->store('videos', 'public');
                    $content = $path;
                } elseif ($request->video_option === 'url') {
                    $content = $request->video_url;
                }
                break;

            case 'audio':
                if ($request->hasFile('audio_file')) {
                    $path = $request->file('audio_file')->store('audios', 'public');
                    $content = $path;
                }
                break;

            case 'pdf':
                if ($request->hasFile('pdf_file')) {
                    $path = $request->file('pdf_file')->store('pdfs', 'public');
                    $content = $path;
                }
                break;
        }

        // Simpan konten jika ada
        if ($content) {
            CourseContent::create([
                'course_id' => $course->id,
                'content_type' => $request->content_type,
                'content' => $content,
            ]);
        }

        return redirect()->route('home')->with('success', 'Course submitted for review.');
    }

    public function mySubmissions()
    {
        $courses = Course::with('contents')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('courses.my_submissions', compact('courses'));
    }

public function enroll(Request $request, Course $course)
{
    $user = auth()->user();

    // Cek apakah user sudah terdaftar
    if (!$user->enrolledCourses()->where('course_id', $course->id)->exists()) {
        $user->enrolledCourses()->attach($course->id);
    }

    return redirect()->route('courses.show', $course)->with('success', 'Berhasil mendaftar ke kursus!');
}
}