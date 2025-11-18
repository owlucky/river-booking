<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать путешествие</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Редактировать путешествие</h2>

    <form method="POST" action="{{ route('admin.trip.update', $trip->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input type="text" name="title" class="form-control"
                   value="{{ $trip->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="description" class="form-control" required>{{ $trip->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Дата отправления</label>
            <input type="datetime-local" name="departure_at" class="form-control"
                   value="{{ \Carbon\Carbon::parse($trip->departure_at)->format('Y-m-d\TH:i') }}"
                   required>
        </div>

        <button class="btn btn-primary">Сохранить изменения</button>
        <a href="{{ route('booking.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>

</body>
</html>

