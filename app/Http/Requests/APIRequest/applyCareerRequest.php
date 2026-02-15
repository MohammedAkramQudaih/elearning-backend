<?php

namespace App\Http\Requests\APIRequest;

use Illuminate\Foundation\Http\FormRequest;

class applyCareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'job_title' => 'required|string|max:255',
            'years_experience' => 'required|string|max:50',
            'major_id' => 'required|exists:majors,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ];
    }
}
