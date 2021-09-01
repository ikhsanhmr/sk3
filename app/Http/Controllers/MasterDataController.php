<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGedung;
use App\Models\MasterLantai;
use App\Models\KantorInduk;
use App\Models\UnitLevel2;
use App\Models\UnitLevel3;
use App\Models\Apar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MasterDataController extends Controller
{
    public function index(){
        if(Auth::check()){
        $gedung = MasterGedung::orderByDesc('created_at')->limit(500)->get();
        $lantai = MasterLantai::orderByDesc('created_at')->limit(500)->get();
        return view('master_data.index',compact('gedung','lantai'));
        }else{
            return redirect()->route('login');
        }
    }

    public function showFormAddGedung(){
        if(Auth::check()){
        $kantor_induk = KantorInduk::all();
        return view('master_data.addGedung',compact('kantor_induk'));
        }else{
            return redirect()->route('login');
        }
    }

    public function addGedung(request $request){

        if(Auth::check()){

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
        }else{
            return redirect()->route('login');
        }
    }

    public function editGedung($id){
        if(Auth::check()){

            $gedung = MasterGedung::find($id);
            $kantor_induk = KantorInduk::all();
            $unit_level2 = UnitLevel2::where('kantor_induk_id',$gedung->id_kantor_induk)->get();
            $unit_level3 = UnitLevel3::where('unit_level2_id',$gedung->id_unit_level2)->get();
            return view('master_data.editGedung',compact('gedung','kantor_induk','unit_level2','unit_level3'));
        }else{
            return redirect()->route('login');
        }
    }

    public function updateGedung(request $request,$id){
        if(Auth::check()){

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

                $gedung =  MasterGedung::find($id);
                $gedung->id_kantor_induk = $request->kantor_induk;
                $gedung->id_unit_level2 = $request->unit_level2;
                $gedung->id_unit_level3 = $request->unit_level3;
                $gedung->nama_gedung = $request->nama_gedung;
                $gedung->company_code = $request->company_code;
                $gedung->busines_area = $request->busines_area;
                $gedung->save();

                if($gedung){
                    Session::flash('success', 'Data berhasil diupdate!');
                    return redirect()->route('masterData');
                }else{
                    Session::flash('success', 'Data gagal diupdate!');
                    return redirect()->route('masterData');
                }
            }else{
                return redirect()->route('login');
            }
    }

    private function deleteFile($document){
        if($document){
            File::delete(public_path('foto_apar/'. $document));
        }
    }


    public function deleteGedung($id){
        $apar = Apar::where('id_gedung',$id)->get();
        $lantai = MasterLantai::where('id_gedung',$id);
        $gedung = MasterGedung::find($id);
        foreach($apar as $value){
            $this->deleteFile($value->foto_apar);
            $value->delete();
        }
        $lantai->delete();
        $gedung->delete();

        if ($gedung) {
            Session::flash('warning', 'Menghapus data berhasil!');
            return redirect()->route('masterData');
        } else {
            Session::flash('errors', ['' => 'Menghapus data gagal!']);
            return redirect()->route('masterData');
        }
    }

    public function showFormAddLantai(){
        $kantor_induk = KantorInduk::all();
        $gedung = MasterGedung::select('id','nama_gedung')->get();
        return view('master_data.addLantai',compact('gedung','kantor_induk'));
    }

    public function addLantai(request $request){

        $rules = [
            'kantor_induk' => 'required',
            'unit_level2' => 'required',
            'nama_lantai' => 'required',
            'gedung' => 'required'
        ];

        $messages = [
            'kantor_induk.required' => 'Kantor induk wajib di isi',
            'unit_level2.required' => 'Unit level 2 wajib di isi',
            'nama_lantai.required' => 'Nama Lantai wajib di isi',
            'gedung.required' => 'Gedung code wajib di isi'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $lantai = new MasterLantai;
        $lantai->id_kantor_induk = $request->kantor_induk;
        $lantai->id_unit_level2 = $request->unit_level2;
        $lantai->id_unit_level3 = $request->unit_level3;
        $lantai->id_gedung = $request->gedung;
        $lantai->nama_lantai = $request->nama_lantai;
        $lantai->save();

        if($lantai){
            Session::flash('success', 'Data berhasil ditambah!');
            return redirect()->route('masterData');
        }else{
            Session::flash('success', 'Data gagal ditambah!');
            return redirect()->route('masterData');
        }

    }

    public function editLantai($id){
        if(Auth::check()){

            $lantai = MasterLantai::find($id);
            $gedung = MasterGedung::all();
            $kantor_induk = KantorInduk::all();
            $unit_level2 = UnitLevel2::where('kantor_induk_id',$lantai->id_kantor_induk)->get();
            $unit_level3 = UnitLevel3::where('unit_level2_id',$lantai->id_unit_level2)->get();
            return view('master_data.editLantai',compact('lantai','gedung','kantor_induk','unit_level2','unit_level3'));
        }else{
            return redirect()->route('login');
        }

    }

    public function deleteLantai($id){
        $apar = Apar::where('id_lantai',$id)->get();
        $lantai = MasterLantai::find($id);

        foreach($apar as $value){
            $this->deleteFile($value->foto_apar);
            $value->delete();
        }
        $lantai->delete();
        if ($lantai) {
            Session::flash('warning', 'Menghapus data berhasil!');
            return redirect()->route('masterData');
        } else {
            Session::flash('errors', ['' => 'Menghapus data gagal!']);
            return redirect()->route('masterData');
        }
    }
}
