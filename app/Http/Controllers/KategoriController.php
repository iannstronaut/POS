<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index(){
        
        $breadcrumb = (object)[
            'title' => 'Daftar Kategori Barang',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar Kategori Barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori';
        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(){
        // $kategori = KategoriModel::select('kategori_id', 'kategori_nama', 'kategori_kode');
        $kategori = KategoriModel::all();
        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) { 
                $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit').'" 
                        class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. 
                        url('/kategori/'.$kategori->kategori_id).'">'
                            . csrf_field() . method_field('DELETE') . 
                            '<button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm(\'Apakah Anda yakit menghapus data 
                            ini?\');">Hapus</button></form>'; 
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Create kategori',
            'list' => ['Home', 'Kategori', 'Create']
        ];

        $page = (object) [
            'title' => 'Create Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $req){
        $req->validate([
            'kategori_kode' => 'required|string|unique:m_kategori,kategori_kode|max:10',
            'kategori_nama' => 'required|string|max:100',
        ]);

        KategoriModel::create([
            'kategori_kode' => $req->kategori_kode,
            'kategori_nama' => $req->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data Kategori berhasil disimpan');
    }

    public function edit($id){
        $breadcrumb = (object)[
            'title' => 'Edit kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';
        $kategori = KategoriModel::find($id);
        
        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function update(Request $req, $id){
        $req->validate([
            'kategori_kode' => 'required|string|unique:m_kategori,kategori_kode|max:10',
            'kategori_nama' => 'required|string|max:100',
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $req->kategori_kode,
            'kategori_nama' => $req->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function show($id){
        $breadcrumb = (object)[
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        $activeMenu = 'kategori';
        $kategori = KategoriModel::find($id);
        
        return view('kategori.show', compact('kategori'), ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function delete($id){
        $check = KategoriModel::find($id);
        if(!$check){
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id);

            return redirect('/kategori')->with('success', 'Data Kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data Kategori gagal dihapus karna masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    
}
