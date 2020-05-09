@if(session()->has('success'))
    <div class="alert alert-success mb-4">
        {{ session()->get('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
