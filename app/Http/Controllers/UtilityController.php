<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\RTRW;
use App\Models\Rumah;
use App\Models\Dasawisma;
use App\Models\Kelurahan;
use App\Models\KartuKeluarga;

class UtilityController extends Controller
{
    public function kelurahanByKecamatan($id)
    {
        $data = Kelurahan::where('kecamatan_id', $id)->get();

        return $data;
    }

    public function rtrwByKelurahan($id)
    {
        $data = RTRW::where('kelurahan_id', $id)->get();

        return $data;
    }

    public function dasawismaByRTRW($id)
    {
        $data = Dasawisma::where('rtrw_id', $id)->get();

        return $data;
    }

    public function rwByKelurahan($id)
    {
        $data = RTRW::select('rw', 'kelurahan_id')->where('kelurahan_id', $id)->groupBy('rw')->get();

        return $data;
    }

    public function rtByRw(Request $request, $id)
    {
        $kecamatan_id = $request->kecamatan_id;
        $kelurahan_id = $request->kelurahan_id;

        $data = RTRW::where('kecamatan_id', $kecamatan_id)->where('kelurahan_id', $kelurahan_id)->where('rw', $id)->get();

        return $data;
    }

    public function getNoKKByKepalaKeluarga($id)
    {
        $data = KartuKeluarga::find($id);

        return $data;
    }

    public function rumahByDasawisma($id)
    {
        $data = Rumah::where('dasawisma_id', $id)->get();

        return $data;
    }

    public function rumahByRTRW($id)
    {
        $data = Rumah::where('rtrw_id', $id)->get();

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
