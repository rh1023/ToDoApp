<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // 登録画面の表示
    public function index()
    {
        return view('login');
    }


    //ユーザーの削除
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('tasklist.taskshow')->with('success', 'ユーザーが削除されました');
    }
}
