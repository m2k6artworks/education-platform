<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'EduPlatform') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Tambahan penting untuk keamanan -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-900">
    <!-- Header/Navbar -->
  <header class="absolute inset-x-0 top-0 z-50">
    <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
      <div class="flex lg:flex-1">
        <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
          <span class="sr-only">EduPlatform</span>
          <span class="text-2xl font-bold text-indigo-600">EduPlatform</span>
        </a>
      </div>
      
      <!-- Mobile menu button -->
      <div class="flex lg:hidden">
        <button type="button" id="mobile-menu-button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      
      <!-- Desktop navigation -->
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="{{ route('home') }}" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">Home</a>
        @auth
          @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">Admin</a>
          @endif
        @endauth
        <a href="#" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">About</a>
        <a href="#" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">Contact</a>
      </div>
      
      <!-- Auth buttons -->
      <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:gap-x-4">
        @auth
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-sm/6 font-semibold text-gray-900 hover:text-red-600">
              Logout <span aria-hidden="true">&rarr;</span>
            </button>
          </form>
          @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'creator']))
            <a href="{{ route('courses.create') }}" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">Create Course</a>
          @endif
        @else
          <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">Log in</a>
          <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Register
          </a>
        @endauth
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto px-6 py-32">
    @if (session('success'))
      <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow mb-6">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </main>
</body>
</html>
