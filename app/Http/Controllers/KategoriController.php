<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable){
        return $dataTable->render('kategori.index');

        // $data =[
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];

        // DB::table('m_kategori')->insert($data);

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);

        // $data = DB::table('m_kategori')->get();
        // return view('kategori', ['data' => $data]);
    }

    public function create(){
        return view('kategori.create');
    }

    public function store(StorePostRequest $req): RedirectResponse{
        $validated = $req->validated();
        
        $validated = $req->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $req->safe()->except(['kategori_kode', 'kategori_nama']);

        return redirect('/kategori');
    }

    public function edit($id){
        $kat = KategoriModel::find($id);
        return view('kategori.edit', [ 'd' => $kat]);
    }

    public function update(Request $req, $id){
        $kategori = KategoriModel::findOrFail($id);
        $kategori->kategori_nama = $req->namaKategori;
        $kategori->kategori_kode = $req->kodeKategori;
        $kategori->save();

        return redirect('/kategori');
    }

    public function showdel($id){
        $kat = KategoriModel::find($id);
        return view('kategori.delete', [ 'd' => $kat]);
    }

    public function delete($id){
        $kategori = KategoriModel::findOrFail($id);
        $kategori->delete();
        return redirect('/kategori');
    }
    
}
