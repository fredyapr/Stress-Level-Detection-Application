<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $primaryKey = 'id_pengguna';
    protected $table = 'pengguna';
    protected $fillable = ['nama_pengguna','email_pengguna','password_pengguna'];

    public static function login($email, $password){
        
        $pgn = Pengguna::where('email_pengguna', $email)->first();
        // echo $pgn;die();
        if($pgn){
            if ($password == $pgn['password_pengguna']){
                $arr = [
                    'nama_pengguna' => $pgn['nama_pengguna'],
                    'email_pengguna' => $pgn['email_pengguna'],
                    'id_pengguna' => $pgn['id_pengguna']
                ];
                return json_encode($arr);
            }else{
                return json_encode([
                    'code'=>'0',
                    'status'=>'Login gagal!',
                    'message'=>'password salah'
                ]);    
            }
            }else{
                return json_encode([
                    'code'=>'0',
                    'status'=>'Login gagal!',
                    'message'=>'email tidak terdaftar'
            ]);
        } 
    }
}