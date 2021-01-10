<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function index(Request $request)
    {
        $data_kuesioner = \App\Kuesioner::all();
        if($request->status){
            echo json_encode($data_kuesioner);
        }else{
            return view('kuesioner.index',['data_kuesioner' => $data_kuesioner]);
        }
    }

    public function create(Request $request)
    {
        \App\Kuesioner::create($request->all());
        return redirect('/kuesioner')->with('message','Data berhasil diinput!');
    }

    public function edit($id_kuesioner)
    {
        $kuesioner = \App\Kuesioner::find($id_kuesioner);
        return view("kuesioner/edit",['kuesioner' => $kuesioner]);
    }

    public function update(Request $request, $id_kuesioner)
    {
        $kuesioner = \App\Kuesioner::find($id_kuesioner);
        $kuesioner->update($request->all());
        return redirect('/kuesioner')->with('message','Data berhasil diupdate!');
    }

    // public function delete($id_kuesioner)
    // {
    //     $kuesioner = \App\Kuesioner::find($id_kuesioner);
    //     $kuesioner->delete();
    //     return redirect('/kuesioner')->with('message','Data berhasil dihapus!');
    // }
}
