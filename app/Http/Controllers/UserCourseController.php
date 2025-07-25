<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user']);
    }

    public function index()
    {
        $user = Auth::user();
        $enrolledCourses = $user->enrolledCourses()->where('status', 'approved')->get();

        return view('user.my-course', compact('enrolledCourses'));
    }

    public function unenroll($courseId)
    {
        $user = Auth::user();
        $user->enrolledCourses()->detach($courseId);

        return redirect()->route('user.my-courses')->with('success', 'Berhasil keluar dari kursus.');
    }
}