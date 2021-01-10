<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolusiController extends Controller
{
    public function index(Request $request)
    {
        $solusi = \App\Solusi::all();
        if($request->status){
            echo json_encode($solusi);
        }else{
            return view('solusi.index',['solusi' => $solusi]);
        }
    }

    public function create(Request $request)
    {
        \App\Solusi::create($request->all());
        return redirect('/solusi')->with('message','Data berhasil diinput!');
    }

    public function edit($id_solusi)
    {
        $solusi = \App\Solusi::find($id_solusi);
        return view("solusi/edit",['solusi' => $solusi]);
    }

    public function update(Request $request, $id_solusi)
    {
        $solusi = \App\Solusi::find($id_solusi);
        $solusi->update($request->all());
        return redirect('/solusi')->with('message','Data berhasil diupdate!');
    }

    public function delete($id_solusi)
    {
        $solusi = \App\Solusi::find($id_solusi);
        $solusi->delete();
        return redirect('/solusi')->with('message','Data berhasil dihapus!');
    }
}
