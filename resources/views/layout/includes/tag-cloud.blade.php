@if($tagCloud->isNotEmpty())
    <div class="p-4">
        <h4 class="font-italic">Теги</h4>
        <ol class="list-unstyled mb-0">
            @foreach($tagCloud as $tag)
                @php /** @var \App\Models\Tag $tag */@endphp
                <li><a href="{{ $tag->url }}">{{ $tag->name }}</a></li>
            @endforeach
        </ol>
    </div>
@endif
