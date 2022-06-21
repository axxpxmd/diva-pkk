<?php

namespace App\Http\Controllers;

use App\Models\Dasawisma;

// Models
use App\Models\RTRW;
use App\Models\Kelurahan;

class UtilityController extends Controller
{
    public function kelurahanByKecamatan($id)
    {
        $data = Kelurahan::where('kecamatan_id', $id)->get();

        return $data;
    }

    public function dasawismaByRTRW($id)
    {
        $rtrw = RTRW::find($id);
        $rtrws = RTRW::select('id')->where('kelurahan_id', $rtrw->kelurahan_id)->get()->toArray();

        $data = Dasawisma::whereIn('rtrw_id', $rtrws)->get();

        return $data;
    }
}
