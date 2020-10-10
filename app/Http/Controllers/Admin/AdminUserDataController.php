<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\Auth;

class AdminUserDataController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getData()
    {
        $user = \App\User::all();

        return view('admin.user.dashboard', ['allUser' => $user]);
    }
    public function showForm()
    {


        return view('addStudent');
    }
    public function viewProfile($userId = null)
    {
        $user = null;

        if ($userId != null) {
            $user = \App\User::find($userId);
        } else {
            $user = \App\User::find(Auth::user()->id);
        }

        return view('profile', [
            'user' => $user
        ]);
    }
    public function show($id)
    {
        $users = DB::select('select * from users where id = ?', [$id]);
        return view('editprofile', ['user' => $users]);
    }
    public function editProfile(Request $request)
    {
        $id = $request->input('id');
        $users = DB::select('select * from users where id = ?', [$id]);
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        if ($password != $users[0]->password) {
            $password = bcrypt($password);
        }
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        DB::update('update users set name = ?,username=?,email=?,password=?,telephone=? where id = ?', [$name, $username, $email, $password, $telephone, $id]);

        $user = \App\User::all();

        return view('admin.user.dashboard', ['allUser' => $user]);
    }
    public function deleteUser($id)
    {
        DB::delete('delete from users where id = ?', [$id]);
        $user = \App\User::all();

        return view('admin.user.dashboard', ['allUser' => $user]);
    }
    public function addStudent(Request $request)
    {
       
        $users = \App\User::all();
        $name = $request->input('name');
        $username = $request->input('username');
        $password =  bcrypt($request->input('password'));
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        foreach($users as $data){
            if($data->username == $username or $data->email==$email or $data->telephone==$telephone){
                return redirect('addStudent')->with('failed', "Thêm học sinh thất bại");
            }
        }
        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'telephone' =>$telephone,
            'usertype'=>0,
            'created_at'=> date('Y-m-d H:i:s'),
            'password' => $password,
            'remember_token' => STR::random(255),

        ]);
        $user = User::all();

         return view('admin.user.dashboard', ['allUser' => $user]);
      
    }
}
