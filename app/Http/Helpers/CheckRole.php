<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public static function getFilterValue()
    {
        $user    = Auth::user();
        $role_id = Auth::user()->modelHasRole->role_id;

        /**
         * Note: role dibawah ini filternya terbuka (tidak disable)
         * 1 : super-admin
         * 9 : admin-dpm
         * 10 : admin-rtrw
         */

        if ($role_id == 1 || $role_id == 9 || $role_id == 10) {
            $dasawisma_id = 0;
            $kecamatan_id = 0;
            $kelurahan_id = 0;
            $rtrw_id = 0;
            $rw = 0;
            $rt = 0;
        } elseif ($role_id == 3 || $role_id == 4) {
            $dasawisma_id = $user->dasawisma_id;
            $kecamatan_id = $user->kecamatan_id;
            $kelurahan_id = $user->kelurahan_id;
            $rtrw_id = $user->rtrw_id;
            $rw = $user->rw;
            $rt = $user->rt;
        } elseif ($role_id == 2) {
            $dasawisma_id = $user->dasawisma_id;
            $kecamatan_id = $user->rtrw->kecamatan_id;
            $kelurahan_id = $user->rtrw->kelurahan_id;
            $rtrw_id = $user->rtrw_id;
            $rw = $user->rtrw->rw;
            $rt = $user->rtrw->rt;
        } elseif ($role_id == 5) {
            $dasawisma_id = 0;
            $kecamatan_id = $user->kecamatan_id;
            $kelurahan_id = $user->kelurahan_id;
            $rtrw_id = 0;
            $rw = 0;
            $rt = 0;
        }

        return [$dasawisma_id, $kecamatan_id, $kelurahan_id, $rtrw_id, $rw, $rt, $role_id];
    }
}
