@extends('layout.base')

@php $title = 'О нас'; @endphp

@section('title', $title)

@section('content')
    <h2 class="pb-4 mb-4 font-italic border-bottom">{{ $title }}</h2>

    <section class="about">
        <p class="lead">Какой-то абстрактный текст "О нас"</p>
    </section>
@endsection
