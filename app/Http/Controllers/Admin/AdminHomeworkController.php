<?php

namespace App\Http\Controllers\Admin;

use App\Homework;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeworkController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getData()
    {
        $data = \App\Homework::all();

        return view('homework', ['allHomework' => $data]);
    }
    public function showForm()
    {
        return view('addHomework');
    }
    public function viewHomework($id)
    {
        $data = DB::table('sub_result')
            ->join('users', 'users.id', '=', 'sub_result.id_user')
            ->join('homework', 'homework.id', '=', 'sub_result.subject_id')
            ->select('users.name', 'homework.subject_name', 'sub_result.created_at', 'sub_result.id')
            ->where('sub_result.subject_id', '=', $id)
            ->get();
        return view('viewHomework', ['allSub' => $data]);
    }
    public function addHomework(Request $request)
    {

        $subject = $request->input('subjectName');
        $filename = $_FILES['download']['name'];
        $r = DB::select("SHOW TABLE STATUS LIKE 'homework'");
        $idfile = $r[0]->Auto_increment;
        $desfolder = 'homeworks/teacher/gv' . $idfile;
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
                DB::table('homework')->insert([
                    'subject_name' => $subject,
                    'size' => $size,
                    'download' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'namefile' => $filename,
                ]);
                $data = Homework::all();

                return view('homework', ['allHomework' => $data]);
            } else {
                return redirect('addHomework')->with('failed', "Thêm bai tap thất bại");
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
    public function deleteHomework($id){
        $file = DB::select('select * from homework where id = ?', [$id]);
        $path = $_SERVER['DOCUMENT_ROOT'].'/homeworks/teacher/gv'.$id.'/'.$file[0]->namefile.'';
        unlink($path);
        DB::table('homework')->where('id', '=', $id)->delete();
        $data = Homework::all();

        return view('homework', ['allHomework' => $data]);
    }
}
