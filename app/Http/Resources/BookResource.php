<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CoverResource;

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
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'published_year' => $this->published_year,
            'description' => $this->description,
            'is_available' => (bool) $this->is_available,
            'categories' => CategoryResource::collection($this->whenLoaded('categories', collect())),
            'cover' => CoverResource::make($this->whenLoaded('cover')),
            'comments_count' => $this->whenCounted('comments'),
            'reviews_count' => $this->whenCounted('reviews'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
