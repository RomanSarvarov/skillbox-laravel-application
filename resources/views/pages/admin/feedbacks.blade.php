@extends('layout.base')

@php $title = 'Список обращений'; @endphp

@section('title', $title)

@section('content')
    <h2 class="pb-4 mb-4 font-italic border-bottom">{{ $title }}</h2>

    <section class="feedbacks">
        <div class="row">
            <div class="mt-5 col-12">
                <div class="feedbacks__list">
                    @if($feedbacks)
                        <table class="table table-bordered">
                            <thead>
                                <th>Email</th>
                                <th>Сообщение</th>
                                <th>Дата получения</th>
                            </thead>

                            <tbody>
                                @foreach($feedbacks as $feedback)
                                    @php /** @var \App\Models\Feedback $feedback */ @endphp
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
