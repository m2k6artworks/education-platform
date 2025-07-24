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
    
    <!-- Mobile menu -->
    <div id="mobile-menu" class="lg:hidden hidden" role="dialog" aria-modal="true">
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
            <span class="sr-only">EduPlatform</span>
            <span class="text-2xl font-bold text-indigo-600">EduPlatform</span>
          </a>
          <button type="button" id="mobile-menu-close" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
              <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="{{ route('home') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Home</a>
              @auth
                @if(auth()->user()->hasRole('admin'))
                  <a href="{{ route('admin.dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Admin Dashboard</a>
                @endif
              @endauth
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">About</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Contact</a>
            </div>
            <div class="py-6">
              @auth
                <form action="{{ route('logout') }}" method="POST" class="inline w-full">
                  @csrf
                  <button type="submit" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50 w-full text-left">
                    Logout
                  </button>
                </form>
                <a href="{{ route('courses.create') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Create Course</a>
              @else
                <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
                <a href="{{ route('register') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold bg-indigo-600 text-white hover:bg-indigo-500 mt-2">Register</a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
