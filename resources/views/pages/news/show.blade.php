@extends('layout.base')

@php
    /** @var \App\Models\News $news */
    $title = $news->title;
@endphp

@section('title', $title)

@section('content')
    <section class="post">
        @include('layout.includes.alerts')

        <h2 class="post__title pb-4 mb-4 font-italic border-bottom">{{ $news->title }}</h2>

        <div class="post__meta text-muted">Дата публикации: {{ $news->created_at->format('d.m.Y') }}</div>

        <div class="row mt-5">
            <div class="post__content col-10 mb-3">
                {{ $news->content }}
            </div>
        </div>

        <footer class="post__footer my-3">
            @include('layout.includes.tags', ['tags' => $news->tags, 'class' => 'mb-4'])

            @comments(['commentable' => $news])

            <a href="{{ route('news.index', [], false) }}" class="btn btn-primary">Вернуться назад</a>

            @newsEditBtn()
        </footer>
    </section>
@endsection
