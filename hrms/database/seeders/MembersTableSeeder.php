<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MembersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('members')->insert([
            [
                'surname' => 'Meyers',
                'given_name' => 'Anna',
                'middle_name' => 'Shannon',
                'email' => 'owoodard@hotmail.com',
                'profile_picture' => null,
                'valid_id' => 'documents/121320f6-b3bc-4533-8e5d-b272ec772058.pdf',
                'password' => Hash::make('password123'),
                'contact_number' => '(436)490-1609x638',
                'salary' => 51462.15,
                'position' => 'Clerk',
                'department' => 'IT',
                'employment_status' => 'contractual',
                'is_verified' => 0,
                'payroll_type' => 'monthly',
                'balance_vacation' => 8.27,
                'balance_sick' => 2.83,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surname' => 'Butler',
                'given_name' => 'Gregory',
                'middle_name' => null,
                'email' => 'derek89@hotmail.com',
                'profile_picture' => null,
                'valid_id' => null,
                'password' => Hash::make('password123'),
                'contact_number' => '677-040-7713x12474',
                'salary' => 52299.90,
                'position' => 'Technician',
                'department' => 'Finance',
                'employment_status' => 'job_order',
                'is_verified' => 0,
                'payroll_type' => 'semi-monthly',
                'balance_vacation' => 10.65,
                'balance_sick' => 7.42,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surname' => 'Cooke',
                'given_name' => 'Jackie',
                'middle_name' => 'Bradley',
                'email' => 'nnelson@brown.info',
                'profile_picture' => 'images/ea730b9c-895b-4c8c-b64b-e437d74408cd.jpg',
                'valid_id' => 'documents/3b32bef2-f079-40fd-a3d4-55d2e238963d.pdf',
                'password' => Hash::make('password123'),
                'contact_number' => '168-876-0954x450',
                'salary' => 70270.26,
                'position' => 'Technician',
                'department' => 'Logistics',
                'employment_status' => 'job_order',
                'is_verified' => 1,
                'payroll_type' => 'semi-monthly',
                'balance_vacation' => 1.47,
                'balance_sick' => 2.46,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records if needed
        ]);
    }
}
