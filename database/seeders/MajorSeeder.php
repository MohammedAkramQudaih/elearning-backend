<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        // تعطيل قيود المفاتيح الأجنبية مؤقتاً
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // مسح الجدول
        DB::table('majors')->truncate();
        
        // إعادة تفعيل القيود
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // بيانات التخصصات
        $majors = [
            [
                'name' => json_encode(['ar' => 'علوم الحاسب', 'en' => 'Computer Science']),
                'academic_level_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['ar' => 'نظم المعلومات', 'en' => 'Information Systems']),
                'academic_level_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['ar' => 'هندسة البرمجيات', 'en' => 'Software Engineering']),
                'academic_level_id' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['ar' => 'الذكاء الاصطناعي', 'en' => 'Artificial Intelligence']),
                'academic_level_id' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['ar' => 'أمن المعلومات', 'en' => 'Information Security']),
                'academic_level_id' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }

        $this->command->info('✅ تم إضافة ' . count($majors) . ' تخصص بنجاح');
    }
}