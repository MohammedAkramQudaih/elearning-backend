<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'academic_level_id',
        'major_id',
        'status'
    ];

    // العلاقات
    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
