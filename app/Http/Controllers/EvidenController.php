<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Eviden;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\Session;

class EvidenController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $eviden = Eviden::orderByDesc('created_at')->get();

            return view('eviden.index',compact('eviden'));
        } else {
            return redirect()->route('login');
        }
    }

    public function showFormEviden(){
        if(Auth::check()){
            $jadwal = Jadwal::all();
            return view('eviden.addEviden',compact('jadwal'));
        }else{
            return redirect()->route('login');
        }

    }

    private function uploadFile($request)
    {
        if ($request) {
            $file_name = Str::random(20) . "." . $request->extension();
            $request->move(public_path("eviden/"), $file_name);
            return $file_name;
        }
    }

    public function add(request $request){
        if(Auth::check()){
            $rules = [
                'id_jadwal' => 'required|unique:eviden',
                'url' => 'mimes:mp4,jpg,png,jpeg',
                'pdf' => 'mimes:pdf'
            ];

            $message = [
                'id_jadwal.required' => 'Jadwal wajib di isi',
                'pdf.mimes' => 'file yang dapat di upload adalah pdf',
                'id_jadwal.unique' => 'Jadwal sudah Terdaftar',
                'url.mimes' => 'File yang dapat di upload adalah mp4,jpg,png,jpeg'
            ];

            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $eviden = new Eviden;
            if($request->file()){
                $eviden->url = $this->uploadFile($request->url);
                $eviden->pdf = $this->uploadFile($request->pdf);
            }
            $eviden->id_jadwal = $request->id_jadwal;
            $eviden->save();

            if($eviden){
                Session::flash('success', 'Data berhasil ditambah!');
                return redirect()->route('eviden');
            }else{
                Session::flash('success', 'Data gagal ditambah!');
                return redirect()->route('eviden');
            }

        }else{
            return redirect()->route('login');
        }
    }

    public function edit($id){
        if(Auth::check()){
            $eviden = Eviden::find($id);
            return view('eviden.editEviden',compact('eviden'));
        }else{
            return redirect()->route('login');
        }
    }
}
