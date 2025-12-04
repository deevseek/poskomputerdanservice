<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlaimGaransiController extends Controller
{
    public function index()
    {
        return view('klaimgaransi.index');
    }
}
