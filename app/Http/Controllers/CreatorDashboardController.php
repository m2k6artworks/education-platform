<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

        return view('creator.edit', compact('course'));
    }

    // Simpan hasil edit
    public function update(Request $request, Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $course->title = $request->title;
        $course->description = $request->description;
        $course->status = 'pending'; // reset ke pending setelah diedit

        if ($request->hasFile('thumbnail')) {
            $course->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->save(); // Eloquent ORM method

        return redirect()->route('creator.dashboard')->with('success', 'Kursus berhasil diperbarui dan menunggu persetujuan admin.');
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
