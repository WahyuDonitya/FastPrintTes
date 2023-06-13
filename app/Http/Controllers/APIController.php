<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use GuzzleHttp\Client;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    function getdataapi(Request $request){


        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

        $response = Http::get($url);

        $username = strstr($response->header('X-Credentials-Username'), ' (', true);

        $tanggalHariIni = date('d');
        $bulanHariIni = date('m');
        $tahunHariIni = substr(date('Y'),-2);

        $password = md5("bisacoding-". strval($tanggalHariIni)."-".strval($bulanHariIni)."-".strval($tahunHariIni));

        // dd($username. "+" .$password);
        $client = new Client();

        $response = $client->post('https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
            'form_params' => [
                'username' => $username,
                'password' => $password,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $databarang = BarangModel::all();

        if(count($databarang) == 0){
            foreach ($data['data'] as $barang) {
                BarangModel::create([
                    'nama_produk' => $barang['nama_produk'],
                    'harga' => $barang['harga'],
                    'kategori' => $barang['kategori'],
                    'status' => $barang['status'],
                ]);
            }
            return redirect()->back()->with('success', 'Berhasil mengambil data dari API');
        }else{
            return redirect()->back()->with('gagal', 'Data Barang sudah diambil');
        }


    }
}
