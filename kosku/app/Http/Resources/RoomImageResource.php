<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image_url' => asset('storage/' . $this->image_path),
            'is_main' => $this->is_main,
            'created_at' => $this->created_at->format('d M Y'),
        ];
    }
}
