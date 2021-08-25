<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGedung;
use App\Models\MasterLantai;
use App\Models\KantorInduk;

class MasterDataController extends Controller
{
    public function index(){
        return view('master_data.index');
    }

    public function showFormAddGedung(){
        $kantor_induk = KantorInduk::all();
        return view('master_data.addGedung',compact('kantor_induk'));
    }
}
