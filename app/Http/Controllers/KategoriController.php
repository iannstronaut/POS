<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
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

    public function store(Request $req){
        KategoriModel::create([
            'kategori_kode' => $req->kodeKategori,
            'kategori_nama' => $req->namaKategori
        ]);
        return redirect('/kategori');
    }
}
