@extends('layout.base')

@section('title', 'Главная страница')

@section('content')
    @include('layout.includes.alerts')

    @include('layout.includes.articles')
@endsection