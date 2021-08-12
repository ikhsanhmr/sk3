<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index(){

        $jadwal = Jadwal::orderByDesc('created_at')->get();
        return view('jadwal.index');
    }
}
