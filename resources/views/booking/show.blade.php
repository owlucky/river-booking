<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $trip->title }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .shipbody {
            width: 90%;
            height: 500px;
            margin: 40px auto;
            position: relative;
        }

        .main {
            width: 100%;
            top: 13.2%;
            height: 70%;
            display: flex;
            position: absolute;
            z-index: 1;
        }

        .main div {
            gap: 0;
            box-sizing: border-box;
        }

        .left {
            position: absolute;
            width: 30%;
            height: 100%;
            border-bottom-left-radius: 50%;
            border-top-left-radius: 50%;
            clip-path: polygon(0 0, 50% 0, 50% 100%, 0 100%);
            border: 2px solid black;
            background: #2D5D9C;
        }

        .middle {
            margin-left: 15%;
            width: 65%;
            height: 100%;
            border: 2px solid black;
            left: 0;
            display: flex;
            z-index: 1;
            position: relative;
            background: white;
        }

        .right {
            width: 38%;
            margin-left: 61%;
            height: 100%;
            border-bottom-right-radius: 50%;
            border-top-right-radius: 50%;
            clip-path: polygon(50% 0, 100% 0, 100% 100%, 50% 100%);
            display: flex;
            background-color: rgb(45, 93, 156);
            position: absolute;
            isolation: isolate;
        }

        .right-2 {
            width: 65%;
            height: 100%;
            border-left: 2px solid black;
            margin: 0;
            margin-left: 35%;
        }

        .top {
            box-sizing: border-box;
            margin: 0;
            height: 50%;
            width: 100%;
            display: flex;
            padding-bottom: 15px; /* Увеличил расстояние между верхними и нижними креслами */
        }

        .bot {
            box-sizing: border-box;
            margin: 0;
            height: 50%;
            width: 100%;
            display: flex;
            position: relative;
            padding-top: 15px; /* Увеличил расстояние между верхними и нижними креслами */
        }

        .top-left-lines {
            width: 17%;
            margin-right: 3%;
            border-bottom: 2px solid black;
            height: 95%;
            padding-top: 1%;
            padding-left: 1%;
            padding-bottom: 1%;
        }

        .doors {
            position: relative;
            margin-left: 1%;
            width: 9%;
            height: 80%;
            top: 10%;
            border: 2px solid black;
            border-radius: 20% 20%;
            margin-right: 1%;
            display: flex;
            background: #ccc;
        }

        .sircle {
            position: absolute;
            width: 50%;
            aspect-ratio: 1 / 1;
            margin-left: 25%;
            top: 50%;
            transform: translateY(-50%);
            border: 2px solid black;
            border-radius: 50%;
            background: #999;
        }

        .chears {
            box-sizing: border-box;
            position: relative;
            top: 5%;
            bottom: 5%;
            width: 7%;
            margin-right: 2%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 95%;
        }

        .chear {
            position: relative;
            color: white;
            font-size: 14px;
            max-height: 30%;
            aspect-ratio: 1 / 1;
            background-color: rgb(16, 81, 177);
            border: 2px solid rgb(16, 81, 177);
            border-radius: 20%;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            cursor: pointer;
            transition: all 0.3s;
        }

        .chear:hover {
            background: white;
            color: rgb(16, 81, 177);
            border: 2px solid rgb(16, 81, 177);
        }

        .chear.booked {
            background-color: #dc3545;
            border-color: #dc3545;
            cursor: not-allowed;
        }

        .chear.booked:hover {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .chear.selected {
            background: white;
            color: rgb(16, 81, 177);
            border: 2px solid rgb(16, 81, 177);
            transform: scale(1.1);
        }

        .chear:last-child {
            margin-bottom: 15%;
        }

        .table {
            height: 90%;
            aspect-ratio: 1/3;
            background-color: gray;
            border-bottom-left-radius: 50% 15%;
            border-bottom-right-radius: 50% 15%;
            margin-right: 2%;
            margin-bottom: -15px; /* Соприкасается с контуром */
        }

        .table-2 {
            height: 90%;
            aspect-ratio: 1/3;
            background-color: gray;
            border-top-left-radius: 50% 15%;
            border-top-right-radius: 50% 15%;
            margin-right: 2%;
            margin-top: 16px;
        }

        .pilot {
            position: absolute;
            height: 50%;
            width: 25%;
            top: 50%;
            margin-left: calc(50% - 4px);
            transform: translateY(-50%);
            background-color: white;
            display: flex;
            border: 1px solid black;
            border-left: none;
            z-index: 1000;
        }

        .chearcap {
            background: #2D5D9C;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 40%;
            width: 35%;
            height: 35%;
            border-radius: 20%;
        }

        .booking-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .selected-seat-info {
            background: #e9f7ff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $trip->title }}</h1>
        <p>{{ $trip->description }}</p>
        <p><strong>Отправление:</strong> {{ $trip->departure_at }}</p>
        <a href="{{ route('booking.index') }}" class="btn btn-secondary">← Назад к списку рейсов</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="shipbody">
        <div class="main">
            <div class="left"></div>
            <div class="middle">
                <div class="right-2">
                    <div class="top">
                        <div class="top-left-lines">
                            <div style="border: 2px solid black; height: 98%; width: calc(100% - 1px); box-sizing: border-box; padding: 0; margin: -1px;">
                                <div style="height: calc(10% + 2px); border-top: 2px solid black; margin: -1px; box-sizing: border-box;"></div>
                                <div style="display: flex; height: 80%; margin: -1px; box-sizing: border-box;">
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                    <div style="width: calc(10% + 2px); border: 2px solid black; box-sizing: border-box; margin: -1px;"></div>
                                </div>
                                <div style="height: calc(10% + 2px); border-top: 2px solid black; margin: -1px; box-sizing: border-box;"></div>
                            </div>
                        </div>

                        <!-- Верхний ряд мест (обратный порядок) -->
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '42')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '42')->first()->id ?? '' }}"
                                    data-seat-label="42">42</button>
                            <button class="chear {{ in_array($seats->where('label', '41')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '41')->first()->id ?? '' }}"
                                    data-seat-label="41">41</button>
                            <button class="chear {{ in_array($seats->where('label', '40')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '40')->first()->id ?? '' }}"
                                    data-seat-label="40">40</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '36')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '36')->first()->id ?? '' }}"
                                    data-seat-label="36">36</button>
                            <button class="chear {{ in_array($seats->where('label', '35')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '35')->first()->id ?? '' }}"
                                    data-seat-label="35">35</button>
                            <button class="chear {{ in_array($seats->where('label', '34')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '34')->first()->id ?? '' }}"
                                    data-seat-label="34">34</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '30')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '30')->first()->id ?? '' }}"
                                    data-seat-label="30">30</button>
                            <button class="chear {{ in_array($seats->where('label', '29')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '29')->first()->id ?? '' }}"
                                    data-seat-label="29">29</button>
                            <button class="chear {{ in_array($seats->where('label', '28')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '28')->first()->id ?? '' }}"
                                    data-seat-label="28">28</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '24')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '24')->first()->id ?? '' }}"
                                    data-seat-label="24">24</button>
                            <button class="chear {{ in_array($seats->where('label', '23')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '23')->first()->id ?? '' }}"
                                    data-seat-label="23">23</button>
                            <button class="chear {{ in_array($seats->where('label', '22')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '22')->first()->id ?? '' }}"
                                    data-seat-label="22">22</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '18')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '18')->first()->id ?? '' }}"
                                    data-seat-label="18">18</button>
                            <button class="chear {{ in_array($seats->where('label', '17')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '17')->first()->id ?? '' }}"
                                    data-seat-label="17">17</button>
                            <button class="chear {{ in_array($seats->where('label', '16')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '16')->first()->id ?? '' }}"
                                    data-seat-label="16">16</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '12')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '12')->first()->id ?? '' }}"
                                    data-seat-label="12">12</button>
                            <button class="chear {{ in_array($seats->where('label', '11')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '11')->first()->id ?? '' }}"
                                    data-seat-label="11">11</button>
                            <button class="chear {{ in_array($seats->where('label', '10')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '10')->first()->id ?? '' }}"
                                    data-seat-label="10">10</button>
                        </div>
                        <div class="table"></div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '1')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '1')->first()->id ?? '' }}"
                                    data-seat-label="1">1</button>
                            <button class="chear {{ in_array($seats->where('label', '2')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '2')->first()->id ?? '' }}"
                                    data-seat-label="2">2</button>
                            <button class="chear {{ in_array($seats->where('label', '3')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '3')->first()->id ?? '' }}"
                                    data-seat-label="3">3</button>
                        </div>
                    </div>
                    <div class="bot">
                        <div class="doors">
                            <div style="height: 100%; width: calc(50% + 1px); border-right: 2px solid black;"></div>
                            <div class="sircle"></div>
                        </div>

                        <!-- Нижний ряд мест (обратный порядок) -->
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '45')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '45')->first()->id ?? '' }}"
                                    data-seat-label="45">45</button>
                            <button class="chear {{ in_array($seats->where('label', '44')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '44')->first()->id ?? '' }}"
                                    data-seat-label="44">44</button>
                            <button class="chear {{ in_array($seats->where('label', '43')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '43')->first()->id ?? '' }}"
                                    data-seat-label="43">43</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '39')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '39')->first()->id ?? '' }}"
                                    data-seat-label="39">39</button>
                            <button class="chear {{ in_array($seats->where('label', '38')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '38')->first()->id ?? '' }}"
                                    data-seat-label="38">38</button>
                            <button class="chear {{ in_array($seats->where('label', '37')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '37')->first()->id ?? '' }}"
                                    data-seat-label="37">37</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '33')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '33')->first()->id ?? '' }}"
                                    data-seat-label="33">33</button>
                            <button class="chear {{ in_array($seats->where('label', '32')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '32')->first()->id ?? '' }}"
                                    data-seat-label="32">32</button>
                            <button class="chear {{ in_array($seats->where('label', '31')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '31')->first()->id ?? '' }}"
                                    data-seat-label="31">31</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '27')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '27')->first()->id ?? '' }}"
                                    data-seat-label="27">27</button>
                            <button class="chear {{ in_array($seats->where('label', '26')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '26')->first()->id ?? '' }}"
                                    data-seat-label="26">26</button>
                            <button class="chear {{ in_array($seats->where('label', '25')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '25')->first()->id ?? '' }}"
                                    data-seat-label="25">25</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '21')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '21')->first()->id ?? '' }}"
                                    data-seat-label="21">21</button>
                            <button class="chear {{ in_array($seats->where('label', '20')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '20')->first()->id ?? '' }}"
                                    data-seat-label="20">20</button>
                            <button class="chear {{ in_array($seats->where('label', '19')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '19')->first()->id ?? '' }}"
                                    data-seat-label="19">19</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '15')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '15')->first()->id ?? '' }}"
                                    data-seat-label="15">15</button>
                            <button class="chear {{ in_array($seats->where('label', '14')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '14')->first()->id ?? '' }}"
                                    data-seat-label="14">14</button>
                            <button class="chear {{ in_array($seats->where('label', '13')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '13')->first()->id ?? '' }}"
                                    data-seat-label="13">13</button>
                        </div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '9')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '9')->first()->id ?? '' }}"
                                    data-seat-label="9">9</button>
                            <button class="chear {{ in_array($seats->where('label', '8')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '8')->first()->id ?? '' }}"
                                    data-seat-label="8">8</button>
                            <button class="chear {{ in_array($seats->where('label', '7')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '7')->first()->id ?? '' }}"
                                    data-seat-label="7">7</button>
                        </div>
                        <div class="table-2"></div>
                        <div class="chears">
                            <button class="chear {{ in_array($seats->where('label', '4')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '4')->first()->id ?? '' }}"
                                    data-seat-label="4">4</button>
                            <button class="chear {{ in_array($seats->where('label', '5')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '5')->first()->id ?? '' }}"
                                    data-seat-label="5">5</button>
                            <button class="chear {{ in_array($seats->where('label', '6')->first()->id ?? '', $bookedSeats) ? 'booked' : '' }}"
                                    data-seat-id="{{ $seats->where('label', '6')->first()->id ?? '' }}"
                                    data-seat-label="6">6</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="pilot">
                    <div style="width: 85%; border-right: 2px solid black;">
                        <div class="chearcap"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="booking-form">
        <h4>Забронировать место</h4>
        <div id="selected-seat-info" class="selected-seat-info" style="display: none;">
            Выбрано место: <strong id="selected-seat-label"></strong>
        </div>

        <form action="{{ route('booking.store', $trip->id) }}" method="POST" id="booking-form">
            @csrf
            <input type="hidden" name="seat_id" id="selected-seat-id">

            <div class="form-group">
                <label class="form-label">Имя</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Фамилия</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Телефон</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            @guest
                <button class="btn btn-primary" disabled title="Войдите, чтобы забронировать">Забронировать выбранное место</button>
                <p class="text-danger mt-2">Для бронирования необходимо <a href="{{ route('login') }}">войти</a>.</p>
            @else
                <button class="btn btn-primary">Забронировать выбранное место</button>
            @endguest

        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedSeat = null;

        // Обработчики для всех мест
        document.querySelectorAll('.chear:not(.booked)').forEach(button => {
            button.addEventListener('click', function() {
                const seatId = this.getAttribute('data-seat-id');
                const seatLabel = this.getAttribute('data-seat-label');

                // Снимаем выделение с предыдущего выбранного места
                if (selectedSeat) {
                    selectedSeat.classList.remove('selected');
                }

                // Выделяем новое место
                this.classList.add('selected');
                selectedSeat = this;

                // Заполняем скрытое поле и показываем информацию
                document.getElementById('selected-seat-id').value = seatId;
                document.getElementById('selected-seat-label').textContent = seatLabel;
                document.getElementById('selected-seat-info').style.display = 'block';
                document.getElementById('submit-btn').disabled = false;
            });
        });

        // Заблокировать клик по занятым местам
        document.querySelectorAll('.chear.booked').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Это место уже занято!');
            });
        });
    });
</script>
</body>
</html>
