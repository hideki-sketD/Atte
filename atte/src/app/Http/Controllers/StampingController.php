<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StampingController extends Controller
{
    public function index(){
        $user = Auth::user();
        // dd($user);

        return view('index', ['my_user' => $user]);
    }

}
