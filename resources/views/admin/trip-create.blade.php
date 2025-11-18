<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить путешествие</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Добавить новое путешествие</h2>

    <form method="POST" action="{{ route('admin.trip.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Дата отправления</label>
            <input type="datetime-local" name="departure_at" class="form-control" required>
        </div>

        <button class="btn btn-success">Сохранить</button>
        <a href="{{ route('booking.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>

</body>
</html>
