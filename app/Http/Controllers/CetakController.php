<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;

// Models
use App\Models\Anggota;
use App\Models\AnggotaDetail;
use App\Models\Rumah;

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
        $pdf->loadView('pages.cetak.dataWarga', compact(
            'anggota',
            'anggota_detail',
            'umur'
        ));

        return $pdf->stream($anggota->nama . ' ( Data )' . ".pdf");
    }

    public function cetakKegiatanWarga($id)
    {
        $anggota = Anggota::find($id);
        $anggota_detail = AnggotaDetail::where('anggota_id', $id)->first();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('portrait');
        $pdf->loadView('pages.cetak.kegiatanWarga', compact(
            'anggota',
            'anggota_detail'
        ));

        return $pdf->stream($anggota->nama . ' ( Kegiatan )' . ".pdf");
    }

    public function cetakRumah($id)
    {
        $data = Rumah::find($id);

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('a4', 'landscape');
        $pdf->loadView('pages.cetak.rumah', compact(
            'data'
        ));

        return $pdf->stream($data->kepala_rumah . ".pdf");
    }
}
