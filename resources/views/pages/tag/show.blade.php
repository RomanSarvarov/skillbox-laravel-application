@extends('layout.base')

@php
    /** @var \App\Models\Tag $tag */
    $title = 'Тег: ' . $tag->name;
@endphp

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    <section class="posts mt-4">
        @include('layout.includes.posts', ['posts' => $tag->posts])
    </section>
@endsection
