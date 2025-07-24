@auth
    <a href="{{ route('courses.show', $course->id) }}"
       class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
       Pelajari Sekarang
    </a>
@else
    <a href="{{ route('login') }}"
       class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
       onclick="alert('Silakan login atau daftar terlebih dahulu untuk mengakses course ini.')">
       Pelajari Sekarang
    </a>
@endauth
