<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserChallengeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getData()
    {
        $data = \App\Challenge::all();

        return view('auth.userChallenge', ['allChallenge' => $data]);
    }
    public function showChallenge($id)
    {
        $data = DB::select('select * from challengequizz where id = ?', [$id]);
        return view('auth.userViewChallenge', [
            'data' => $data[0]
        ]);
    }
    public function subChallenge(Request $request)
    {
        // name of the uploaded file
        $idfile = $request->input('id');
        $desfolder = 'challenges/chall' . $idfile;

        $results_array = array();

        if (is_dir($desfolder)) {
            if ($handle = opendir($desfolder)) {
                //Notice the parentheses I added:
                while (($file = readdir($handle)) !== FALSE) {
                    $results_array[] = $file;
                }
                closedir($handle);
            }
        }
        $answer = $request->input('answer');
        //Output findings

        $check = false;
        foreach ($results_array as $value) {
            if (basename($value, ".txt") == $answer) {
                $check = true;
                break;
            }
        }
        if ($check) {
            $des = 'challenges/chall' . $idfile . '/' . $value;
            $content = "";
            $read = file($des);
            foreach ($read as $line) {
                $content = $content . $line . "<br>";
            }
            $data = DB::select('select * from challengequizz where id = ?', [$idfile]);
            return view('auth.userShowChallenge', [
                'data' => $data[0], 'check' => true, 'content' => $content
            ]);
        } else {
            return redirect('userViewChallenge/' . $idfile . '')->with('failed', "Cau tra loi ba la sai. Thu Lai");
        }
    }
}
