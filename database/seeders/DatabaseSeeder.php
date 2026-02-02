<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => '12345678',
            ]
        );

        $this->call([
            BranchSeeder::class,
            EmployeeSeeder::class,
            BannerSeeder::class,
            ManagementSeeder::class,
        ]);
        
        // $this->call(SystemSettingSeeder::class);
        // $this->call(WordSeeder::class);
    }
}
