<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Branch;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = Branch::first();

        if ($branch) {
            Employee::updateOrCreate(
                ['email' => 'employee@example.com'],
                [
                    'branch_id' => $branch->id,
                    'name' => 'John Doe',
                    'employee_id' => 'EMP001',
                    'designation' => 'Manager',
                    'phone' => '01987654321',
                    'nid_number' => '1234567890123',
                    'present_address' => 'Dhaka',
                    'permanent_address' => 'Dhaka',
                    'joining_date' => '2023-01-01',
                    'workplace_address' => 'Dhaka Office',
                    'shift' => 'Morning',
                    'status' => 1,
                ]
            );
        }
    }
}
