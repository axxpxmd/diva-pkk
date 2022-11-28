<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;

class ValidasiSuratController extends Controller
{
    public function validasiRT($id)
    {
        $data = Pengajuan::find($id);

        return view('pages.validasi.suratRT', compact('data'));
    }

    public function validasiRW($id)
    {
        $data = Pengajuan::find($id);

        return view('pages.validasi.suratRW', compact('data'));
    }
}
