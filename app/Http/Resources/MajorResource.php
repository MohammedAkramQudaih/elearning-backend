<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MajorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();

        // تحقق من نوع البيانات
        $name = $this->name;

        // إذا كان string (مخزن كـ JSON)
        if (is_string($name)) {
            $nameArray = json_decode($name, true);
            $displayName = $nameArray[$locale] ?? $nameArray['en'] ?? $name;
        }
        // إذا كان array بالفعل
        elseif (is_array($name)) {
            $displayName = $name[$locale] ?? $name['en'] ?? '';
        }
        // إذا كان كائن
        elseif (is_object($name)) {
            $nameArray = (array) $name;
            $displayName = $nameArray[$locale] ?? $nameArray['en'] ?? '';
        }
        // أي شيء آخر
        else {
            $displayName = (string) $name;
        }

        return [
            // 'id' => $this->id,
            // 'name' => $displayName,
            // 'academic_level_id' => $this->academic_level_id,

            'id' => $this->id,
            'name' => $displayName,
            // 'academic_level_id' => $this->academic_level_id,
            'academic_level' => new AcademicLevelResource($this->whenLoaded('academicLevel')),

        ];
    }
}
