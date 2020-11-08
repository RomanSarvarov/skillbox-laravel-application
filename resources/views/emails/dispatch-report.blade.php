@component('mail::message')
    <strong>Статистика сайта:</strong>
    <ul>
        @foreach($report as $data)
            <li>{{ $data['name'] }}: {{ $data['count'] }}</li>
        @endforeach
    </ul>
@endcomponent