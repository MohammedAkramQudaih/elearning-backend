<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'academic_level_id', 'status'];

    protected $casts = [
        'name' => 'array',
    ];

    // العلاقات
    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function careerSubmissions()
    {
        return $this->hasMany(CareerSubmission::class);
    }
}
