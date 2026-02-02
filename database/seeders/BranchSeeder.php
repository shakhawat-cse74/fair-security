<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::updateOrCreate(
            ['email' => 'mainbranch@example.com'],
            [
                'name' => 'Main Branch',
                'location' => 'Dhaka, Bangladesh',
                'mobile' => '01234567890',
                'status' => 1,
            ]
        );
    }
}
