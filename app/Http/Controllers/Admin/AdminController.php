<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
 
}
