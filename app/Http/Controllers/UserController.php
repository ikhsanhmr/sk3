<?php

namespace App\Http\Controllers;

use App\Models\UnitLevel3;
use App\Models\Role;
use App\Models\User;
use App\Models\KantorInduk;
use App\Models\UnitLevel2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $users = User::orderBy('created_at','DESC')->get();
            $kantor_induk = KantorInduk::all();
            $roles = Role::all();
            return view('user.index', ['users' => $users, 'kantor_induk' => $kantor_induk,'roles'=>$roles]);
        } else {
            return redirect()->route('login');
        }
    }

    public function add(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:35',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'nip' => 'required|unique:users,nip',
            'role' => 'required'
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 35 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password',
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP sudah terdaftar',
            'role.required' => 'Role wajib di isi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


        if($request->kantor_induk != NULL){
            $kantor_induk = KantorInduk::where('id',$request->kantor_induk)->first();
            $KodeUnit_kantor_induk = $kantor_induk->kode_unit;
        }else{
            $KodeUnit_kantor_induk = NULL;
        }

        if($request->unit_level2 != NULL){
            $unit_level2 = UnitLevel2::where('id',$request->unit_level2)->first();
            $KodeUnit_level2 = $unit_level2->kode_unit;
        }else{
            $KodeUnit_level2 = NULL;
        }

        if($request->unit_level3 != NULL){
            $unit_level3 = UnitLevel3::where('id',$request->unit_level3)->first();
            $KodeUnit_level3 = $unit_level3->kode_unit;
        }else{
            $KodeUnit_level3 = NULL;
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->nip = $request->nip;
        $user->password = Hash::make($request->password);
        $user->id_kantor_induk = $request->kantor_induk;
        $user->KodeUnit_kantor_induk = $KodeUnit_kantor_induk;
        $user->KodeUnit_unit_level2 = $KodeUnit_level2;
        $user->KodeUnit_unit_level3 = $KodeUnit_level3;
        $user->id_unit_level2 = $request->unit_level2;
        $user->id_unit_level3 = $request->unit_level3;
        $user->role_id = $request->role;
        $user->verifikasi_user = '0';
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Data berhasil ditambah!');
            return redirect()->route('user');
        } else {
            Session::flash('errors', ['' => 'Data gagal ditambah!']);
            return redirect()->route('user');
        }
    }

    public function userAktif($id){
        if(Auth::check()){
        User::where('id',$id)->update([
            'verifikasi_user' => '1'
        ]);
        }
        return back();
    }


    public function userNonaktif($id){
        if(Auth::check()){
        User::where('id',$id)->update([
            'verifikasi_user' => '0'
        ]);
        }
        return back();
    }

    public function edit($id){

        $user = User::where('id',$id)->first();
        $unitUser = User::where('id',$id)->first();
        $roles = Role::all();
        $kantor_induk = KantorInduk::all();
        $unit_level2 = UnitLevel2::where('kantor_induk_id',$user->id_kantor_induk)->get();
        $unit_level3 = UnitLevel3::where('unit_level2_id',$user->id_unit_level2)->get();

        return view('user.editUser',['user'=> $user,'roles'=>$roles,'kantor_induk'=>$kantor_induk,
                                    'unit_level2'=>$unit_level2,'unit_level3'=>$unit_level3]);

    }

    public function update(Request $request,$id)
    {
        $rules = [
            'name' => 'required|min:3|max:35',
            'email' => 'required|email',
            'nip' => 'required',
            // 'password' => 'required|confirmed',
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 35 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'nip.required' => 'NIP wajib diisi',
            // 'password.required' => 'Password wajib diisi',
            // 'password.confirmed' => 'Password tidak sama dengan konfirmasi password',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = User::find($id);

        if($request->password){
            if($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
            }else{
                $request->validate([
                    'password' => 'confirmed'
                ]);
            }
        }

        if($request->kantor_induk != NULL){
            $kantor_induk = KantorInduk::where('id',$request->kantor_induk)->first();
            $KodeUnit_kantor_induk = $kantor_induk->kode_unit;
        }else{
            $KodeUnit_kantor_induk = NULL;
        }

        if($request->unit_level2 != NULL){
            $unit_level2 = UnitLevel2::where('id',$request->unit_level2)->first();
            $KodeUnit_level2 = $unit_level2->kode_unit;
        }else{
            $KodeUnit_level2 = NULL;
        }

        if($request->unit_level3 != NULL){
            $unit_level3 = UnitLevel3::where('id',$request->unit_level3)->first();
            $KodeUnit_level3 = $unit_level3->kode_unit;
        }else{
            $KodeUnit_level3 = NULL;
        }

        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->nip = $request->nip;
        $user->role_id = $request->role;
        $user->KodeUnit_kantor_induk = $KodeUnit_kantor_induk;
        $user->KodeUnit_unit_level2 = $KodeUnit_level2;
        $user->KodeUnit_unit_level3 = $KodeUnit_level3;
        $user->id_kantor_induk = $request->kantor_induk;
        $user->id_unit_level2 = $request->unit_level2;
        $user->id_unit_level3 = $request->unit_level3;
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Data berhasil diubah!');
            return redirect()->back();
        } else {
            Session::flash('errors', ['' => 'Data gagal diubah!']);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $delete = User::find($id)->delete();
        if ($delete) {
            Session::flash('warning', 'Menghapus data berhasil!');
            return redirect()->route('user');
        } else {
            Session::flash('errors', ['' => 'Menghapus data gagal!']);
            return redirect()->route('user');
        }
    }
}
