<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicLevel extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'status'];

    protected $casts = [
        'name' => 'array', // تحويل JSON إلى array تلقائياً
    ];

    // العلاقات
    public function majors()
    {
        return $this->hasMany(Major::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
