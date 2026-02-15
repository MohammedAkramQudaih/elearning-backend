<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // بيانات الشهادات مع صور افتراضية
        $testimonials = [
            [
                'name' => 'أحمد محمد',
                'position_ar' => 'مهندس برمجيات',
                'position_en' => 'Software Engineer',
                'content_ar' => 'تجربتي مع هذه المنصة كانت رائعة جداً. المحتوى التعليمي ممتاز والمدربين محترفين.',
                'content_en' => 'My experience with this platform was amazing. The educational content is excellent and the trainers are professional.',
                'rating' => 5,
                'image' => 'https://randomuser.me/api/portraits/men/1.jpg', // صورة وهمية
            ],
            [
                'name' => 'سارة أحمد',
                'position_ar' => 'طبيبة',
                'position_en' => 'Doctor',
                'content_ar' => 'ساعدتني المنصة في تطوير مهاراتي. الدورات كانت مفيدة جداً.',
                'content_en' => 'The platform helped me develop my skills. The courses were very useful.',
                'rating' => 5,
                'image' => 'https://randomuser.me/api/portraits/women/1.jpg',
            ],
            // ... المزيد
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create([
                'name' => $testimonial['name'],
                'position' => [
                    'ar' => $testimonial['position_ar'],
                    'en' => $testimonial['position_en'],
                ],
                'content' => [
                    'ar' => $testimonial['content_ar'],
                    'en' => $testimonial['content_en'],
                ],
                'image' => $testimonial['image'],
                'status' => true,
            ]);
        }
    }
}
