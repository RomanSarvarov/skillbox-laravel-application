@extends('layout.base')

@php($title = 'Панель управления')

@section('title', $title)

@section('content')
    <h2 class="pb-4 mb-4 font-italic border-bottom">{{ $title }}</h2>

    <section class="feedbacks">
        <div class="row">
            <div class="mt-5 col-12">
                <div class="posts__list mb-5">
                    @if($posts)
                        <h3 class="mb-3">Записи</h3>

                        <table class="table table-bordered">
                            <thead>
                                <th>Заголовок</th>
                                <th>Дата</th>
                                <th>Операции</th>
                            </thead>

                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->created_at->format('d.m.Y') }}</td>
                                        <td>
                                            <a href="{{ route('posts.edit', $post, false) }}" class="btn btn-danger">Изменить</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Записей не найдено!</p>
                    @endif
                </div>

                <div class="feedbacks__list mb-5">
                    @if($feedbacks)
                        <h3 class="mb-3">Обращения</h3>

                        <table class="table table-bordered">
                            <thead>
                                <th>Email</th>
                                <th>Сообщение</th>
                                <th>Дата получения</th>
                            </thead>

                            <tbody>
                                @foreach($feedbacks as $feedback)
                                    <tr>
                                        <td>{{ $feedback->email }}</td>
                                        <td>{{ $feedback->message }}</td>
                                        <td>{{ $feedback->created_at->format('d.m.Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Обращений не найдено!</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
