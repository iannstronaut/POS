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
            'username' => 'manager33',
            'nama' => 'Manager Tiga Tiga',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ]);

        $user->save();
        return view('user', ['data' => $user]);
    }
}
