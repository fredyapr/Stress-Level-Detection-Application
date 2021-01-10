<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use App\Nilai;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        
        $nilai = \App\Nilai::all();
        
        if($request->status){
            echo json_encode($nilai['nilai']);
        }else{
            return view('nilai.index',['nilai' => $nilai]);
        }
    }

    public function create(Request $request)
    {
        $nama = $request->
        $email_user = '';
        $search_user = DB::table('pengguna')->where('email',$request->email)->count();
        if($search_user == 0){
            $input_user = \App\Pengguna::create($request->all());
            $search_user2 = DB::table('pengguna')->where('email',$request->email)->count();
            $data= [
                'id_pengguna' => $search_user2->id_pengguna,
                'hasil'=> $request->hasil,
            ];
            $input = \App\Hasil::insert($data);
        }else{
            $search_user2 = DB::table('pengguna')->where('email',$request->email)->count();
            $data= [
                'id_pengguna' => $search_user2->id_pengguna,
                'hasil'=> $request->hasil,
            ];
            $input = \App\Hasil::insert($request->all());
        }
        return redirect('/nilai')->with('sukses','Data berhasil');
    }



    public function edit($id_nilai)
    {
        $nilai = \App\Nilai::find($id_nilai);
        return view("nilai/edit",['nilai' => $nilai]);
    }

    public function update(Request $request, $id_nilai)
    {
        $nilai = \App\Nilai::find($id_nilai);
        $nilai->update($request->all());
        return redirect('/nilai')->with('sukses','Data berhasil diupdate');
    }

    public function delete($id_nilai)
    {
        $nilai = \App\Nilai::find($id_nilai);
        $nilai->delete();
        return redirect('/nilai')->with('sukses','Data berhasil dihapus');
    }
}
