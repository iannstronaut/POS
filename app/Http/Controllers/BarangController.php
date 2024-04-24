<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar Barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function list(Request $req){
        // $kategori = KategoriModel::select('kategori_id', 'kategori_nama', 'kategori_kode');
        $barang = BarangModel::all();

        if($req->kategori_id){
            $barang->where('kategori_id', $req->kategori_id);
        }

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) { 
                $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" 
                        class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. 
                        url('/barang/'.$barang->barang_id).'">'
                            . csrf_field() . method_field('DELETE') . 
                            '<button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm(\'Apakah Anda yakit menghapus data 
                            ini?\');">Hapus</button></form>'; 
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Create Barang',
            'list' => ['Home', 'Barang', 'Create']
        ];

        $page = (object) [
            'title' => 'Create Barang'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori,'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer'
        ]);

        BarangModel::create([
            'kategori_id' => $req->kategori_id,
            'barang_kode' => $req->barang_kode,
            'barang_nama' => $req->barang_nama,
            'harga_beli' => $req->harga_beli,
            'harga_jual' => $req->harga_jual,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breadcrumb = (object)[
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang';
        $barang = BarangModel::with('kategori')->find($id);
        
        return view('barang.show', compact('barang'), ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = (object)[
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();
        
        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori, 'barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $req->validate([
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer'
        ]);

        BarangModel::find($id)->update([
            'kategori_id' => $req->kategori_id,
            'barang_kode' => $req->barang_kode,
            'barang_nama' => $req->barang_nama,
            'harga_beli' => $req->harga_beli,
            'harga_jual' => $req->harga_jual,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if(!$check){
            return redirect('/barang')->with('error', 'Data Barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data Barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data Barang gagal dihapus karna masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
