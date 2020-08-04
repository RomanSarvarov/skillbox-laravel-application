@extends('layout.base')

@php($title = 'Статистика сайта')

@section('title', $title)

@section('content')
    <h2 class="pb-4 mb-4 font-italic border-bottom">{{ $title }}</h2>

    <section class="statistics">
        <table class="table">
            <thead>
                <tr>
                    <th>Параметр</th>
                    <th>Значение</th>
                </tr>
            </thead>

            <tbody>
                @foreach($report as $row)
                    <tr>
                        <td><b>{{ $row['parameter'] }}</b></td>
                        <td>{!! $row['value'] ?? '---' !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
