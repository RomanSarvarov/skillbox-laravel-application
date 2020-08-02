<hr />

<div class="comments py-2">
    <h3>Комментарии</h3>

    <div class="comments__list">
        @forelse($commentable->comments as $comment)
            <div class="comment card mb-3">
                <div class="card-body">
                    <div class="comment__author"><b>Автор:</b> {{ $comment->author->name }}</div>
                    <div class="comment__content"><b>Комментарий:</b> {{ $comment->content }}</div>
                </div>
            </div>
        @empty
            <p>Комментариев нет.</p>
        @endforelse
    </div>

    @include('layout.includes.comment-form')
</div>

<hr />