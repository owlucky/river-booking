<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\Seat;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Добавляем два рейса
        Trip::create([
            'title' => 'Саратов — Балаково',
            'description' => 'Рейc по Волге от Саратовского речного вокзала до Балаково',
            'departure_at' => '2025-11-05 09:00:00'
        ]);

        Trip::create([
            'title' => 'Саратов — Маркс',
            'description' => 'Прогулка до города Маркс по Волге',
            'departure_at' => '2025-11-06 10:00:00'
        ]);

        // Добавляем 10 мест
        for ($i = 1; $i <= 10; $i++) {
            Seat::create(['label' => "Место $i"]);
        }
    }
}
