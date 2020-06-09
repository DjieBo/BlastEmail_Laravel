<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Excel;

class ProcessController extends Controller
{
    function main(){
        $mail = DB::table('list_email')->get();
        return view('main', compact('mail'));
    }
    function upload(Request $upload){
        $path = $upload->file('excelfile');
        $email = $upload->input('email');
        $name = $upload->input('name');
        if($path != null){
            $paching = $path->getRealPath();
            $data = Excel::load($paching)->get();
            if($data->count() > 0){
                foreach($data->toArray() as $key => $value){
                    foreach($value as $row){
                        $insert[] = array(
                            'nama'  => $row['nama'],
                            'email' => $row['email']
                        );
                    }
                }
                if(!empty($insert)){
                    DB::table('list_email')->insert($insert);
                }
            }
        } else {
            $data = array(
                'nama'  => $name,
                'email' => $email
            );
            DB::table('list_email')->insert($data);
        }
        return redirect('main')->with('message', 'Penambahan List Sukses');
    }
    function sendemail(Request $sender){
        $name = $sender->input('nama');
        $mail = $sender->input('email');
        $subject = $sender->input('subject');
        $message = $sender->input('pesan');
        for($n = 0; $n < count($mail); $n++){
            $data = array(
                'namaTo' => $name[$n],
                'isiEmail' => $message
            );
            Mail::to($mail[$n])->send(new SendMail($name[$n], $mail[$n], $subject, $message, $data));
        }
        return redirect('main')->with('sennder', 'Email Telah Terkirim');
    }
}
