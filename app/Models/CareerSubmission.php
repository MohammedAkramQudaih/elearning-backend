<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerSubmission extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'job_title',
        'years_experience',
        'major_id',
        'name',
        'phone',
        'email',
        'cv_path',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending' // القيمة الافتراضية
    ];

    // العلاقات
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    // Accessor للحصول على رابط تحميل السيرة الذاتية
    public function getCvUrlAttribute()
    {
        return $this->cv_path ? asset('storage/' . $this->cv_path) : null;
    }
}
