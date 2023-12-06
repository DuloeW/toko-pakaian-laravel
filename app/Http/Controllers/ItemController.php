<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Barang::paginate(4);
        return view('welcome', compact("items"));
    }

    public function add()
    {
        return view('add-item');
    }

    public function getItem(Request $request) {
        $items = Barang::where('jenis_barang', $request->keyword)->get();
        return response($items, 200, ['']);
        // return view('welcome', compact('items'));
        // return $items;
    }

    public function show($kodeBarang) {
        $item = Barang::where('kode_barang', $kodeBarang)->get();
        return view('update-item', ['item' => $item]);
    }

    public function postData(Request $request)
    {
        if(!$this->checkItemExist($request->kodeBarang)) {
            $hargaBarangString = ''. $request -> hargaBarang1 . $request->hargaBarang2 . $request->hargaBarang3 . '';

            $barang = new  Barang;
            $barang -> kode_barang = $request -> kodeBarang;
            $barang -> merek_barang = $request -> merekBarang;
            $barang -> stok_barang = $request -> stockBarang;
            $barang -> jenis_barang = $request -> jenisBarang;
            $barang -> harga_barang = intval($hargaBarangString);
            $barang -> save();

            return redirect('/add-data')->withSuccess('Succes Create');
        } else {
            return redirect('/add-data')->withError('Failed, Because Kode Barang is Exist');
        }
    }

    public function delete($kodeBarang) {
        $barang = Barang::find($kodeBarang);

        $barang->delete();
        return redirect('/');
    }

    public function update(Request $request, $kodeBarang) {
        $item = Barang::find($kodeBarang);
        if ($item) {
            $item -> stok_barang = $request -> stockBarang;
            $item -> harga_barang = $request -> hargaBarang;
            $item -> save();
            return redirect('/get/item/'.$kodeBarang)->withSuccess('Success Update');
        } else {
            return redirect('/get/item/'.$kodeBarang)->withErrors('Failed, Because i dont know');
        }
    }


    private function checkItemExist($kodeBarang)
    {
        $barang = Barang::find($kodeBarang);
        return $barang ? true : false;
    }
}
