<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function indexPage() {
        return view('admin.index');
    }

    public function infoPage() {
        return view('admin.info');
    }
}
