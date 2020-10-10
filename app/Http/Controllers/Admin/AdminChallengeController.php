<?php

namespace App\Http\Controllers\Admin;

use App\Challenge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function showForm()
    {
        return view('addChallenge');
    }
    public function viewChallenge($id)
    {
        $data = DB::select('select * from challengequizz where id = ?', [$id]);
        return view('viewChallenge', [
            'data' => $data[0]
        ]);
    }
    public function subChallenge(Request $request){
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
       
        $check =false;
        foreach ($results_array as $value) {
            if (basename($value,".txt") == $answer) {
                $check=true;
                break;
            } 
        }
        if($check){
            $des = 'challenges/chall'.$idfile.'/'.$value;
            $content="";
            $read = file($des);
            foreach ($read as $line) {
                $content= $content.$line."<br>";
            }   
            $data = DB::select('select * from challengequizz where id = ?', [$idfile]);
            return view('showChallenge', [
                'data' => $data[0],'check'=>true,'content'=>$content
            ]);
        }
        else{
            return redirect('viewChallenge/'.$idfile.'')->with('failed', "Cau tra loi ba la sai. Thu Lai");
        }
    }
    public function addChallenge(Request $request){
        // name of the uploaded file
        $r = DB::select("SHOW TABLE STATUS LIKE 'challengequizz'");
        $idfile = $r[0]->Auto_increment;
        $name = $request->input('ChallName');
        $filename = $_FILES['download']['name'];
        $hint =$request->input('hint');
        $desfolder ='challenges/chall'.$idfile;
        if(!mkdir($desfolder,0777, true)){
            die('Tao folder thất bại');
        };
        // destination of the file on the server
        $destination = $desfolder.'/' . $filename;

        // get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['download']['tmp_name'];
        $size = $_FILES['download']['size'];

        if (!in_array($extension, ['txt'])) {
            echo "You file extension must be .txt";
        } elseif ($_FILES['download']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            echo "File too large!";
        } else {
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
                DB::table('challengequizz')->insert([
                    'name' => $name,
                    'hint' => $hint,
                    'created_at' => date('Y-m-d H:i:s'),
                   
                ]);
                $data = Challenge::all();

                return view('challenge', ['allChallenge' => $data]);
            } else {
                return redirect('addChallenge')->with('failed', "Thêm challenge thất bại");
            }
        }
    }
    public function deleteChallenge($id){
        // $file = DB::select('select * from challengequizz where id = ?', [$id]);
        // $path = $_SERVER['DOCUMENT_ROOT'].'/challenges/chall'.$id.'';
        // unlink($path);
        DB::table('challengequizz')->where('id', '=', $id)->delete();
        $data = Challenge::all();

        return view('challenge', ['allChallenge' => $data]);
    }
}
