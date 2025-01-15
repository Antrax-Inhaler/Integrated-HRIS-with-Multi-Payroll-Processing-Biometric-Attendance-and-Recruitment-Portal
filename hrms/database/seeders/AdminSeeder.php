<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => 'da@admin.com'],
            [
                'name' => 'Admin User',
                'email' => 'da@admin.com',
                'password' => Hash::make('Admin#123')
            ]
        );
    }
    
}
