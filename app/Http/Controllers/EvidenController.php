<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Eviden;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\File;
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

    private function updateFileUpload($request, $document)
    {
        // 1. Cek apakah user upload file
        if ($request) {
            // 2. Cek apakah file sebelumnya ada
            if ($document) {
                // 3. Jika ada maka file sebelumnya dihapus
                File::delete(public_path('eviden/'. $document));
            }
            // 3. Upload file baru
            $files = $request;
            $files_name = Str::random(20) . "." . $files->extension();
            $files->move(public_path("eviden/"), $files_name);
            return $files_name;
        } else {
            if ($document) {
                return $document;
            }
            return null;
        }
    }

    private function deleteFile($document){
        if($document){
            File::delete(public_path('eviden/'. $document));
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

    public function update(request $request,$id){
        if(Auth::check()){

            $eviden = Eviden::find($id);

            $rules = [
                'url' => 'mimes:mp4,jpg,png,jpeg',
                'pdf' => 'mimes:pdf'
            ];

            $message = [
                'pdf.mimes' => 'file yang dapat di upload adalah pdf',
                'url.mimes' => 'File yang dapat di upload adalah mp4,jpg,png,jpeg'
            ];

            $validator = Validator::make($request->all(),$rules,$message);

            if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $eviden->url = $this->updateFileUpload($request->url, $eviden->url);
            $eviden->pdf = $this->updateFileUpload($request->pdf, $eviden->pdf);
            $eviden->save();


            if($eviden){
                Session::flash('success', 'Data berhasil di Update!');
                return redirect()->route('eviden');
            }else{
                Session::flash('success', 'Data gagal di Update!');
                return redirect()->route('eviden');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function destroy($id){

        $eviden = Eviden::find($id);
        $this->deleteFile($eviden->url);
        $this->deleteFile($eviden->pdf);
        $eviden->delete();

        if ($eviden) {
            Session::flash('warning', 'Menghapus data berhasil!');
            return redirect()->route('eviden');
        } else {
            Session::flash('errors', ['' => 'Menghapus data gagal!']);
            return redirect()->route('eviden');
        }

    }
}
