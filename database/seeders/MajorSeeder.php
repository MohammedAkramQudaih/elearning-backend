<?php

namespace Database\Seeders;

use App\Models\AcademicLevel;
use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // مسح الجدول قبل الإضافة (اختياري)
        // DB::table('majors')->truncate();

        // جلب جميع المستويات الأكاديمية النشطة
        $levels = AcademicLevel::where('status', true)->get();

        if ($levels->isEmpty()) {
            $this->command->error('❌ No academic levels found. Please run AcademicLevelSeeder first.');
            return;
        }

        $this->command->info('🔍 Found ' . $levels->count() . ' academic levels');

        // إنشاء خريطة للمستويات حسب الاسم
        $levelMap = [];
        foreach ($levels as $level) {
            $name = is_array($level->name) ? ($level->name['en'] ?? '') : $level->name;
            $levelMap[$name] = $level->id;
        }

        // بيانات التخصصات (مرتبطة بأسماء المستويات وليس IDs)
        $majorsData = [
            // المستوى الأول: Bachelor / بكالوريوس
            'First Level' => [
                [
                    'ar' => 'علوم الحاسب',
                    'en' => 'Computer Science'
                ],
                [
                    'ar' => 'نظم المعلومات',
                    'en' => 'Information Systems'
                ],
                [
                    'ar' => 'تقنية المعلومات',
                    'en' => 'Information Technology'
                ],
                [
                    'ar' => 'الرياضيات',
                    'en' => 'Mathematics'
                ],
            ],

            // المستوى الثاني: Master / ماجستير
            'Second Level' => [
                [
                    'ar' => 'هندسة البرمجيات',
                    'en' => 'Software Engineering'
                ],
                [
                    'ar' => 'أمن المعلومات',
                    'en' => 'Information Security'
                ],
                [
                    'ar' => 'شبكات الحاسب',
                    'en' => 'Computer Networks'
                ],
                [
                    'ar' => 'قواعد البيانات',
                    'en' => 'Database Systems'
                ],
            ],

            // المستوى الثالث: PhD / دكتوراه
            'Third Level' => [
                [
                    'ar' => 'الذكاء الاصطناعي',
                    'en' => 'Artificial Intelligence'
                ],
                [
                    'ar' => 'علوم البيانات',
                    'en' => 'Data Science'
                ],
                [
                    'ar' => 'تعلم الآلة',
                    'en' => 'Machine Learning'
                ],
                [
                    'ar' => 'معالجة اللغات الطبيعية',
                    'en' => 'Natural Language Processing'
                ],
            ],

            // المستوى الرابع: Diploma / دبلوم (اختياري وغير مفعل)
            'Fourth Level' => [
                [
                    'ar' => 'الحوسبة السحابية',
                    'en' => 'Cloud Computing'
                ],
                [
                    'ar' => 'إنترنت الأشياء',
                    'en' => 'Internet of Things'
                ],
                [
                    'ar' => 'تطوير تطبيقات الجوال',
                    'en' => 'Mobile App Development'
                ],
            ],
        ];

        $count = 0;
        $skipped = 0;

        DB::beginTransaction();

        try {
            foreach ($majorsData as $levelName => $majors) {
                // البحث عن المستوى الأكاديمي بالاسم
                $levelId = null;
                foreach ($levelMap as $dbLevelName => $id) {
                    if (stripos($dbLevelName, $levelName) !== false || 
                        stripos($levelName, $dbLevelName) !== false) {
                        $levelId = $id;
                        break;
                    }
                }

                if (!$levelId) {
                    $this->command->warn("⚠️ Level '{$levelName}' not found. Skipping its majors.");
                    $skipped += count($majors);
                    continue;
                }

                // إضافة تخصصات هذا المستوى
                foreach ($majors as $major) {
                    // التحقق من عدم وجود التخصص مسبقاً
                    $exists = Major::where('academic_level_id', $levelId)
                        ->where('name->en', $major['en'])
                        ->exists();

                    if (!$exists) {
                        Major::create([
                            'name' => [
                                'ar' => $major['ar'],
                                'en' => $major['en'],
                            ],
                            'academic_level_id' => $levelId,
                            'status' => true, // كل التخصصات مفعلة
                        ]);
                        $count++;
                        $this->command->line("✅ Added: {$major['en']} ({$major['ar']}) to {$levelName}");
                    } else {
                        $this->command->line("⏭️ Skipped (already exists): {$major['en']}");
                        $skipped++;
                    }
                }
            }

            // إضافة بعض التخصصات غير المفعلة (status = false)
            $inactiveMajors = [
                [
                    'ar' => 'التجارة الإلكترونية',
                    'en' => 'E-commerce',
                    'level' => 'Second Level'
                ],
                [
                    'ar' => 'الألعاب الإلكترونية',
                    'en' => 'Game Development',
                    'level' => 'Third Level'
                ],
            ];

            foreach ($inactiveMajors as $major) {
                $levelId = null;
                foreach ($levelMap as $dbLevelName => $id) {
                    if (stripos($dbLevelName, $major['level']) !== false) {
                        $levelId = $id;
                        break;
                    }
                }

                if ($levelId) {
                    Major::create([
                        'name' => [
                            'ar' => $major['ar'],
                            'en' => $major['en'],
                        ],
                        'academic_level_id' => $levelId,
                        'status' => false, // غير مفعل
                    ]);
                    $count++;
                    $this->command->line("🟡 Added (inactive): {$major['en']} ({$major['ar']})");
                }
            }

            DB::commit();

            // عرض الإحصائيات
            $this->command->info("==================================");
            $this->command->info("📊 Seeding Summary:");
            $this->command->info("   ✅ Added: {$count} majors");
            $this->command->info("   ⏭️ Skipped: {$skipped} majors (already exist or level not found)");
            $this->command->info("   📚 Total now: " . Major::count() . " majors in database");
            $this->command->info("==================================");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('❌ Error: ' . $e->getMessage());
        }
    }
}
