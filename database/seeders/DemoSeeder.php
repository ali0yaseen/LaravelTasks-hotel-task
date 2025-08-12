<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Room;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $h = Hotel::create([
            'name' => 'Sea Breeze Hotel',
            'location' => 'Valencia, Spain',
            'description' => 'Cozy hotel near the beach.',
            'rating' => 4.4,
            'image' => 'https://picsum.photos/seed/h1/1000/500',
        ]);

        Room::insert([
            ['hotel_id' => $h->id, 'type' => 'Standard', 'price' => 75,  'capacity' => 2],
            ['hotel_id' => $h->id, 'type' => 'Deluxe',   'price' => 120, 'capacity' => 3],
            ['hotel_id' => $h->id, 'type' => 'Suite',    'price' => 190, 'capacity' => 4],
        ]);
    }
}
