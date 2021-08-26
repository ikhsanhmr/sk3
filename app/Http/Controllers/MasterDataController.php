<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGedung;
use App\Models\MasterLantai;
use App\Models\KantorInduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MasterDataController extends Controller
{
    public function index(){

        $gedung = MasterGedung::orderByDesc('created_at')->limit(200)->get();
        $lantai = MasterLantai::orderByDesc('created_at')->limit(200)->get();
        return view('master_data.index',compact('gedung','lantai'));
    }

    public function showFormAddGedung(){
        $kantor_induk = KantorInduk::all();
        return view('master_data.addGedung',compact('kantor_induk'));
    }

    public function addGedung(request $request){

        $rules = [
            'kantor_induk' => 'required',
            'unit_level2' => 'required',
            'nama_gedung' => 'required',
            'company_code' => 'required',
            'busines_area' => 'required'
        ];

        $messages = [
            'kantor_induk.required' => 'Kantor induk wajib di isi',
            'unit_level2.required' => 'Unit level 2 wajib di isi',
            'nama_gedung.required' => 'Nama Gedung wajib di isi',
            'company_code.required' => 'Company code wajib di isi',
            'busines_area.required' => 'Busines Area wajib di isi'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        if(Auth::check()){
            $gedung = new MasterGedung;
            $gedung->id_kantor_induk = $request->kantor_induk;
            $gedung->id_unit_level2 = $request->unit_level2;
            $gedung->id_unit_level3 = $request->unit_level3;
            $gedung->nama_gedung = $request->nama_gedung;
            $gedung->company_code = $request->company_code;
            $gedung->busines_area = $request->busines_area;
            $gedung->save();

            if($gedung){
                Session::flash('success', 'Data berhasil ditambah!');
                return redirect()->route('masterData');
            }else{
                Session::flash('success', 'Data gagal ditambah!');
                return redirect()->route('masterData');
            }
        }
    }
}
