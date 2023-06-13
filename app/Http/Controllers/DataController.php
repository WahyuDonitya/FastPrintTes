<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;

class DataController extends Controller
{
    function destroy($id){
        $data = BarangModel::find($id);

        $data->delete();
        return redirect()->back()->with('success','Berhasil delete data');
    }

    function store(Request $request){
        if($request->id_produk == null){
            $request->validate([
                'nama_produk' => 'required',
                'harga' =>'required|gt:0|numeric',
                'kategori' => 'required'
            ]);

            BarangModel::create($request->all());

            return redirect()->back()->with('success','Berhasil menambahkan data');
        }else{
            $request->validate([
                'nama_produk' => 'required',
                'harga' =>'required|gt:0|numeric',
                'kategori' => 'required'
            ]);

            BarangModel::where('id_produk', $request->id_produk)->update(['nama_produk' => $request->nama_produk, 'harga' => $request->harga, 'kategori' => $request->kategori, 'status'=> $request->status]);
            return redirect()->back()->with('success','Berhasil update barang dengan id ' . $request->id_produk);
        }

    }


}
