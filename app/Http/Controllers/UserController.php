<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin_dashboard()
    {
        $user = User::all();
        return view('admin.dashboard', compact('user'));
    }
    public function aprendiz_dashboard()
    {
        $user = User::all();
        return view('aprendiz.dashboard', compact('user'));
    }
}
