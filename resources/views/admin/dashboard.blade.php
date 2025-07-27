<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin Dashboard | Kyulearn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Dashboard for Kyulearn Education Platform" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}">
    
    <!-- App css -->
    <link href="{{ asset('assets/css/config/default/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/config/default/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    
    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-end mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/profile.png') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>
                        <a href="{{ route('home') }}" class="dropdown-item notify-item">
                            <i class="fe-home"></i>
                            <span>Back to Home</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('icons/logo-circle.svg') }}" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('icons/logo-circle.svg') }}" alt="" height="20"> <span class="logo-txt">Kyulearn</span>
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>
            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">
            <div class="slimscroll-menu">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Navigation</li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                <i class="fe-airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="waves-effect">
                                <i class="fe-home"></i>
                                <span> Back to Site </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Admin Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="text-muted fw-normal mt-0" title="Total Users">{{ $totalUsers }}</h4>
                                            <h3 class="mt-3 mb-3">Total Users</h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-success me-2">
                                                    <i class="mdi mdi-arrow-up-bold"></i> 5.27%
                                                </span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-end">
                                                <i class="fas fa-users text-primary" style="font-size: 3rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="text-muted fw-normal mt-0" title="Pending Courses">{{ $pendingCourses }}</h4>
                                            <h3 class="mt-3 mb-3">Pending Courses</h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-warning me-2">
                                                    <i class="mdi mdi-arrow-up-bold"></i> 1.08%
                                                </span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-end">
                                                <i class="fas fa-clock text-warning" style="font-size: 3rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="text-muted fw-normal mt-0" title="Total Courses">{{ $totalCourses ?? 0 }}</h4>
                                            <h3 class="mt-3 mb-3">Total Courses</h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-success me-2">
                                                    <i class="mdi mdi-arrow-up-bold"></i> 6.65%
                                                </span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-end">
                                                <i class="fas fa-book text-success" style="font-size: 3rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="text-muted fw-normal mt-0" title="Total Categories">{{ $totalCategories ?? 7 }}</h4>
                                            <h3 class="mt-3 mb-3">Categories</h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-info me-2">
                                                    <i class="mdi mdi-arrow-up-bold"></i> 2.25%
                                                </span>
                                                <span class="text-nowrap">Since last month</span>
                                            </p>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-end">
                                                <i class="fas fa-tags text-info" style="font-size: 3rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mb-3">Pending Course Submissions</h4>
                                    <div class="table-responsive">
                                        <table id="pending-courses-table" class="table table-centered table-nowrap table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Instructor</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Submitted</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingList as $course)
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 fw-normal">{{ $course->title }}</h5>
                                                        <span class="text-muted font-13">{{ Str::limit($course->description, 50) }}</span>
                                                    </td>
                                                    <td>{{ $course->user->name }}</td>
                                                    <td>
                                                        @if($course->category)
                                                            <span class="badge" style="background-color: {{ $course->category->color }}; color: white;">
                                                                {{ $course->category->name }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-secondary">Uncategorized</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-warning">{{ ucfirst($course->status) }}</span>
                                                    </td>
                                                    <td>{{ $course->created_at->diffForHumans() }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fas fa-check"></i> Approve
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-times"></i> Reject
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mb-3">Registered Users</h4>
                                    <div class="table-responsive">
                                        <table id="users-table" class="table table-centered table-nowrap table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Joined</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded-circle me-2">
                                                                <span class="avatar-title text-primary fw-bold">
                                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <h5 class="font-14 my-1 fw-normal">{{ $user->name }}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if($user->hasRole('admin'))
                                                            <span class="badge bg-danger">Admin</span>
                                                        @elseif($user->hasRole('creator'))
                                                            <span class="badge bg-warning">Instructor</span>
                                                        @else
                                                            <span class="badge bg-info">Student</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- container -->
            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; Kyulearn by <a href="">Your Company</a> 
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#pending-courses-table').DataTable({
                "pageLength": 10,
                "order": [[4, "desc"]], // Sort by submitted date
                "language": {
                    "search": "Search courses:",
                    "lengthMenu": "Show _MENU_ courses per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ courses",
                    "infoEmpty": "No courses available",
                    "infoFiltered": "(filtered from _MAX_ total courses)"
                }
            });

            $('#users-table').DataTable({
                "pageLength": 15,
                "order": [[3, "desc"]], // Sort by joined date
                "language": {
                    "search": "Search users:",
                    "lengthMenu": "Show _MENU_ users per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ users",
                    "infoEmpty": "No users available",
                    "infoFiltered": "(filtered from _MAX_ total users)"
                }
            });
        });
    </script>

</body>
</html>