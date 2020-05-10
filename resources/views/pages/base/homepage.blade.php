@extends('layout.base')

@section('title', 'Главная страница')

@section('content')
    <section class="posts">
        @if($posts)
            @foreach($posts as $post)
                @php /** @var \App\Models\Post $post */ @endphp
                <article class="posts__entry post mb-5">
                    <h2 class="post__title">{{ $post->title }}</h2>
                    <p class="post__created-at text-muted">Опубликовано {{ $post->created_at->format('d.m.Y') }}</p>

                    <div class="post__description">
                        {{ $post->description }}
                    </div>

                    <a href="{{ route('posts.show', $post->slug, false) }}" class="btn btn-primary mt-4">Читать полностью</a>
                </article>
            @endforeach
        @else
            <p class="lead">Статей нет.</p>
        @endif
    </section>
@endsection
