<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function mem_show()
    {
        return view('memberlist');
    }
}
