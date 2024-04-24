<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;

class userController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar user',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';
        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'level' => $level,'activeMenu' => $activeMenu]);
    }

    public function list(Request $req){
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        if($req->level_id){
            $users->where('level_id', $req->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { 
                $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" 
                        class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. 
                        url('/user/'.$user->user_id).'">'
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
            'title' => 'Create user',
            'list' => ['Home', 'User', 'Create']
        ];

        $page = (object) [
            'title' => 'Create User'
        ];

        $activeMenu = 'user';
        $level = LevelModel::all();

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,'activeMenu' => $activeMenu]);
    }

    public function store(Request $req){
        $req->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $req->username,
            'nama' => $req->nama,
            'password' => bcrypt($req->password),
            'level_id' => $req->level_id
        ]);

        return redirect('/user')->with('success', 'Data User berhasil disimpan');
    }

    public function edit($id){
        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User'
        ];

        $activeMenu = 'user';
        $user = UserModel::find($id);
        $level = LevelModel::all();
        
        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level' => $level, 'user' => $user]);
    }

    public function update($id, Request $req){
        $req->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username' => $req->username,
            'nama' => $req->nama,
            'password' => $req->password? bcrypt($req->password) : UserModel::find($id)->password,
            'level_id' => $req->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy($id){
        $check = UserModel::find($id);
        if(!$check){
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data USer gagal dihapus karna masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function show($id){
        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail User'
        ];

        $activeMenu = 'user';
        $user = UserModel::with('level')->find($id);
        
        return view('user.show', compact('user'), ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
