<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        if($user){
            if($user->level_id == '1'){
                return redirect()->intended('admin');
            }else if($user->level_id == '2'){
                return redirect()->intended('manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $req){
        $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credential = $req->only('username', 'password');

        if(Auth::attempt($credential)){
            $user = Auth::user();
            if($user->level_id == '1'){
                return redirect()->intended('admin');
            }else if($user->level_id == '2'){
                return redirect()->intended('manager');
            }
            return redirect()->intended('/');
        }
        return redirect('login')
        ->withInput()
        ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukkan benar']);
    }

    public function register(){

        return view('register');
    }

    public function proses_register(Request $req){
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect('register')
            ->withErrors($validator)
            ->withInput();
        }

        $req['level_id'] = '2';
        $req['password'] = Hash::make($req->password);

        UserModel::create($req->all());

        return redirect()->route('login');
    }

    public function logout(Request $req){
        $req->session()->flush();

        Auth::logout();

        return redirect('login');
    }
}
