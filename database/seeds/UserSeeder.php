<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'username' => 'admin',
        //     'telephone' =>'0333712623',
        //     'usertype'=>1,
        //     'created_at'=> date('Y-m-d H:i:s'),
        //     'password' => bcrypt('admin'),
        //     'remember_token' => STR::random(255),
        // ]);
        DB::table('users')->insert([
            'name' => 'student2',
            'email' => 'student2@gmail.com',
            'username' => 'student2',
            'telephone' =>'0333712623',
            'usertype'=>0,
            'created_at'=> date('Y-m-d H:i:s'),
            'password' => Hash::make('123456789'),
            'remember_token' => STR::random(255),

        ]);
        // $user = new User();
        // $user->name = ' Admin';
        // $user->username = 'admin';
        // $user->email = 'admin@gmail.com';
        // $user->password = bcrypt('password');
        // $user->telephone ='0328038407';
        // $user->usertype = 1;
        // $user->save();
    }
}
