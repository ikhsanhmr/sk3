<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvidenController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('eviden.index');
        } else {
            return redirect()->route('login');
        }
    }
}
