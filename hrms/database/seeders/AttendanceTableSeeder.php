<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceTableSeeder extends Seeder
{
    public function run()
    {
        // Define the month and year for attendance logs
        $year = 2024;
        $month = 11; // November
        $members = [9, 13, 14, 15, 16]; // IDs of employees
    
        // Loop through each day of the month
        for ($day = 1; $day <= 30; $day++) { // November has 30 days
            $date = Carbon::create($year, $month, $day);
            
            // Skip Sundays
            if ($date->isSunday()) {
                continue;
            }
    
            foreach ($members as $member_id) {
                // Set fixed attendance times for perfect attendance
                $am_in = $date->copy()->setTime(8, 0);  // AM IN at 08:00
                $am_out = $date->copy()->setTime(12, 0); // AM OUT at 12:00
                $pm_in = $date->copy()->setTime(13, 0);  // PM IN at 13:00
                $pm_out = $date->copy()->setTime(17, 0); // PM OUT at 17:00
    
                // Insert logs into the attendance table
                DB::table('attendance')->insert([
                    [
                        'member_id' => $member_id,
                        'log_type' => 'AM IN',
                        'datetime_log' => $am_in,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'member_id' => $member_id,
                        'log_type' => 'AM OUT',
                        'datetime_log' => $am_out,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'member_id' => $member_id,
                        'log_type' => 'PM IN',
                        'datetime_log' => $pm_in,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'member_id' => $member_id,
                        'log_type' => 'PM OUT',
                        'datetime_log' => $pm_out,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }
    }

}    