<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;

// Models
use App\Models\Anggota;
use App\Models\AnggotaDetail;
use App\Models\KartuKeluarga;
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
        $pdf->setPaper('legal', 'portrait');
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
        $pdf->setPaper('legal', 'portrait');
        $pdf->loadView('pages.cetak.kegiatanWarga', compact(
            'anggota',
            'anggota_detail'
        ));

        return $pdf->stream($anggota->nama . ' ( Kegiatan )' . ".pdf");
    }

    public function cetakRumah($id)
    {
        $data = Rumah::find($id);
        $kk   = KartuKeluarga::where('rumah_id', $id)->get();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('legal', 'landscape');
        $pdf->loadView('pages.cetak.rumah', compact(
            'data',
            'kk'
        ));

        return $pdf->stream($data->kepala_rumah . ".pdf");
    }

    public function cetakKartuKeluarga($id)
    {
        $data = KartuKeluarga::find($id);
        $anggota = Anggota::where('no_kk', $data->no_kk)->where('status_hidup', 1)->get();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('legal', 'landscape');
        $pdf->loadView('pages.cetak.kartuKeluarga', compact(
            'data',
            'anggota'
        ));

        return $pdf->stream($data->no_kk . ".pdf");
    }
}
