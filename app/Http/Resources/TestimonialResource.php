<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'name' => $this->name,
            'position' => $this->position[$locale] ?? $this->position['en'],
            'content' => $this->content[$locale] ?? $this->content['en'],
            'image' => $this->image_url,
        ];
    }
}
