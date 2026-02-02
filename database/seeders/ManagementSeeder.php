<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Management;

class ManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Management::create([
            'branch_id' => 1,
            'name' => 'John Doe',
            'designation' => 'General Manager',
            'image' => null,
            'email' => 'john.doe@example.com',
            'phone' => '123-456-7890',
            'employee_id' => 'EMP001',
            'message' => 'Welcome to our team!',
            'joining_date' => '2023-01-01',
        ]);
    }
}
