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
        $user = UserModel::firstOrNew([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ]);
        $user->username = 'manager 12';

        $user->save();

        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged(['username','level_id']);
        $user->wasChanged('nama');
        $user->wasChanged(['nama', 'username']);
        dd($user->wasChanged(['nama', 'username']));

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
}
