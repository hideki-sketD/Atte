<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = Carbon::now()->subWeeks(4);  // 4週間前から
        $endDate = Carbon::now();                 // 今日まで

        // 4週間分の日付をループ
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // 各日付に対して50人分のデータを生成
            for ($userId = 1; $userId <= 50; $userId++) {
                Attendance::factory()->create([
                    'user_id' => $userId,
                    'date' => $date->format('Y-m-d'),
                    'punchIn' => Carbon::now()->subHours(rand(1, 8))->format('H:i:s'),
                    'punchOut' => Carbon::now()->format('H:i:s'),
                ]);
            }
        }
    }
}
