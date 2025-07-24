@extends('layouts.guest')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

    {{-- Summary Widgets --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="p-4 bg-white rounded shadow">
            <p class="text-sm text-gray-500">Total Users</p>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <p class="text-sm text-gray-500">Pending Courses</p>
            <p class="text-2xl font-bold">{{ $pendingCourses }}</p>
        </div>
    </div>

    {{-- Chart Area --}}
    <div class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-lg font-semibold mb-4">User Registrations</h2>
        <canvas id="userChart" class="w-full"></canvas>
    </div>

    {{-- Course Approval Table --}}
    <div class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-lg font-semibold mb-4">Pending Course Submissions</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Submitted By</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pendingList as $course)
                <tr>
                    <td class="px-4 py-2">{{ $course->title }}</td>
                    <td class="px-4 py-2">{{ $course->user->name }}</td>
                    <td class="px-4 py-2">{{ ucfirst($course->status) }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Approve</button>
                        </form>
                        <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Reject</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- User Management --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Registered Users</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart');
    const userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Users',
                data: @json($chartData),
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderRadius: 6
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection