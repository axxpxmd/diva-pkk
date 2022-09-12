<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\AnggotaDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CetakController extends Controller
{
    public function cetakAnggota($id)
    {
        $anggota = Anggota::find($id);
        $anggota_detail = AnggotaDetail::where('anggota_id', $id)->first();

        $umur = Carbon::parse($anggota->tgl_lahir)->age;

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('portrait');
        $pdf->loadView('pages.cetak.anggota', compact(
            'anggota',
            'anggota_detail',
            'umur'
        ));

        return $pdf->stream($anggota->nama . ".pdf");
    }
}
