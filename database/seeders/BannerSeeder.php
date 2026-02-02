<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::updateOrCreate(
            ['title' => 'Welcome Banner'],
            [
                'sub_title' => 'Welcome to Our Website',
                'status' => 1,
            ]
        );
    }
}
