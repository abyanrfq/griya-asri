<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'room_number',
        'type',
        'price',
        'is_available',
        'description',
    ];

    /**
     * Get all images for the room.
     */
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}