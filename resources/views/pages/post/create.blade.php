@extends('layout.base')

@php $title = 'Создание новой статьи'; @endphp

@section('title', $title)

@section('content')
    <h2 class="pb-4 mb-4 font-italic border-bottom">{{ $title }}</h2>

    <section class="new-post">
        <div class="row">
            <div class="col-10 mb-5">
                <div class="new-post__form">
                    @include('layout.includes.alerts')

                    <form method="POST" action="{{ route('posts', [], false) }}">
                        <div class="form-group">
                            <label for="titleInput">Название статьи</label>
                            <input id="titleInput" name="title" type="text" class="form-control" value="{{ old('title') }}"/>
                        </div>

                        <div class="form-group">
                            <label for="slugInput">Символьный код (Url Slug)</label>
                            <input id="slugInput" name="slug" type="text" class="form-control" value="{{ old('slug') }}"/>
                        </div>

                        <hr class="my-5"/>

                        <div class="form-group">
                            <label for="descriptionInput">Краткое описание</label>
                            <textarea id="descriptionInput" name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="contentInput">Содержимое статьи</label>
                            <textarea id="contentInput" name="content" class="form-control" rows="15">{{ old('content') }}</textarea>
                        </div>

                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" name="is_posted" id="isPostedCheckbox" value="1" {{ old('is_posted', true) ? 'checked' : '' }}/>
                            <label class="custom-control-label" for="isPostedCheckbox">Опубликовано сейчас</label>
                        </div>

                        @csrf

                        <input type="submit" class="btn btn-primary" value="Отправить"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
