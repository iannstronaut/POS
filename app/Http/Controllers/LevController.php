<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class LevController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $breadcrumb = (object)[
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';
        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(){
        $level = LevelModel::all();
        return DataTables::of($level)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) { 
                $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" 
                        class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. 
                        url('/level/'.$level->level_id).'">'
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
            'title' => 'Create level',
            'list' => ['Home', 'Level', 'Create']
        ];

        $page = (object) [
            'title' => 'Create Level'
        ];

        $activeMenu = 'level';

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'level_kode' => 'required|string|unique:m_level,level_kode|max:10',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_kode' => $req->level_kode,
            'level_nama' => $req->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data Level berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level';
        $level = LevelModel::find($id);
        
        return view('level.show', compact('level'), ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcrumb = (object)[
            'title' => 'Edit level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit level'
        ];

        $activeMenu = 'level';
        $level = LevelModel::find($id);
        
        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level' => $level]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $req->validate([
            'level_kode' => 'required|string|unique:m_level,level_kode|max:10',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $req->level_kode,
            'level_nama' => $req->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if(!$check){
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data Level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data Level gagal dihapus karna masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}