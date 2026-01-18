<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'room_number' => '101',
                'type' => 'Standard',
                'price' => 500000,
                'is_available' => true,
                'description' => 'Kamar standar dengan fasilitas lengkap',
            ],
            [
                'room_number' => '102',
                'type' => 'Deluxe',
                'price' => 750000,
                'is_available' => true,
                'description' => 'Kamar deluxe dengan view kota',
            ],
            [
                'room_number' => '201',
                'type' => 'Suite',
                'price' => 1200000,
                'is_available' => false,
                'description' => 'Suite room dengan living room terpisah',
            ],
            [
                'room_number' => '202',
                'type' => 'Executive',
                'price' => 1500000,
                'is_available' => true,
                'description' => 'Kamar executive untuk business traveler',
            ],
            [
                'room_number' => '301',
                'type' => 'Presidential',
                'price' => 3000000,
                'is_available' => true,
                'description' => 'Presidential suite dengan fasilitas premium',
            ],
        ];

        foreach ($rooms as $roomData) {
            $room = Room::create($roomData);
            
            // Create sample images for each room
            $room->images()->create([
                'image_path' => 'rooms/' . $room->room_number . '/main.jpg',
                'is_main' => true
            ]);
            
            $room->images()->create([
                'image_path' => 'rooms/' . $room->room_number . '/view.jpg',
                'is_main' => false
            ]);
        }
        
        // Create additional random rooms using factory
        Room::factory(10)->withImages()->create();
    }
}