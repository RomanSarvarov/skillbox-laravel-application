@if(isset($tags) && $tags->isNotEmpty())
    @php($class = $class ?? [])

    <div class="tags {{ implode(' ', (array)$class) }}">
        Теги:

        @foreach($tags as $tag)
            <a href="{{ $tag->url }}" class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
