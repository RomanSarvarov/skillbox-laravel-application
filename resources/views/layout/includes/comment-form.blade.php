<div class="comments_form mt-3">
    <form method="POST">
        <textarea
            name="content"
            class="form-control"
            placeholder="Введите текст для комментария..."
            rows="4">{{ old('content') }}</textarea>

        @csrf

        <input class="btn btn-block btn-sm btn-success mt-2" type="submit" value="Отправить комментарий" />
    </form>
</div>