<?php

namespace Database\Seeders;

use App\Models\Major;
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
        // جلب أول تخصص موجود في قاعدة البيانات
        $firstMajor = Major::first();
        
        if (!$firstMajor) {
            $this->command->error('❌ لا يوجد أي تخصص في قاعدة البيانات. شغل MajorSeeder أولاً');
            return;
        }

        $majorId = $firstMajor->id;
        $this->command->info("📌 باستخدام التخصص ID: {$majorId}");

        // بيانات الطلاب (كلهم بنفس التخصص الموجود)
        $students = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'phone' => '0591234567',
                'academic_level_id' => 1,
                'major_id' => $majorId,
                'status' => true,
            ],
            [
                'name' => 'سارة أحمد',
                'email' => 'sara@example.com',
                'phone' => '0592345678',
                'academic_level_id' => 1,
                'major_id' => $majorId,
                'status' => true,
            ],
            [
                'name' => 'محمد علي',
                'email' => 'mohamed@example.com',
                'phone' => '0593456789',
                'academic_level_id' => 2,
                'major_id' => $majorId,
                'status' => true,
            ],
            [
                'name' => 'فاطمة عمر',
                'email' => 'fatima@example.com',
                'phone' => '0594567890',
                'academic_level_id' => 2,
                'major_id' => $majorId,
                'status' => true,
            ],
            [
                'name' => 'خالد محمود',
                'email' => 'khaled@example.com',
                'phone' => '0595678901',
                'academic_level_id' => 3,
                'major_id' => $majorId,
                'status' => false,
            ],
        ];

        // إضافة البيانات
        foreach ($students as $student) {
            if (!Student::where('email', $student['email'])->exists()) {
                Student::create($student);
                $this->command->info("✅ تم إضافة الطالب: " . $student['name']);
            } else {
                $this->command->warn("⚠️ الطالب " . $student['name'] . " موجود مسبقاً");
            }
        }

        $this->command->info('=================================');
        $this->command->info('✅ تم إضافة الطلاب بنجاح');
        $this->command->info('=================================');
    }
}
