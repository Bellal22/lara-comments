<link rel="stylesheet" href={{ asset('vendor/comments/css/app.css') }}>

    <div class="comment mb-4 p-3 border rounded" id="comment-{{ $comment->id }}">
        <div class="d-flex align-items-start">
            <!-- User Avatar and Name -->
            @if($user->hasMedia('avatars'))
            <img src="{{ $comment->user?->getAvatar() }}" alt="{{ $comment->user?->name }}" class="rounded-circle" width="50" height="50">
            @endif
            <div class="ml-3">
                <strong>{{ $comment->user?->name }}</strong>
                <small class="text-muted">{{ $comment->created_at?->diffForHumans() }}</small>

                <div class="mt-2">
                    <div>{!! $comment->content !!}</div>
                </div>
            </div>
        </div>

        <!-- Optional: Display replies to this comment if your system supports nested comments -->
        @if($comment->replies->count() > 0)
            <div class="mt-3">
                @foreach($comment->replies as $reply)
                    <x-comments-comment-component :comment="$reply"/>
                @endforeach
            </div>
    @endif

    <!-- Comment Reply Form (optional) -->
        <div class="mt-3">
            <form method="POST" action="{{ route('comments.reply', $comment) }}">
                @csrf
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="2" placeholder="Reply to this comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Reply</button>
            </form>
        </div>
    </div>
