<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id', // Make parent_id optional
        ]);

        Comment::create([
            'course_id' => $course->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null, // Set to null if not provided
        ]);

        return back()->with('success', 'Comment posted');
    }
}