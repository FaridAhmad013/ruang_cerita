<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\ResponseConstant;
use App\Helpers\Util;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        $auth = AuthCommon::user();
        if($auth){
            return redirect()->route('dashboard.index');
        }

        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $message = [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];
        $request->validate($rules, $message);

        $result =  User::where('username', $request->username)->select('id', 'username', 'nama_depan', 'nama_belakang', 'email', 'password',  'status', 'role_id')->first();
        if(!$result){
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INVALID_USERNAME_PASSWORD
            ], 400);
        }

        if(!Hash::check($request->password, $result->password)){
            $auth_attemp = intval($result->auth_attemp ?? 0) + 1;
            User::where('username', $request['username'])->update(['auth_attemp' => $auth_attemp]);
            return response([
                'status' => false,
                'message' => ResponseConstant::RM_INVALID_USERNAME_PASSWORD
            ], 400);
        }

        $get_role = Role::find($result->role_id);
        if(!in_array($get_role->role, ['Admin', 'Pengguna'])){
            return response([
                'status' => false,
                'message' => 'Anda Tidak Punya Hak Akses'
            ], 400);
        }


        $data_session = (object) $result->toArray();
        unset($result->password);
        $data_session->role = $get_role;
        AuthCommon::setUser($data_session);

        return response([
            'status' => true,
            'message' => 'Login Berhasil'
        ]);
    }

    public function register(){
        return view('auth.register');
    }

    public function register_process(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users|regex:/^(?!.*[_.]{2})(?![_.])[a-zA-Z0-9._]{3,20}(?<![_.])$/',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',

        ];

        $message = [
            'username.required' => 'Kolom Username tidak boleh kosong',
            'username.unique' => 'Username sudah digunakan',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, titik, dan underscore tanpa simbol berurutan atau di awal/akhir.',
            'nama_depan.required' => 'Kolom Nama Depan tidak boleh kosong',
            'nama_belakang.required' => 'Kolom Nama Belakang tidak boleh kosong',
            'email.required' => 'Kolom Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Kolom Password tidak boleh kosong',
            'password.confirmed' => 'Kolom Password tidak sama',

        ];
        $request->validate($rules, $message);

        if(!Util::isPasswordValid($request->password, $request->username)){
            return response([
                'status' => false,
                'message' => 'Password harus terdiri dari setidaknya satu angka (0-9), satu huruf kecil (a-z), satu huruf besar (A-Z), satu karakter khusus (@, #, $, %, ^, &, +, =, !), setidaknya berjumlah 8 dan tidak mengandung username'
            ], 400);
        }

        $formData = $request->only([
            'username',
            'nama_depan',
            'nama_belakang',
            'email',
            'password',
        ]);

        $formData['password'] = bcrypt($formData['password']);
        $formData['status'] = true;
        $formData['role_id'] = 2;

        try {
            User::create($formData);

            return response([
                'status' => true,
                'message' => 'Berhasil Menambahkan Data'
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Gagal Menambahkan Data'
            ], 400);
        }

    }

    public function logout()
    {
        AuthCommon::logout();
        return redirect('/');
    }


}
