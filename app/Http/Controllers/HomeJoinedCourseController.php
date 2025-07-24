<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class HomeJoinedCourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $enrolledCourses = $user->enrolledCourses()
            ->where('status', 'approved')
            ->latest()
            ->get();

        $unjoinedCourses = Course::where('status', 'approved')
            ->whereDoesntHave('students', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->latest()
            ->get();
        
        $enrolledCourseIds = $enrolledCourses->pluck('id')->toArray();

        return view('courses.HomeJoinedCourse', compact('enrolledCourses', 'unjoinedCourses','enrolledCourseIds'));
    }
}