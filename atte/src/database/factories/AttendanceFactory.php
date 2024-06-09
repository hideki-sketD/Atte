<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceFactory extends Factory
{

    protected $model = Attendance::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => $this->faker->numberBetween(1, 50),
            // 'date' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+4 week'),
            // 'punchIn' => $this->faker->time('08:00:00', '12:00:00'),
            // 'punchOut' => $this->faker->time('13:00:00', '00:00:00'),
            'user_id' => null,  // シーダーで指定する
            'date' => null,     // シーダーで指定する
            'punchIn' => Carbon::now()->subHours(rand(1, 8))->format('H:i:s'),
            'punchOut' => Carbon::now()->format('H:i:s'),
        ];
    }
}
