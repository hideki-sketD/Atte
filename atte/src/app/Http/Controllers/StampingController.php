<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PunchInRequest;
use App\Http\Requests\PunchOutRequest;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StampingController extends Controller
{
    public function index(){
        $user = Auth::user();
        // dd($user);

        return view('index', ['my_user' => $user]);
    }

    public function punchIn(PunchInRequest $request)
    {
        $user = Auth::user();

        
        $attendance = Attendance::create
        ([ 'user_id' => $user->id, 'date' => Carbon::today(),'punchIn' => Carbon::now(), ]);
        

        return redirect()->back()->with('message', 'よろしくお願いします');
    }

    public function punchOut(PunchOutRequest $request)
    {
        $user = Auth::user();
        
        $attendance = Attendance::where('user_id', $user->id)
                      ->whereNull('punchOut')
                      ->whereDate('punchIn',Carbon::today())
                      ->first();

        if ($attendance) {
            $attendance->punchOut = Carbon::now();
            $attendance->save();
        }

        return redirect()->back()->with('message', 'お疲れ様でした');
    }

    public function start(Request $request)
    {
    $user = Auth::user();

    $attendance = Attendance::where('user_id', $user->id)
                      ->whereNull('punchOut')
                      ->where('date',Carbon::today())
                      ->first();

    if ($attendance) {
            Rest::create([
                'attendance_id' => $attendance->id,
                'start_time' => Carbon::now(),
            ]);

    return redirect()->back()->with('message', '休憩を開始しました');
    }

    }

    public function end(Request $request)
    {
        $user = Auth::user();

        $attendance = Attendance::where('user_id', $user->id)
                      ->whereNull('punchOut')
                      ->where('date',Carbon::today())
                      ->first();
        
        $rest = Rest::where('attendance_id', $attendance->id)
                      ->whereNull('end_time')
                      ->latest()
                      ->first();

        if ($rest) {
            $rest->end_time = Carbon::now();
            $rest->save();

        return redirect()->back()->with('message', '休憩を終了しました');}
    }

    public function attendance(){
        $user = Auth::user();
        // dd($user);

        $dates = Attendance::select('date')
                            ->distinct()
                            ->orderBy('date', 'desc')
                            ->get();

        $reports = [];
        foreach ($dates as $date) {
            $attendances = Attendance::with('user', 'rests')
                                     ->where('date', $date->date)
                                     ->get();

            $reports[$date->date] = $attendances;
        }

        return view('attendance', compact('reports'));
    }
}