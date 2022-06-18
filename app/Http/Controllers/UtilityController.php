<?php

namespace App\Http\Controllers;

use App\Models\Dasawisma;
use Illuminate\Http\Request;

// Models
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
        $data = Dasawisma::where('rtrw_id', $id)->get();

        return $data;
    }
}
