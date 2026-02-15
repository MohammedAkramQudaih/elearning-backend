<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     User::create([
    //         'name' => 'Admin',
    //         'email' => 'admin@example.com',
    //         'password' => Hash::make('password'),
    //         'email_verified_at' => now(),
    //     ]);
    // }

    public function run(): void
    {
        // البحث عن المستخدم أولاً، إذا لم يوجد يتم إنشاؤه
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'], // شرط البحث
            [ // البيانات التي ستضاف إذا لم يوجد
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        if ($user->wasRecentlyCreated) {
            $this->command->info('✅ Admin user created successfully!');
        } else {
            $this->command->warn('⚠️ Admin user already exists. Skipped.');
        }
    }
}
