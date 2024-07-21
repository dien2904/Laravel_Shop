<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function xinchao(Request $request)
    {
        $query = request()->query->all();
        $users = DB::table('users')->select('id', 'name', 'email');
        var_dump($users->get());

        return view('hello', ['name' => $query['name']]);
    }

    public function getUsers(Request $request)
    {
        $users = DB::table('users')->select('id', 'name', 'email');
        $results = $users->get();

        return view('users', ['users' => $results]);
    }
    
    public function detailUsers(Request $request)
    {
        $users = DB::table('users')->select('id', 'name', 'email');
        $results = $users->get();

        return view('users', ['users' => $results]);
    }
}
