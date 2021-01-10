<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;


class PenggunaController extends Controller
{
    public function regis(Request $r){
        $data = [
            'nama_pengguna' => $r['nama_pengguna'],
            'email_pengguna' => $r['email_pengguna'],
            'password_pengguna' => $r['password_pengguna']
        ];

        $insert = Pengguna::create($data);
        
        if($insert){
            return json_encode([
                'status' => 'berhasil',
                'pesan' => 'berhasil cok'
            ]);
        }else{
            return json_encode([
                'status' => 'gagal',
                'pesan' => 'gagal cok'
            ]);
        }
    }

    public function login(Request $request){
        $email = $request['email_pengguna'];
        $password = $request['password_pengguna'];
        $auth = Pengguna::login($email, $password);
        echo $auth;
    }
}