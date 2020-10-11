<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
class UserDataController extends Controller
{
    //
   
    public function getData()
    {
        $user = \App\User::all();

        return view('home', ['allUser' => $user]);
    }
    public function profile($userId = null)
    {
        $user = null;

        if ($userId != null) {
            $user = \App\User::find($userId);
        } else {
            $user = \App\User::find(Auth::user()->id);
        }

        return view('userprofile', [
            'user' => $user
        ]);
    }
    public function show($id)
    {
        $users = DB::select('select * from users where id = ?', [$id]);
        return view('editprofile', ['user' => $users]);
    }
    public function editProfile(Request $request,$id)
    {
            $users = DB::select('select * from users where id = ?', [$id]);
            $name = $request->input('name');
            $username = $request->input('username');
            $password = $request->input('password');
            if($password!=$users[0]->password){
                $password=bcrypt($password);
            }
            $email = $request->input('email');
            $telephone = $request->input('telephone');
           
            DB::update('update users set name = ?,username=?,email=?,password=?,telephone=? where id = ?',[$name,$username,$email,$password,$telephone,$id]);    
            $user = \App\User::all();

            return view('admin.user.dashboard', ['allUser' => $user]);
           
    }

    public function index()
    {
        return view('index');
    }

}
