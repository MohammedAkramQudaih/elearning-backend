<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $locale = app()->getLocale();
        
        return [
            'id' => $this->id,
            'title' => $this->title[$locale] ?? $this->title['en'],
            'content' => $this->content[$locale] ?? $this->content['en'],
            'image' => $this->image_url,
            'date' => $this->date->format('Y-m-d'),
            'status' => $this->status,
        ];
    }
}
