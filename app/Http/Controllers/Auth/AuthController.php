<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\ResponseConstant;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
            'g-recaptcha-response.required' => 'Recaptcha wajib dilengkapi',
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];

        if (!env('RECAPTCHA')) {
            unset($rules['g-recaptcha-response']);
            unset($message['g-recaptcha-response.required']);
        }
        $request->validate($rules, $message);

        $result =  User::where('username', $request->username)->select('id', 'username', 'nama_depan', 'nama_belakang', 'email', 'password',  'status')->first();
        if(!$result){
            return redirect()->route('auth.login')->with(['error' => ResponseConstant::RM_INVALID_USERNAME_PASSWORD]);
        }

        // if(!EncryptionHelper::checkPassword($request->password, $result->id, $result->pass)){
        //     $auth_attemp = intval($result->auth_attemp ?? 0) + 1;
        //     DB::table('aauth_users')->where('username', $request['username'])->update(['auth_attemp' => $auth_attemp]);
        //     LogCommon::save_log($result->id, ConstantUtility::LOG_GAGAL_LOGIN, $result->id);
        //     return redirect()->route('auth.login')->with(['error' => ResponseConstant::RM_INVALID_USERNAME_PASSWORD]);
        // }

        // $get_role = DB::table('aauth_user_to_group')
        //     ->join('aauth_groups', 'aauth_user_to_group.group_id', '=', 'aauth_groups.id')
        //     ->where('aauth_user_to_group.user_id', $result->id)
        //     ->first();

        // if(!in_array($get_role->name, ['Admin Bpr', 'Web Admin', 'Admin', 'Admin SMKI', 'Web Admin Perbarindo', 'Konsultan SMKI'])){
        //     LogCommon::save_log($result->id, ConstantUtility::LOG_GAGAL_LOGIN, $result->id);
        //     return redirect()->route('auth.login')->with(['error' => 'Anda Tidak Punya Hak Akses']);
        // }

        //cek apakah user menggunakan mfa atau tidak
        // if($result->enabled_mfa == 1){
        //     $data = '';
        //     $bumbu = '';
        //     $mie = '';
        //     if($result->mfa_secret == '' || $result->mfa_secret == null){
        //         $otp = TOTP::create();
        //         $generate_secret = $otp->getSecret();
        //         $otp->setLabel('SMKI-PERBARINDO');

        //         AauthUser::findOrFail($result->id)->update([
        //             'mfa_secret' => $generate_secret,
        //             // 'last_update' => Carbon::now()
        //         ]);

        //         $data = [
        //             'qr' => $otp->getProvisioningUri()
        //         ];
        //     }

        //     $sedap = EncryptionHelper::encToken(json_encode(['id' => $result->id]));
        //     $bumbu = $sedap['iv'];
        //     $mie = $sedap['encryptedData'];
        //     return view('admin.login2Fa', compact('data', 'bumbu', 'mie'));
        // }

        $ip_address = $request->server('REMOTE_ADDR');
        if($ip_address == '::1'){
            $ip_address = '127.0.0.1';
        }
        if(substr_count($ip_address, '.') != 3){
            return redirect(route('auth.login'))->with(['error' => "Invalid IP Address"]);
        }
        // AauthUser::where('username', $request->username)->update(['last_ip_address' => $ip_address]);

        $data_session = (object) $result->toArray();
        if($result->bpr != null){
            $data_session->bpr = (object) $result->_bpr;
            // if($result->smki_account != 1) LogCommon::save_log($result->id, ConstantUtility::LOG_ACTIVATION_SMKI_ACCOUNT, $result->id);
            $result->update(['smki_account' => 1]);
        } else{
            unset($data_session->bpr);
        }
        unset($get_role->user_id);
        unset($get_role->group_id);
        unset($result->pass);
        // $data_session->role = $get_role;
        $data_session->last_ip_address = $ip_address;
        AuthCommon::setUser($data_session);
        // LogCommon::save_log($result->id, ConstantUtility::LOG_BERHASIL_LOGIN, $result->id);

        return redirect()->route('dashboard.index');
    }
}
