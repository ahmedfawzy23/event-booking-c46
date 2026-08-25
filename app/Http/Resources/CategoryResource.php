<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => "cat-" . $this->id,
            'name' => $this->name,
            'description' => $this->description,
            "updatedAt" => $this->updated_at->diffForHumans(),
            "createdAt" => $this->created_at->diffForHumans(),
        ];
    }
}
