@extends('layout.base')

@section('title', 'Главная страница')

@section('content')
    @include('layout.includes.posts', ['posts' => $posts])
@endsection
