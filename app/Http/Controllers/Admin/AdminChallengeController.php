<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminChallengeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function getData()
    {
        $data = \App\Challenge::all();

        return view('challenge', ['allChallenge' => $data]);
    }
}
