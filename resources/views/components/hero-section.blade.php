<!-- Hero Section Component -->
<section class="relative isolate px-6 pt-14 lg:px-8">
  <!-- Background gradient blurs -->
  <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
    <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" 
         class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
  </div>
  
  <div class="mx-auto max-w-4xl py-24 sm:py-32 lg:py-40">
    <!-- Announcement banner -->
    @if(isset($announcement))
    <div class="hidden sm:mb-8 sm:flex sm:justify-center">
      <div class="relative rounded-full px-4 py-2 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20 transition-all duration-300">
        {{ $announcement['text'] ?? 'Platform pembelajaran online terpercaya.' }}
        @if(isset($announcement['link']))
        <a href="{{ $announcement['link'] }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
          <span aria-hidden="true" class="absolute inset-0"></span>
          {{ $announcement['link_text'] ?? 'Pelajari lebih lanjut' }} <span aria-hidden="true">&rarr;</span>
        </a>
        @endif
      </div>
    </div>
    @endif
    
    <!-- Main hero content -->
    <div class="text-center">
      <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl lg:text-7xl">
        {{ $title ?? 'Belajar Online Bersama EduPlatform' }}
      </h1>
      <p class="mt-6 text-lg leading-8 text-gray-600 max-w-3xl mx-auto">
        {{ $subtitle ?? 'Platform edukasi terbaik untuk meningkatkan keterampilanmu secara fleksibel. Temukan ribuan kursus berkualitas dari instruktur terpercaya.' }}
      </p>
      
      <!-- Statistics -->
      @if(isset($stats))
      <div class="mt-10 flex items-center justify-center gap-x-8 text-sm leading-6 text-gray-600">
        @foreach($stats as $stat)
        <div class="flex items-center gap-x-2">
          <span class="font-semibold text-gray-900">{{ $stat['value'] }}</span>
          <span>{{ $stat['label'] }}</span>
        </div>
        @endforeach
      </div>
      @endif
      
      <!-- CTA buttons -->
      <div class="mt-10 flex items-center justify-center gap-x-6">
        @if(isset($primaryButton))
        <a href="{{ $primaryButton['url'] }}" 
           class="rounded-md bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200">
          {{ $primaryButton['text'] }}
        </a>
        @endif
        
        @if(isset($secondaryButton))
        <a href="{{ $secondaryButton['url'] }}" 
           class="text-sm font-semibold leading-6 text-gray-900 hover:text-indigo-600 transition-colors duration-200">
          {{ $secondaryButton['text'] }} <span aria-hidden="true">→</span>
        </a>
        @endif
      </div>
      
      <!-- Featured content preview -->
      @if(isset($featuredCourses) && count($featuredCourses) > 0)
      <div class="mt-16">
        <p class="text-sm font-medium text-gray-500 mb-8">Kursus Unggulan</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
          @foreach($featuredCourses->take(3) as $course)
          <div class="bg-white/80 backdrop-blur-sm rounded-lg border border-gray-200 p-4 hover:shadow-lg transition-all duration-300">
            @if($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                 alt="{{ $course->title }}" 
                 class="w-full h-32 object-cover rounded-md mb-3">
            @else
            <div class="w-full h-32 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-md mb-3 flex items-center justify-center">
              <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
            </div>
            @endif
            <h3 class="font-medium text-gray-900 text-sm mb-1">{{ Str::limit($course->title, 40) }}</h3>
            <p class="text-xs text-gray-500">{{ $course->instructor }}</p>
          </div>
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>
  
  <!-- Bottom gradient blur -->
  <div aria-hidden="true" class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
    <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" 
         class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"></div>
  </div>
</section>