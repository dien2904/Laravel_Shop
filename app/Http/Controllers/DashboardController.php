<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $template = 'dashboard.home.index' ;
        return view('dashboard.layout',compact(
            'template'
        ));
    }
}
