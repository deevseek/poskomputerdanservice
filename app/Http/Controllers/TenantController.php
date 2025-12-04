<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        return view('tenant.index');
    }

    public function daftar()
    {
        return view('tenant.daftar');
    }
}
