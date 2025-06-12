<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\ResponseConstant;
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

    public function logout()
    {
        AuthCommon::logout();
        return redirect('/');
    }


}
