<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index()
    {
        return view('front.index');
    }

    public function sctipts()
    {
        return view('admin.sctipts');
    }

}
