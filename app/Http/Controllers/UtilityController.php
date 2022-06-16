<?php

namespace App\Http\Controllers;

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
}
