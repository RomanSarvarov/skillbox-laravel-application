@can('update', $news)
    <a href="{{ route('news.edit', $news, false) }}" class="btn btn-danger">Изменить</a>
@endcan