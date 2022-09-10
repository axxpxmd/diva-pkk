<?php

namespace App\Http\Controllers;

use App\Models\Dasawisma;
use App\Models\KartuKeluarga;

// Models
use App\Models\RTRW;
use App\Models\Kelurahan;
use App\Models\Rumah;

class UtilityController extends Controller
{
    public function kelurahanByKecamatan($id)
    {
        $data = Kelurahan::where('kecamatan_id', $id)->get();

        return $data;
    }

    public function dasawismaByRTRW($id)
    {
        $rtrw  = RTRW::find($id);
        $rtrws = RTRW::select('id')->where('kelurahan_id', $rtrw->kelurahan_id)->get()->toArray();

        $data = Dasawisma::whereIn('rtrw_id', $rtrws)->get();

        return $data;
    }

    public function getNoKKByKepalaKeluarga($id)
    {
        $data = KartuKeluarga::find($id);

        return $data;
    }

    public function nokkByRumah($id)
    {
        $data = KartuKeluarga::where('rumah_id', $id)->get();

        return $data;
    }

    public function getDetailRumah($id)
    {
        $data = Rumah::find($id);

        return $data;
    }
}
