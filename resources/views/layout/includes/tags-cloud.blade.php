@if(isset($tagsCloud) && $tagsCloud->isNotEmpty())
    <div class="p-4">
        <h4 class="font-italic">Теги</h4>
        @foreach($tagsCloud as $tag)
            @php /** @var \App\Models\Tag $tag */@endphp
            <a href="{{ $tag->url }}" class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
