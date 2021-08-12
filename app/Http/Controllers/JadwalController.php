<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('jadwal.index');
        } else {
            return redirect()->route('login');
        }
    }
}
