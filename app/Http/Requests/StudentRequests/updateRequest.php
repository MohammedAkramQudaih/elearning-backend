<?php

namespace App\Http\Requests\StudentRequests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'academic_level_id' => 'required|exists:academic_levels,id',
            'major_id' => 'required|exists:majors,id',
        ];
    }
}
