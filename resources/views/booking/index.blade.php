<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выбор рейса</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<!-- 🔐 Панель входа -->
<div class="position-absolute top-0 end-0 p-3">
    @guest
        <a href="{{ route('login') }}" class="btn btn-outline-primary">Войти</a>
    @else
        <span class="me-2">Привет, {{ Auth::user()->name }}</span>

        <a href="{{ route('profile') }}" class="btn btn-outline-success me-2">
            Личный кабинет
        </a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button class="btn btn-outline-danger">Выйти</button>
        </form>
    @endguest
</div>


<div class="container mt-5">
    <h1 class="mb-4 text-center">Система бронирования мест</h1>

    <!-- 🔍 Форма поиска -->
    <form method="GET" action="{{ route('booking.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Введите название путешествия"
                   value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Поиск</button>
        </div>
    </form>
    <!-- Кнопка "Добавить новое путешествие" — видна только админам -->
    @auth
        @if(Auth::user()->role === 'admin')
            <div class="mb-4 text-end">
                <a href="{{ route('admin.trip.create') }}" class="btn btn-success">
                    ➕ Добавить новое путешествие
                </a>
            </div>
        @endif
    @endauth

    <div class="row">
        @forelse($trips as $trip)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $trip->title }}</h5>
                        <p class="card-text">{{ $trip->description }}</p>
                        <p>
                            <strong>Отправление:</strong>
                            {{ \Carbon\Carbon::parse($trip->departure_at)->format('d.m.Y H:i') }}
                        </p>

                        <a href="{{ route('booking.show', $trip->id) }}" class="btn btn-primary">Забронировать</a>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.trip.edit', $trip->id) }}" class="btn btn-warning ms-2">
                                    ✏ Редактировать
                                </a>

                                <form action="{{ route('admin.trip.delete', $trip->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ms-2"
                                            onclick="return confirm('Удалить это путешествие?')">
                                        🗑 Удалить
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Путешествия не найдены.</p>
        @endforelse
    </div>
</div>
</body>
</html>
