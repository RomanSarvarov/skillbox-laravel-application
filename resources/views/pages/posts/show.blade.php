@extends('layout.base')

@php
    $title = $post->title;

    /** @var \App\Models\Post $post */
@endphp

@section('title', $title)

@section('content')
    <section class="post">
        @include('layout.includes.alerts')

        <h2 class="post__title pb-4 mb-4 font-italic border-bottom">{{ $post->title }}</h2>

        <div class="post__meta text-muted">Дата публикации: {{ $post->created_at->format('d.m.Y') }}</div>

        <div class="row mt-5">
            <div class="post__content col-10 mb-5">
                {{ $post->content }}
            </div>
        </div>

        <footer class="post__footer my-3">
            @include('layout.includes.tags', ['tags' => $post->tags, 'class' => 'mb-4'])

            <a href="{{ route('homepage', [], false) }}" class="btn btn-primary">Вернуться на главную</a>

            @can('update', $post)
                <a href="{{ route('posts.edit', $post, false) }}" class="btn btn-danger">Изменить</a>
            @endcan
        </footer>
    </section>
@endsection
