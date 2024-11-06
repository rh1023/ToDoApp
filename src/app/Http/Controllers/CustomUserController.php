<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomUserController extends Controller
{
    // 登録画面の表示
    public function index()
    {
        return view('login');
    }
}
