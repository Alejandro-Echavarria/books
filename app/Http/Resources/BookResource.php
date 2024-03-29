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
            'id'             => $this->id,
            'name'           => $this->name,
            'price'          => '$' . number_format($this->price, 2) . ' USD',
            'date_published' => $this->date_published->format('d/m/Y'),
            'author'         => AuthorResource::collection($this->authors),
            'chapters'       => ChapterResource::collection($this->chapters),
        ];
    }
}
