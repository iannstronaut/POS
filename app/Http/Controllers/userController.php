<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function user($id, $name){
        return view('user')
            ->with('id', $id)
            ->with('name', $name);
    }

    public function index(){

        $user = UserModel::all();
        return view('user', ['data' => $user]);
        
        // $data =[
        //     'level_id' => 2,
        //     'username' => 'manager-tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        // $data = [
        //     'nama' => 'Pelanggan Pertama'
        // ];
        // UserModel::where('username', 'customer-1')->update($data);
        
            // $user = UserModel::where('level_id', 2)->count();
            // // dd($user);
        // $user = UserModel::firstOrNew([
        //     'username' => 'manager11',
        //     'nama' => 'Manager11',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ]);
        // $user->username = 'manager 12';

        // $user->save();

        // $user->wasChanged();
        // $user->wasChanged('username');
        // $user->wasChanged(['username','level_id']);
        // $user->wasChanged('nama');
        // $user->wasChanged(['nama', 'username']);
        // dd($user->wasChanged(['nama', 'username']));

        // $user->isDirty();
        // $user->isDirty('username');
        // $user->isDirty('nama');
        // $user->isDirty(['nama', 'username']);

        // $user->isClean();
        // $user->isClean('username');
        // $user->isClean('nama');
        // $user->isClean(['nama','username']);

        // $user->save();

        // $user->isDirty();
        // $user->isClean();

        // dd($user->isDirty());
        // return view('user', ['data' => $user]);
    }

    public function tambah(){
        return view('user_tambah');
    }

    public function tambah_simpan(Request $req){
        UserModel::create([
            'username' => $req->username,
            'nama' => $req->nama,
            'password' => Hash::make('$req->password'),
            'level_id' => $req->level_id,
        ]);

        return redirect('/user');
    }

    public function ubah($id){
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $req){
        $user = UserModel::find($id);

        $user->username = $req->username;
        $user->nama = $req->nama;
        $user->password = Hash::make('$req->username');
        $user->level_id = $req->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id){
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
}
