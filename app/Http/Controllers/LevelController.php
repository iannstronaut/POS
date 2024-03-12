<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(){
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) value(?, ?, ?)', ['cus', 'pelanggan', now()]);
        
        // $row = DB::update('update m_level set level_nama = ? where level_kode =?', ['Customer','cus']);

        // $row = DB::delete('delete from m_level where level_kode =?', ['cus']);

        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }
}
