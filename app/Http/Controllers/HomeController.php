<?php

namespace App\Http\Controllers;

use App\Models\DataDokter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('pages.home');
    }
}
