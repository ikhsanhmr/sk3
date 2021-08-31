<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGedung;

class AparController extends Controller
{
    public function index(){
        return view('apar.index');
    }

    public function showFormAddApar(){
        $masterGedung = MasterGedung::all();
        return view('apar.addApar',compact('masterGedung'));
    }


    public function addApar(request $request){
        dd($request->all());
    }

    public function get_lantai(request $request){

        $id_gedung = $request->gedung;

        $option = "<option value='$id_gedung' > $id_gedung </option>";

        echo $option;

    }
}
