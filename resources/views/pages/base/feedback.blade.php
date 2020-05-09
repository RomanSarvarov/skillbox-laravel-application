@extends('layout.base')

@php $title = 'Связаться с нами'; @endphp

@section('title', $title)

@section('content')
    <h2 class="pb-4 mb-4 font-italic border-bottom">{{ $title }}</h2>

    <section class="contacts">
        <div class="contacts__info">
            <ul>
                <li>Телефон: +7 (495) 999-99-99</li>
                <li>E-mail: <a href="mailto:test@gmail.com">test@gmail.com</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="mt-5 col-9">
                <div class="contacts__form">
                    <h3 class="mb-3">Форма обратной связи</h3>

                    @include('layout.includes.alerts')

                    <form method="POST">
                        <div class="form-group">
                            <label for="emailInput">Ваш Email</label>
                            <input id="emailInput" name="email" type="email" class="form-control" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <label for="messageInput">Сообщение</label>
                            <textarea id="messageInput" name="message" class="form-control" rows="5" value="{{ old('message') }}"></textarea>
                        </div>

                        @csrf

                        <input type="submit" class="btn btn-primary" value="Отправить" />
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
