<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function taskshow()
    {
        return view('tasklist');
    }

    public function create()
    {
        return view('taskadd');
    }





}
