<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Course;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors(['email' => 'You are not authorized as admin.']);
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput();
    }

public function dashboard()
{
$totalUsers = User::count();
    $pendingCourses = Course::where('status', 'pending')->count();
    $pendingList = Course::with('user')->where('status', 'pending')->get();
    $users = User::all();

    // Chart: Jumlah user per bulan (6 bulan terakhir)
    $chartLabels = [];
    $chartData = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = Carbon::now()->subMonths($i)->format('F');
        $count = User::whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                    ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                    ->count();

        $chartLabels[] = $month;
        $chartData[] = $count;
    }

    return view('admin.dashboard', compact(
        'totalUsers',
        'pendingCourses',
        'pendingList',
        'users',
        'chartLabels',
        'chartData'
    ));
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
public function reject($id)
{
    $course = Course::findOrFail($id);
    $course->status = 'rejected';
    $course->save();

    return redirect()->route('admin.dashboard')->with('success', 'Course rejected successfully.');
}
public function approve($id)
{
    $course = Course::findOrFail($id);
    $course->status = 'approved';
    $course->save();

    return redirect()->route('admin.dashboard')->with('success', 'Course approved successfully.');
}
public function destroyUser($id)
{
    $user = User::findOrFail($id);

    // Optional: jangan hapus admin dirinya sendiri
    if (auth()->id() == $user->id) {
        return redirect()->route('admin.dashboard')->withErrors('You cannot delete yourself.');
    }

    $user->delete();

    return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
}
}