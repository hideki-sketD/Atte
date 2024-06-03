<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'punchIn', 'punchOut',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

    public function getTotalWorkAttribute()
    {
        if ($this->punchIn && $this->punchOut) {
            $punchInTime = Carbon::createFromFormat('H:i:s', $this->punchIn);
            $punchOutTime = Carbon::createFromFormat('H:i:s', $this->punchOut);
            $minutes = $punchOutTime->diffInMinutes($punchInTime);
            return $this->formatMinutes($minutes);
        }
        return '00:00:00';
    }

    public function getTotalRestAttribute()
    {
        $totalRestMinutes = $this->rests->sum(function($rest) {
        if ($rest->start_time && $rest->end_time) {
            $startTime = Carbon::createFromFormat('H:i:s', $rest->start_time);
            $endTime = Carbon::createFromFormat('H:i:s', $rest->end_time);
            return $endTime->diffInMinutes($startTime);
        }
        return 0;
    });

    return $this->formatMinutes($totalRestMinutes);
    }

    protected function formatMinutes($minutes)
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;
        $seconds = 0; // 秒単位の計算がないため、0秒とする

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
