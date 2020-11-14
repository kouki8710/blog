<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function create_get()
    {
        return view('admin.create');
    }

    
    public function admin()
    {
        return view('admin.admin');
    }

    public function update_get($id)
    {
        return view("admin.update");
    }

    public function create_tag()
    {
        return view("admin.tag");
    }
}
