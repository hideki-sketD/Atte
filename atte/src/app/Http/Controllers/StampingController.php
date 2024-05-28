<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PunchInRequest;
use App\Models\Stamp;
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
        
        $stamp = Stamp::create
        ([ 'user_id' => $user->id, 'punchIn' => Carbon::now(), ]);
        // $stamp->punchIn = Carbon::now();
        

        return redirect()->back()->with('message', 'お疲れ様です');
    }

    public function punchOut(Request $request)
    {
        $user = Auth::user();
        
        $stamp = Stamp::where('user_id', $user->id)
                      ->whereNull('punchOut')
                      ->orderBy('punchIn', 'desc')
                      ->first();

        if ($stamp) {
            $stamp->punchOut = Carbon::now();
            $stamp->workingTime = $stamp->punchOut->diffInSeconds($stamp->punchIn);
            $stamp->save();
        }

        return redirect()->back()->with('message', 'お疲れ様でした');
    }

}
