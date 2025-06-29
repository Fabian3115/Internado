<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }
    public function aprendiz_dashboard()
    {
        return view('aprendiz.dashboard');
    }
}
