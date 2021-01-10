<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hasil;

class HasilController extends Controller
{
    public function hasil(Request $request)
    {
        $status = '';
        $hasil = $request['total'];
        if ($hasil > 0 && $hasil < 15) {
            $status = 'Stres Ringan';
        }elseif ($hasil > 14 && $hasil < 27) {
            $status = 'Stres Sedang';
        }else{
            $status = 'Stres Berat';
        }
        $data = Hasil::create(['id_pengguna'=>$request['id_pengguna'],'hasil'=>$status])->save();
        echo json_encode([
            'status' => 'berhasil',
            'pesan' => 'berhasil cok',
            'data' => $status
        ]);
    }

    public function history(Request $request)
    {
        $idPengguna = $request['id_pengguna'];
        $data['hasil'] = Hasil::where('id_pengguna',$request['id_pengguna'])->get();
        echo json_encode($data);
    }
}