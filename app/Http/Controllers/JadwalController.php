<?php

namespace App\Http\Controllers;

use App\Models\KantorInduk;
use App\Models\Jadwal;
use App\Models\Eviden;
use App\Models\UnitLevel2;
use App\Models\UnitLevel3;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $jadwal = Jadwal::orderByDesc('created_at')->limit(500)->get();
            return view('jadwal.index',compact('jadwal'));
        } else {
            return redirect()->route('login');
        }
    }

    public function showFormJadwal(){
        if(Auth::check()){

            $kantor_induk = KantorInduk::all();
            return view('jadwal.addJadwal',compact('kantor_induk'));
        }else{
            return redirect()->route('login');
        }
    }

    public function add(request $request){
        if(Auth::check()){

            $rules = [
                'kantor_induk' => 'required',
                'unit_level2' => 'required',
                'lokasi' => 'required',
                'koordinat' => 'required',
                'deskripsi' => 'required'
            ];

            $messages = [
                'kantor_induk.required' => 'Kantor_induk wajib di isi',
                'unit_level2.required' => 'Unit_level2 wajib di isi',
                'lokasi.required' => 'Lokasi wajib di isi',
                'koordinat.required' => 'koordinat wajib di isi',
                'deskripsi.required' => 'Deskripsi wajib di isi'
            ];

            $validator = Validator::make($request->all(),$rules,$messages);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $jadwal = Jadwal::create([
                'id_kantor_induk' => $request->kantor_induk,
                'id_unit_level2' => $request->unit_level2,
                'id_unit_level3' => $request->unit_level3,
                'lokasi' => $request->lokasi,
                'koordinat' => $request->koordinat,
                'deskripsi' => $request->deskripsi
            ]);

            if($jadwal){
                Session::flash('success', 'Data berhasil di tambah!');
                return redirect()->route('jadwal');
            }else{
                Session::flash('success', 'Data gagal di tambah!');
                return redirect()->route('jadwal');
            }

            return redirect(route('jadwal'));

        }else{
            return redirect()->route('login');
        }
    }

    public function edit($id){
        if(Auth::check()){
            $jadwal = Jadwal::find($id);
            $kantor_induk = KantorInduk::all();
            $unit_level2 = UnitLevel2::where('kantor_induk_id',$jadwal->id_kantor_induk)->get();
            $unit_level3 = UnitLevel3::where('unit_level2_id',$jadwal->id_unit_level2)->get();
            return view('jadwal.editJadwal',compact('jadwal','kantor_induk','unit_level2','unit_level3'));
        }else{
            return redirect()->route('login');
        }
    }

    public function update(request $request,$id){

        if(Auth::check()){
            $result = [
                'kantor_induk' => 'required',
                'unit_level2' => 'required',
                'lokasi' => 'required',
                'koordinat' => 'required',
                'deskripsi' => 'required'
            ];

            $message = [
                'kantor_induk.required' => 'Kantor Induk wajib di isi',
                'unit_level2.required' => 'Unit Level2 wajib di isi',
                'unit_level3.required' => 'Unit Level3 wajib di isi',
                'lokasi.required' => 'Lokasi wajib di isi',
                'koordinat.required' => 'Koordinat wajib di isi',
                'deskripsi.required' => 'Deskripsi wajib di isi'

            ];

            $validator = Validator::make($request->all(),$result,$message);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $jadwal = Jadwal::find($id);

            $jadwal->id_kantor_induk = $request->kantor_induk;
            $jadwal->id_unit_level2 = $request->unit_level2;
            $jadwal->id_unit_level3 = $request->unit_level3;
            $jadwal->lokasi = $request->lokasi;
            $jadwal->koordinat = $request->koordinat;
            $jadwal->deskripsi = $request->deskripsi;
            $jadwal->save();

            if($jadwal){
                Session::flash('success', 'Data berhasil ditambah!');
                return redirect()->route('jadwal');
            }else{
                Session::flash('success', 'Data gagal ditambah!');
                return redirect()->route('jadwal');
            }

            return redirect(route('jadwal'));

        }else{

            return redirect()->route('login');

        }
    }

    private function deleteFile($document){
        if($document){
            File::delete(public_path('eviden/'. $document));
        }
    }

    public function destroy($id){

        $jadwal = Jadwal::find($id);
        $eviden = Eviden::where('id_jadwal',$id)->first();
        $this->deleteFile($eviden->url);
        $this->deleteFile($eviden->pdf);
        $eviden->delete();
        $jadwal->delete();

        if ($jadwal) {
            Session::flash('warning', 'Menghapus data berhasil!');
            return redirect()->route('jadwal');
        } else {
            Session::flash('errors', ['' => 'Menghapus data gagal!']);
            return redirect()->route('jadwal');
        }

    }
}
