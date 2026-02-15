<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // بيانات الطلاب
        $students = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'phone' => '0591234567',
                'academic_level_id' => 1,
                'major_id' => 1,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سارة أحمد',
                'email' => 'sara@example.com',
                'phone' => '0592345678',
                'academic_level_id' => 1,
                'major_id' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'محمد علي',
                'email' => 'mohamed@example.com',
                'phone' => '0593456789',
                'academic_level_id' => 2,
                'major_id' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'فاطمة عمر',
                'email' => 'fatima@example.com',
                'phone' => '0594567890',
                'academic_level_id' => 2,
                'major_id' => 4,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'خالد محمود',
                'email' => 'khaled@example.com',
                'phone' => '0595678901',
                'academic_level_id' => 3,
                'major_id' => 5,
                'status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // إضافة البيانات
        foreach ($students as $student) {
            // التحقق من عدم وجود البريد الإلكتروني مكرر
            if (!Student::where('email', $student['email'])->exists()) {
                Student::create($student);
                $this->command->info("✅ تم إضافة الطالب: " . $student['name']);
            } else {
                $this->command->warn("⚠️ الطالب " . $student['name'] . " موجود مسبقاً");
            }
        }

        $this->command->info('=================================');
        $this->command->info('✅ تم إضافة ' . count($students) . ' طالب بنجاح');
        $this->command->info('=================================');
    }
}
