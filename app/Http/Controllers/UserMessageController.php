<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserMessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showForm($id)
    {
        $users = DB::select('select * from users where id = ?', [$id]);

        return view('auth.useraddMessage', ['user' => $users]);
    }
    public function updateMessage(Request $request, $id)
    {
        // $from_user_id = Auth::user()->id;
        $status = 0;
        $title = $request->input('title');
        $msg = $request->input('msg');
        DB::update('update chat_message set title = ?, msg = ? , status_mes = ? where id = ?', [$title, $msg, $status, $id]);
        return redirect('userMessage');
    }
    public function seenMessage($id)
    {
        DB::update('update chat_message set status_mes = ? where id = ?', [1, $id]);
        return redirect('userMessage');
    }
    public function editMessage($id)
    {
        $data = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.from_user_id')
            ->select('users.name', 'chat_message.from_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where('chat_message.id', '=', $id)
            ->get();
        return view('auth.userEditMessage', ['user' => $data]);
    }
    public function viewMessage($id)
    {
        $data = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.from_user_id')
            ->select('users.name', 'chat_message.from_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where('chat_message.id', '=', $id)
            ->get();
        return view('auth.userViewMessage', ['data' => $data]);
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
        $user = \App\User::all();

        return view('auth.home', ['allUser' => $user]);
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
            ->where(['chat_message.to_user_id' => $id, 'chat_message.status_mes' => 0])
            ->orderBy('chat_message.from_user_id')
            ->get();

        $data_seen = DB::table('chat_message')
            ->join('users', 'users.id', '=', 'chat_message.from_user_id')
            ->select('users.name', 'chat_message.from_user_id', 'chat_message.title', 'chat_message.msg', 'chat_message.created_at', 'chat_message.id')
            ->where(['chat_message.to_user_id' => $id, 'chat_message.status_mes' => 1])
            ->orderBy('chat_message.from_user_id')
            ->get();
        return view('auth.userMessage', [
            'data_send' => $data_send, 'data_noseen' => $data_noseen, 'data_seen' => $data_seen
        ]);
    }
    public function deleteMessage( $id)
    {
        DB::table('chat_message')->where('id', '=', $id)->delete();
        return redirect('userMessage');
    }



}
