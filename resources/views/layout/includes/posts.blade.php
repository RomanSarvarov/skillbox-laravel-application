<section class="posts">
    @if($posts->isNotEmpty())
        @foreach($posts as $post)
            @php /** @var \App\Models\Post $post */ @endphp
            <article class="posts__entry post mb-5">
                <h2 class="post__title">{{ $post->title }}</h2>
                <p class="post__created-at text-muted">Опубликовано {{ $post->created_at->format('d.m.Y') }}</p>

                <div class="post__description">
                    {{ $post->description }}
                </div>

                @include('layout.includes.tags', ['tags' => $post->tags, 'class' => 'mt-4'])

                <a href="{{ route('posts.show', $post, false) }}" class="btn btn-primary mt-3">Читать полностью</a>
            </article>
        @endforeach
    @else
        <p class="lead">Статей нет.</p>
    @endif
</section>
