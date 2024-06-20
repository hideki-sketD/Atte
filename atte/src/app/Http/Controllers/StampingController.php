<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StampingController extends Controller
{


    public function __construct()
    {
        // 全てのメソッドに対して、認証とメール確認のミドルウェアを適用
        $this->middleware(['auth', 'verified']);
    }


    public function index(){
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        $hasPunchedIn = $attendance && $attendance->punchIn !== null;
        $hasPunchedOut = $attendance && $attendance->punchOut !== null;
        $isResting = $attendance && $attendance->rests()->whereNull('end_time')->exists();

        $my_user = $user;

        return view('index', compact('hasPunchedIn', 'hasPunchedOut', 'my_user', 'isResting'));
    }

    public function punchIn(Request $request)
    {
        $user = Auth::user();

        
        $attendance = Attendance::create
        ([ 'user_id' => $user->id, 'date' => Carbon::today(),'punchIn' => Carbon::now(), ]);
        

        return redirect()->back()->with('message', 'お疲れ様です！');
    }

    public function punchOut(Request $request)
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

        return redirect()->back()->with('message', 'お疲れ様でした！');
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

    public function attendance($date = null){
        $user = Auth::user();

        $date = $date ? Carbon::parse($date) : Carbon::today();

        $previousDate = $date->copy()->subDay()->toDateString();
        $nextDate = $date->copy()->addDay()->toDateString();

        $attendances = Attendance::with('user', 'rests')
        ->where('date', $date->toDateString())
        ->Paginate(5);
        // ->get();
        

        return view('attendance', compact('date', 'previousDate', 'nextDate', 'attendances'));
    }
    

    public function userlist()
    {
        return view('userlist');
    }

}