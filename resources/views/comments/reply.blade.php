<div class="ml-{{ $depth * 4 }} border-l pl-4 mt-4">
    <p class="text-gray-800"><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
    <form action="{{ route('comments.store', $comment->course) }}" method="POST" class="mt-2">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <textarea name="content" class="w-full p-2 border rounded focus:ring focus:ring-blue-200" placeholder="Reply to this comment"></textarea>
        <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Reply</button>
    </form>
    @foreach($comment->replies as $reply)
        @include('comments.reply', ['comment' => $reply, 'depth' => $depth + 1])
    @endforeach
</div>