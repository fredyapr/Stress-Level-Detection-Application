<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlinikController extends Controller
{
    public function index(Request $request)
    {
        $data_klinik = \App\Klinik::all();
        // dd($data_klinik);
        if($request->status){
            echo json_encode($data_klinik);
        }else{
            return view('klinik.index',['data_klinik' => $data_klinik]);
        }
    }

    public function create(Request $request)
    {
        \App\Klinik::create($request->all());
        return redirect('/klinik')->with('message','Data berhasil diinput!');
    }

    public function edit($id_klinik)
    {
        $klinik = \App\Klinik::find($id_klinik);
        return view("klinik/edit",['klinik' => $klinik]);
    }

    public function update(Request $request, $id_klinik)
    {
        $klinik = \App\Klinik::find($id_klinik);
        $klinik->update($request->all());
        return redirect('/klinik')->with('message','Data berhasil diupdate!');
    }

    public function delete($id_klinik)
    {
        $klinik = \App\Klinik::find($id_klinik);
        $klinik->delete();
        return redirect('/klinik')->with('message','Data berhasil dihapus!');
    }
}
