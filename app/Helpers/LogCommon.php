<?php

namespace App\Helpers;

use App\Models\AauthUser;
use App\Models\LogActivitySmki;
use Carbon\Carbon;

class LogCommon{
    static function save_log($target_id, $activity, $action_by_id)
    {
        try {
            $target = AauthUser::findOrFail($target_id);
            $action = AauthUser::findOrFail($action_by_id);
            $log = [];
            if ($target->_bpr) {
                $log['bpr_id'] = $target->_bpr->id;
                $log['bpr_name'] = strtoupper($target->_bpr->perusahaan->name . ' ' . $target->_bpr->jenis_bank . ' ' . $target->_bpr->name);
            }
            $log['activity'] = $activity;
            $log['activity_date'] = Carbon::now();
            $log['username'] = $target->username;
            $log['user_json'] = json_encode([
                'id' => $target->id,
                'username' => $target->username,
                'fullname' => $target->first_name . ' ' . $target->last_name
            ]);

            $log['action_by'] = $action->username;
            $log['action_by_user'] = json_encode([
                'id' => $action->id,
                'username' => $action->username,
                'fullname' => $action->first_name . ' ' . $action->last_name
            ]);
            LogActivitySmki::create($log);
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
        }
    }
}
