<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "fieldId" => $this->fieldId,
            "username" => $this->username,
            "phoneNumber" => $this->phoneNumber,
            "time" => $this->time,
            "date" => $this->date,
            "message" => $this->message,
            "status" => $this->status,
        ];
    }
}
