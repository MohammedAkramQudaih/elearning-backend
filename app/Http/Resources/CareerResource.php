<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
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
                'job_title' => $this->job_title,
                'years_experience' => $this->years_experience,
                'major' => new MajorResource($this->whenLoaded('major')),
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'cv_url' => $this->cv_url,
                'status' => $this->status,
        ];
    }
}
