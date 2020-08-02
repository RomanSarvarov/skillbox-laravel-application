<section class="posts">
    @forelse($posts as $post)
        @php /** @var \App\Models\Post $post */ @endphp
        <article class="posts__entry post mb-5">
            <h2 class="post__title">{{ $post->title }}</h2>
            <p class="post__created-at text-muted">Опубликовано {{ $post->created_at->format('d.m.Y') }}</p>

            <div class="post__description">
                {{ $post->description }}
            </div>

            @include('layout.includes.tags', ['tags' => $post->tags, 'class' => 'mt-4', 'modelKey' => 'posts'])

            <a href="{{ $post->url }}"
               class="btn btn-primary mt-3">
                Читать полностью
            </a>
        </article>
@empty
    <p class="lead">Статей нет.</p>
@endforelse
</section>
