<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class WelcomeController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Dashboard',
            'list' => ['Home']
        ];

        $page = (object) [
            'title' => 'Dashboard Admin'
        ];

        $activeMenu = 'dashboard';
        
        return view('welcome', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}