<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\EncryptionHelper;
use App\Helpers\LogCommon;
use App\Helpers\ResponseConstant;
use App\Helpers\Util;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {

        $id = AuthCommon::user()->id;
        $data = AuthCommon::user();
        return view('pages/user/profile/show', compact('id', 'data'));
    }

    public function edit_profile(Request $request)
    {
        $auth = AuthCommon::user();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:aauth_users,email,'.$auth->id,
        ], [
            'email.unique' => 'Email telah digunakan'
        ]);

        $form = $request->only(['first_name', 'last_name', 'email']);
        $form['username'] = $auth->username;
        $form['id'] = $auth->id;

        if (!User::where('id', $form['id'])->first()) {
            return response([
                "status" => false,
                "message" => "User Tidak Ditemukan",
                "data" => []
            ], 400);
        }


        $update = User::where('id', $form['id'])->update([
            'nama_depan' => $form['first_name'],
            'nama_belakang' => $form['last_name'],
            'email' => $form['email'],
            // 'last_update' => Carbon::now(),
        ]);
        if($update > 0){
            return response([
                "status" => true,
                "message" => ResponseConstant::RM_UPDATE_SUCCESS,
            ], 200);
        }

        return response([
            "status" => false,
            "message" => ResponseConstant::RM_UPDATE_FAILED,
            "data" => []
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updatePassword(Request $request)
    {
        $username = AuthCommon::user()->username;
        $formData = $request->validate([
            'password_lama' => 'required',
            'password_baru' => ['confirmed']
        ], ['confirmed' => 'Password Baru Tidak Cocok']);

        if(!Util::isPasswordValid($request->password_baru, $username)){
            return redirect()->route('profile.index')->with(['change_pas' => ' ', 'error' => 'Password harus terdiri dari setidaknya satu angka (0-9), satu huruf kecil (a-z), satu huruf besar (A-Z), satu karakter khusus (@, #, $, %, ^, &, +, =, !), setidaknya berjumlah 8 dan tidak mengandung username']);
        }

        $id = AuthCommon::user()->id;
        $formData['konfirmasi_password'] = $request->password_baru_confirmation;

        $result = User::where('id', $id)->select('id', 'username', 'password')->first();
        if(!$result){
            return redirect()->route('profile.index')->with(['change_pas' => ' ', 'error' => ResponseConstant::RM_USER_NOT_FOUND]);
        }

        if(!EncryptionHelper::checkPassword($request->password_lama, $id, $result->pass)){
            return redirect()->route('profile.index')->with(['change_pas' => ' ', 'error' => 'Password Lama Salah']);
        }

        $result = User::where('id', $id)->update([
            'updated_at' => Carbon::now(),
            'password' =>  bcrypt($request->password_baru)
        ]);

        if($result){
            $session_data = AuthCommon::user();
            $session_data->last_update = Carbon::now();
            AuthCommon::setUser($session_data);
            LogCommon::save_log($session_data->id, ConstantUtility::LOG_GANTI_PASSWORD, $session_data->id);
            return redirect()->route('profile.index')->with(['change_pas' => ' ', 'success' => "Password Berhasil Diupdate"]);
        }

        return redirect()->route('profile.index')->with(['change_pas' => ' ', 'error' => "Password Gagal Diupdate"]);
    }
}
