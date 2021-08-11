<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kantor_induk;
use App\Models\KantorInduk;
use App\Models\Unit_level2;
use App\Models\Unit_level3;

class UnitController extends Controller
{
    public function index(){

        $kantor_induk = KantorInduk::get();
        $unit_level2 = Unit_level2::get();
        $unit_level3= Unit_level3::get();

        dd($unit_level2);
    }
}
