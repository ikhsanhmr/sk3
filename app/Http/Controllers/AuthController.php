<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Adldap\Laravel\Facades\Adldap;
use Adldap\Exceptions\AdldapException;
use Carbon\Carbon;
use App\Models\KantorInduk;
use App\Models\UnitLevel2;
use App\Models\UnitLevel3;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    public function showFormLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.login');
    }

    public function login(request $request){

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi'
        ];
        // $data = [
        //     'email' => $request->email,
        //     'password' => $request->password
        // ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        Auth::attempt(['email'=>$request->email,'password'=>$request->password,'verifikasi_user'=>'1']);

        if(Auth::check()){
            return redirect()->route('dashboard');
        }

        $verifikasi = User::where('email', $request->email)->where('verifikasi_user','0')->first();

        // $verifikasi_user = User::where('verifikasi_user','0')->first();

       $dataUser = User::where('email', $request->email)->first();


        if($verifikasi != NULL ){
                Session::flash('error', 'User belum di verifikasi oleh admin');
                return redirect()->route('login');
        }


        if(empty($dataUser)){
            return redirect()->route('register');
        }else{
            Session::flash('error', 'Email atau password salah');
                return redirect()->route('login');
            }
        }

        public function showFormRegister()
        {
            $kantor_induk = KantorInduk::all();
            return view('admin.register',['kantor_induk' => $kantor_induk]);
        }


        public function get_unitlevel2(request $request){

            $id_kantor_induk = $request->kantor_induk;

            $unit_level2 = UnitLevel2::where('kantor_induk_id',$id_kantor_induk)->get();

            $option = "<option value='' disabled selected >- - - P i l i h - - -</option>";

            echo $option;

            foreach($unit_level2 as $UnitLevel2){

                $option1 = "<option value='$UnitLevel2->id'>$UnitLevel2->nama_unit_level2</option>";

                echo $option1;

            }

        }

        public function get_unitlevel3(request $request){

            $id_unit_level2 = $request->unit_level2;

            $unit_level3 = UnitLevel3::where('unit_level2_id',$id_unit_level2)->get();

            foreach($unit_level3 as $UnitLevel3){

            $option = "<option value='$UnitLevel3->id'>$UnitLevel3->nama_unit_level3</option>";

            echo $option;
            }
        }

            public function register(Request $request)
        {
            $rules = [
                'name' => 'required|min:3|max:35',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
                'nip' => 'required',
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
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->all);
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
            $user->role_id = 2;
            $user->KodeUnit_kantor_induk = $KodeUnit_kantor_induk;
            $user->KodeUnit_unit_level2 = $KodeUnit_level2;
            $user->KodeUnit_unit_level3 = $KodeUnit_level3;
            $user->id_kantor_induk = $request->kantor_induk;
            $user->id_unit_level2 = $request->unit_level2;
            $user->id_unit_level3 = $request->unit_level3;
            $user->verifikasi_user = '0';
            $user->password = Hash::make($request->password);
            $simpan = $user->save();

            if ($simpan) {
                Session::flash('success', 'Register berhasil! Tunggu admin menverifikasi akun anda');
                return redirect()->route('login');
            } else {
                Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
                return redirect()->route('register');
            }
        }

        public function logout()
        {
            Auth::logout();
            return redirect()->route('login');
        }

}


