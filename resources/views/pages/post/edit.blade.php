@extends('layout.base')

@php $title = 'Изменение статьи'; @endphp

@section('title', $title)

@section('content')
    <h2 class="pb-4 mb-4 font-italic border-bottom">{{ $title }}</h2>

    <section class="new-post">
        <div class="row">
            <div class="col-10 mb-5">
                <div class="new-post__form">
                    @include('layout.includes.alerts')

                    @method('PUT')
                    <form method="POST" action="{{ route('posts.update', $post->slug, false) }}">
                        <div class="form-group">
                            <label for="titleInput">Название статьи</label>
                            <input id="titleInput" name="title" type="text" class="form-control"
                                   value="{{ old('title', $post->title) }}"/>
                        </div>

                        <div class="form-group">
                            <label for="slugInput">Символьный код (Url Slug)</label>
                            <input id="slugInput" name="slug" type="text" class="form-control"
                                   value="{{ old('slug', $post->slug) }}"/>
                        </div>

                        <hr class="my-5"/>

                        <div class="form-group">
                            <label for="descriptionInput">Краткое описание</label>
                            <textarea id="descriptionInput" name="description" class="form-control"
                                      rows="2">{{ old('description', $post->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="contentInput">Содержимое статьи</label>
                            <textarea id="contentInput" name="content" class="form-control"
                                      rows="15">{{ old('content', $post->content) }}</textarea>
                        </div>

                        <div class="custom-control custom-checkbox mb-4">
                            <input type="hidden" name="is_posted" value="0" />
                            <input type="checkbox" class="custom-control-input" name="is_posted" id="isPostedCheckbox"
                                   value="1" {{ old('is_posted', $post->is_posted) ? 'checked' : '' }}/>
                            <label class="custom-control-label" for="isPostedCheckbox">Опубликовано сейчас</label>
                        </div>

                        @csrf

                        @method('PATCH')

                        <input type="submit" class="btn btn-primary" value="Отправить"/>
                    </form>

                    <div class="mt-3">
                        <form method="POST" action="{{ route('posts.destroy', $post->slug, false) }}">
                            @csrf

                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" value="Удалить запись" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
