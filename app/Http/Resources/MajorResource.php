<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MajorResource extends JsonResource
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
            'name' => $this->name[$locale] ?? $this->name['en'],
            'academic_level_id' => $this->academic_level_id,
            'academic_level' => new AcademicLevelResource($this->whenLoaded('academicLevel')),
        ];
    }
}
