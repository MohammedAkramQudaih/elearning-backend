<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $faker = Faker::create();
        
        // عناوين وأخبار عربية جاهزة
        $arabicTitles = [
            'إطلاق دورة جديدة في البرمجة',
            'ورشة عمل مجانية عن الذكاء الاصطناعي',
            'تحديثات جديدة على المنصة',
            'مسابقة البرمجة السنوية',
            'ندوة عن مستقبل التكنولوجيا',
            'شراكة مع شركة تقنية عالمية',
            'تخريج دفعة جديدة من الطلاب',
            'إطلاق برنامج المنح الدراسية',
            'مؤتمر التعليم الإلكتروني 2026',
            'جائزة أفضل منصة تعليمية',
        ];

        $englishTitles = [
            'New Programming Course Launch',
            'Free AI Workshop',
            'New Platform Updates',
            'Annual Programming Competition',
            'Future of Technology Seminar',
            'Partnership with Global Tech Company',
            'New Student Batch Graduation',
            'Scholarship Program Launch',
            'E-Learning Conference 2026',
            'Best Educational Platform Award',
        ];

        $arabicContents = [
            'يسعدنا الإعلان عن إطلاق دورة جديدة في البرمجة بلغة بايثون. الدورة مناسبة للمبتدئين والمحترفين على حد سواء.',
            'تنظم المنصة ورشة عمل مجانية عن الذكاء الاصطناعي يوم الخميس القادم. الورشة يقدمها خبراء في المجال.',
            'أضفنا العديد من التحديثات الجديدة على المنصة لتجربة أفضل للمستخدمين. شكراً لملاحظاتكم القيمة.',
            'تعلن المنصة عن مسابقة البرمجة السنوية بجوائز قيمة تصل إلى 10000 دولار. سجل الآن وشارك.',
            'ينظم مركز الأبحاث ندوة عن مستقبل التكنولوجيا بمشاركة خبراء من 10 دول.',
            'وقعنا اتفاقية شراكة مع إحدى كبرى شركات التقنية العالمية لتوفير محتوى تدريبي متطور.',
            'احتفلت المنصة بتخريج الدفعة الجديدة من طلاب برنامج تطوير المهارات التقنية.',
            'أطلقنا برنامج المنح الدراسية للطلاب المتميزين في الدول النامية.',
            'تنظم المنصة المؤتمر السنوي للتعليم الإلكتروني بمشاركة 50 خبيراً عالمياً.',
            'حصلت المنصة على جائزة أفضل منصة تعليمية في الشرق الأوسط للعام 2026.',
        ];

        $englishContents = [
            'We are pleased to announce the launch of a new Python programming course. The course is suitable for both beginners and professionals.',
            'The platform organizes a free AI workshop next Thursday. The workshop is presented by experts in the field.',
            'We have added many new updates to the platform for a better user experience. Thanks for your valuable feedback.',
            'The platform announces the annual programming competition with valuable prizes up to $10,000. Register now and participate.',
            'The research center organizes a seminar on the future of technology with experts from 10 countries.',
            'We signed a partnership agreement with a major global technology company to provide advanced training content.',
            'The platform celebrated the graduation of the new batch of students from the technical skills development program.',
            'We launched the scholarship program for distinguished students in developing countries.',
            'The platform organizes the annual e-learning conference with 50 global experts.',
            'The platform won the Best Educational Platform in the Middle East award for 2026.',
        ];

        // إنشاء 20 خبراً
        for ($i = 0; $i < 20; $i++) {
            $index = array_rand($arabicTitles);
            $date = $faker->dateTimeBetween('-3 months', 'now');
            
            News::create([
                'title' => [
                    'ar' => $arabicTitles[$index] . ' ' . ($i + 1),
                    'en' => $englishTitles[$index] . ' ' . ($i + 1),
                ],
                'content' => [
                    'ar' => $arabicContents[$index] . ' ' . $faker->paragraph(),
                    'en' => $englishContents[$index] . ' ' . $faker->paragraph(),
                ],
                'image' => $faker->boolean(70) ? 'news/news-' . ($i + 1) . '.jpg' : null,
                'date' => $date->format('Y-m-d'),
                'status' => $faker->boolean(80), // 80% مفعل
            ]);
        }

        $this->command->info('✅ 20 news articles created successfully!');
    }
}
