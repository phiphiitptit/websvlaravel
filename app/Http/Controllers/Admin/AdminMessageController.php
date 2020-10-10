<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\AtMost;

class AdminMessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showForm($id)
    {
        $users = DB::select('select * from users where id = ?', [$id]);

        return view('addMessage', ['user' => $users]);
    }
    public function sendMessage(Request $request)
    {
        $to_user_id = $request->input('id');
        $from_user_id = Auth::user()->id;
        $status = 0;
        $title = $request->input('title');
        $msg = $request->input('msg');
        DB::table('chat_message')->insert([
            'title' => $title,
            'to_user_id' => $to_user_id,
            'from_user_id' => $from_user_id,
            'status_mes' => $status,
            'msg' => $msg,
            'created_at' => date('Y-m-d H:i:s'),

        ]);
        $id = Auth::user()->id;

        $data_send = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.to_user_id')
            ->select('users.name', 'chat_message.to_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where('chat_message.from_user_id', '=', $id)
            ->orderBy('chat_message.id')
            ->get();

        $data_noseen = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.from_user_id')
            ->select('users.name', 'chat_message.from_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where('chat_message.to_user_id', '=', $id, 'and', 'chat_message.status_mes', '=', 0)
            ->orderBy('chat_message.from_user_id')
            ->get();

        $data_seen = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.from_user_id')
            ->select('users.name', 'chat_message.from_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where('chat_message.to_user_id', '=', $id, 'and', 'chat_message.status_mes', '=', 1)
            ->orderBy('chat_message.from_user_id')
            ->get();


        return view('message', [
            'data_send' => $data_send, 'data_noseen' => $data_noseen, 'data_seen' => $data_seen
        ]);
       
    }
    public function getData()
    {
        $id = Auth::user()->id;

        $data_send = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.to_user_id')
            ->select('users.name', 'chat_message.to_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where('chat_message.from_user_id', '=', $id)
            ->orderBy('chat_message.id')
            ->get();

        $data_noseen = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.from_user_id')
            ->select('users.name', 'chat_message.from_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where(['chat_message.to_user_id'=>$id,'chat_message.status_mes'=>0])
            ->orderBy('chat_message.from_user_id')
            ->get();

        $data_seen = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.from_user_id')
            ->select('users.name', 'chat_message.from_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where(['chat_message.to_user_id'=>$id,'chat_message.status_mes'=>1])
            ->orderBy('chat_message.from_user_id')
            ->get();


        return view('message', [
            'data_send' => $data_send, 'data_noseen' => $data_noseen, 'data_seen' => $data_seen
        ]);
    }
}
