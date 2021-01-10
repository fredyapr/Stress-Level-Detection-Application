<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use App\Pertanyaan;

class PertanyaanController extends Controller
{
    public function index(Request $request)
    {
        // echo "asd";
        // dd('asd');
        if($request->has('cari')){
            $data_pertanyaaan = \App\Pertanyaan::where('kategori','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_pertanyaaan = \App\Pertanyaan::all();
        }
        //$kategori = Kategori::pluck('kategori');
        $data['kategori'] =Kategori::get();
        $data['pertanyaan']= Pertanyaan::Join('kategori','pertanyaan.kategori','kategori.id_kategori')->get();
        // //dd($data);
        if($request->status){
            echo json_encode($data['pertanyaan']);
        }else{
            return view('pertanyaan.index',$data);
        }
    }

    public function create(Request $request)
    {
        \App\Pertanyaan::create($request->all());
        return redirect('/pertanyaan')->with('sukses','Data berhasil');
    }

    public function edit($id_pertanyaan)
    {
        $pertanyaan = \App\Pertanyaan::find($id_pertanyaan);
        $kategori = Kategori::pluck('kategori');
        return view("pertanyaan/edit",['pertanyaan' => $pertanyaan], ['kategori' => $kategori,]);
    }

    public function update(Request $request, $id_pertanyaan)
    {
        $pertanyaan = \App\Pertanyaan::find($id_pertanyaan);
        $pertanyaan->update($request->all());
        return redirect('/pertanyaan')->with('sukses','Data berhasil diupdate');
    }

    public function delete($id_pertanyaan)
    {
        $pertanyaan = \App\Pertanyaan::find($id_pertanyaan);
        $pertanyaan->delete();
        return redirect('/pertanyaan')->with('sukses','Data berhasil dihapus');
    }
}