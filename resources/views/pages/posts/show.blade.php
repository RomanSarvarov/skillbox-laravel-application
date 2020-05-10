@extends('layout.base')

@php
    $title = 'Создание новой статьи';

    /** @var \App\Models\Post $post */
@endphp

@section('title', $title)

@section('content')
    <section class="post">
        <h2 class="post__title pb-4 mb-4 font-italic border-bottom">{{ $post->title }}</h2>

        <div class="post__meta text-muted">Дата публикации: {{ $post->created_at->format('d.m.Y') }}</div>

        <div class="row mt-5">
            <div class="post__content col-10 mb-5">
                {{ $post->content }}
            </div>
        </div>

        <footer class="post__footer my-3">
            @if($post->tags->isNotEmpty())
                <div class="tags">Теги: {{ $post->tags->implode('name', ', ') }}</div>

                <br />
            @endif

            <a href="{{ route('homepage', [], false) }}" class="btn btn-primary">Вернуться на главную</a>
        </footer>
    </section>
@endsection
