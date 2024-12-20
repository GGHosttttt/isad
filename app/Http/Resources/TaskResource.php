<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "detail" => $this->detail,
            "price" => (float) $this->price,
            "bookStatus" => $this->bookStatus,
            "image" => $this->image
                ? asset('storage/' . $this->image)
                : asset('storage/default-placeholder.jpg'),
        ];
    }

}
