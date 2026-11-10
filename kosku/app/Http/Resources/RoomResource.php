<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_number' => $this->room_number,
            'type' => $this->type,
            'price' => $this->price,
            'formatted_price' => 'Rp ' . number_format($this->price, 0, ',', '.'),
            'is_available' => $this->is_available,
            'availability' => $this->is_available ? 'Available' : 'Booked',
            'description' => $this->description,
            'images' => RoomImageResource::collection($this->whenLoaded('images')),
            'main_image' => $this->images->first()?->image_path,
            'created_at' => $this->created_at->format('d M Y'),
            'updated_at' => $this->updated_at->format('d M Y'),
        ];
    }
}
