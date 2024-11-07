<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function use_group()
    {
        return view('groupmanagement');
    }
}
