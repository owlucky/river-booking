<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">Личный кабинет</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Ваши данные</h5>
            <p><strong>Имя:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>

    <h4>Ваши бронирования</h4>

    @forelse($bookings as $booking)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Путешествие:</strong> {{ $booking->trip->title }}</p>
                <p><strong>Место:</strong> {{ $booking->seat->label }}</p>
                <p><strong>Дата отправления:</strong> {{ $booking->trip->departure_at }}</p>
                <p><strong>Телефон:</strong> {{ $booking->phone }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted">Вы ещё не бронировали места.</p>
    @endforelse

    <a href="{{ route('booking.index') }}" class="btn btn-secondary mt-3">Назад</a>

</div>

</body>
</html>

