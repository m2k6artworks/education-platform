<div class="border-start border-2 ps-3 mt-3" style="margin-left: {{ $depth * 20 }}px;">
    <div class="d-flex align-items-start mb-2">
        <div class="flex-shrink-0 me-3">
            <div class="avatar-sm bg-light rounded-circle">
                <span class="avatar-title text-primary fw-bold">
                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                </span>
            </div>
        </div>
        <div class="flex-grow-1">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="mb-1 fw-bold">{{ $comment->user->name }}</h6>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="mt-2">
                {!! $comment->content !!}
            </div>
            
            <!-- Reply Form -->
            <div class="mt-3">
                                    <button class="btn btn-sm btn-outline-primary" type="button" 
                            onclick="toggleReplyForm({{ $comment->id }}, '{{ $comment->user->name }}')">
                        <i class="fas fa-reply me-1"></i>Reply
                    </button>
            </div>
            
            <div id="reply-form-{{ $comment->id }}" class="mt-3" style="display: none;">
                <form action="{{ route('comments.store', $comment->course) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="mb-3">
                        <div id="snow-editor-reply-{{ $comment->id }}" style="height: 150px;">
                            <p></p>
                        </div>
                        <input type="hidden" name="content" id="reply-content-{{ $comment->id }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm" 
                                onclick="submitReply(event, {{ $comment->id }})">
                            <i class="fas fa-paper-plane me-1"></i>Post Reply
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" 
                                onclick="toggleReplyForm({{ $comment->id }})">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Nested Replies -->
    @foreach($comment->replies as $reply)
        @include('comments.reply', ['comment' => $reply, 'depth' => $depth + 1])
    @endforeach
</div>

<script>
function toggleReplyForm(commentId, username) {
    const form = document.getElementById(`reply-form-${commentId}`);
    const isHidden = form.style.display === 'none';
    
    if (isHidden) {
        form.style.display = 'block';
        // Initialize Quill editor for this reply form
        if (!window.quillInstances) window.quillInstances = {};
        if (!window.quillInstances[commentId]) {
            window.quillInstances[commentId] = new Quill(`#snow-editor-reply-${commentId}`, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'font': [] }, { 'size': [] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'script': 'super' }, { 'script': 'sub' }],
                        [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                        ['direction', { 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                },
                placeholder: 'Write your reply...'
            });
            
            // Insert @username at the beginning
            window.quillInstances[commentId].insertText(0, `@${username} `);
        }
    } else {
        form.style.display = 'none';
    }
}

function submitReply(event, commentId) {
    event.preventDefault();
    
    // Get the HTML content from Quill editor
    var content = window.quillInstances[commentId].root.innerHTML;
    
    // Set the hidden input value
    document.getElementById(`reply-content-${commentId}`).value = content;
    
    // Submit the form
    event.target.closest('form').submit();
}
</script>