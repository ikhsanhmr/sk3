<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGedung;
use App\Models\MasterLantai;
use App\Models\Apar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Suppor\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AparController extends Controller
{
    public function index(){
        $apar = Apar::orderByDesc('created_at')->limit(500)->get();
        return view('apar.index',compact('apar'));
    }

    public function showFormAddApar(){
        $masterGedung = MasterGedung::all();
        return view('apar.addApar',compact('masterGedung'));
    }

    private function uploadFile($request){
        if($request){
            $file_name = Str::random(20) . "." . $request->extension();
            $request->move(public_path("foto_apar/"), $file_name);
            return $file_name;
        }
    }

    public function addApar(request $request){

        $rules = [
            'gedung' => 'required',
            'lantai' => 'required',
            'lokasi_apar' => 'required',
            'nomor_urut' => 'required',
            'merk_apar' => 'required',
            'type_apar' => 'required',
            'kapasitas' => 'required',
            'media' => 'required',
            'tanggal_expired' => 'required',
            'jadwal_refill' => 'required',
            'jadwal_rutin' => 'required',
            'foto_apar' => 'required'
        ];

        $messages = [
            'gedung.required' => 'Gedung Wajib di isi',
            'lantai.required' => 'Lantai Wajib di isi',
            'lokasi_apar.required' => 'Lokasi Apar Wajib di isi',
            'nomor_urut.required' => 'Nomor Urut Wajib di isi',
            'merk_apar.required' => 'Merk Apar Wajib di isi',
            'type_apar.required' => 'type Apar Wajib di isi',
            'kapasitas.required' => 'Kapasitas Wajib di isi',
            'media.required' => 'Media Wajib di isi',
            'tanggal_expired.required' => 'Tanggal Expired Wajib di isi',
            'jadwal_refill.required' => 'Jadwal Refill Wajib di isi',
            'jadwal_rutin.required' => 'Jadwal Rutin Wajib di isi',
            'foto_apar.required' => 'Foto Apar Wajib di isi'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $apar = new Apar;
        $apar->id_gedung = $request->gedung;
        $apar->id_lantai = $request->lantai;
        $apar->lokasi_apar = $request->lokasi_apar;
        $apar->nomor_urut = $request->nomor_urut;
        $apar->foto_apar = $this->uploadFile($request->foto_apar);
        $apar->merek_apar = $request->merk_apar;
        $apar->type_apar = $request->type_apar;
        $apar->kapasitas = $request->kapasitas;
        $apar->media = $request->media;
        $apar->tanggal_expired = $request->tanggal_expired;
        $apar->jadwal_refill = $request->jadwal_refill;
        $apar->jadwal_triwulanan = $request->jadwal_rutin;
        $apar->save();

        if($apar){
            Session::flash('success', 'Data berhasil ditambah!');
                return redirect()->route('apar');
            }else{
                Session::flash('success', 'Data gagal ditambah!');
                return redirect()->route('apar');
            }
    }

    public function get_lantai(request $request){

        $id_gedung = $request->gedung;

        $lantai = MasterLantai::where('id_gedung',$id_gedung)->get();

        foreach($lantai as $value){

            $option = "<option value='$value->id' > $value->nama_lantai </option>";

            echo $option;

        }

    }
}
