@extends('layout.base')

@section('title', 'Новости')

@section('content')
    @include('layout.includes.alerts')

    @include('layout.includes.articles', ['posts' => $news])
@endsection