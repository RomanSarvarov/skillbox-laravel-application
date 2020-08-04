@if ($model->history->isNotEmpty())
    <hr class="my-5" />

    <h3>История изменений</h3>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Когда</th>
            <th>Кем</th>
            <th>Что</th>
        </tr>
        </thead>

        <tbody>
        @foreach($model->history as $change)
            @continue(empty($change->changes))

            <tr>
                <td>
                    {{ $change->created_at ? $change->created_at->diffForHumans() : '---' }}
                </td>
                <td>{{ $change->user ? "{$change->user->name} (ID: {$change->user->id})" : '---' }}</td>
                <td>
                    <ul class="m-0 list-unstyled">
                        @foreach($change->changes as $param => $changes)
                            <li>
                                <b>{{ $param }}</b> <small>({{ $changes[0] ?: 'нет' }} <code>-></code> {{ $changes[1] ?: 'нет' }})</small>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif