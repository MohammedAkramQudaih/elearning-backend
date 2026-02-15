<?php

namespace Database\Seeders;

use App\Models\AcademicLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => ['en' => 'Bachelor', 'ar' => 'بكالوريوس'],
                'status' => true,
            ],
            [
                'name' => ['en' => 'Master', 'ar' => 'ماجستير'],
                'status' => true,
            ],
            [
                'name' => ['en' => 'PhD', 'ar' => 'دكتوراه'],
                'status' => true,
            ],
            [
                'name' => ['en' => 'Diploma', 'ar' => 'دبلوم'],
                'status' => true,
            ],
        ];

        foreach ($levels as $level) {
            AcademicLevel::create($level);
        }
    }
}
