<?php

namespace App\Http\Controllers\Admin\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view ('admin.pages.home');
    }
}
