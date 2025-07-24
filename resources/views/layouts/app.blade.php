<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'EduPlatform') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-900 max-full mx-auto px-4 sm:px-6 lg:px-8 mt-8" >
  
  <!-- Navbar -->
  @include('components.navbar')

  <!-- Hero Section -->
@if(!auth()->check())
  @if(View::hasSection('hero'))
    @yield('hero')
  @else
    @include('components.hero-section')
  @endif
@endif

  <!-- Content -->
  <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if (session('success'))
      <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow mb-6">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </main>

  <!-- Footer -->
  @include('components.footer')
  <script>
    // Mobile menu JS
    document.addEventListener('DOMContentLoaded', function() {
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');
      const mobileMenuClose = document.getElementById('mobile-menu-close');

      if (mobileMenuButton && mobileMenu && mobileMenuClose) {
        mobileMenuButton.addEventListener('click', function() {
          mobileMenu.classList.remove('hidden');
        });

        mobileMenuClose.addEventListener('click', function() {
          mobileMenu.classList.add('hidden');
        });

        document.addEventListener('click', function(event) {
          if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            mobileMenu.classList.add('hidden');
          }
        });
      }
    });
  </script>

  @yield('scripts')
</body>
</html>