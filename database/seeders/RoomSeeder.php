<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $rooms = [
        [
            'name' => 'Garden Suite',
            'description' => 'Pemandangan taman asri dengan privasi tinggi.',
            'price_per_night' => 12000000,
            'image' => 'garden_suite.jpg'
        ],
        [
            'name' => 'Borobudur Pool Suite',
            'description' => 'Kolam renang pribadi dengan pemandangan Candi Borobudur.',
            'price_per_night' => 25000000,
            'image' => 'pool_suite.jpg'
        ],
        [
            'name' => 'Dalem Jiwo Suite',
            'description' => 'Suite paling mewah dengan pelayan pribadi 24 jam.',
            'price_per_night' => 45000000,
            'image' => 'dalem_jiwo.jpg'
        ],
    ];

    foreach ($rooms as $room) {
        \App\Models\RoomType::create($room);
    }
}
}
