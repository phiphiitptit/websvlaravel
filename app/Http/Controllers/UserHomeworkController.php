<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserHomeworkController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getData()
    {
        $data = \App\Homework::all();

        return view('auth.userHomework', ['allHomework' => $data]);
    }
    public function getHomework($id)
    {
        $data = DB::select('select * from sub_result where id = ?', [$id]);
        return view('auth.uploadHomework', ['data' => $data]);
    }
    public function uploadHomework(Request $request)
    {
        $id_subject = $request->input('id');
        $id_user = Auth::user()->id;
        $filename = $_FILES['download']['name'];
        $r = DB::select("SHOW TABLE STATUS LIKE 'sub_result'");
        $idfile = $r[0]->Auto_increment;
        $desfolder = 'homeworks/student/sv' . $idfile;
        if (!mkdir($desfolder, 0777, true)) {
            die('Tao folder thất bại');
        };
        // destination of the file on the server
        $destination = $desfolder . '/' . $filename;

        // get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['download']['tmp_name'];
        $size = $_FILES['download']['size'];

        if (!in_array($extension, ['zip', 'pdf', 'docx', 'txt'])) {
            echo "You file extension must be .zip, .pdf or .docx";
        } elseif ($_FILES['download']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            echo "File too large!";
        } else {
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
                DB::table('sub_result')->insert([
                    'subject_id' => $id_subject,
                    'name' => $filename,
                    'id_user' => $id_user,
                    'created_at' => date('Y-m-d H:i:s'),

                ]);
                $data = \App\Homework::all();

                return view('auth.userHomework', ['allHomework' => $data]);
            } else {
                return redirect('userHomework')->with('failed', "Nop bai tap thất bại");
            }
        }
    }
    public function downloadHomework($id)
    {
        // fetch file to download from database
        $file = DB::select('select * from homework where id = ?', [$id]);

        //   $file = mysqli_fetch_assoc($result);
        $filepath = 'homeworks/teacher/gv' . $id . '/' . $file[0]->namefile;

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));

            //This part of code prevents files from being corrupted after download
            ob_clean();
            flush();

            readfile($filepath);

            // Now update downloads count
            $newCount = $file[0]->download + 1;
            DB::table('homework')
                ->where('id', $id)
                ->update(['download' => $newCount]);
            //   $updateQuery = "UPDATE homework SET download=$newCount WHERE id=$id";
            //   mysqli_query($con, $updateQuery);
            //   exit;
        }
    }
}
