<?php

namespace App\Http\Controllers\Api;

use App\Models\LevelModel;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(){
        return LevelModel::all();
    }

    public function store(Request $req){
        $level = LevelModel::create($req->all());
        return response()->json($level, 201);
    }

    public function show(LevelModel $level){
        return LevelModel::find($level);
    }

    public function update(Request $req, LevelModel $level){
        $level->update($req->all());
        return LevelModel::find($level);
    }

    public function destroy(LevelModel $user){
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
